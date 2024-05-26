<?php
// Set custom session name
session_name("BMISSESSID");

// ensure that session is only maintained using cookies
ini_set('session.use_only_cookies', 1);

// enable strict session mode
ini_set('session.use_strict_mode', 1);

// set session cookie parameters for security
session_set_cookie_params([
  'lifetime' => 1800, // session lifetime in seconds 30 minutes
  'path' => '/', // path on the server where the cookie will be available
  'domain' => 'localhost', // replace localhost with new domain after deployment
  'secure' => true, // use secure connection https for cookie transmission
  'httponly' => true, // restrict cookie access to http only to prevent js access
  'samesite' => 'Strict' // prevent cross site request forgery csrf attacks
]);

// start or resume the session
session_start();

// check if session regeneration is needed
if (needs_session_regeneration()) {
  regenerate_session_id();
}

// function to check if session regeneration is needed
function needs_session_regeneration()
{
  // check if last session regeneration time is not set
  if (!isset($_SESSION['last_session_regeneration'])) {
    return true;
  }

  // regenerate session id after 30 minutes in 1800 seconds
  $interval = 1800;

  // check if the time since last regeneration exceeds the interval
  if (time() - $_SESSION['last_session_regeneration'] >= $interval) {
    return true;
  }

  return false;
}

// function to regenerate session id
function regenerate_session_id()
{
  // regenerate session id to prevent session fixation
  session_regenerate_id(true);
  $_SESSION['last_session_regeneration'] = time();
}

// Check session timeout
function check_session_timeout()
{
  $timeout = 1800; // 30 minutes in seconds

  // check if last activity time is set
  if (isset($_SESSION['last_activity'])) {
    // calculate time difference
    $inactive_time = time() - $_SESSION['last_activity'];

    // check if inactive time exceeds timeout period
    if ($inactive_time >= $timeout) {
      // destroy session
      session_unset();
      session_destroy();
      // redirect to login page
      header('location: login.php');
      exit;
    }
  }

  // update last activity time
  $_SESSION['last_activity'] = time();
}

// check session timeout on every page load
check_session_timeout();
