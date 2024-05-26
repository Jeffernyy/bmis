<?php
if (!function_exists('addedGenerateLogMessage')) {
  function addedGenerateLogMessage($householdData)
  {
    // household data fetched
    $logMessage = "added household details...\n\n";
    $logMessage .= "id: " . $householdData['id'] . "\n";
    $logMessage .= "household_num: " . $householdData['household_num'] . "\n";
    $logMessage .= "household_purok: " . $householdData['household_purok'] . "\n";
    $logMessage .= "household_total_mem: " . $householdData['household_total_mem'] . "\n";
    $logMessage .= "household_head_of_family: " . $householdData['household_head_of_family_res_name'] . "\n";
    $logMessage .= "household_date_added: " . $householdData['household_date_added'] . "\n";
    $logMessage .= "household_date_edited: " . $householdData['household_date_edited'] . "\n";
    $logMessage .= "household_added_by: " . $householdData['household_added_by'] . "\n";
    $logMessage .= "household_edited_by: " . $householdData['household_edited_by'] . "\n\n";

    // log session role
    $logMessage .= "this add is done by " . $_SESSION['fname'] . (empty ($_SESSION['mname']) || $_SESSION['mname'] === 'n/a' ? "" : " ") . (empty ($_SESSION['mname']) || $_SESSION['mname'] === 'n/a' ? "" : $_SESSION['mname']) . " " . $_SESSION['lname'] . " as " . $_SESSION['role'] . "\n";
    $logMessage .= "add household id number " . $householdData['id'] . " for household head of family " . $householdData['household_head_of_family_res_name'] . "\n";
    $logMessage .= "date and time added " . date('m/d/Y h:i A') . "\n"; // include current date and time
    return rtrim($logMessage, ",\n") . "\n";
  }
}

