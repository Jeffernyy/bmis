<?php
use Dotenv\Dotenv;

require __DIR__ . '../../vendor/autoload.php';

$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();

function check_if_banned($login_attempt = false, $login_success = false)
{
  $limit = 7;

  // retrieve database connection parameters from environment variables
  $_ENV['DB_HOST'];
  $_ENV['DB_NAME'];
  $_ENV['DB_USER'];
  $_ENV['DB_PASS'];

  // define database connection parameters only if not already defined
  if (!defined('DB_HOST')) {
    define('DB_HOST', $_ENV['DB_HOST']);
  }

  if (!defined('DB_USER')) {
    define('DB_USER', $_ENV['DB_USER']);
  }

  if (!defined('DB_PASS')) {
    define('DB_PASS', $_ENV['DB_PASS']);
  }

  if (!defined('DB_NAME')) {
    define('DB_NAME', $_ENV['DB_NAME']);
  }

  // establish the database connection
  $con = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);

  // check if the connection was successful
  if (!$con) {
    die("Error: " . mysqli_connect_error());
  }

  $ip = get_ip();

  $query = "SELECT * FROM tblloginattempts WHERE login_attempts_ip_address  = ?";
  $stm = $con->prepare($query);
  $stm->bind_param("s", $ip);
  $stm->execute();
  $result = $stm->get_result();
  $row = $result->fetch_assoc();

  if ($row) {
    $time = time();
    if ($row['login_attempts_time_banned'] > $time) {
      // banned
      header("location: denied.php");
      die();

    } else {

      if ($login_attempt) {

        if ($row['login_attempts_count'] >= $limit) {
          $query = "UPDATE tblloginattempts SET login_attempts_time_banned = ?, login_attempts_count = 0 WHERE id = ? LIMIT 1";
          $expire = ($time + (60 * 2));
          $stm = $con->prepare($query);
          $stm->bind_param("ii", $expire, $row['id']);
          $stm->execute();
          return;

        } elseif ($login_success) {
          // success
          $query = "UPDATE tblloginattempts SET login_attempts_count = 0 WHERE id = ? LIMIT 1";
          $stm = $con->prepare($query);
          $stm->bind_param("i", $row['id']);
          $stm->execute();

        } else {
          // failure
          $query = "UPDATE tblloginattempts SET login_attempts_count = login_attempts_count + 1 WHERE id = ? LIMIT 1";
          $stm = $con->prepare($query);
          $stm->bind_param("i", $row['id']);
          $stm->execute();
        }
      }
    }

    return;
  }

  $login_attempts_count = 0;
  $login_attempts_time_banned = 0;
  $query = "INSERT INTO tblloginattempts (login_attempts_ip_address , login_attempts_count, login_attempts_time_banned) VALUES (?, ?, ?)";
  $stm = $con->prepare($query);
  $stm->bind_param("sii", $ip, $login_attempts_count, $login_attempts_time_banned);
  $stm->execute();
}

function get_ip()
{
  $ip = "";

  if (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
    return $_SERVER['HTTP_X_FORWARDED_FOR'];
  }

  if (isset($_SERVER['REMOTE_ADDR'])) {
    return $_SERVER['REMOTE_ADDR'];
  }

  if (isset($_SERVER['HTTP_X_REAL_IP'])) {
    return $_SERVER['HTTP_X_REAL_IP'];
  }

  return $ip;
}