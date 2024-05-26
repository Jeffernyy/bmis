<?php
// check before declaring to see if it already exists
if (!function_exists('addedGenerateLogMessage')) {
  function addedGenerateLogMessage($announcementData)
  {
    // announcement data fetched
    $logMessage = "added announcement details...\n\n";
    foreach ($announcementData as $key => $value) {
      if (!is_numeric($key)) {
        $logMessage .= $key . ": " . $value . "\n";
      }
    }

    // log session role
    $logMessage .= "\nthis added is done by " . $_SESSION['fname'] . (empty($_SESSION['mname']) || $_SESSION['mname'] === 'n/a' ? "" : " ") . (empty($_SESSION['mname']) || $_SESSION['mname'] === 'n/a' ? "" : $_SESSION['mname']) . " " . $_SESSION['lname'] . " as " . $_SESSION['role'] . "\n";
    $logMessage .= "add announcement id number " . $announcementData['id'] . " for announcement " . $announcementData['announcement'] . "\n";
    $logMessage .= "date and time added " . date('m/d/Y h:i A') . "\n"; // include current date and time
    return rtrim($logMessage, ",\n") . "\n";
  }
}

if (isset($_POST['btn_add'])) {
  $txt_add_announcement = !empty($_POST['txt_add_announcement']) ? strtolower($_POST['txt_add_announcement']) : 'n/a';
  $txt_add_announcement_date = date('m/d/Y h:i A', strtotime($_POST['txt_add_announcement_date']));
  $txt_add_announcement_desc = !empty($_POST['txt_add_announcement_desc']) ? strtolower($_POST['txt_add_announcement_desc']) : 'n/a';

  $txt_add_announcement_date_added = date('m/d/Y h:i A');
  $txt_add_announcement_added_by = $_SESSION['fname'] . (empty($_SESSION['mname']) || $_SESSION['mname'] === 'n/a' ? '' : ' ') . (empty($_SESSION['mname']) || $_SESSION['mname'] === 'n/a' ? '' : $_SESSION['mname']) . ' ' . $_SESSION['lname'] . ' as ' . $_SESSION['role'];
  $txt_add_announcement_user_type = $_SESSION['role'];

  $query = $con->prepare("INSERT INTO tblannouncement (announcement, announcement_date, announcement_description, announcement_date_added, announcement_date_edited, announcement_added_by, announcement_edited_by) VALUES (?, ?, ?, ?, 'n/a', ?, 'n/a')");
  $query->bind_param("sssss", $txt_add_announcement, $txt_add_announcement_date, $txt_add_announcement_desc, $txt_add_announcement_date_added, $txt_add_announcement_added_by);
  $query->execute();

  $id = $query->insert_id;

  if (isset($_FILES['txt_add_announcement_image'])) {
    foreach ($_FILES['txt_add_announcement_image']['tmp_name'] as $key => $tmp_name) {
      $target = "images/";
      $milliseconds = round(microtime(true) * 1000);
      $name = $milliseconds . $_FILES['txt_add_announcement_image']['name'][$key];
      $target = $target . $name;

      if (move_uploaded_file($tmp_name, $target)) {
        $photo_query = $con->prepare("INSERT INTO tblannouncementphoto (announcement_id, announcement_filename) VALUES (?, ?)");
        $photo_query->bind_param("is", $id, $name);
        $photo_query->execute();
      }
    }
  }

  if ($id > 0) {
    // fetch the last inserted household record
    $lastInsertedId = $id;

    // fetch announcement data after the update
    $announcement_data_query = mysqli_prepare($con, "SELECT * FROM tblannouncement WHERE id = ?");
    mysqli_stmt_bind_param($announcement_data_query, "i", $lastInsertedId);
    mysqli_stmt_execute($announcement_data_query);
    $announcement_data_query_result = mysqli_stmt_get_result($announcement_data_query);
    $announcementData = mysqli_fetch_array($announcement_data_query_result, MYSQLI_ASSOC);
    mysqli_stmt_close($announcement_data_query);

    if (isset($_SESSION['role'])) {
      // log the old and new data
      $action = addedGenerateLogMessage($announcementData);
      $log_query = mysqli_prepare($con, "INSERT INTO tbllogs (logs_user_type, logs_fname, logs_lname, logs_logdate, logs_action) VALUES (?, ?, ?, ?, ?)");
      mysqli_stmt_bind_param($log_query, "sssss", $txt_add_announcement_user_type, $_SESSION['fname'], $_SESSION['lname'], $txt_add_announcement_date_added, $action);
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
}

// check before declaring to see if it already exists
if (!function_exists('editedGenerateLogMessage')) {
  function editedGenerateLogMessage($oldData, $newData)
  {
    $logMessage = "edited announcement details...\n\n";

    // old data fetched
    $logMessage .= "old data:\n";
    foreach ($oldData as $key => $value) {
      if (!is_numeric($key)) {
        $logMessage .= $key . ": " . $value . "\n";
      }
    }

    // new data fetched
    $logMessage .= "\nnew data:\n";
    foreach ($newData as $key => $value) {
      if (!is_numeric($key)) {
        $logMessage .= $key . ": " . $value . "\n";
      }
    }

    // log session role
    $logMessage .= "\nthis edit is done by " . $_SESSION['fname'] . (empty($_SESSION['mname']) || $_SESSION['mname'] === 'n/a' ? "" : " ") . (empty($_SESSION['mname']) || $_SESSION['mname'] === 'n/a' ? "" : $_SESSION['mname']) . " " . $_SESSION['lname'] . " as " . $_SESSION['role'] . "\n";
    $logMessage .= "edit announcement id number " . $newData['id'] . " for announcement " . $newData['announcement'] . "\n";
    $logMessage .= "date and time edited " . date('m/d/Y h:i A') . "\n"; // include current date and time
    return rtrim($logMessage, ",\n") . "\n";
  }
}

if (isset($_POST['btn_edit'])) {
  $txt_edit_announcement_user_id = $_POST['hidden_id'];

  // fetch old data before the update
  $oldDataQuery = mysqli_prepare($con, "SELECT * FROM tblannouncement WHERE id = ?");
  mysqli_stmt_bind_param($oldDataQuery, "i", $txt_edit_announcement_user_id);
  mysqli_stmt_execute($oldDataQuery);
  $oldDataResult = mysqli_stmt_get_result($oldDataQuery);
  $oldData = mysqli_fetch_array($oldDataResult, MYSQLI_ASSOC);
  mysqli_stmt_close($oldDataQuery);

  $txt_edit_announcement = !empty($_POST['txt_edit_announcement']) ? strtolower($_POST['txt_edit_announcement']) : 'n/a';
  $txt_edit_announcement_date = date('m/d/Y h:i A', strtotime($_POST['txt_edit_announcement_date']));
  $txt_edit_announcement_desc = !empty($_POST['txt_edit_announcement_desc']) ? strtolower($_POST['txt_edit_announcement_desc']) : 'n/a';

  $txt_edit_announcement_date_edited = date('m/d/Y h:i A');
  $txt_edit_announcement_edited_by = $_SESSION['fname'] . (empty($_SESSION['mname']) || $_SESSION['mname'] === 'n/a' ? '' : ' ') . (empty($_SESSION['mname']) || $_SESSION['mname'] === 'n/a' ? '' : $_SESSION['mname']) . ' ' . $_SESSION['lname'] . ' as ' . $_SESSION['role'];
  $txt_edit_announcement_user_type = $_SESSION['role'];

  $update_query = mysqli_prepare($con, "UPDATE tblannouncement SET announcement = ?, announcement_date = ?, announcement_description = ?, announcement_date_edited = ?, announcement_edited_by = ? WHERE id = ?");
  mysqli_stmt_bind_param($update_query, "sssssi", $txt_edit_announcement, $txt_edit_announcement_date, $txt_edit_announcement_desc, $txt_edit_announcement_date_edited, $txt_edit_announcement_edited_by, $txt_edit_announcement_user_id);
  mysqli_stmt_execute($update_query);

  if ($update_query == true) {
    // fetch new data after the update
    $newDataQuery = mysqli_prepare($con, "SELECT * FROM tblannouncement WHERE id = ?");
    mysqli_stmt_bind_param($newDataQuery, "i", $txt_edit_announcement_user_id);
    mysqli_stmt_execute($newDataQuery);
    $newDataResult = mysqli_stmt_get_result($newDataQuery);
    $newData = mysqli_fetch_array($newDataResult, MYSQLI_ASSOC);
    mysqli_stmt_close($newDataQuery);

    if (isset($_SESSION['role'])) {
      // log the old and new data
      $action = editedGenerateLogMessage($oldData, $newData);
      $log_query = mysqli_prepare($con, "INSERT INTO tbllogs (logs_user_type, logs_fname, logs_lname, logs_logdate, logs_action) VALUES (?, ?, ?, ?, ?)");
      mysqli_stmt_bind_param($log_query, "sssss", $txt_edit_announcement_user_type, $_SESSION['fname'], $_SESSION['lname'], $txt_edit_announcement_date_edited, $action);
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
}

if (isset($_POST['btn_add_announcement_image'])) {
  $txt_add_announcement_user_id = $_POST['hidden_id'];

  if (isset($_FILES['images'])) {
    foreach ($_FILES['images']['tmp_name'] as $key => $tmp_name) {
      $target = "images/";
      $milliseconds = round(microtime(true) * 1000);
      $name = $milliseconds . $_FILES['images']['name'][$key];
      $target = $target . $name;

      if (move_uploaded_file($tmp_name, $target)) {
        $query = mysqli_query($con, "INSERT INTO tblannouncementphoto (announcement_id, announcement_filename) VALUES ('$txt_add_announcement_user_id', '" . $name . "')") or die('Error: ' . mysqli_error($con));

        if ($query == true) {
          $message = "Success";
          $_SESSION['success'] = $message;
          header("location: " . $_SERVER['REQUEST_URI']);
        }

      } else {
        $message = "Error";
        $_SESSION['error'] = $message;
        header("location: " . $_SERVER['REQUEST_URI']);
        exit();
      }
    }

  } else {
    $message = "Error";
    $_SESSION['error'] = $message;
    header("location: " . $_SERVER['REQUEST_URI']);
    exit();
  }
}

if (isset($_POST['btn_del_announcement_image'])) {
  if (isset($_POST['chk_deletephoto']) && is_array($_POST['chk_deletephoto'])) {
    // validate and sanitize each selected ID
    $validIds = array_map('intval', $_POST['chk_deletephoto']);
    // remove non-numeric values
    $validIds = array_filter($validIds, 'is_numeric');

    if (!empty($validIds)) {
      $placeholders = implode(', ', array_fill(0, count($validIds), '?'));
      $delete_query = mysqli_prepare($con, "DELETE FROM tblannouncementphoto WHERE id IN ($placeholders)");

      $types = str_repeat('i', count($validIds));
      mysqli_stmt_bind_param($delete_query, $types, ...$validIds);

      if (mysqli_stmt_execute($delete_query)) {
        $message = "Success";
        $_SESSION['success'] = $message;
        header("location: " . $_SERVER['REQUEST_URI']);

      } else {
        $message = "Error";
        $_SESSION['error'] = $message;
        header("location: " . $_SERVER['REQUEST_URI']);
        exit();
      }

    } else {
      $message = "Error";
      $_SESSION['error'] = $message;
      header("location: " . $_SERVER['REQUEST_URI']);
      exit();
    }

  } else {
    $message = "Error";
    $_SESSION['error'] = $message;
    header("location: " . $_SERVER['REQUEST_URI']);
    exit();
  }
}

// check before declaring to see if it already exists
if (!function_exists('deletedGenerateLogMessage')) {
  function deletedGenerateLogMessage($announcementData)
  {
    // data fetched
    $logMessage = "deleted announcement details before deletion...\n\n";
    foreach ($announcementData as $key => $value) {
      if (!is_numeric($key)) {
        $logMessage .= $key . ": " . $value . "\n";
      }
    }

    // log session role
    $logMessage .= "\nthis delete is done by " . $_SESSION['fname'] . (empty($_SESSION['mname']) || $_SESSION['mname'] === 'n/a' ? "" : " ") . (empty($_SESSION['mname']) || $_SESSION['mname'] === 'n/a' ? "" : $_SESSION['mname']) . " " . $_SESSION['lname'] . " as " . $_SESSION['role'] . "\n";
    $logMessage .= "delete announcement id number " . $announcementData['id'] . " for announcement " . $announcementData['announcement'] . "\n";
    $logMessage .= "date and time deleted " . date('m/d/Y h:i A') . "\n"; // include current date and time
    return rtrim($logMessage, ",\n") . "\n";
  }
}

if (isset($_POST['btn_delete'])) {

  if (isset($_POST['chk_delete']) && is_array($_POST['chk_delete'])) {

    $txt_delete_announcement_date_deleted = date('m/d/Y h:i A');
    // validate and sanitize each selected ids
    $validIds = array_map('intval', $_POST['chk_delete']);
    // remove non-numeric values
    $validIds = array_filter($validIds, 'is_numeric');

    if (!empty($validIds)) {
      // fetch the data before deleted for logging
      $placeholders = implode(', ', array_fill(0, count($validIds), '?'));

      // fetch the data to be deleted
      $deletedDataQuery = mysqli_prepare($con, "SELECT * FROM tblannouncement WHERE id IN ($placeholders)");
      mysqli_stmt_bind_param($deletedDataQuery, str_repeat('i', count($validIds)), ...$validIds);
      mysqli_stmt_execute($deletedDataQuery);
      $deletedDataResult = mysqli_stmt_get_result($deletedDataQuery);

      // log each deleted record
      while ($deletedData = mysqli_fetch_array($deletedDataResult, MYSQLI_ASSOC)) {
        $action = deletedGenerateLogMessage($deletedData);
        $log_query = mysqli_prepare($con, "INSERT INTO tbllogs (logs_user_type, logs_fname, logs_lname, logs_logdate, logs_action) VALUES (?, ?, ?, ?, ?)");
        mysqli_stmt_bind_param($log_query, "sssss", $_SESSION['role'], $_SESSION['fname'], $_SESSION['lname'], $txt_delete_announcement_date_deleted, $action);
        mysqli_stmt_execute($log_query);
      }

      // prepare and execute the deletion query
      $delete_query = mysqli_prepare($con, "DELETE FROM tblannouncement WHERE id IN ($placeholders)");

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