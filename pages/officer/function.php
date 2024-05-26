<?php
// check before declaring to see if it already exists
if (!function_exists('addedGenerateLogMessage')) {
  function addedGenerateLogMessage($officer_data)
  {
    // household data fetched
    $logMessage = "added officer of the day details...\n\n";
    $logMessage .= "id: " . $officer_data['id'] . "\n";
    $logMessage .= "officer_fname: " . $officer_data['officer_fname'] . "\n";
    $logMessage .= "officer_mname: " . $officer_data['officer_mname'] . "\n";
    $logMessage .= "officer_lname: " . $officer_data['officer_lname'] . "\n";
    $logMessage .= "officer_position: " . $officer_data['officer_position'] . "\n";
    $logMessage .= "officer_date_added: " . $officer_data['officer_date_added'] . "\n";
    $logMessage .= "officer_date_edited: " . $officer_data['officer_date_edited'] . "\n";
    $logMessage .= "officer_added_by: " . $officer_data['officer_added_by'] . "\n";
    $logMessage .= "officer_edited_by: " . $officer_data['officer_edited_by'] . "\n\n";

    // log session role
    $logMessage .= "this add is done by " . $_SESSION['fname'] . (empty($_SESSION['mname']) || $_SESSION['mname'] === 'n/a' ? "" : " ") . (empty($_SESSION['mname']) || $_SESSION['mname'] === 'n/a' ? "" : $_SESSION['mname']) . " " . $_SESSION['lname'] . " as " . $_SESSION['role'] . "\n";
    $logMessage .= "add officer of the day id number " . $officer_data['id'] . " for officer of the day " . $officer_data['officer_res_name'] . "\n";
    $logMessage .= "date and time added " . date('m/d/Y h:i A') . "\n";
    return rtrim($logMessage, ",\n") . "\n";
  }
}

