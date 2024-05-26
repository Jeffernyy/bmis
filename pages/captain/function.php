<?php
// check before declaring to see if it already exists
if (!function_exists('addedGenerateLogMessage')) {
  function addedGenerateLogMessage($captainData)
  {
    // household data fetched
    $logMessage = "added barangay captain details...\n\n";
    $logMessage .= "id: " . $captainData['id'] . "\n";
    $logMessage .= "captain_fname: " . $captainData['captain_fname'] . "\n";
    $logMessage .= "captain_mname: " . $captainData['captain_mname'] . "\n";
    $logMessage .= "captain_lname: " . $captainData['captain_lname'] . "\n";
    $logMessage .= "captain_uname: " . $captainData['captain_uname'] . "\n";
    $logMessage .= "captain_date_added: " . $captainData['captain_date_added'] . "\n";
    $logMessage .= "captain_date_edited: " . $captainData['captain_date_edited'] . "\n";
    $logMessage .= "captain_added_by: " . $captainData['captain_added_by'] . "\n";
    $logMessage .= "captain_edited_by: " . $captainData['captain_edited_by'] . "\n\n";

    // log session role
    $logMessage .= "this add is done by " . $_SESSION['fname'] . (empty($_SESSION['mname']) || $_SESSION['mname'] === 'n/a' ? "" : " ") . (empty($_SESSION['mname']) || $_SESSION['mname'] === 'n/a' ? "" : $_SESSION['mname']) . " " . $_SESSION['lname'] . " as " . $_SESSION['role'] . "\n";
    $logMessage .= "add barangay captain id number " . $captainData['id'] . " for barangay captain " . $captainData['captain_res_name'] . "\n";
    $logMessage .= "date and time added " . date('m/d/Y h:i A') . "\n";
    return rtrim($logMessage, ",\n") . "\n";
  }
}

