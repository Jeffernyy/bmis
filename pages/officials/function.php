<?php
if (!function_exists('addedGenerateLogMessage')) {
  function addedGenerateLogMessage($officialData)
  {
    // official data fetched
    $logMessage = "added barangay official details...\n\n";
    $logMessage .= "id: " . $officialData['id'] . "\n";
    $logMessage .= "official_position: " . $officialData['official_position'] . "\n";
    $logMessage .= "official_res_name: " . $officialData['official_res_name'] . "\n";
    $logMessage .= "official_contact_num: " . $officialData['official_contact_num'] . "\n";
    $logMessage .= "official_address: " . $officialData['official_address'] . "\n";
    $logMessage .= "official_term_start: " . $officialData['official_term_start'] . "\n";
    $logMessage .= "official_term_end: " . $officialData['official_term_end'] . "\n";
    $logMessage .= "official_status: " . $officialData['official_status'] . "\n";
    $logMessage .= "official_date_added: " . $officialData['official_date_added'] . "\n";
    $logMessage .= "official_date_edited: " . $officialData['official_date_edited'] . "\n";
    $logMessage .= "official_added_by: " . $officialData['official_added_by'] . "\n";
    $logMessage .= "official_edited_by: " . $officialData['official_edited_by'] . "\n\n";

    // log session role
    $logMessage .= "this add is done by " . $_SESSION['fname'] . (empty($_SESSION['mname']) || $_SESSION['mname'] === 'n/a' ? "" : " ") . (empty($_SESSION['mname']) || $_SESSION['mname'] === 'n/a' ? "" : $_SESSION['mname']) . " " . $_SESSION['lname'] . " as " . $_SESSION['role'] . "\n";
    $logMessage .= "add barangay official id number " . $officialData['id'] . " for barangay official " . $officialData['official_res_name'] . "\n";
    $logMessage .= "date and time added " . date('m/d/Y h:i A') . "\n"; // include current date and time
    return rtrim($logMessage, ",\n") . "\n";
  }
}

