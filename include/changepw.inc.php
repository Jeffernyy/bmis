<?php
if (isset($_POST['btn_change_users_pass'])) {
  $txt_change_uname = $_POST['txt_change_uname'];
  $txt_change_pword = $_POST['txt_change_pword'];
  $txt_confirm_pword = $_POST['txt_confirm_pword'];
  $txt_change_pword_skey = $_POST['txt_change_pword_skey'];

  // check if password field is empty
  if (empty($txt_change_pword)) {
    $message = "The password cannot be empty. Please ensure your password is not empty.";
    $_SESSION['warning'] = $message;
    header("location: " . $_SERVER['REQUEST_URI']);
    exit();
  }

  // check if passwords match
  if ($txt_change_pword !== $txt_confirm_pword) {
    $message = "The passwords do not match. Please ensure your passwords match.";
    $_SESSION['warning'] = $message;
    header("location: " . $_SERVER['REQUEST_URI']);
    exit();
  }

  // use prepared statements to prevent sql injection
  $updateQuery = null;
  $selectQuery = null;
  $hashedPassword = password_hash($txt_change_pword, PASSWORD_DEFAULT);

  // prepare and execute the update query
  if ($_SESSION['role'] === "administrator") {
    $updateQuery = mysqli_prepare($con, "UPDATE tbluser SET admin_upass = ? WHERE id = ? AND admin_uname = ?");
    $selectQuery = mysqli_prepare($con, "SELECT admin_uname FROM tbluser WHERE id = ?");

  } elseif ($_SESSION['role'] === "captain") {
    $updateQuery = mysqli_prepare($con, "UPDATE tblcaptain SET captain_upass = ? WHERE id = ? AND captain_uname = ?");
    $selectQuery = mysqli_prepare($con, "SELECT captain_uname FROM tblcaptain WHERE id = ?");

  } elseif ($_SESSION['role'] === "staff") {
    $updateQuery = mysqli_prepare($con, "UPDATE tblstaff SET staff_upass = ? WHERE id = ? AND staff_uname = ?");
    $selectQuery = mysqli_prepare($con, "SELECT staff_uname FROM tblstaff WHERE id = ?");

  } elseif ($_SESSION['role'] === "resident") {
    $updateQuery = mysqli_prepare($con, "UPDATE tblresident SET resident_upass = ? WHERE id = ? AND resident_secret_key = ?");
    $selectQuery = mysqli_prepare($con, "SELECT resident_secret_key FROM tblresident WHERE id = ?");
  }

  // check if prepared statements were successfully created
  if ($updateQuery && $selectQuery) {
    // bind parameters and execute the query to select the original username or secret key
    mysqli_stmt_bind_param($selectQuery, 'i', $_SESSION['userid']);
    mysqli_stmt_execute($selectQuery);
    mysqli_stmt_store_result($selectQuery);

    // check if the query was successful
    if (mysqli_stmt_num_rows($selectQuery) > 0) {
      // fetch the original username or secret key
      mysqli_stmt_bind_result($selectQuery, $originalValue);
      mysqli_stmt_fetch($selectQuery);

      // check if the new value matches the original value
      if ($_SESSION['role'] === "resident") {
        if ($txt_change_pword_skey === $originalValue) {
          // execute the update query
          mysqli_stmt_bind_param($updateQuery, 'sis', $hashedPassword, $_SESSION['userid'], $txt_change_pword_skey);
          mysqli_stmt_execute($updateQuery);

          // check if the password was successfully updated
          if (mysqli_stmt_affected_rows($updateQuery) > 0) {
            // destroy the current session
            session_unset(); // unset all session variables
            session_destroy(); // destroy the session data

            // set success message
            $message = "Password changed successfully.";
            $_SESSION['success'] = $message;
            header("location: ../../login.php"); // redirect to the login page
            exit();

          } else {
            // display an error message if the update query fails
            $message = "You have failed to update your password.";
            $_SESSION['error'] = $message;
            header("location: " . $_SERVER['REQUEST_URI']);
            exit();
          }

        } else {
          // display an error message if the new secret key does not match the original secret key
          $message = "The secret key does not match the data in the database. You will get the secret key sent to your mobile number during your initial registration.";
          $_SESSION['error'] = $message;
          header("location: " . $_SERVER['REQUEST_URI']);
          exit();
        }

      } else {
        // for non resident users
        // compare the entered username with the original username fetched from the database
        if ($txt_change_uname === $originalValue) {
          // execute the update query
          mysqli_stmt_bind_param($updateQuery, 'sis', $hashedPassword, $_SESSION['userid'], $txt_change_uname);
          mysqli_stmt_execute($updateQuery);

          // check if the password was successfully updated
          if (mysqli_stmt_affected_rows($updateQuery) > 0) {
            // destroy the current session
            session_unset(); // unset all session variables
            session_destroy(); // destroy the session data

            // set success message
            $message = "Password changed successfully.";
            $_SESSION['success'] = $message;
            header("location: ../../login.php"); // redirect to the login page
            exit();

          } else {
            // display an error message if the update query fails
            $message = "You have failed to update your password.";
            $_SESSION['error'] = $message;
            header("location: " . $_SERVER['REQUEST_URI']);
            exit();
          }

        } else {
          // display an error message if the new username does not match the original username
          $message = "The username does not match the data in the database. Please ensure that your username matches the one you are currently using.";
          $_SESSION['error'] = $message;
          header("location: " . $_SERVER['REQUEST_URI']);
          exit();
        }
      }

    } else {
      // display an error message if the select query fails
      $message = "Error fetching original data.";
      $_SESSION['error'] = $message;
      header("location: " . $_SERVER['REQUEST_URI']);
      exit();
    }

  } else {
    // display an error message if prepared statements failed to create
    $message = "Error preparing statements.";
    $_SESSION['error'] = $message;
    header("location: " . $_SERVER['REQUEST_URI']);
    exit();
  }

  // close the statements if they were successfully prepared
  if ($updateQuery) {
    mysqli_stmt_close($updateQuery);
  }

  if ($selectQuery) {
    mysqli_stmt_close($selectQuery);
  }
}