if (isset($_POST['btn_add'])) {
  $txt_add_captain_fname = !empty($_POST['txt_add_captain_fname']) ? strtolower($_POST['txt_add_captain_fname']) : 'n/a';
  $txt_add_captain_mname = !empty($_POST['txt_add_captain_mname']) ? strtolower($_POST['txt_add_captain_mname']) : 'n/a';
  $txt_add_captain_lname = !empty($_POST['txt_add_captain_lname']) ? strtolower($_POST['txt_add_captain_lname']) : 'n/a';

  $txt_add_captain_uname = !empty($_POST['txt_add_captain_uname']) ? strtolower($_POST['txt_add_captain_uname']) : 'n/a';
  $txt_add_captain_upass = !empty($_POST['txt_add_captain_upass']) ? $_POST['txt_add_captain_upass'] : 'n/a';

  $txt_add_captain_date_added = date('m/d/Y h:i A');
  $txt_add_captain_added_by = $_SESSION['fname'] . (empty($_SESSION['mname']) || $_SESSION['mname'] === 'n/a' ? '' : ' ') . (empty($_SESSION['mname']) || $_SESSION['mname'] === 'n/a' ? '' : $_SESSION['mname']) . ' ' . $_SESSION['lname'] . ' as ' . $_SESSION['role'];
  $txt_add_captain_user_type = $_SESSION['role'];

  $name = basename($_FILES['txt_add_captain_image']['name']);
  $temp = $_FILES['txt_add_captain_image']['tmp_name'];
  $imagetype = $_FILES['txt_add_captain_image']['type'];
  $size = $_FILES['txt_add_captain_image']['size'];

  $milliseconds = round(microtime(true) * 1000);
  $image = $milliseconds . '_' . $name;

  // hash the password using PASSWORD_DEFAULT
  $txt_add_captain_hashed_pass = password_hash($txt_add_captain_upass, PASSWORD_DEFAULT);

  $stmt = mysqli_prepare($con, "SELECT captain_uname FROM tblcaptain WHERE captain_uname = ?");
  mysqli_stmt_bind_param($stmt, 's', $txt_add_captain_uname);
  mysqli_stmt_execute($stmt);
  mysqli_stmt_store_result($stmt);
  $res_add_check = mysqli_stmt_num_rows($stmt);

  if ($res_add_check == 0) {

    if ($name != "") {

      if (($imagetype == "image/jpeg" || $imagetype == "image/jpg" || $imagetype == "image/png")) {
        // check if the file size is within the limit
        if ($size <= 2048000) {
          // move uploaded file to destination
          if (move_uploaded_file($temp, 'images/' . $image)) {
            $txt_add_captain_image = $image;

          } else {
            // File upload failed
            $message = "File upload failed. Please try again later.";
            $_SESSION['error'] = $message;
            header("location: " . $_SERVER['REQUEST_URI']);
            exit();
          }

        } else {
          // file size exceeds the limit
          $message = "File size exceeds the limit. Please upload a file up to 2MB in size.";
          $_SESSION['error'] = $message;
          header("location: " . $_SERVER['REQUEST_URI']);
          exit();
        }

      } else {
        // invalid file format
        $message = "Unsupported file format. Only jpeg, jpg, and png files are allowed.";
        $_SESSION['error'] = $message;
        header("location: " . $_SERVER['REQUEST_URI']);
        exit();
      }

    } else {
      $txt_add_captain_image = 'default.png';
    }

    $query = mysqli_prepare($con, "INSERT INTO tblcaptain (captain_fname, captain_mname, captain_lname, captain_uname, captain_upass, captain_image, captain_date_added, captain_date_edited, captain_added_by, captain_edited_by) VALUES (?, ?, ?, ?, ?, ?, ?, 'n/a', ?, 'n/a')");
    mysqli_stmt_bind_param($query, 'ssssssss', $txt_add_captain_fname, $txt_add_captain_mname, $txt_add_captain_lname, $txt_add_captain_uname, $txt_add_captain_hashed_pass, $txt_add_captain_image, $txt_add_captain_date_added, $txt_add_captain_added_by);
    mysqli_stmt_execute($query);

    if (mysqli_stmt_affected_rows($query) > 0) {
      // fetch the last inserted household record
      $lastInsertedId = mysqli_insert_id($con);

      // fetch new data after the update
      $captainDataQuery = mysqli_prepare($con, "SELECT *,CONCAT(captain_fname, IF(captain_mname = 'n/a', '', CONCAT(' ', captain_mname)), ' ', captain_lname) as captain_res_name FROM tblcaptain WHERE id = ?");
      mysqli_stmt_bind_param($captainDataQuery, "i", $lastInsertedId);
      mysqli_stmt_execute($captainDataQuery);
      $captainDataQueryResult = mysqli_stmt_get_result($captainDataQuery);
      $captainData = mysqli_fetch_array($captainDataQueryResult, MYSQLI_ASSOC);
      mysqli_stmt_close($captainDataQuery);

      if (isset($_SESSION['role'])) {
        // log the old and new data
        $action = addedGenerateLogMessage($captainData);
        $log_query = mysqli_prepare($con, "INSERT INTO tbllogs (logs_user_type, logs_fname, logs_lname, logs_logdate, logs_action) VALUES (?, ?, ?, ?, ?)");
        mysqli_stmt_bind_param($log_query, "sssss", $txt_add_captain_user_type, $_SESSION['fname'], $_SESSION['lname'], $txt_add_captain_date_added, $action);
        mysqli_stmt_execute($log_query);
      }

      $message = "Success";
      $_SESSION['success'] = $message;
      header("location: " . $_SERVER['REQUEST_URI']);
      exit();

    } else {
      $message = "Error";
      $_SESSION['error'] = $message;
      header("location: " . $_SERVER['REQUEST_URI']);
      exit();
    }

  } else {
    $message = "Warning";
    $_SESSION['warning'] = $message;
    header("location: " . $_SERVER['REQUEST_URI']);
    exit();
  }
}

