<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// define constants for role names
define('ROLE_ADMINISTRATOR', 'administrator');
define('ROLE_CAPTAIN', 'captain');
define('ROLE_STAFF', 'staff');
define('ROLE_RESIDENT', 'resident');

require_once "include/session.inc.php";

// check if user is logged in
if (isset($_SESSION['userid'])) {

  // validate user role and redirect accordingly
  switch ($_SESSION['role']) {

    case ROLE_ADMINISTRATOR:
      header('location: pages/dashboard/dashboard.php');
      break;

    case ROLE_CAPTAIN:
      header('location: pages/announcement/announcement.php');
      break;

    case ROLE_STAFF:
      header('location: pages/officials/officials.php');
      break;

    case ROLE_RESIDENT:
      header('location: pages/clearance/clearance.php');
      break;

    default:

      header('location: main/index.php');
      break;
  }
  exit;
}

require "include/banned.inc.php";
check_if_banned();

// function to verify captcha response
function verifyCaptcha($response)
{
  // verify the captcha response using the recaptcha library
  $secretKey = getenv('GOOGLE_CAPTCHA_API_KEY');
  $recaptcha = new \ReCaptcha\ReCaptcha($secretKey);
  $captchaResponse = $recaptcha->verify($response, $_SERVER['REMOTE_ADDR']);
  return $captchaResponse->isSuccess();
}

// logging code
$log_username = isset($_POST['txt_log_uname']) ? ucwords(strtolower($_POST['txt_log_uname'])) : "username";
$log_role = isset($_POST['txt_log_user_role']) ? ucwords(strtolower($_POST['txt_log_user_role'])) : "role";