if (isset ($_POST['btn_add'])) {
  $txt_add_household_num = !empty ($_POST['txt_add_household_num']) ? strtolower($_POST['txt_add_household_num']) : 'n/a';
  $txt_add_household_purok = !empty ($_POST['txt_add_household_purok']) ? strtolower($_POST['txt_add_household_purok']) : 'n/a';
  $txt_add_household_total_household_mem = !empty ($_POST['txt_add_household_total_household_mem']) ? strtolower($_POST['txt_add_household_total_household_mem']) : 'n/a';
  $txt_add_household_head_of_family = !empty ($_POST['txt_add_household_head_of_family']) ? strtolower($_POST['txt_add_household_head_of_family']) : 'n/a';

  $txt_add_household_date_added = date('m/d/Y h:i A');
  $txt_add_household_added_by = $_SESSION['fname'] . (empty ($_SESSION['mname']) || $_SESSION['mname'] === 'n/a' ? '' : ' ') . (empty ($_SESSION['mname']) || $_SESSION['mname'] === 'n/a' ? '' : $_SESSION['mname']) . ' ' . $_SESSION['lname'] . ' as ' . $_SESSION['role'];
  $txt_add_household_user_type = $_SESSION['role'];

  $chkdup = mysqli_prepare($con, "SELECT household_num FROM tblhousehold WHERE household_num = ?");
  mysqli_stmt_bind_param($chkdup, "s", $txt_add_household_num);
  mysqli_stmt_execute($chkdup);
  $result = mysqli_stmt_get_result($chkdup);
  $num_rows = mysqli_num_rows($result);

  if ($num_rows == 0) {
    $query = mysqli_prepare($con, "INSERT INTO tblhousehold (household_num, household_purok, household_total_mem, household_head_of_family, household_date_added, household_date_edited, household_added_by, household_edited_by) VALUES (?, ?, ?, ?, ?, 'n/a', ?, 'n/a')");
    mysqli_stmt_bind_param($query, "ssssss", $txt_add_household_num, $txt_add_household_purok, $txt_add_household_total_household_mem, $txt_add_household_head_of_family, $txt_add_household_date_added, $txt_add_household_added_by);

    // check if the query was executed successfully
    if (mysqli_stmt_execute($query)) {
      // fetch the last inserted household record
      $lastInsertedId = mysqli_insert_id($con);

      // fetch new data after the update
      $householdDataQuery = mysqli_prepare($con, "SELECT *, CONCAT(r.resident_fname, IF(r.resident_mname = 'n/a', '', CONCAT(' ', r.resident_mname)), ' ', r.resident_lname) as household_head_of_family_res_name, p.id as pid FROM tblhousehold p LEFT JOIN tblresident r ON r.id = p.household_head_of_family WHERE p.id = ?");
      mysqli_stmt_bind_param($householdDataQuery, "i", $lastInsertedId);
      mysqli_stmt_execute($householdDataQuery);
      $householdDataQueryResult = mysqli_stmt_get_result($householdDataQuery);
      $householdData = mysqli_fetch_array($householdDataQueryResult, MYSQLI_ASSOC);
      mysqli_stmt_close($householdDataQuery);

      if (isset ($_SESSION['role'])) {
        // log the old and new data
        $action = addedGenerateLogMessage($householdData);
        $log_query = mysqli_prepare($con, "INSERT INTO tbllogs (logs_user_type, logs_fname, logs_lname, logs_logdate, logs_action) VALUES (?, ?, ?, ?, ?)");
        mysqli_stmt_bind_param($log_query, "sssss", $txt_add_household_user_type, $_SESSION['fname'], $_SESSION['lname'], $txt_add_household_date_added, $action);
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
    // old data fetched
    $logMessage = "edited household details...\n\n";
    $logMessage .= "old data:\n";
    $logMessage .= "id: " . $oldData['pid'] . "\n";
    $logMessage .= "household_num: " . $oldData['household_num'] . "\n";
    $logMessage .= "household_purok: " . $oldData['household_purok'] . "\n";
    $logMessage .= "household_total_mem: " . $oldData['household_total_mem'] . "\n";
    $logMessage .= "household_head_of_family: " . $oldData['household_head_of_family_res_name'] . "\n";
    $logMessage .= "household_date_added: " . $oldData['household_date_added'] . "\n";
    $logMessage .= "household_date_edited: " . $oldData['household_date_edited'] . "\n";
    $logMessage .= "household_added_by: " . $oldData['household_added_by'] . "\n";
    $logMessage .= "household_edited_by: " . $oldData['household_edited_by'] . "\n";

    // new data fetched
    $logMessage .= "\nnew data:\n";
    $logMessage .= "id: " . $newData['pid'] . "\n";
    $logMessage .= "household_num: " . $newData['household_num'] . "\n";
    $logMessage .= "household_purok: " . $newData['household_purok'] . "\n";
    $logMessage .= "household_total_mem: " . $newData['household_total_mem'] . "\n";
    $logMessage .= "household_head_of_family: " . $newData['household_head_of_family_res_name'] . "\n";
    $logMessage .= "household_date_added: " . $newData['household_date_added'] . "\n";
    $logMessage .= "household_date_edited: " . $newData['household_date_edited'] . "\n";
    $logMessage .= "household_added_by: " . $newData['household_added_by'] . "\n";
    $logMessage .= "household_edited_by: " . $newData['household_edited_by'] . "\n\n";

    // log session role
    $logMessage .= "this edit is done by " . $_SESSION['fname'] . (empty ($_SESSION['mname']) || $_SESSION['mname'] === 'n/a' ? "" : " ") . (empty ($_SESSION['mname']) || $_SESSION['mname'] === 'n/a' ? "" : $_SESSION['mname']) . " " . $_SESSION['lname'] . " as " . $_SESSION['role'] . "\n";
    $logMessage .= "edit household id number " . $newData['id'] . " for household head of family " . $newData['household_head_of_family_res_name'] . "\n";
    $logMessage .= "date and time edited " . date('m/d/Y h:i A') . "\n"; // include current date and time
    return rtrim($logMessage, ",\n") . "\n";
  }
}

if (isset ($_POST['btn_edit'])) {
  $txt_edit_household_user_id = $_POST['hidden_id'];

  // fetch old data before the update using prepared statement
  $oldDataQuery = mysqli_prepare($con, "SELECT *, COALESCE(CONCAT(r.resident_fname, IF(r.resident_mname = 'n/a', '', CONCAT(' ', r.resident_mname)), ' ', r.resident_lname), 'n/a') as household_head_of_family_res_name, p.id as pid FROM tblhousehold p LEFT JOIN tblresident r ON r.id = p.household_head_of_family WHERE p.id = ?");
  mysqli_stmt_bind_param($oldDataQuery, "i", $txt_edit_household_user_id);
  mysqli_stmt_execute($oldDataQuery);
  $oldDataResult = mysqli_stmt_get_result($oldDataQuery);
  $oldData = mysqli_fetch_array($oldDataResult, MYSQLI_ASSOC);
  mysqli_stmt_close($oldDataQuery);

  $txt_edit_household_purok = !empty ($_POST['txt_edit_household_purok']) ? strtolower($_POST['txt_edit_household_purok']) : 'n/a';
  $txt_edit_household_date_edited = date('m/d/Y h:i A');
  $txt_edit_household_edited_by = $_SESSION['fname'] . (empty ($_SESSION['mname']) || $_SESSION['mname'] === 'n/a' ? '' : ' ') . (empty ($_SESSION['mname']) || $_SESSION['mname'] === 'n/a' ? '' : $_SESSION['mname']) . ' ' . $_SESSION['lname'] . ' as ' . $_SESSION['role'];
  $txt_edit_household_user_type = $_SESSION['role'];

  $update_query = mysqli_prepare($con, "UPDATE tblhousehold SET household_purok = ?, household_date_edited = ?, household_edited_by = ? WHERE id = ?");
  mysqli_stmt_bind_param($update_query, "sssi", $txt_edit_household_purok, $txt_edit_household_date_edited, $txt_edit_household_edited_by, $txt_edit_household_user_id);
  $update_success = mysqli_stmt_execute($update_query);

  if ($update_success) {
    // fetch new data after the update
    $newDataQuery = mysqli_prepare($con, "SELECT *, COALESCE(CONCAT(r.resident_fname, IF(r.resident_mname = 'n/a', '', CONCAT(' ', r.resident_mname)), ' ', r.resident_lname), 'n/a') as household_head_of_family_res_name, p.id as pid FROM tblhousehold p LEFT JOIN tblresident r ON r.id = p.household_head_of_family WHERE p.id = ?");
    mysqli_stmt_bind_param($newDataQuery, "i", $txt_edit_household_user_id);
    mysqli_stmt_execute($newDataQuery);
    $newDataResult = mysqli_stmt_get_result($newDataQuery);
    $newData = mysqli_fetch_array($newDataResult, MYSQLI_ASSOC);
    mysqli_stmt_close($newDataQuery);

    if (isset ($_SESSION['role'])) {
      // log the old and new data
      $action = editedGenerateLogMessage($oldData, $newData);
      $log_query = mysqli_prepare($con, "INSERT INTO tbllogs (logs_user_type, logs_fname, logs_lname, logs_logdate, logs_action) VALUES (?, ?, ?, ?, ?)");
      mysqli_stmt_bind_param($log_query, "sssss", $txt_edit_household_user_type, $_SESSION['fname'], $_SESSION['lname'], $txt_edit_household_date_edited, $action);
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

if (!function_exists('deletedGenerateLogMessage')) {
  function deletedGenerateLogMessage($householdData)
  {
    // data fetched
    $logMessage = "deleted household details before deletion...\n\n";
    $logMessage .= "id: " . $householdData['id'] . "\n";
    $logMessage .= "household_num: " . $householdData['household_num'] . "\n";
    $logMessage .= "household_purok: " . $householdData['household_purok'] . "\n";
    $logMessage .= "household_total_mem: " . $householdData['household_total_mem'] . "\n";
    $logMessage .= "household_head_of_family: " . $householdData['household_head_of_family_res_name'] . "\n";
    $logMessage .= "household_date_added: " . $householdData['household_date_added'] . "\n";
    $logMessage .= "household_date_edited: " . $householdData['household_date_edited'] . "\n";
    $logMessage .= "household_added_by: " . $householdData['household_added_by'] . "\n";
    $logMessage .= "household_edited_by: " . $householdData['household_edited_by'] . "\n\n";

    // log session role
    $logMessage .= "this delete is done by " . $_SESSION['fname'] . (empty ($_SESSION['mname']) || $_SESSION['mname'] === 'n/a' ? "" : " ") . (empty ($_SESSION['mname']) || $_SESSION['mname'] === 'n/a' ? "" : $_SESSION['mname']) . " " . $_SESSION['lname'] . " as " . $_SESSION['role'] . "\n";
    $logMessage .= "delete household id number " . $householdData['id'] . " for household head of family " . $householdData['household_head_of_family_res_name'] . "\n";
    $logMessage .= "date and time deleted " . date('m/d/Y h:i A') . "\n"; // include current date and time
    return rtrim($logMessage, ",\n") . "\n";
  }
}

if (isset ($_POST['btn_delete'])) {
  if (isset ($_POST['chk_delete']) && is_array($_POST['chk_delete'])) {
    $txt_delete_household_date_deleted = date('m/d/Y h:i A');
    // validate and sanitize each selected ids
    $validIds = array_map('intval', $_POST['chk_delete']);
    // remove non-numeric values
    $validIds = array_filter($validIds, 'is_numeric');

    if (!empty ($validIds)) {
      // fetch the data before deleted for logging
      $placeholders = implode(', ', array_fill(0, count($validIds), '?'));

      // fetch the data to be deleted
      $deletedDataQuery = mysqli_prepare($con, "SELECT *, COALESCE(CONCAT(r.resident_fname, IF(r.resident_mname = 'n/a', '', CONCAT(' ', r.resident_mname)), ' ', r.resident_lname), 'n/a') as household_head_of_family_res_name, p.id as pid FROM tblhousehold p LEFT JOIN tblresident r ON r.id = p.household_head_of_family WHERE p.id IN ($placeholders)");
      mysqli_stmt_bind_param($deletedDataQuery, str_repeat('i', count($validIds)), ...$validIds);
      mysqli_stmt_execute($deletedDataQuery);
      $deletedDataResult = mysqli_stmt_get_result($deletedDataQuery);

      // log each deleted record
      while ($deletedData = mysqli_fetch_array($deletedDataResult, MYSQLI_ASSOC)) {
        $action = deletedGenerateLogMessage($deletedData);
        $log_query = mysqli_prepare($con, "INSERT INTO tbllogs (logs_user_type, logs_fname, logs_lname, logs_logdate, logs_action) VALUES (?, ?, ?, ?, ?)");
        mysqli_stmt_bind_param($log_query, "sssss", $_SESSION['role'], $_SESSION['fname'], $_SESSION['lname'], $txt_delete_household_date_deleted, $action);
        mysqli_stmt_execute($log_query);
      }

      // prepare and execute the deletion query
      $delete_query = mysqli_prepare($con, "DELETE FROM tblhousehold WHERE id IN ($placeholders)");

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