// check before declaring to see if it already exists
if (!function_exists('editedGenerateLogMessage')) {
  function editedGenerateLogMessage($oldData, $newData)
  {
    // old data fetched
    $logMessage = "edited barangay captain details...\n\n";
    $logMessage .= "old data:\n";
    $logMessage .= "id: " . $oldData['id'] . "\n";
    $logMessage .= "captain_fname: " . $oldData['captain_fname'] . "\n";
    $logMessage .= "captain_mname: " . $oldData['captain_mname'] . "\n";
    $logMessage .= "captain_lname: " . $oldData['captain_lname'] . "\n";
    $logMessage .= "captain_uname: " . $oldData['captain_uname'] . "\n";
    $logMessage .= "captain_date_added: " . $oldData['captain_date_added'] . "\n";
    $logMessage .= "captain_date_edited: " . $oldData['captain_date_edited'] . "\n";
    $logMessage .= "captain_added_by: " . $oldData['captain_added_by'] . "\n";
    $logMessage .= "captain_edited_by: " . $oldData['captain_edited_by'] . "\n\n";

    // new data fetched
    $logMessage .= "new data:\n";
    $logMessage .= "id: " . $newData['id'] . "\n";
    $logMessage .= "captain_fname: " . $newData['captain_fname'] . "\n";
    $logMessage .= "captain_mname: " . $newData['captain_mname'] . "\n";
    $logMessage .= "captain_lname: " . $newData['captain_lname'] . "\n";
    $logMessage .= "captain_uname: " . $newData['captain_uname'] . "\n";
    $logMessage .= "captain_date_added: " . $newData['captain_date_added'] . "\n";
    $logMessage .= "captain_date_edited: " . $newData['captain_date_edited'] . "\n";
    $logMessage .= "captain_added_by: " . $newData['captain_added_by'] . "\n";
    $logMessage .= "captain_edited_by: " . $newData['captain_edited_by'] . "\n\n";

    // log session role
    $logMessage .= "this edit is done by " . $_SESSION['fname'] . (empty($_SESSION['mname']) || $_SESSION['mname'] === 'n/a' ? "" : " ") . (empty($_SESSION['mname']) || $_SESSION['mname'] === 'n/a' ? "" : $_SESSION['mname']) . " " . $_SESSION['lname'] . " as " . $_SESSION['role'] . "\n";
    $logMessage .= "edit barangay captain id number " . $newData['id'] . " for barangay captain " . $newData['captain_res_name'] . "\n";
    $logMessage .= "date and time edited " . date('m/d/Y h:i A') . "\n";
    return rtrim($logMessage, ",\n") . "\n";
  }
}