if (isset($_POST['btn_login'])) {
  $username = $_POST['txt_log_uname'];
  $password = $_POST['txt_log_pword'];
  $txt_log_user_role = isset($_POST['txt_log_user_role']) ? $_POST['txt_log_user_role'] : '';

  require_once "include/db.inc.php";

  // Verify captcha response
  $captchaResponse = isset($_POST['g-recaptcha-response']) ? $_POST['g-recaptcha-response'] : '';

  if (empty($captchaResponse)) {
    // Handle case where captcha response is empty
    ?>
    <script>
      $(document).ready(function () {
        let timerInterval;
        Swal.fire({
          icon: "error",
          html: "Error<br><br>Please complete the recaptcha verification to continue login.<br><br>Will close in <b></b> milliseconds.",
          timer: 7000,
          timerProgressBar: true,
          position: "center",
          allowOutsideClick: true,
          didOpen: () => {
            Swal.showLoading();
            const timer = Swal.getPopup().querySelector("b");
            timerInterval = setInterval(() => {
              timer.textContent = `${Swal.getTimerLeft()}`;
            }, 100);
          },
          willClose: () => {
            clearInterval(timerInterval);
          }
        }).then((result) => {
          if (result.dismiss === Swal.DismissReason.timer) {
            console.log("I was closed by the timer");
          }
        });
      });
    </script>
    <?php
  } else {
    // Verify the captcha response
    if (!verifyCaptcha($captchaResponse)) {
      // Handle case where captcha verification fails
      ?>
      <script>
        $(document).ready(function () {
          let timerInterval;
          Swal.fire({
            icon: "error",
            html: "Error<br><br>Oops! It looks like there was an issue verifying the recaptcha. Please try again.<br><br>Will close in <b></b> milliseconds.",
            timer: 7000,
            timerProgressBar: true,
            position: "center",
            allowOutsideClick: true,
            didOpen: () => {
              Swal.showLoading();
              const timer = Swal.getPopup().querySelector("b");
              timerInterval = setInterval(() => {
                timer.textContent = `${Swal.getTimerLeft()}`;
              }, 100);
            },
            willClose: () => {
              clearInterval(timerInterval);
            }
          }).then((result) => {
            if (result.dismiss === Swal.DismissReason.timer) {
              console.log("I was closed by the timer");
            }
          });
        });
      </script>
      <?php
    } else {

      // login proccess and validation
      if (empty($username) || empty($password)) { ?>
        <script>
          $(document).ready(function () {
            let timerInterval;
            Swal.fire({
              icon: "error",
              html: "Error<br><br>Please fill out both username and password fields.<br><br>Will close in <b></b> milliseconds.",
              timer: 7000,
              timerProgressBar: true,
              position: "center",
              allowOutsideClick: true,
              didOpen: () => {
                Swal.showLoading();
                const timer = Swal.getPopup().querySelector("b");
                timerInterval = setInterval(() => {
                  timer.textContent = `${Swal.getTimerLeft()}`;
                }, 100);
              },
              willClose: () => {
                clearInterval(timerInterval);
              }
            }).then((result) => {
              if (result.dismiss === Swal.DismissReason.timer) {
                console.log("I was closed by the timer");
              }
            });
          });
        </script>
        <?php

      } else {

        switch ($txt_log_user_role) {

          case 'administrator':
            $stmt = mysqli_prepare($con, "SELECT id, admin_fname, admin_mname, admin_lname, admin_uname, admin_upass, admin_image FROM tbluser WHERE admin_uname = ? AND admin_user_type = 'administrator'");
            break;

          case 'captain':
            $stmt = mysqli_prepare($con, "SELECT id, captain_fname, captain_mname, captain_lname, captain_uname, captain_upass, captain_image FROM tblcaptain WHERE captain_uname = ?");
            break;

          case 'staff':
            $stmt = mysqli_prepare($con, "SELECT id, staff_fname, staff_mname, staff_lname, staff_uname, staff_upass, staff_image FROM tblstaff WHERE staff_uname = ?");
            break;

          case 'resident':
            $stmt = mysqli_prepare($con, "SELECT id, resident_fname, resident_mname, resident_lname, resident_uname, resident_upass, resident_image FROM tblresident WHERE resident_uname = ?");
            break;

          default:

            // handle invalid role
            ?>
            <script>
              $(document).ready(function () {
                let timerInterval;
                Swal.fire({
                  icon: "error",
                  html: "Error<br><br>Please sign in with your role.<br><br>Will close in <b></b> milliseconds.",
                  timer: 7000,
                  timerProgressBar: true,
                  position: "center",
                  allowOutsideClick: true,
                  didOpen: () => {
                    Swal.showLoading();
                    const timer = Swal.getPopup().querySelector("b");
                    timerInterval = setInterval(() => {
                      timer.textContent = `${Swal.getTimerLeft()}`;
                    }, 100);
                  },
                  willClose: () => {
                    clearInterval(timerInterval);
                  }
                }).then((result) => {
                  if (result.dismiss === Swal.DismissReason.timer) {
                    console.log("I was closed by the timer");
                  }
                });
              });
            </script>
            <?php
            break;
        }

        if (isset($stmt)) {
          mysqli_stmt_bind_param($stmt, "s", $username);
          mysqli_stmt_execute($stmt);
          mysqli_stmt_store_result($stmt);
          $numrow = mysqli_stmt_num_rows($stmt);

          if ($numrow > 0) {
            mysqli_stmt_bind_result($stmt, $user_id, $user_fname, $user_mname, $user_lname, $user_username, $hashed_password, $user_avatar);
            mysqli_stmt_fetch($stmt);

            // verify the hashed password
            if (password_verify($password, $hashed_password)) {

              // regenerate session id to prevent session fixation
              session_regenerate_id(true);

              // store data to the session after successful login
              $_SESSION['userid'] = $user_id;
              $_SESSION['fname'] = $user_fname;
              $_SESSION['mname'] = $user_mname;
              $_SESSION['lname'] = $user_lname;
              $_SESSION['profile'] = $user_avatar;
              $_SESSION['role'] = $txt_log_user_role;

              // redirect user based on role
              switch ($txt_log_user_role) {

                case 'administrator':
                  $_SESSION['name'] = $user_username;
                  check_if_banned(true, true);
                  header('location: pages/dashboard/dashboard.php');
                  break;

                case 'captain':
                  $_SESSION['name'] = $user_username;
                  check_if_banned(true, true);
                  header('location: pages/announcement/announcement.php');
                  break;

                case 'staff':
                  $_SESSION['username'] = $user_username;
                  check_if_banned(true, true);
                  header('location: pages/officials/officials.php');
                  break;

                case 'resident':
                  $_SESSION['resident'] = 1;
                  $_SESSION['username'] = $user_username;
                  check_if_banned(true, true);
                  header('location: pages/clearance/clearance.php');
                  break;
              }

              exit;

              // handle invalid login and show a message
            } else { ?>
              <script>
                $(document).ready(function () {
                  let timerInterval;
                  Swal.fire({
                    icon: "error",
                    html: "Error<br><br>Invalid username or password. Please ensure they are correct to login.<br><br>Will close in <b></b> milliseconds.",
                    timer: 7000,
                    timerProgressBar: true,
                    position: "center",
                    allowOutsideClick: true,
                    didOpen: () => {
                      Swal.showLoading();
                      const timer = Swal.getPopup().querySelector("b");
                      timerInterval = setInterval(() => {
                        timer.textContent = `${Swal.getTimerLeft()}`;
                      }, 100);
                    },
                    willClose: () => {
                      clearInterval(timerInterval);
                    }
                  }).then((result) => {
                    if (result.dismiss === Swal.DismissReason.timer) {
                      console.log("I was closed by the timer");
                    }
                  });
                });
              </script>
              <?php
            }

          } else { ?>

            <script>
              $(document).ready(function () {
                let timerInterval;
                Swal.fire({
                  icon: "error",
                  html: "Error<br><br>Invalid username or password. Please ensure they are correct to login.<br><br>Will close in <b></b> milliseconds.",
                  timer: 7000,
                  timerProgressBar: true,
                  position: "center",
                  allowOutsideClick: true,
                  didOpen: () => {
                    Swal.showLoading();
                    const timer = Swal.getPopup().querySelector("b");
                    timerInterval = setInterval(() => {
                      timer.textContent = `${Swal.getTimerLeft()}`;
                    }, 100);
                  },
                  willClose: () => {
                    clearInterval(timerInterval);
                  }
                }).then((result) => {
                  if (result.dismiss === Swal.DismissReason.timer) {
                    console.log("I was closed by the timer");
                  }
                });
              });
            </script>
            <?php
          }
          mysqli_stmt_close($stmt);
        }
      }
    }
  }
  check_if_banned(true, false);
}