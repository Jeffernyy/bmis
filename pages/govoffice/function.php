<?php
if (!function_exists('addedGenerateLogMessage')) {
  function addedGenerateLogMessage($gov_office_data)
  {
    // government office data fetched
    $logMessage = "added government office details...\n\n";
    foreach ($gov_office_data as $key => $value) {
      if (!is_numeric($key)) {
        $logMessage .= $key . ": " . $value . "\n";
      }
    }

    // log session role
    $logMessage .= "\nthis add is done by " . $_SESSION['fname'] . (empty ($_SESSION['mname']) || $_SESSION['mname'] === 'n/a' ? "" : " ") . (empty ($_SESSION['mname']) || $_SESSION['mname'] === 'n/a' ? "" : $_SESSION['mname']) . " " . $_SESSION['lname'] . " as " . $_SESSION['role'] . "\n";
    $logMessage .= "add government office id number " . $gov_office_data['id'] . " for government office " . $gov_office_data['gov_office'] . "\n";
    $logMessage .= "date and time added " . date('m/d/Y h:i A') . "\n"; // include current date and time
    return rtrim($logMessage, ",\n") . "\n";
  }
}

if (isset ($_POST['btn_add'])) {
  $txt_add_gov_office = !empty ($_POST['txt_add_gov_office']) ? $_POST['txt_add_gov_office'] : 'n/a';

  $txt_add_gov_office_date_added = date('m/d/Y h:i A');
  $txt_add_gov_office_added_by = $_SESSION['fname'] . (empty ($_SESSION['mname']) || $_SESSION['mname'] === 'n/a' ? '' : ' ') . (empty ($_SESSION['mname']) || $_SESSION['mname'] === 'n/a' ? '' : $_SESSION['mname']) . ' ' . $_SESSION['lname'] . ' as ' . $_SESSION['role'];
  $txt_add_gov_office_user_type = $_SESSION['role'];

  $stmt = mysqli_prepare($con, "SELECT gov_office FROM tblgovoffice WHERE gov_office = ?");
  mysqli_stmt_bind_param($stmt, 's', $txt_add_gov_office);
  mysqli_stmt_execute($stmt);
  mysqli_stmt_store_result($stmt);
  $num_rows = mysqli_stmt_num_rows($stmt);

  if ($num_rows == 0) {
    $query = mysqli_prepare($con, "INSERT INTO tblgovoffice (gov_office, gov_office_date_added, gov_office_date_edited, gov_office_added_by, gov_office_edited_by) VALUES (?, ?, 'n/a', ?, 'n/a')");
    mysqli_stmt_bind_param($query, 'sss', $txt_add_gov_office, $txt_add_gov_office_date_added, $txt_add_gov_office_added_by);
    mysqli_stmt_execute($query);

    if (mysqli_stmt_affected_rows($query) > 0) {
      // fetch the last inserted household record
      $lastInsertedId = mysqli_insert_id($con);

      // fetch new data after the update
      $gov_off_data_query = mysqli_prepare($con, "SELECT * FROM tblgovoffice WHERE id = ?");
      mysqli_stmt_bind_param($gov_off_data_query, "i", $lastInsertedId);
      mysqli_stmt_execute($gov_off_data_query);
      $gov_office_data_query_result = mysqli_stmt_get_result($gov_off_data_query);
      $gov_office_data = mysqli_fetch_array($gov_office_data_query_result, MYSQLI_ASSOC);
      mysqli_stmt_close($gov_off_data_query);

      if (isset ($_SESSION['role'])) {
        // log the old and new data
        $action = addedGenerateLogMessage($gov_office_data);
        $log_query = mysqli_prepare($con, "INSERT INTO tbllogs (logs_user_type, logs_fname, logs_lname, logs_logdate, logs_action) VALUES (?, ?, ?, ?, ?)");
        mysqli_stmt_bind_param($log_query, "sssss", $txt_add_gov_office_user_type, $_SESSION['fname'], $_SESSION['lname'], $txt_add_gov_office_date_added, $action);
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

if (!function_exists('editedGenerateLogMessage')) {
  function editedGenerateLogMessage($oldData, $newData)
  {
    $logMessage = "edited government office details...\n\n";

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
    $logMessage .= "\nthis edit is done by " . $_SESSION['fname'] . (empty ($_SESSION['mname']) || $_SESSION['mname'] === 'n/a' ? "" : " ") . (empty ($_SESSION['mname']) || $_SESSION['mname'] === 'n/a' ? "" : $_SESSION['mname']) . " " . $_SESSION['lname'] . " as " . $_SESSION['role'] . "\n";
    $logMessage .= "edit government office id number " . $newData['id'] . " for government office " . $newData['gov_office'] . "\n";
    $logMessage .= "date and time edited " . date('m/d/Y h:i A') . "\n"; // include current date and time
    return rtrim($logMessage, ",\n") . "\n";
  }
}

if (isset ($_POST['btn_edit'])) {
  $txt_edit_gov_office_user_id = $_POST['hidden_id'];

  // fetch old data before the update
  $oldDataQuery = mysqli_prepare($con, "SELECT * FROM tblgovoffice WHERE id = ?");
  mysqli_stmt_bind_param($oldDataQuery, "i", $txt_edit_gov_office_user_id);
  mysqli_stmt_execute($oldDataQuery);
  $oldDataResult = mysqli_stmt_get_result($oldDataQuery);
  $oldData = mysqli_fetch_array($oldDataResult, MYSQLI_ASSOC);
  mysqli_stmt_close($oldDataQuery);

  $txt_edit_gov_office = !empty ($_POST['txt_edit_gov_office']) ? $_POST['txt_edit_gov_office'] : 'n/a';

  $txt_edit_gov_office_date_edited = date('m/d/Y h:i A');
  $txt_edit_gov_office_edited_by = $_SESSION['fname'] . (empty ($_SESSION['mname']) || $_SESSION['mname'] === 'n/a' ? '' : ' ') . (empty ($_SESSION['mname']) || $_SESSION['mname'] === 'n/a' ? '' : $_SESSION['mname']) . ' ' . $_SESSION['lname'] . ' as ' . $_SESSION['role'];
  $txt_edit_gov_office_user_type = $_SESSION['role'];

  $update_query = mysqli_prepare($con, "UPDATE tblgovoffice SET gov_office = ?, gov_office_date_edited = ?, gov_office_edited_by = ? WHERE id = ?");
  mysqli_stmt_bind_param($update_query, "sssi", $txt_edit_gov_office, $txt_edit_gov_office_date_edited, $txt_edit_gov_office_edited_by, $txt_edit_gov_office_user_id);
  $update_success = mysqli_stmt_execute($update_query);

  if ($update_success) {
    // fetch new data after the update
    $newDataQuery = mysqli_prepare($con, "SELECT * FROM tblgovoffice WHERE id = ?");
    mysqli_stmt_bind_param($newDataQuery, "i", $txt_edit_gov_office_user_id);
    mysqli_stmt_execute($newDataQuery);
    $newDataResult = mysqli_stmt_get_result($newDataQuery);
    $newData = mysqli_fetch_array($newDataResult, MYSQLI_ASSOC);
    mysqli_stmt_close($newDataQuery);

    if (isset ($_SESSION['role'])) {
      // log the old and new data
      $action = editedGenerateLogMessage($oldData, $newData);
      $log_query = mysqli_prepare($con, "INSERT INTO tbllogs (logs_user_type, logs_fname, logs_lname, logs_logdate, logs_action) VALUES (?, ?, ?, ?, ?)");
      mysqli_stmt_bind_param($log_query, "sssss", $txt_edit_gov_office_user_type, $_SESSION['fname'], $_SESSION['lname'], $txt_edit_gov_office_date_edited, $action);
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
if (!function_exists('deletedGenerateLogMessage')) {
  function deletedGenerateLogMessage($govOfficeData)
  {
    // purpose data fetched
    $logMessage = "deleted government office details before deletion...\n\n";
    foreach ($govOfficeData as $key => $value) {
      if (!is_numeric($key)) {
        $logMessage .= $key . ": " . $value . "\n";
      }
    }

    // log session role
    $logMessage .= "\nthis delete is done by " . $_SESSION['fname'] . (empty ($_SESSION['mname']) || $_SESSION['mname'] === 'n/a' ? "" : " ") . (empty ($_SESSION['mname']) || $_SESSION['mname'] === 'n/a' ? "" : $_SESSION['mname']) . " " . $_SESSION['lname'] . " as " . $_SESSION['role'] . "\n";
    $logMessage .= "delete government office id number " . $govOfficeData['id'] . " for government office " . $govOfficeData['gov_office'] . "\n";
    $logMessage .= "date and time deleted " . date('m/d/Y h:i A') . "\n"; // include current date and time
    return rtrim($logMessage, ",\n") . "\n";
  }
}

if (isset ($_POST['btn_delete'])) {

  if (isset ($_POST['chk_delete']) && is_array($_POST['chk_delete'])) {

    $txt_delete_gov_office_date_deleted = date('m/d/Y h:i A');
    // validate and sanitize each selected ids
    $validIds = array_map('intval', $_POST['chk_delete']);
    // remove non-numeric values
    $validIds = array_filter($validIds, 'is_numeric');

    if (!empty ($validIds)) {
      // fetch the data before deleted for logging
      $placeholders = implode(', ', array_fill(0, count($validIds), '?'));

      // fetch the data to be deleted
      $deletedDataQuery = mysqli_prepare($con, "SELECT * FROM tblgovoffice WHERE id IN ($placeholders)");
      mysqli_stmt_bind_param($deletedDataQuery, str_repeat('i', count($validIds)), ...$validIds);
      mysqli_stmt_execute($deletedDataQuery);
      $deletedDataResult = mysqli_stmt_get_result($deletedDataQuery);

      // log each deleted record
      while ($deletedData = mysqli_fetch_array($deletedDataResult, MYSQLI_ASSOC)) {
        $action = deletedGenerateLogMessage($deletedData);
        $log_query = mysqli_prepare($con, "INSERT INTO tbllogs (logs_user_type, logs_fname, logs_lname, logs_logdate, logs_action) VALUES (?, ?, ?, ?, ?)");
        mysqli_stmt_bind_param($log_query, "sssss", $_SESSION['role'], $_SESSION['fname'], $_SESSION['lname'], $txt_delete_gov_office_date_deleted, $action);
        mysqli_stmt_execute($log_query);
      }

      // prepare and execute the deletion query
      $delete_query = mysqli_prepare($con, "DELETE FROM tblgovoffice WHERE id IN ($placeholders)");

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