if (isset($_POST['btn_edit'])) {
  $txt_edit_captain_user_id = $_POST['hidden_id'];

  // fetch old data before the update using prepared statement
  $oldDataQuery = mysqli_prepare($con, "SELECT *,CONCAT(captain_fname, IF(captain_mname = 'n/a', '', CONCAT(' ', captain_mname)), ' ', captain_lname) as captain_res_name FROM tblcaptain WHERE id = ?");
  mysqli_stmt_bind_param($oldDataQuery, "i", $txt_edit_captain_user_id);
  mysqli_stmt_execute($oldDataQuery);
  $oldDataResult = mysqli_stmt_get_result($oldDataQuery);
  $oldData = mysqli_fetch_array($oldDataResult, MYSQLI_ASSOC);
  mysqli_stmt_close($oldDataQuery);

  $txt_edit_captain_fname = !empty($_POST['txt_edit_captain_fname']) ? strtolower($_POST['txt_edit_captain_fname']) : 'n/a';
  $txt_edit_captain_mname = !empty($_POST['txt_edit_captain_mname']) ? strtolower($_POST['txt_edit_captain_mname']) : 'n/a';
  $txt_edit_captain_lname = !empty($_POST['txt_edit_captain_lname']) ? strtolower($_POST['txt_edit_captain_lname']) : 'n/a';

  // Check if username or password is modified
  $chk_credentials = mysqli_query($con, "SELECT captain_uname, captain_upass FROM tblcaptain WHERE id = '" . $txt_edit_captain_user_id . "'");
  $row_credentials = mysqli_fetch_array($chk_credentials);
  // If username or password is not modified, use the existing values
  $txt_edit_captain_uname = !empty($_POST['txt_edit_captain_uname']) ? strtolower($_POST['txt_edit_captain_uname']) : $row_credentials['captain_uname'];
  $txt_edit_captain_upass = !empty($_POST['txt_edit_captain_upass']) ? $_POST['txt_edit_captain_upass'] : $row_credentials['captain_upass'];
  // Hash the password only if it is modified
  $txt_edit_captain_hashed_upass = !empty($_POST['txt_edit_captain_upass']) ? password_hash($txt_edit_captain_upass, PASSWORD_DEFAULT) : $row_credentials['captain_upass'];

  $txt_edit_captain_date_edited = date('m/d/Y h:i A');
  $txt_edit_captain_edited_by = $_SESSION['fname'] . (empty($_SESSION['mname']) || $_SESSION['mname'] === 'n/a' ? '' : ' ') . (empty($_SESSION['mname']) || $_SESSION['mname'] === 'n/a' ? '' : $_SESSION['mname']) . ' ' . $_SESSION['lname'] . ' as ' . $_SESSION['role'];
  $txt_edit_captain_user_type = $_SESSION['role'];

  $name = basename($_FILES['txt_edit_captain_image']['name']);
  $temp = $_FILES['txt_edit_captain_image']['tmp_name'];
  $imagetype = $_FILES['txt_edit_captain_image']['type'];
  $size = $_FILES['txt_edit_captain_image']['size'];

  $milliseconds = round(microtime(true) * 1000);
  $image = $milliseconds . '_' . $name;

  // check if the username already exists after edited
  // planning to use email instead of using local username because email is more unique and secure for users
  $stmt = mysqli_prepare($con, "SELECT captain_uname FROM tblcaptain WHERE captain_uname = ? AND id <> ?");
  mysqli_stmt_bind_param($stmt, 'si', $txt_edit_captain_uname, $txt_edit_captain_user_id);
  mysqli_stmt_execute($stmt);
  mysqli_stmt_store_result($stmt);
  $res_edit_check = mysqli_stmt_num_rows($stmt);

  if ($res_edit_check == 0) {
    if ($name != "") {
      if (($imagetype == "image/jpeg" || $imagetype == "image/jpg" || $imagetype == "image/png")) {
        // check if the file size is within the limit
        if ($size <= 2048000) {
          // move uploaded file to destination
          if (move_uploaded_file($temp, 'images/' . $image)) {
            $txt_edit_captain_image = $image;
          } else {
            $message = "File upload failed. Please try again later.";
            $_SESSION['error'] = $message;
            header("location: " . $_SERVER['REQUEST_URI']);
            exit();
          }
        } else {
          // file size exceeds the limit
          $message = "File size exceeds the limit. Please upload a file up to 2MB in size.";
          $_SESSION['error'] = $message;
          header("location: " . $_SERVER['REQUEST_URI']);
          exit();
        }
      } else {
        // invalid file format
        $message = "Unsupported file format. Only jpeg, jpg, and png files are allowed.";
        $_SESSION['error'] = $message;
        header("location: " . $_SERVER['REQUEST_URI']);
        exit();
      }
    } else {
      $chk_image = mysqli_query($con, "SELECT * FROM tblcaptain WHERE id = '" . $_POST['hidden_id'] . "'");
      $rowimg = mysqli_fetch_array($chk_image);
      $txt_edit_captain_image = $rowimg['captain_image'];
    }

    $update_query = mysqli_query($con, "UPDATE tblcaptain SET captain_fname = '" . $txt_edit_captain_fname . "', captain_mname = '" . $txt_edit_captain_mname . "', captain_lname = '" . $txt_edit_captain_lname . "', captain_uname = '" . $txt_edit_captain_uname . "', captain_upass = '" . $txt_edit_captain_hashed_upass . "', captain_image = '" . $txt_edit_captain_image . "', captain_date_edited = '" . $txt_edit_captain_date_edited . "', captain_edited_by = '" . $txt_edit_captain_edited_by . "' WHERE id = '" . $txt_edit_captain_user_id . "'") or die('Error: ' . mysqli_error($con));

    if ($update_query == true) {
      // fetch new data after the update
      $newDataQuery = mysqli_prepare($con, "SELECT *,CONCAT(captain_fname, IF(captain_mname = 'n/a', '', CONCAT(' ', captain_mname)), ' ', captain_lname) as captain_res_name FROM tblcaptain WHERE id = ?");
      mysqli_stmt_bind_param($newDataQuery, "i", $txt_edit_captain_user_id);
      mysqli_stmt_execute($newDataQuery);
      $newDataResult = mysqli_stmt_get_result($newDataQuery);
      $newData = mysqli_fetch_array($newDataResult, MYSQLI_ASSOC);
      mysqli_stmt_close($newDataQuery);

      if (isset($_SESSION['role'])) {
        // log the old and new data
        $action = editedGenerateLogMessage($oldData, $newData);
        $log_query = mysqli_prepare($con, "INSERT INTO tbllogs (logs_user_type, logs_fname, logs_lname, logs_logdate, logs_action) VALUES (?, ?, ?, ?, ?)");
        mysqli_stmt_bind_param($log_query, "sssss", $txt_edit_captain_user_type, $_SESSION['fname'], $_SESSION['lname'], $txt_edit_captain_date_edited, $action);
        mysqli_stmt_execute($log_query);
      }

      $message = "Success";
      $_SESSION['success'] = $message;
      header("location: " . $_SERVER['REQUEST_URI']);
      exit();

    } else {
      $message = "Error";
      $_SESSION['error'] = $message;
      header("location: " . $_SERVER['REQUEST_URI']);
      exit();
    }

  } else {
    $message = "Warning";
    $_SESSION['warning'] = $message;
    header("location: " . $_SERVER['REQUEST_URI']);
    exit();
  }
}