if (isset($_POST['btn_add'])) {
  $txt_add_officer_fname = !empty($_POST['txt_add_officer_fname']) ? strtolower($_POST['txt_add_officer_fname']) : 'n/a';
  $txt_add_officer_mname = !empty($_POST['txt_add_officer_mname']) ? strtolower($_POST['txt_add_officer_mname']) : 'n/a';
  $txt_add_officer_lname = !empty($_POST['txt_add_officer_lname']) ? strtolower($_POST['txt_add_officer_lname']) : 'n/a';
  $txt_add_officer_position = !empty($_POST['txt_add_officer_position']) ? $_POST['txt_add_officer_position'] : 'n/a';

  $txt_add_officer_date_added = date('m/d/Y h:i A');
  $txt_add_officer_added_by = $_SESSION['fname'] . (empty($_SESSION['mname']) || $_SESSION['mname'] === 'n/a' ? '' : ' ') . (empty($_SESSION['mname']) || $_SESSION['mname'] === 'n/a' ? '' : $_SESSION['mname']) . ' ' . $_SESSION['lname'] . ' as ' . $_SESSION['role'];
  $txt_add_officer_user_type = $_SESSION['role'];

  // Check the count of existing records
  $count_query = mysqli_prepare($con, "SELECT COUNT(*) AS count FROM tblofficer");
  mysqli_stmt_execute($count_query);
  $count_result = mysqli_stmt_get_result($count_query);
  $count_row = mysqli_fetch_assoc($count_result);
  $count = $count_row['count'];
  $limit = 5;

  if ($count >= $limit) {

    $message = "Error";
    $_SESSION['error'] = $message;
    header("location: " . $_SERVER['REQUEST_URI']);
    exit();

  } else {
    $query = mysqli_prepare($con, "INSERT INTO tblofficer (officer_fname, officer_mname, officer_lname, officer_position, officer_date_added, officer_date_edited, officer_added_by, officer_edited_by) VALUES (?, ?, ?, ?, ?, 'n/a', ?, 'n/a')");
    mysqli_stmt_bind_param($query, 'ssssss', $txt_add_officer_fname, $txt_add_officer_mname, $txt_add_officer_lname, $txt_add_officer_position, $txt_add_officer_date_added, $txt_add_officer_added_by);
    mysqli_stmt_execute($query);

    if (mysqli_stmt_affected_rows($query) > 0) {
      // fetch the last inserted household record
      $lastInsertedId = mysqli_insert_id($con);

      // fetch new data after the update
      $officer_data_query = mysqli_prepare($con, "SELECT *,CONCAT(officer_fname, IF(officer_mname = 'n/a', '', CONCAT(' ', officer_mname)), ' ', officer_lname) as officer_res_name FROM tblofficer WHERE id = ?");
      mysqli_stmt_bind_param($officer_data_query, "i", $lastInsertedId);
      mysqli_stmt_execute($officer_data_query);
      $officer_data_query_result = mysqli_stmt_get_result($officer_data_query);
      $officer_data = mysqli_fetch_array($officer_data_query_result, MYSQLI_ASSOC);
      mysqli_stmt_close($officer_data_query);

      if (isset($_SESSION['role'])) {
        // log the old and new data
        $action = addedGenerateLogMessage($officer_data);
        $log_query = mysqli_prepare($con, "INSERT INTO tbllogs (logs_user_type, logs_fname, logs_lname, logs_logdate, logs_action) VALUES (?, ?, ?, ?, ?)");
        mysqli_stmt_bind_param($log_query, "sssss", $txt_add_officer_user_type, $_SESSION['fname'], $_SESSION['lname'], $txt_add_officer_date_added, $action);
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
}

// check before declaring to see if it already exists
if (!function_exists('editedGenerateLogMessage')) {
  function editedGenerateLogMessage($oldData, $newData)
  {
    // old data fetched
    $logMessage = "edited officer of the day details...\n\n";
    $logMessage .= "old data:\n";
    $logMessage .= "id: " . $oldData['id'] . "\n";
    $logMessage .= "officer_fname: " . $oldData['officer_fname'] . "\n";
    $logMessage .= "officer_mname: " . $oldData['officer_mname'] . "\n";
    $logMessage .= "officer_lname: " . $oldData['officer_lname'] . "\n";
    $logMessage .= "officer_position: " . $oldData['officer_position'] . "\n";
    $logMessage .= "officer_date_added: " . $oldData['officer_date_added'] . "\n";
    $logMessage .= "officer_date_edited: " . $oldData['officer_date_edited'] . "\n";
    $logMessage .= "officer_added_by: " . $oldData['officer_added_by'] . "\n";
    $logMessage .= "officer_edited_by: " . $oldData['officer_edited_by'] . "\n\n";

    // new data fetched
    $logMessage .= "new data:\n";
    $logMessage .= "id: " . $newData['id'] . "\n";
    $logMessage .= "officer_fname: " . $newData['officer_fname'] . "\n";
    $logMessage .= "officer_mname: " . $newData['officer_mname'] . "\n";
    $logMessage .= "officer_lname: " . $newData['officer_lname'] . "\n";
    $logMessage .= "officer_position: " . $newData['officer_position'] . "\n";
    $logMessage .= "officer_date_added: " . $newData['officer_date_added'] . "\n";
    $logMessage .= "officer_date_edited: " . $newData['officer_date_edited'] . "\n";
    $logMessage .= "officer_added_by: " . $newData['officer_added_by'] . "\n";
    $logMessage .= "officer_edited_by: " . $newData['officer_edited_by'] . "\n\n";

    // log session role
    $logMessage .= "this edit is done by " . $_SESSION['fname'] . (empty($_SESSION['mname']) || $_SESSION['mname'] === 'n/a' ? "" : " ") . (empty($_SESSION['mname']) || $_SESSION['mname'] === 'n/a' ? "" : $_SESSION['mname']) . " " . $_SESSION['lname'] . " as " . $_SESSION['role'] . "\n";
    $logMessage .= "edit officer of the day id number " . $newData['id'] . " for officer of the day " . $newData['officer_res_name'] . "\n";
    $logMessage .= "date and time edited " . date('m/d/Y h:i A') . "\n";
    return rtrim($logMessage, ",\n") . "\n";
  }
}

if (isset($_POST['btn_edit'])) {
  $txt_edit_gov_office_user_id = $_POST['hidden_id'];

  // fetch old data before the update
  $oldDataQuery = mysqli_prepare($con, "SELECT *,CONCAT(officer_fname, IF(officer_mname = 'n/a', '', CONCAT(' ', officer_mname)), ' ', officer_lname) as officer_res_name FROM tblofficer WHERE id = ?");
  mysqli_stmt_bind_param($oldDataQuery, "i", $txt_edit_gov_office_user_id);
  mysqli_stmt_execute($oldDataQuery);
  $oldDataResult = mysqli_stmt_get_result($oldDataQuery);
  $oldData = mysqli_fetch_array($oldDataResult, MYSQLI_ASSOC);
  mysqli_stmt_close($oldDataQuery);

  $txt_edit_officer_fname = !empty($_POST['txt_edit_officer_fname']) ? strtolower($_POST['txt_edit_officer_fname']) : 'n/a';
  $txt_edit_officer_mname = !empty($_POST['txt_edit_officer_mname']) ? strtolower($_POST['txt_edit_officer_mname']) : 'n/a';
  $txt_edit_officer_lname = !empty($_POST['txt_edit_officer_lname']) ? strtolower($_POST['txt_edit_officer_lname']) : 'n/a';
  $txt_edit_officer_position = !empty($_POST['txt_edit_officer_position']) ? strtolower($_POST['txt_edit_officer_position']) : 'n/a';

  $txt_edit_officer_date_edited = date('m/d/Y h:i A');
  $txt_edit_officer_edited_by = $_SESSION['fname'] . (empty($_SESSION['mname']) || $_SESSION['mname'] === 'n/a' ? '' : ' ') . (empty($_SESSION['mname']) || $_SESSION['mname'] === 'n/a' ? '' : $_SESSION['mname']) . ' ' . $_SESSION['lname'] . ' as ' . $_SESSION['role'];
  $txt_edit_officer_user_type = $_SESSION['role'];

  $update_query = mysqli_prepare($con, "UPDATE tblofficer SET officer_fname = ?, officer_mname = ?, officer_lname = ?, officer_position = ?, officer_date_edited = ?, officer_edited_by = ? WHERE id = ?");
  mysqli_stmt_bind_param($update_query, "ssssssi", $txt_edit_officer_fname, $txt_edit_officer_mname, $txt_edit_officer_lname, $txt_edit_officer_position, $txt_edit_officer_date_edited, $txt_edit_officer_edited_by, $txt_edit_gov_office_user_id);
  $update_success = mysqli_stmt_execute($update_query);

  if ($update_success) {
    // fetch new data after the update
    $newDataQuery = mysqli_prepare($con, "SELECT *,CONCAT(officer_fname, IF(officer_mname = 'n/a', '', CONCAT(' ', officer_mname)), ' ', officer_lname) as officer_res_name FROM tblofficer WHERE id = ?");
    mysqli_stmt_bind_param($newDataQuery, "i", $txt_edit_gov_office_user_id);
    mysqli_stmt_execute($newDataQuery);
    $newDataResult = mysqli_stmt_get_result($newDataQuery);
    $newData = mysqli_fetch_array($newDataResult, MYSQLI_ASSOC);
    mysqli_stmt_close($newDataQuery);

    if (isset($_SESSION['role'])) {
      // log the old and new data
      $action = editedGenerateLogMessage($oldData, $newData);
      $log_query = mysqli_prepare($con, "INSERT INTO tbllogs (logs_user_type, logs_fname, logs_lname, logs_logdate, logs_action) VALUES (?, ?, ?, ?, ?)");
      mysqli_stmt_bind_param($log_query, "sssss", $txt_edit_officer_user_type, $_SESSION['fname'], $_SESSION['lname'], $txt_edit_officer_date_edited, $action);
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
  function deletedGenerateLogMessage($officer_data)
  {
    // data fetched
    $logMessage = "deleted officer of the day details before deletion...\n\n";
    $logMessage .= "id: " . $officer_data['id'] . "\n";
    $logMessage .= "officer_fname: " . $officer_data['officer_fname'] . "\n";
    $logMessage .= "officer_mname: " . $officer_data['officer_mname'] . "\n";
    $logMessage .= "officer_lname: " . $officer_data['officer_lname'] . "\n";
    $logMessage .= "officer_position: " . $officer_data['officer_position'] . "\n";
    $logMessage .= "officer_date_added: " . $officer_data['officer_date_added'] . "\n";
    $logMessage .= "officer_date_edited: " . $officer_data['officer_date_edited'] . "\n";
    $logMessage .= "officer_added_by: " . $officer_data['officer_added_by'] . "\n";
    $logMessage .= "officer_edited_by: " . $officer_data['officer_edited_by'] . "\n\n";

    // log session role
    $logMessage .= "this delete is done by " . $_SESSION['fname'] . (empty($_SESSION['mname']) || $_SESSION['mname'] === 'n/a' ? "" : " ") . (empty($_SESSION['mname']) || $_SESSION['mname'] === 'n/a' ? "" : $_SESSION['mname']) . " " . $_SESSION['lname'] . " as " . $_SESSION['role'] . "\n";
    $logMessage .= "delete officer of the day id number " . $officer_data['id'] . " for officer of the day " . $officer_data['officer_res_name'] . "\n";
    $logMessage .= "date and time deleted " . date('m/d/Y h:i A') . "\n";
    return rtrim($logMessage, ",\n") . "\n";
  }
}

if (isset($_POST['btn_delete'])) {

  if (isset($_POST['chk_delete']) && is_array($_POST['chk_delete'])) {

    $txt_delete_officer_date_deleted = date('m/d/Y h:i A');
    // validate and sanitize each selected ids
    $validIds = array_map('intval', $_POST['chk_delete']);
    // remove non-numeric values
    $validIds = array_filter($validIds, 'is_numeric');

    if (!empty($validIds)) {
      // fetch the data before deleted for logging
      $placeholders = implode(', ', array_fill(0, count($validIds), '?'));

      // fetch the data to be deleted
      $deletedDataQuery = mysqli_prepare($con, "SELECT *,CONCAT(officer_fname, IF(officer_mname = 'n/a', '', CONCAT(' ', officer_mname)), ' ', officer_lname) as officer_res_name FROM tblofficer WHERE id IN ($placeholders)");
      mysqli_stmt_bind_param($deletedDataQuery, str_repeat('i', count($validIds)), ...$validIds);
      mysqli_stmt_execute($deletedDataQuery);
      $deletedDataResult = mysqli_stmt_get_result($deletedDataQuery);

      // log each deleted record
      while ($deletedData = mysqli_fetch_array($deletedDataResult, MYSQLI_ASSOC)) {
        $action = deletedGenerateLogMessage($deletedData);
        $log_query = mysqli_prepare($con, "INSERT INTO tbllogs (logs_user_type, logs_fname, logs_lname, logs_logdate, logs_action) VALUES (?, ?, ?, ?, ?)");
        mysqli_stmt_bind_param($log_query, "sssss", $_SESSION['role'], $_SESSION['fname'], $_SESSION['lname'], $txt_delete_officer_date_deleted, $action);
        mysqli_stmt_execute($log_query);
      }

      // prepare and execute the deletion query
      $delete_query = mysqli_prepare($con, "DELETE FROM tblofficer WHERE id IN ($placeholders)");

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