if (isset($_POST['btn_add'])) {
  $txt_add_official_position = !empty($_POST['txt_add_official_position']) ? strtolower($_POST['txt_add_official_position']) : 'n/a';
  $txt_add_official_res_id = !empty($_POST['txt_add_official_res_id']) ? strtolower($_POST['txt_add_official_res_id']) : 'n/a';
  $txt_add_official_contact_num = !empty($_POST['txt_add_official_contact_num']) ? strtolower($_POST['txt_add_official_contact_num']) : 'n/a';
  $txt_add_official_address = !empty($_POST['txt_add_official_address']) ? strtolower($_POST['txt_add_official_address']) : 'n/a';
  $txt_add_official_sterm = date('m-d-Y', strtotime($_POST['txt_add_official_sterm']));
  $txt_add_official_eterm = date('m-d-Y', strtotime($_POST['txt_add_official_eterm']));

  $txt_add_official_date_added = date('m/d/Y h:i A');
  $txt_add_official_added_by = $_SESSION['fname'] . (empty($_SESSION['mname']) || $_SESSION['mname'] === 'n/a' ? '' : ' ') . (empty($_SESSION['mname']) || $_SESSION['mname'] === 'n/a' ? '' : $_SESSION['mname']) . ' ' . $_SESSION['lname'] . ' as ' . $_SESSION['role'];
  $txt_add_official_user_type = $_SESSION['role'];

  $query = mysqli_query($con, "SELECT * FROM tblofficial WHERE official_position = '" . $txt_add_official_position . "' AND official_term_start = '" . $txt_add_official_sterm . "' AND official_term_end = '" . $txt_add_official_eterm . "'");
  $num_rows = mysqli_num_rows($query);

  if ($num_rows == 0) {
    $query = mysqli_query($con, "INSERT INTO tblofficial (official_position, official_res_id, official_contact_num, official_address, official_term_start, official_term_end, official_status, official_date_added, official_date_edited, official_added_by, official_edited_by) VALUES ('$txt_add_official_position', '$txt_add_official_res_id', '$txt_add_official_contact_num', '$txt_add_official_address', '$txt_add_official_sterm', '$txt_add_official_eterm', 'ongoing term', '$txt_add_official_date_added', 'n/a', '$txt_add_official_added_by', 'n/a')") or die('Error: ' . mysqli_error($con));

    if ($query == true) {
      // fetch the last inserted official record
      $lastInsertedId = mysqli_insert_id($con);

      // fetch new data after the update
      $officialDataQuery = mysqli_prepare($con, "SELECT *,CONCAT(r.resident_fname, IF(r.resident_mname = 'n/a', '', CONCAT(' ', r.resident_mname)), ' ', r.resident_lname) as official_res_name, p.id as pid FROM tblofficial p left join tblresident r on r.id = p.official_res_id WHERE p.id = ?");
      mysqli_stmt_bind_param($officialDataQuery, "i", $lastInsertedId);
      mysqli_stmt_execute($officialDataQuery);
      $officialDataQueryResult = mysqli_stmt_get_result($officialDataQuery);
      $officialData = mysqli_fetch_array($officialDataQueryResult, MYSQLI_ASSOC);
      mysqli_stmt_close($officialDataQuery);

      if (isset($_SESSION['role'])) {
        // log the old and new data
        $action = addedGenerateLogMessage($officialData);
        $log_query = mysqli_prepare($con, "INSERT INTO tbllogs (logs_user_type, logs_fname, logs_lname, logs_logdate, logs_action) VALUES (?, ?, ?, ?, ?)");
        mysqli_stmt_bind_param($log_query, "sssss", $txt_add_official_user_type, $_SESSION['fname'], $_SESSION['lname'], $txt_add_official_date_added, $action);
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
    $logMessage = "edited barangay official details...\n\n";
    $logMessage .= "old data:\n";
    $logMessage .= "id: " . $oldData['id'] . "\n";
    $logMessage .= "official_position: " . $oldData['official_position'] . "\n";
    $logMessage .= "official_res_name: " . $oldData['official_res_name'] . "\n";
    $logMessage .= "official_contact_num: " . $oldData['official_contact_num'] . "\n";
    $logMessage .= "official_address: " . $oldData['official_address'] . "\n";
    $logMessage .= "official_term_start: " . $oldData['official_term_start'] . "\n";
    $logMessage .= "official_term_end: " . $oldData['official_term_end'] . "\n";
    $logMessage .= "official_status: " . $oldData['official_status'] . "\n";
    $logMessage .= "official_date_added: " . $oldData['official_date_added'] . "\n";
    $logMessage .= "official_date_edited: " . $oldData['official_date_edited'] . "\n";
    $logMessage .= "official_added_by: " . $oldData['official_added_by'] . "\n";
    $logMessage .= "official_edited_by: " . $oldData['official_edited_by'] . "\n\n";

    // new data fetched
    $logMessage .= "\nnew data:\n";
    $logMessage .= "id: " . $newData['id'] . "\n";
    $logMessage .= "official_position: " . $newData['official_position'] . "\n";
    $logMessage .= "official_res_name: " . $newData['official_res_name'] . "\n";
    $logMessage .= "official_contact_num: " . $newData['official_contact_num'] . "\n";
    $logMessage .= "official_address: " . $newData['official_address'] . "\n";
    $logMessage .= "official_term_start: " . $newData['official_term_start'] . "\n";
    $logMessage .= "official_term_end: " . $newData['official_term_end'] . "\n";
    $logMessage .= "official_status: " . $newData['official_status'] . "\n";
    $logMessage .= "official_date_added: " . $newData['official_date_added'] . "\n";
    $logMessage .= "official_date_edited: " . $newData['official_date_edited'] . "\n";
    $logMessage .= "official_added_by: " . $newData['official_added_by'] . "\n";
    $logMessage .= "official_edited_by: " . $newData['official_edited_by'] . "\n\n";

    // log session role
    $logMessage .= "this edit is done by " . $_SESSION['fname'] . (empty($_SESSION['mname']) || $_SESSION['mname'] === 'n/a' ? "" : " ") . (empty($_SESSION['mname']) || $_SESSION['mname'] === 'n/a' ? "" : $_SESSION['mname']) . " " . $_SESSION['lname'] . " as " . $_SESSION['role'] . "\n";
    $logMessage .= "edit barangay official id number " . $newData['id'] . " for barangay official " . $newData['official_res_name'] . "\n";
    $logMessage .= "date and time edited " . date('m/d/Y h:i A') . "\n"; // include current date and time
    return rtrim($logMessage, ",\n") . "\n";
  }
}

if (isset($_POST['btn_edit'])) {
  $txt_edit_official_user_id = $_POST['hidden_id'];

  // fetch old data before the update using prepared statement
  $oldDataQuery = mysqli_prepare($con, "SELECT *, CONCAT(r.resident_fname, IF(r.resident_mname = 'n/a', '', CONCAT(' ', r.resident_mname)), ' ', r.resident_lname) as official_res_name, p.id as pid FROM tblofficial p LEFT JOIN tblresident r ON r.id = p.official_res_id WHERE p.id = ?");
  mysqli_stmt_bind_param($oldDataQuery, "i", $txt_edit_official_user_id);
  mysqli_stmt_execute($oldDataQuery);
  $oldDataResult = mysqli_stmt_get_result($oldDataQuery);
  $oldData = mysqli_fetch_array($oldDataResult, MYSQLI_ASSOC);
  mysqli_stmt_close($oldDataQuery);

  $txt_edit_official_contact_num = !empty($_POST['txt_edit_official_contact_num']) ? strtolower($_POST['txt_edit_official_contact_num']) : 'n/a';
  $txt_edit_official_address = !empty($_POST['txt_edit_official_address']) ? strtolower($_POST['txt_edit_official_address']) : 'n/a';
  $txt_edit_official_sterm = date('m-d-Y', strtotime($_POST['txt_edit_official_sterm']));
  $txt_edit_official_eterm = date('m-d-Y', strtotime($_POST['txt_edit_official_eterm']));

  $txt_edit_official_date_edited = date('m/d/Y h:i A');
  $txt_edit_official_edited_by = $_SESSION['fname'] . (empty($_SESSION['mname']) || $_SESSION['mname'] === 'n/a' ? '' : ' ') . (empty($_SESSION['mname']) || $_SESSION['mname'] === 'n/a' ? '' : $_SESSION['mname']) . ' ' . $_SESSION['lname'] . ' as ' . $_SESSION['role'];
  $txt_edit_official_user_type = $_SESSION['role'];

  $update_query = mysqli_prepare($con, "UPDATE tblofficial SET official_contact_num = ?, official_address = ?, official_term_start = ?, official_term_end = ?, official_date_edited = ?, official_edited_by = ? WHERE id = ?");
  mysqli_stmt_bind_param($update_query, "ssssssi", $txt_edit_official_contact_num, $txt_edit_official_address, $txt_edit_official_sterm, $txt_edit_official_eterm, $txt_edit_official_date_edited, $txt_edit_official_edited_by, $txt_edit_official_user_id);
  $update_success = mysqli_stmt_execute($update_query);

  if ($update_success) {
    // fetch new data after the update
    $newDataQuery = mysqli_prepare($con, "SELECT *, CONCAT(r.resident_fname, IF(r.resident_mname = 'n/a', '', CONCAT(' ', r.resident_mname)), ' ', r.resident_lname) as official_res_name, p.id as pid FROM tblofficial p LEFT JOIN tblresident r ON r.id = p.official_res_id WHERE p.id = ?");
    mysqli_stmt_bind_param($newDataQuery, "i", $txt_edit_official_user_id);
    mysqli_stmt_execute($newDataQuery);
    $newDataResult = mysqli_stmt_get_result($newDataQuery);
    $newData = mysqli_fetch_array($newDataResult, MYSQLI_ASSOC);
    mysqli_stmt_close($newDataQuery);

    if (isset($_SESSION['role'])) {
      // log the old and new data
      $action = editedGenerateLogMessage($oldData, $newData);
      $log_query = mysqli_prepare($con, "INSERT INTO tbllogs (logs_user_type, logs_fname, logs_lname, logs_logdate, logs_action) VALUES (?, ?, ?, ?, ?)");
      mysqli_stmt_bind_param($log_query, "sssss", $txt_edit_official_user_type, $_SESSION['fname'], $_SESSION['lname'], $txt_edit_official_date_edited, $action);
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

if (isset($_POST['btn_end'])) {
  $txt_id = $_POST['hidden_id'];
  $end_query = mysqli_query($con, "UPDATE tblofficial SET official_status = 'end term' WHERE id = '$txt_id' ") or die('Error: ' . mysqli_error($con));

  if ($end_query == true) {

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

if (isset($_POST['btn_start'])) {
  $txt_id = $_POST['hidden_id'];
  $start_query = mysqli_query($con, "UPDATE tblofficial SET official_status = 'ongoing term' WHERE id = '$txt_id' ") or die('Error: ' . mysqli_error($con));

  if ($start_query == true) {

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
  function deletedGenerateLogMessage($officialData)
  {
    // data fetched
    $logMessage = "deleted barangay official details before deletion...\n\n";
    $logMessage .= "id: " . $officialData['id'] . "\n";
    $logMessage .= "official_position: " . $officialData['official_position'] . "\n";
    $logMessage .= "official_res_name: " . $officialData['official_res_name'] . "\n";
    $logMessage .= "official_contact_num: " . $officialData['official_contact_num'] . "\n";
    $logMessage .= "official_address: " . $officialData['official_address'] . "\n";
    $logMessage .= "official_term_start: " . $officialData['official_term_start'] . "\n";
    $logMessage .= "official_term_end: " . $officialData['official_term_end'] . "\n";
    $logMessage .= "official_status: " . $officialData['official_status'] . "\n";
    $logMessage .= "official_date_added: " . $officialData['official_date_added'] . "\n";
    $logMessage .= "official_date_edited: " . $officialData['official_date_edited'] . "\n";
    $logMessage .= "official_added_by: " . $officialData['official_added_by'] . "\n";
    $logMessage .= "official_edited_by: " . $officialData['official_edited_by'] . "\n\n";

    // log session role
    $logMessage .= "this delete is done by " . $_SESSION['fname'] . (empty($_SESSION['mname']) || $_SESSION['mname'] === 'n/a' ? "" : " ") . (empty($_SESSION['mname']) || $_SESSION['mname'] === 'n/a' ? "" : $_SESSION['mname']) . " " . $_SESSION['lname'] . " as " . $_SESSION['role'] . "\n";
    $logMessage .= "delete barangay official id number " . $officialData['id'] . " for barangay official " . $officialData['official_res_name'] . "\n";
    $logMessage .= "date and time deleted " . date('m/d/Y h:i A') . "\n"; // include current date and time
    return rtrim($logMessage, ",\n") . "\n";
  }
}

if (isset($_POST['btn_delete'])) {
  if (isset($_POST['chk_delete']) && is_array($_POST['chk_delete'])) {
    $txt_edit_official_date_deleted = date('m/d/Y h:i A');
    // validate and sanitize each selected ids
    $validIds = array_map('intval', $_POST['chk_delete']);
    // remove non-numeric values
    $validIds = array_filter($validIds, 'is_numeric');

    if (!empty($validIds)) {
      // fetch the data before deleted for logging
      $placeholders = implode(', ', array_fill(0, count($validIds), '?'));

      // fetch the data to be deleted
      $deletedDataQuery = mysqli_prepare($con, "SELECT *, CONCAT(r.resident_fname, IF(r.resident_mname = 'n/a', '', CONCAT(' ', r.resident_mname)), ' ', r.resident_lname) as official_res_name, p.id as pid FROM tblofficial p LEFT JOIN tblresident r ON r.id = p.official_res_id WHERE p.id IN ($placeholders)");
      mysqli_stmt_bind_param($deletedDataQuery, str_repeat('i', count($validIds)), ...$validIds);
      mysqli_stmt_execute($deletedDataQuery);
      $deletedDataResult = mysqli_stmt_get_result($deletedDataQuery);

      // log each deleted record
      while ($deletedData = mysqli_fetch_array($deletedDataResult, MYSQLI_ASSOC)) {
        $action = deletedGenerateLogMessage($deletedData);
        $log_query = mysqli_prepare($con, "INSERT INTO tbllogs (logs_user_type, logs_fname, logs_lname, logs_logdate, logs_action) VALUES (?, ?, ?, ?, ?)");
        mysqli_stmt_bind_param($log_query, "sssss", $_SESSION['role'], $_SESSION['fname'], $_SESSION['lname'], $txt_edit_official_date_deleted, $action);
        mysqli_stmt_execute($log_query);
      }

      // prepare and execute the deletion query
      $delete_query = mysqli_prepare($con, "DELETE FROM tblofficial WHERE id IN ($placeholders)");

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