// check before declaring to see if it already exists
if (!function_exists('deletedGenerateLogMessage')) {
  function deletedGenerateLogMessage($captainData)
  {
    // data fetched
    $logMessage = "deleted barangay captain details before deletion...\n\n";
    $logMessage .= "id: " . $captainData['id'] . "\n";
    $logMessage .= "captain_fname: " . $captainData['captain_fname'] . "\n";
    $logMessage .= "captain_mname: " . $captainData['captain_mname'] . "\n";
    $logMessage .= "captain_lname: " . $captainData['captain_lname'] . "\n";
    $logMessage .= "captain_uname: " . $captainData['captain_uname'] . "\n";
    $logMessage .= "captain_date_added: " . $captainData['captain_date_added'] . "\n";
    $logMessage .= "captain_date_edited: " . $captainData['captain_date_edited'] . "\n";
    $logMessage .= "captain_added_by: " . $captainData['captain_added_by'] . "\n";
    $logMessage .= "captain_edited_by: " . $captainData['captain_edited_by'] . "\n\n";

    // log session role
    $logMessage .= "this delete is done by " . $_SESSION['fname'] . (empty($_SESSION['mname']) || $_SESSION['mname'] === 'n/a' ? "" : " ") . (empty($_SESSION['mname']) || $_SESSION['mname'] === 'n/a' ? "" : $_SESSION['mname']) . " " . $_SESSION['lname'] . " as " . $_SESSION['role'] . "\n";
    $logMessage .= "delete barangay captain id number " . $captainData['id'] . " for barangay captain " . $captainData['resident_res_name'] . "\n";
    $logMessage .= "date and time deleted " . date('m/d/Y h:i A') . "\n";
    return rtrim($logMessage, ",\n") . "\n";
  }
}

if (isset($_POST['btn_delete'])) {

  if (isset($_POST['chk_delete']) && is_array($_POST['chk_delete'])) {

    $txt_delete_captain_date_deleted = date('m/d/Y h:i A');
    // validate and sanitize each selected ids
    $validIds = array_map('intval', $_POST['chk_delete']);
    // remove non-numeric values
    $validIds = array_filter($validIds, 'is_numeric');

    if (!empty($validIds)) {
      // fetch the data before deleted for logging
      $placeholders = implode(', ', array_fill(0, count($validIds), '?'));

      // fetch the data to be deleted
      $deletedDataQuery = mysqli_prepare($con, "SELECT *, CONCAT(captain_fname, IF(captain_mname = 'n/a', '', CONCAT(' ', captain_mname)), ' ', captain_lname) as resident_res_name FROM tblcaptain WHERE id IN ($placeholders)");
      mysqli_stmt_bind_param($deletedDataQuery, str_repeat('i', count($validIds)), ...$validIds);
      mysqli_stmt_execute($deletedDataQuery);
      $deletedDataResult = mysqli_stmt_get_result($deletedDataQuery);

      // log each deleted record
      while ($deletedData = mysqli_fetch_array($deletedDataResult, MYSQLI_ASSOC)) {
        $action = deletedGenerateLogMessage($deletedData);
        $log_query = mysqli_prepare($con, "INSERT INTO tbllogs (logs_user_type, logs_fname, logs_lname, logs_logdate, logs_action) VALUES (?, ?, ?, ?, ?)");
        mysqli_stmt_bind_param($log_query, "sssss", $_SESSION['role'], $_SESSION['fname'], $_SESSION['lname'], $txt_delete_captain_date_deleted, $action);
        mysqli_stmt_execute($log_query);
      }

      // prepare and execute the deletion query
      $delete_query = mysqli_prepare($con, "DELETE FROM tblcaptain WHERE id IN ($placeholders)");

      // bind parameters
      $types = str_repeat('i', count($validIds));
      mysqli_stmt_bind_param($delete_query, $types, ...$validIds);

      if (mysqli_stmt_execute($delete_query)) {

        $message = "Success";
        $_SESSION['success'] = $message;
        header("location: " . $_SERVER['REQUEST_URI']);
        exit();

      } else {
        $message = "Error";
        $_SESSION['error'] = $message;
        header("location: " . $_SERVER['REQUEST_URI']);
        exit();
      }
    }
  }
}