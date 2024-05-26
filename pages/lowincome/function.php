<?php

use Infobip\Configuration;
use Infobip\ApiException;
use Infobip\Api\SmsApi;
use Infobip\Model\SmsDestination;
use Infobip\Model\SmsTextualMessage;
use Infobip\Model\SmsAdvancedTextualRequest;

require __DIR__ . "../../../vendor/autoload.php";

// check before declaring to see if it already exists
if (!function_exists('addedGenerateLogMessage')) {
  function addedGenerateLogMessage($lowincomeData)
  {
    // data fetched
    $logMessage = "added certificate of low income details...\n\n";
    $logMessage .= "id: " . $lowincomeData['id'] . "\n";
    $logMessage .= "lowincome_num: " . $lowincomeData['lowincome_num'] . "\n";
    $logMessage .= "lowincome_res_name: " . $lowincomeData['lowincome_resident_name'] . "\n";
    $logMessage .= "lowincome_requester_res_name: " . $lowincomeData['lowincome_requester_res_name'] . "\n";
    $logMessage .= "lowincome_children_res_name: " . $lowincomeData['lowincome_children_res_name'] . "\n";
    $logMessage .= "lowincome_children_age: " . $lowincomeData['lowincome_children_res_age'] . "\n";
    $logMessage .= "lowincome_num_of_children: " . $lowincomeData['lowincome_num_of_children'] . "\n";
    $logMessage .= "lowincome_annual_income: " . $lowincomeData['lowincome_annual_income'] . "\n";
    $logMessage .= "lowincome_gov_office: " . $lowincomeData['lowincome_gov_office'] . "\n";
    $logMessage .= "lowincome_findings: " . $lowincomeData['lowincome_findings'] . "\n";
    $logMessage .= "lowincome_or_num: " . $lowincomeData['lowincome_or_num'] . "\n";
    $logMessage .= "lowincome_payment: " . $lowincomeData['lowincome_payment'] . "\n";
    $logMessage .= "lowincome_status: " . $lowincomeData['lowincome_status'] . "\n";
    $logMessage .= "lowincome_officer_name: " . $lowincomeData['lowincome_officer_res_name'] . "\n";
    $logMessage .= "lowincome_officer_position_id: " . $lowincomeData['lowincome_officer_position_id'] . "\n";
    $logMessage .= "lowincome_date_added: " . date('m/d/Y h:i A', strtotime($lowincomeData['lowincome_date_added'])) . "\n";
    $logMessage .= "lowincome_date_edited: " . $lowincomeData['lowincome_date_edited'] . "\n";
    $logMessage .= "lowincome_date_requested: " . $lowincomeData['lowincome_date_requested'] . "\n";
    $logMessage .= "lowincome_date_approved: " . $lowincomeData['lowincome_date_approved'] . "\n";
    $logMessage .= "lowincome_date_disapproved: " . $lowincomeData['lowincome_date_disapproved'] . "\n";
    $logMessage .= "lowincome_added_by: " . $lowincomeData['lowincome_added_by'] . "\n";
    $logMessage .= "lowincome_edited_by: " . $lowincomeData['lowincome_edited_by'] . "\n";
    $logMessage .= "lowincome_requested_by: " . $lowincomeData['lowincome_requested_by'] . "\n";
    $logMessage .= "lowincome_approved_by: " . $lowincomeData['lowincome_approved_by'] . "\n";
    $logMessage .= "lowincome_disapproved_by: " . $lowincomeData['lowincome_disapproved_by'] . "\n\n";

    // log session role
    $logMessage .= "this add is done by " . $_SESSION['fname'] . (empty($_SESSION['mname']) || $_SESSION['mname'] === 'n/a' ? "" : " ") . (empty($_SESSION['mname']) || $_SESSION['mname'] === 'n/a' ? "" : $_SESSION['mname']) . " " . $_SESSION['lname'] . " as " . $_SESSION['role'] . "\n";
    $logMessage .= "add certificate of low income id number " . $lowincomeData['id'] . " for resident " . $lowincomeData['lowincome_resident_name'] . "\n";
    $logMessage .= "date and time added " . date('m/d/Y h:i A') . "\n"; // include current date and time
    return rtrim($logMessage, ",\n") . "\n";
  }
}

if (isset($_POST['btn_add'])) {
  $txt_add_lowincome_num = !empty($_POST['txt_add_lowincome_num']) ? strtolower($_POST['txt_add_lowincome_num']) : 'n/a';
  $txt_add_lowincome_res_id = !empty($_POST['txt_add_lowincome_res_id']) ? strtolower($_POST['txt_add_lowincome_res_id']) : 'n/a';
  $txt_add_lowincome_requester_res_id = !empty($_POST['txt_add_lowincome_requester_res_id']) ? strtolower($_POST['txt_add_lowincome_requester_res_id']) : 'n/a';
  $txt_add_lowincome_children_res_id = !empty($_POST['txt_add_lowincome_children_res_id']) ? strtolower($_POST['txt_add_lowincome_children_res_id']) : 'n/a';
  $txt_add_lowincome_children_age = !empty($_POST['txt_add_lowincome_children_age']) ? strtolower($_POST['txt_add_lowincome_children_age']) : 'n/a';
  $txt_add_lowincome_num_of_children = !empty($_POST['txt_add_lowincome_num_of_children']) ? $_POST['txt_add_lowincome_num_of_children'] : 'n/a';
  $txt_add_lowincome_annual_income = !empty($_POST['txt_add_lowincome_annual_income']) ? strtolower('Php ' . number_format($_POST['txt_add_lowincome_annual_income'], 2)) : 'Php 0.00';
  $txt_add_lowincome_gov_office = !empty($_POST['txt_add_lowincome_gov_office']) ? $_POST['txt_add_lowincome_gov_office'] : 'n/a';
  $txt_add_lowincome_officer_of_dday = !empty($_POST['txt_add_lowincome_officer_of_dday']) ? strtolower($_POST['txt_add_lowincome_officer_of_dday']) : 'n/a';
  $txt_add_lowincome_officer_of_dday_pos = !empty($_POST['txt_add_lowincome_officer_of_dday_pos']) ? strtolower($_POST['txt_add_lowincome_officer_of_dday_pos']) : 'n/a';
  $txt_add_lowincome_or_num = !empty($_POST['txt_add_lowincome_or_num']) ? strtolower($_POST['txt_add_lowincome_or_num']) : 'n/a';
  $txt_add_lowincome_payment = !empty($_POST['txt_add_lowincome_payment']) ? strtolower('₱' . number_format($_POST['txt_add_lowincome_payment'], 2)) : '₱0.00';
  $txt_add_lowincome_status = ($_SESSION['role'] === "administrator" || $_SESSION['role'] === "staff") ? 'approved' : 'new';

  $txt_add_lowincome_date_added = date('m/d/Y h:i A');
  $txt_add_lowincome_added_by = $_SESSION['fname'] . (empty($_SESSION['mname']) || $_SESSION['mname'] === 'n/a' ? '' : ' ') . (empty($_SESSION['mname']) || $_SESSION['mname'] === 'n/a' ? '' : $_SESSION['mname']) . ' ' . $_SESSION['lname'] . ' as ' . $_SESSION['role'];
  $txt_add_lowincome_user_type = $_SESSION['role'];

  // check duplicate lowincome num
  $check_query = mysqli_prepare($con, "SELECT lowincome_num FROM tbllowincome WHERE lowincome_num = ?");
  mysqli_stmt_bind_param($check_query, "s", $txt_add_lowincome_num);
  mysqli_stmt_execute($check_query);
  mysqli_stmt_store_result($check_query);
  $num_rows = mysqli_stmt_num_rows($check_query);

  if ($num_rows == 0) {
    // insert query
    $insert_query = mysqli_prepare($con, "INSERT INTO tbllowincome (lowincome_num, lowincome_res_id, lowincome_requester_res_id, lowincome_children_res_id, lowincome_children_age, lowincome_num_of_children, lowincome_annual_income, lowincome_gov_office, lowincome_findings, lowincome_or_num, lowincome_payment, lowincome_status, lowincome_officer_res_id, lowincome_officer_position_id, lowincome_date_added, lowincome_date_edited, lowincome_date_requested, lowincome_date_approved, lowincome_date_disapproved, lowincome_added_by, lowincome_edited_by, lowincome_requested_by, lowincome_approved_by, lowincome_disapproved_by) VALUES (?, ?, ?, ?, ?, ?, ?, ?, 'n/a', ?, ?, ?, ?, ?, ?, 'n/a', 'n/a', 'n/a', 'n/a', ?, 'n/a', 'n/a', 'n/a', 'n/a')");
    mysqli_stmt_bind_param($insert_query, "sssssssssssssss", $txt_add_lowincome_num, $txt_add_lowincome_res_id, $txt_add_lowincome_requester_res_id, $txt_add_lowincome_children_res_id, $txt_add_lowincome_children_age, $txt_add_lowincome_num_of_children, $txt_add_lowincome_annual_income, $txt_add_lowincome_gov_office, $txt_add_lowincome_or_num, $txt_add_lowincome_payment, $txt_add_lowincome_status, $txt_add_lowincome_officer_of_dday, $txt_add_lowincome_officer_of_dday_pos, $txt_add_lowincome_date_added, $txt_add_lowincome_added_by);

    if (mysqli_stmt_execute($insert_query)) {
      // fetch the last inserted record
      $lastInsertedId = mysqli_insert_id($con);

      // fetch new data after the update
      $lowincomeDataQuery = mysqli_prepare($con, "SELECT p.*, 
      CASE
      WHEN r1.id IS NOT NULL THEN CONCAT(r1.resident_fname, 
      IF(r1.resident_mname = 'n/a', '', CONCAT(' ', SUBSTRING(r1.resident_mname, 1, 1), '.')), 
      ' ', r1.resident_lname)
      WHEN p.lowincome_res_id REGEXP '^[0-9]+$' THEN (SELECT CONCAT(resident_fname, 
      IF(resident_mname = 'n/a', '', CONCAT(' ', SUBSTRING(resident_mname, 1, 1), '.')), 
      ' ', resident_lname) FROM tblresident WHERE id = p.lowincome_res_id) 
          ELSE p.lowincome_res_id
          END AS lowincome_resident_name,
      CASE 
          WHEN r2.id IS NOT NULL THEN CONCAT(r2.resident_fname, 
      IF(r2.resident_mname = 'n/a', '', CONCAT(' ', SUBSTRING(r2.resident_mname, 1, 1), '.')), 
      ' ', r2.resident_lname)
          WHEN p.lowincome_children_res_id REGEXP '^[0-9]+$' THEN (SELECT CONCAT(resident_fname, 
      IF(resident_mname = 'n/a', '', CONCAT(' ', SUBSTRING(resident_mname, 1, 1), '.')), 
      ' ', resident_lname) FROM tblresident WHERE id = p.lowincome_children_res_id) 
          ELSE p.lowincome_children_res_id 
      END AS lowincome_children_res_name,
      CASE 
      WHEN p.lowincome_children_age = 'n/a' THEN r2.resident_age
      ELSE p.lowincome_children_age
      END AS lowincome_children_res_age,
      CASE 
          WHEN r3.id IS NOT NULL THEN CONCAT(r3.resident_fname, 
      IF(r3.resident_mname = 'n/a', '', CONCAT(' ', SUBSTRING(r3.resident_mname, 1, 1), '.')), 
      ' ', r3.resident_lname)
          WHEN p.lowincome_requester_res_id = 'n/a' THEN 'requester is not needed when making request'
          WHEN p.lowincome_requester_res_id REGEXP '^[0-9]+$' THEN (SELECT CONCAT(resident_fname, 
      IF(resident_mname = 'n/a', '', CONCAT(' ', SUBSTRING(resident_mname, 1, 1), '.')), 
      ' ', resident_lname) FROM tblresident WHERE id = p.lowincome_requester_res_id) 
          ELSE p.lowincome_requester_res_id 
      END AS lowincome_requester_res_name,

      CASE 
          WHEN r4.id IS NOT NULL THEN CONCAT(r4.officer_fname, 
      IF(r4.officer_mname = 'n/a', '', CONCAT(' ', SUBSTRING(r4.officer_mname, 1, 1), '.')), 
      ' ', r4.officer_lname)
          WHEN p.lowincome_officer_res_id IS NULL THEN 'officer of the day is not found in the database'
          WHEN p.lowincome_officer_res_id REGEXP '^[0-9]+$' THEN (SELECT CONCAT(officer_fname, 
      IF(officer_mname = 'n/a', '', CONCAT(' ', SUBSTRING(officer_mname, 1, 1), '.')), 
      ' ', officer_lname) FROM tblofficer WHERE id = p.lowincome_officer_res_id) 
          ELSE p.lowincome_officer_res_id 
      END AS lowincome_officer_res_name

      FROM tbllowincome p 
      LEFT JOIN tblresident r1 ON r1.id = p.lowincome_res_id 
      LEFT JOIN tblresident r2 ON r2.id = p.lowincome_children_res_id 
      LEFT JOIN tblresident r3 ON r3.id = p.lowincome_requester_res_id 
      LEFT JOIN tblofficer r4 ON r4.id = p.lowincome_officer_res_id 
      WHERE p.id = ?");

      mysqli_stmt_bind_param($lowincomeDataQuery, "i", $lastInsertedId);
      mysqli_stmt_execute($lowincomeDataQuery);
      $lowincomeDataQueryResult = mysqli_stmt_get_result($lowincomeDataQuery);
      $lowincomeData = mysqli_fetch_array($lowincomeDataQueryResult, MYSQLI_ASSOC);
      mysqli_stmt_close($lowincomeDataQuery);

      if (isset($_SESSION['role'])) {
        // log the old and new data
        $action = addedGenerateLogMessage($lowincomeData);
        $log_query = mysqli_prepare($con, "INSERT INTO tbllogs (logs_user_type, logs_fname, logs_lname, logs_logdate, logs_action) VALUES (?, ?, ?, ?, ?)");
        mysqli_stmt_bind_param($log_query, "sssss", $txt_add_lowincome_user_type, $_SESSION['fname'], $_SESSION['lname'], $txt_add_lowincome_date_added, $action);
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
if (!function_exists('requestedGenerateLogMessage')) {
  function requestedGenerateLogMessage($lowincomeData)
  {
    // data fetched
    $logMessage = "requested certificate of low income details...\n\n";
    $logMessage .= "id: " . $lowincomeData['id'] . "\n";
    $logMessage .= "lowincome_num: " . $lowincomeData['lowincome_num'] . "\n";
    $logMessage .= "lowincome_res_name: " . $lowincomeData['lowincome_resident_name'] . "\n";
    $logMessage .= "lowincome_requester_res_name: " . $lowincomeData['lowincome_requester_res_name'] . "\n";
    $logMessage .= "lowincome_children_res_name: " . $lowincomeData['lowincome_children_res_name'] . "\n";
    $logMessage .= "lowincome_children_age: " . $lowincomeData['lowincome_children_res_age'] . "\n";
    $logMessage .= "lowincome_num_of_children: " . $lowincomeData['lowincome_num_of_children'] . "\n";
    $logMessage .= "lowincome_annual_income: " . $lowincomeData['lowincome_annual_income'] . "\n";
    $logMessage .= "lowincome_gov_office: " . $lowincomeData['lowincome_gov_office'] . "\n";
    $logMessage .= "lowincome_findings: " . $lowincomeData['lowincome_findings'] . "\n";
    $logMessage .= "lowincome_or_num: " . $lowincomeData['lowincome_or_num'] . "\n";
    $logMessage .= "lowincome_payment: " . $lowincomeData['lowincome_payment'] . "\n";
    $logMessage .= "lowincome_status: " . $lowincomeData['lowincome_status'] . "\n";
    $logMessage .= "lowincome_officer_res_name: " . $lowincomeData['lowincome_officer_res_id'] . "\n";
    $logMessage .= "lowincome_officer_position_id: " . $lowincomeData['lowincome_officer_position_id'] . "\n";
    $logMessage .= "lowincome_date_added: " . $lowincomeData['lowincome_date_added'] . "\n";
    $logMessage .= "lowincome_date_edited: " . $lowincomeData['lowincome_date_edited'] . "\n";
    $logMessage .= "lowincome_date_requested: " . date('m/d/Y h:i A', strtotime($lowincomeData['lowincome_date_requested'])) . "\n";
    $logMessage .= "lowincome_date_approved: " . $lowincomeData['lowincome_date_approved'] . "\n";
    $logMessage .= "lowincome_date_disapproved: " . $lowincomeData['lowincome_date_disapproved'] . "\n";
    $logMessage .= "lowincome_added_by: " . $lowincomeData['lowincome_added_by'] . "\n";
    $logMessage .= "lowincome_edited_by: " . $lowincomeData['lowincome_edited_by'] . "\n";
    $logMessage .= "lowincome_requested_by: " . $lowincomeData['lowincome_requested_by'] . "\n";
    $logMessage .= "lowincome_approved_by: " . $lowincomeData['lowincome_approved_by'] . "\n";
    $logMessage .= "lowincome_disapproved_by: " . $lowincomeData['lowincome_disapproved_by'] . "\n\n";

    // log session role
    $logMessage .= "this request is done by " . $_SESSION['fname'] . (empty($_SESSION['mname']) || $_SESSION['mname'] === 'n/a' ? "" : " ") . (empty($_SESSION['mname']) || $_SESSION['mname'] === 'n/a' ? "" : $_SESSION['mname']) . " " . $_SESSION['lname'] . " as " . $_SESSION['role'] . "\n";
    $logMessage .= "request certificate of low income id number " . $lowincomeData['id'] . " for resident " . $lowincomeData['lowincome_resident_name'] . "\n";
    $logMessage .= "date and time requested " . date('m/d/Y h:i A') . "\n"; // include current date and time
    return rtrim($logMessage, ",\n") . "\n";
  }
}

if (isset($_POST['btn_request'])) {
  $txt_req_lowincome_user_id = $_SESSION['userid'];

  // Check if the user has exceeded the maximum number of requests
  $check_lowincome_requests = "SELECT COUNT(*) AS request_count FROM tbllowincome WHERE lowincome_res_id = ? AND lowincome_status = 'new'";
  $check_lowincome_stmt = mysqli_prepare($con, $check_lowincome_requests);
  mysqli_stmt_bind_param($check_lowincome_stmt, "s", $txt_req_lowincome_user_id);
  mysqli_stmt_execute($check_lowincome_stmt);
  $result = mysqli_stmt_get_result($check_lowincome_stmt);
  $row = mysqli_fetch_assoc($result);
  $request_count = $row['request_count'];

  if ($request_count >= 3) {
    // User has exceeded the maximum number of requests
    $message = "You've maxed out requests. Please wait for the barangay admin request approval.";
    $_SESSION['warning'] = $message;
    header("location: " . $_SERVER['REQUEST_URI']);
    exit();

  } else {
    // check if it is not a respondent in any unsolved blotter
    $check_blotter = "SELECT * FROM tblblotter WHERE blotter_status = 'unsolved' AND blotter_respondent = ?";
    $check_blotter_stmt = mysqli_prepare($con, $check_blotter);
    mysqli_stmt_bind_param($check_blotter_stmt, "s", $txt_req_lowincome_user_id);

    if (mysqli_stmt_execute($check_blotter_stmt)) {
      $check_res = mysqli_stmt_get_result($check_blotter_stmt);

      // it is not a respondent in any unsolved blotter
      if (mysqli_num_rows($check_res) == 0) {
        // check length of stay
        $check_length = "SELECT * FROM tblresident WHERE id = ?";
        $check_length_stmt = mysqli_prepare($con, $check_length);
        mysqli_stmt_bind_param($check_length_stmt, "s", $txt_req_lowincome_user_id);

        if (mysqli_stmt_execute($check_length_stmt)) {
          $check_res = mysqli_stmt_get_result($check_length_stmt);

          while ($row = mysqli_fetch_array($check_res)) {
            // request was unsuccessful because it is below 6 months
            if ($row['resident_length_of_stay'] < 6) {

              $message = "Your request was unsuccessful because you have not resided in this barangay for at least 6 months.";
              $_SESSION['warning'] = $message;
              header("location: " . $_SERVER['REQUEST_URI']);
              exit();

            } else {
              // user can request lowincome
              $txt_req_lowincome_children_res_id = !empty($_POST['txt_req_lowincome_children_res_id']) ? strtolower($_POST['txt_req_lowincome_children_res_id']) : 'n/a';
              $txt_req_lowincome_children_age = !empty($_POST['txt_req_lowincome_children_age']) ? strtolower($_POST['txt_req_lowincome_children_age']) : 'n/a';
              $txt_req_lowincome_num_of_children = !empty($_POST['txt_req_lowincome_num_of_children']) ? strtolower($_POST['txt_req_lowincome_num_of_children']) : 'n/a';
              $txt_req_lowincome_annual_income = !empty($_POST['txt_req_lowincome_annual_income']) ? strtolower('Php ' . number_format($_POST['txt_req_lowincome_annual_income'], 2)) : 'Php 0.00';
              $txt_req_lowincome_gov_office = !empty($_POST['txt_req_lowincome_gov_office']) ? $_POST['txt_req_lowincome_gov_office'] : 'n/a';

              $txt_req_lowincome_date_requested = date('m/d/Y h:i A');
              $txt_req_lowincome_requested_by = $_SESSION['fname'] . (empty($_SESSION['mname']) || $_SESSION['mname'] === 'n/a' ? '' : ' ') . (empty($_SESSION['mname']) || $_SESSION['mname'] === 'n/a' ? '' : $_SESSION['mname']) . ' ' . $_SESSION['lname'] . ' as ' . $_SESSION['role'];
              $txt_req_lowincome_user_type = $_SESSION['role'];

              // insert query
              $req_query = "INSERT INTO tbllowincome (lowincome_num, lowincome_res_id, lowincome_requester_res_id, lowincome_children_res_id, lowincome_children_age, lowincome_num_of_children, lowincome_annual_income, lowincome_gov_office, lowincome_findings, lowincome_or_num, lowincome_payment, lowincome_status, lowincome_officer_res_id, lowincome_officer_position_id, lowincome_date_added, lowincome_date_edited, lowincome_date_requested, lowincome_date_approved, lowincome_date_disapproved, lowincome_added_by, lowincome_edited_by, lowincome_requested_by, lowincome_approved_by, lowincome_disapproved_by) VALUES ('n/a', ?, 'n/a', ?, ?, ?, ?, ?, 'n/a', 'n/a', 'n/a', 'new', 'n/a', 'n/a', 'n/a', 'n/a', ?, 'n/a', 'n/a', 'n/a', 'n/a', ?, 'n/a', 'n/a')";
              $req_query_stmt = mysqli_prepare($con, $req_query);
              mysqli_stmt_bind_param($req_query_stmt, "isssssss", $txt_req_lowincome_user_id, $txt_req_lowincome_children_res_id, $txt_req_lowincome_children_age, $txt_req_lowincome_num_of_children, $txt_req_lowincome_annual_income, $txt_req_lowincome_gov_office, $txt_req_lowincome_date_requested, $txt_req_lowincome_requested_by);

              // execute query statement
              if (mysqli_stmt_execute($req_query_stmt)) {

                if (mysqli_stmt_affected_rows($req_query_stmt) > 0) {
                  // fetch the last inserted record
                  $lastInsertedId = mysqli_insert_id($con);

                  // fetch new data after the update
                  $lowincomeDataQuery = mysqli_prepare($con, "SELECT p.*, 
                  CASE
                  WHEN r1.id IS NOT NULL THEN CONCAT(r1.resident_fname, 
                  IF(r1.resident_mname = 'n/a', '', CONCAT(' ', SUBSTRING(r1.resident_mname, 1, 1), '.')), 
                  ' ', r1.resident_lname)
                  WHEN p.lowincome_res_id REGEXP '^[0-9]+$' THEN (SELECT CONCAT(resident_fname, 
                  IF(resident_mname = 'n/a', '', CONCAT(' ', SUBSTRING(resident_mname, 1, 1), '.')), 
                  ' ', resident_lname) FROM tblresident WHERE id = p.lowincome_res_id) 
                      ELSE p.lowincome_res_id
                      END AS lowincome_resident_name,
                  CASE 
                      WHEN r2.id IS NOT NULL THEN CONCAT(r2.resident_fname, 
                  IF(r2.resident_mname = 'n/a', '', CONCAT(' ', SUBSTRING(r2.resident_mname, 1, 1), '.')), 
                  ' ', r2.resident_lname)
                      WHEN p.lowincome_children_res_id REGEXP '^[0-9]+$' THEN (SELECT CONCAT(resident_fname, 
                  IF(resident_mname = 'n/a', '', CONCAT(' ', SUBSTRING(resident_mname, 1, 1), '.')), 
                  ' ', resident_lname) FROM tblresident WHERE id = p.lowincome_children_res_id) 
                      ELSE p.lowincome_children_res_id 
                  END AS lowincome_children_res_name,
                  CASE 
                  WHEN p.lowincome_children_age = 'n/a' THEN r2.resident_age
                  ELSE p.lowincome_children_age
                  END AS lowincome_children_res_age,
                  CASE 
                      WHEN r3.id IS NOT NULL THEN CONCAT(r3.resident_fname, 
                  IF(r3.resident_mname = 'n/a', '', CONCAT(' ', SUBSTRING(r3.resident_mname, 1, 1), '.')), 
                  ' ', r3.resident_lname)
                      WHEN p.lowincome_requester_res_id = 'n/a' THEN 'requester is not needed when making request'
                      WHEN p.lowincome_requester_res_id REGEXP '^[0-9]+$' THEN (SELECT CONCAT(resident_fname, 
                  IF(resident_mname = 'n/a', '', CONCAT(' ', SUBSTRING(resident_mname, 1, 1), '.')), 
                  ' ', resident_lname) FROM tblresident WHERE id = p.lowincome_requester_res_id) 
                      ELSE p.lowincome_requester_res_id 
                  END AS lowincome_requester_res_name
                  FROM tbllowincome p 
                  LEFT JOIN tblresident r1 ON r1.id = p.lowincome_res_id 
                  LEFT JOIN tblresident r2 ON r2.id = p.lowincome_children_res_id 
                  LEFT JOIN tblresident r3 ON r3.id = p.lowincome_requester_res_id 
                  WHERE p.id = ?");

                  mysqli_stmt_bind_param($lowincomeDataQuery, "i", $lastInsertedId);
                  mysqli_stmt_execute($lowincomeDataQuery);
                  $lowincomeDataQueryResult = mysqli_stmt_get_result($lowincomeDataQuery);
                  $lowincomeData = mysqli_fetch_array($lowincomeDataQueryResult, MYSQLI_ASSOC);
                  mysqli_stmt_close($lowincomeDataQuery);

                  if (isset($_SESSION['role'])) {
                    // log the old and new data
                    $action = requestedGenerateLogMessage($lowincomeData);
                    $log_query = mysqli_prepare($con, "INSERT INTO tbllogs (logs_user_type, logs_fname, logs_lname, logs_logdate, logs_action) VALUES (?, ?, ?, ?, ?)");
                    mysqli_stmt_bind_param($log_query, "sssss", $txt_req_lowincome_user_type, $_SESSION['fname'], $_SESSION['lname'], $txt_req_lowincome_date_requested, $action);
                    mysqli_stmt_execute($log_query);
                  }

                  $message = 'Success';
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
                $message = "Error";
                $_SESSION['error'] = $message;
                header("location: " . $_SERVER['REQUEST_URI']);
                exit();
              }
            }
          }

        } else {
          $message = "Error";
          $_SESSION['error'] = $message;
          header("location: " . $_SERVER['REQUEST_URI']);
          exit();
        }

        // close prepared statement
        mysqli_stmt_close($check_length_stmt);

      } else {
        // request was unsuccessful because this user is listed as a respondent in unresolved blotter
        $message = "Your request cannot be processed at this time as you are listed as a respondent in unresolved blotter.";
        $_SESSION['warning'] = $message;
        header("location: " . $_SERVER['REQUEST_URI']);
        exit();
      }

    } else {
      $message = "Error";
      $_SESSION['error'] = $message;
      header("location: " . $_SERVER['REQUEST_URI']);
      exit();
    }
    // close prepared statement
    mysqli_stmt_close($check_blotter_stmt);

    // reset request count if needed
    if ($request_count >= 3) {
      // update the request count to 0
      $reset_request_count_query = "UPDATE tbllowincome SET request_count = 0 WHERE lowincome_res_id = ? AND lowincome_status = 'approve'";
      $reset_request_count_stmt = mysqli_prepare($con, $reset_request_count_query);
      mysqli_stmt_bind_param($reset_request_count_stmt, "s", $txt_req_lowincome_user_id);
      mysqli_stmt_execute($reset_request_count_stmt);

    } else {
      $message = "Error";
      $_SESSION['error'] = $message;
      header("location: " . $_SERVER['REQUEST_URI']);
      exit();
    }
  }
}

// check before declaring to see if it already exists
if (!function_exists('approvedGenerateLogMessage')) {
  function approvedGenerateLogMessage($lowincomeData)
  {
    // data fetched
    $logMessage = "approved certificate of low income details...\n\n";
    $logMessage .= "id: " . $lowincomeData['id'] . "\n";
    $logMessage .= "lowincome_num: " . $lowincomeData['lowincome_num'] . "\n";
    $logMessage .= "lowincome_res_name: " . $lowincomeData['lowincome_resident_name'] . "\n";
    $logMessage .= "lowincome_requester_res_name: " . $lowincomeData['lowincome_requester_res_name'] . "\n";
    $logMessage .= "lowincome_children_res_name: " . $lowincomeData['lowincome_children_res_name'] . "\n";
    $logMessage .= "lowincome_children_age: " . $lowincomeData['lowincome_children_res_age'] . "\n";
    $logMessage .= "lowincome_num_of_children: " . $lowincomeData['lowincome_num_of_children'] . "\n";
    $logMessage .= "lowincome_annual_income: " . $lowincomeData['lowincome_annual_income'] . "\n";
    $logMessage .= "lowincome_gov_office: " . $lowincomeData['lowincome_gov_office'] . "\n";
    $logMessage .= "lowincome_findings: " . $lowincomeData['lowincome_findings'] . "\n";
    $logMessage .= "lowincome_or_num: " . $lowincomeData['lowincome_or_num'] . "\n";
    $logMessage .= "lowincome_payment: " . $lowincomeData['lowincome_payment'] . "\n";
    $logMessage .= "lowincome_status: " . $lowincomeData['lowincome_status'] . "\n";
    $logMessage .= "lowincome_officer_res_id: " . $lowincomeData['lowincome_officer_res_name'] . "\n";
    $logMessage .= "lowincome_officer_position_id: " . $lowincomeData['lowincome_officer_position_id'] . "\n";
    $logMessage .= "lowincome_date_added: " . $lowincomeData['lowincome_date_added'] . "\n";
    $logMessage .= "lowincome_date_edited: " . $lowincomeData['lowincome_date_edited'] . "\n";
    $logMessage .= "lowincome_date_requested: " . $lowincomeData['lowincome_date_requested'] . "\n";
    $logMessage .= "lowincome_date_approved: " . date('m/d/Y h:i A', strtotime($lowincomeData['lowincome_date_approved'])) . "\n";
    $logMessage .= "lowincome_date_disapproved: " . $lowincomeData['lowincome_date_disapproved'] . "\n";
    $logMessage .= "lowincome_added_by: " . $lowincomeData['lowincome_added_by'] . "\n";
    $logMessage .= "lowincome_edited_by: " . $lowincomeData['lowincome_edited_by'] . "\n";
    $logMessage .= "lowincome_requested_by: " . $lowincomeData['lowincome_requested_by'] . "\n";
    $logMessage .= "lowincome_approved_by: " . $lowincomeData['lowincome_approved_by'] . "\n";
    $logMessage .= "lowincome_disapproved_by: " . $lowincomeData['lowincome_disapproved_by'] . "\n\n";

    // log session role
    $logMessage .= "this approve is done by " . $_SESSION['fname'] . (empty($_SESSION['mname']) || $_SESSION['mname'] === 'n/a' ? "" : " ") . (empty($_SESSION['mname']) || $_SESSION['mname'] === 'n/a' ? "" : $_SESSION['mname']) . " " . $_SESSION['lname'] . " as " . $_SESSION['role'] . "\n";
    $logMessage .= "approve certificate of low income id number " . $lowincomeData['id'] . " requested by " . $lowincomeData['lowincome_resident_name'] . "\n";
    $logMessage .= "date and time approved " . date('m/d/Y h:i A') . "\n"; // include current date and time
    return rtrim($logMessage, ",\n") . "\n";
  }
}

if (isset($_POST['btn_approve'])) {
  $txt_app_lowincome_user_id = $_POST['hidden_id'];
  $txt_app_lowincome_num = !empty($_POST['txt_app_lowincome_num']) ? strtolower($_POST['txt_app_lowincome_num']) : 'n/a';
  $txt_app_lowincome_or_num = !empty($_POST['txt_app_lowincome_or_num']) ? strtolower($_POST['txt_app_lowincome_or_num']) : 'n/a';
  $txt_app_lowincome_payment = !empty($_POST['txt_app_lowincome_payment']) ? strtolower('₱' . number_format($_POST['txt_app_lowincome_payment'], 2)) : '₱0.00';
  $txt_app_lowincome_officer_of_dday = !empty($_POST['txt_app_lowincome_officer_of_dday']) ? strtolower($_POST['txt_app_lowincome_officer_of_dday']) : 'n/a';
  $txt_app_lowincome_officer_of_dday_pos = !empty($_POST['txt_app_lowincome_officer_of_dday_pos']) ? strtolower($_POST['txt_app_lowincome_officer_of_dday_pos']) : 'n/a';

  $txt_app_lowincome_date_approved = date('m/d/Y h:i A');
  $txt_app_lowincome_approved_by = $_SESSION['fname'] . (empty($_SESSION['mname']) || $_SESSION['mname'] === 'n/a' ? '' : ' ') . (empty($_SESSION['mname']) || $_SESSION['mname'] === 'n/a' ? '' : $_SESSION['mname']) . ' ' . $_SESSION['lname'] . ' as ' . $_SESSION['role'];
  $txt_app_lowincome_user_type = $_SESSION['role'];

  $check_lowincome_num = mysqli_prepare($con, "SELECT lowincome_num FROM tbllowincome WHERE lowincome_num = ?");
  mysqli_stmt_bind_param($check_lowincome_num, "s", $txt_app_lowincome_num);
  mysqli_stmt_execute($check_lowincome_num);
  mysqli_stmt_store_result($check_lowincome_num);
  $num_rows = mysqli_stmt_num_rows($check_lowincome_num);

  if ($num_rows == 0) {
    // update query
    $approve_query = mysqli_prepare($con, "UPDATE tbllowincome SET lowincome_num = ?, lowincome_or_num = ?, lowincome_payment = ?, lowincome_status = 'approved', lowincome_officer_res_id = ?, lowincome_officer_position_id = ?, lowincome_date_approved = ?, lowincome_approved_by = ? WHERE id = ?");
    mysqli_stmt_bind_param($approve_query, "sssssssi", $txt_app_lowincome_num, $txt_app_lowincome_or_num, $txt_app_lowincome_payment, $txt_app_lowincome_officer_of_dday, $txt_app_lowincome_officer_of_dday_pos, $txt_app_lowincome_date_approved, $txt_app_lowincome_approved_by, $txt_app_lowincome_user_id);

    if (mysqli_stmt_execute($approve_query)) {
      // fetch new data after the update
      $lowincomeDataQuery = mysqli_prepare($con, "SELECT p.*, 
      CASE
      WHEN r1.id IS NOT NULL THEN CONCAT(r1.resident_fname, 
      IF(r1.resident_mname = 'n/a', '', CONCAT(' ', SUBSTRING(r1.resident_mname, 1, 1), '.')), 
      ' ', r1.resident_lname)
      WHEN p.lowincome_res_id REGEXP '^[0-9]+$' THEN (SELECT CONCAT(resident_fname, 
      IF(resident_mname = 'n/a', '', CONCAT(' ', SUBSTRING(resident_mname, 1, 1), '.')), 
      ' ', resident_lname) FROM tblresident WHERE id = p.lowincome_res_id) 
          ELSE p.lowincome_res_id
          END AS lowincome_resident_name,
      CASE 
          WHEN r2.id IS NOT NULL THEN CONCAT(r2.resident_fname, 
      IF(r2.resident_mname = 'n/a', '', CONCAT(' ', SUBSTRING(r2.resident_mname, 1, 1), '.')), 
      ' ', r2.resident_lname)
          WHEN p.lowincome_children_res_id REGEXP '^[0-9]+$' THEN (SELECT CONCAT(resident_fname, 
      IF(resident_mname = 'n/a', '', CONCAT(' ', SUBSTRING(resident_mname, 1, 1), '.')), 
      ' ', resident_lname) FROM tblresident WHERE id = p.lowincome_children_res_id) 
          ELSE p.lowincome_children_res_id 
      END AS lowincome_children_res_name,
      CASE 
      WHEN p.lowincome_children_age = 'n/a' THEN r2.resident_age
      ELSE p.lowincome_children_age
      END AS lowincome_children_res_age,
      CASE 
          WHEN r3.id IS NOT NULL THEN CONCAT(r3.resident_fname, 
      IF(r3.resident_mname = 'n/a', '', CONCAT(' ', SUBSTRING(r3.resident_mname, 1, 1), '.')), 
      ' ', r3.resident_lname)
          WHEN p.lowincome_requester_res_id = 'n/a' THEN 'requester is not needed when making request'
          WHEN p.lowincome_requester_res_id REGEXP '^[0-9]+$' THEN (SELECT CONCAT(resident_fname, 
      IF(resident_mname = 'n/a', '', CONCAT(' ', SUBSTRING(resident_mname, 1, 1), '.')), 
      ' ', resident_lname) FROM tblresident WHERE id = p.lowincome_requester_res_id) 
          ELSE p.lowincome_requester_res_id 
      END AS lowincome_requester_res_name,

      CASE 
          WHEN r4.id IS NOT NULL THEN CONCAT(r4.officer_fname, 
      IF(r4.officer_mname = 'n/a', '', CONCAT(' ', SUBSTRING(r4.officer_mname, 1, 1), '.')), 
      ' ', r4.officer_lname)
          WHEN p.lowincome_officer_res_id IS NULL THEN 'officer of the day is not found in the database'
          WHEN p.lowincome_officer_res_id REGEXP '^[0-9]+$' THEN (SELECT CONCAT(officer_fname, 
      IF(officer_mname = 'n/a', '', CONCAT(' ', SUBSTRING(officer_mname, 1, 1), '.')), 
      ' ', officer_lname) FROM tblofficer WHERE id = p.lowincome_officer_res_id) 
          ELSE p.lowincome_officer_res_id 
      END AS lowincome_officer_res_name,

      r1.resident_mobile_num

      FROM tbllowincome p 
      LEFT JOIN tblresident r1 ON r1.id = p.lowincome_res_id 
      LEFT JOIN tblresident r2 ON r2.id = p.lowincome_children_res_id 
      LEFT JOIN tblresident r3 ON r3.id = p.lowincome_requester_res_id 
      LEFT JOIN tblofficer r4 ON r4.id = p.lowincome_officer_res_id 
      WHERE p.id = ?");

      mysqli_stmt_bind_param($lowincomeDataQuery, "i", $txt_app_lowincome_user_id);
      mysqli_stmt_execute($lowincomeDataQuery);
      $lowincomeDataQueryResult = mysqli_stmt_get_result($lowincomeDataQuery);
      $lowincomeData = mysqli_fetch_array($lowincomeDataQueryResult, MYSQLI_ASSOC);
      mysqli_stmt_close($lowincomeDataQuery);

      if (isset($_SESSION['role'])) {
        // log the old and new data
        $action = approvedGenerateLogMessage($lowincomeData);
        $log_query = mysqli_prepare($con, "INSERT INTO tbllogs (logs_user_type, logs_fname, logs_lname, logs_logdate, logs_action) VALUES (?, ?, ?, ?, ?)");
        mysqli_stmt_bind_param($log_query, "sssss", $txt_app_lowincome_user_type, $_SESSION['fname'], $_SESSION['lname'], $txt_app_lowincome_date_approved, $action);
        mysqli_stmt_execute($log_query);
      }

      // send sms notification with the secret key
      try {
        // infobip config
        $configuration = new Configuration(host: getenv('INFOBIP_BASE_URL'), apiKey: getenv('INFOBIP_API_KEY'));
        $sendSmsApi = new SmsApi(config: $configuration);
        $destination = new SmsDestination(to: $lowincomeData['resident_mobile_num']);

        $message = "Hi " . ucwords(strtolower(htmlspecialchars($lowincomeData['lowincome_res_name']))) . ", good news! Your request is approved. You can get your certificate of low income at the barangay hall now.";

        $message = new SmsTextualMessage(destinations: [$destination], from: 'NEWPANDAN', text: $message);
        $request = new SmsAdvancedTextualRequest(messages: [$message]);

        // send sms message
        $smsResponse = $sendSmsApi->sendSmsMessage($request);

        // retrieve a bulk id and a message id from the sms response object to use for troubleshooting or fetching a delivery report for a given message or a bulk
        $bulkId = $smsResponse->getBulkId();
        $messages = $smsResponse->getMessages();
        $messageId = (!empty($messages)) ? current($messages)->getMessageId() : null;

      } catch (ApiException $apiException) {
        // get the deserialized response body using get response object method
        $apiException->getCode();
        $apiException->getResponseHeaders();
        $apiException->getResponseBody();
        $apiException->getResponseObject();

        // log error
        error_log('API Error: ' . $apiException->getMessage());

        // user friendly error message here
        $message = "An error occurred while sending the auto generated sms notification. Please try again later.";
        $_SESSION['error'] = $message;
        header("location: " . $_SERVER['REQUEST_URI']);
        exit();
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
if (!function_exists('disapprovedGenerateLogMessage')) {
  function disapprovedGenerateLogMessage($lowincomeData)
  {
    // data fetched
    $logMessage = "disapproved certificate of low income details...\n\n";
    $logMessage .= "id: " . $lowincomeData['id'] . "\n";
    $logMessage .= "lowincome_num: " . $lowincomeData['lowincome_num'] . "\n";
    $logMessage .= "lowincome_res_name: " . $lowincomeData['lowincome_resident_name'] . "\n";
    $logMessage .= "lowincome_requester_res_name: " . $lowincomeData['lowincome_requester_res_name'] . "\n";
    $logMessage .= "lowincome_children_res_name: " . $lowincomeData['lowincome_children_res_name'] . "\n";
    $logMessage .= "lowincome_children_age: " . $lowincomeData['lowincome_children_res_age'] . "\n";
    $logMessage .= "lowincome_num_of_children: " . $lowincomeData['lowincome_num_of_children'] . "\n";
    $logMessage .= "lowincome_annual_income: " . $lowincomeData['lowincome_annual_income'] . "\n";
    $logMessage .= "lowincome_gov_office: " . $lowincomeData['lowincome_gov_office'] . "\n";
    $logMessage .= "lowincome_findings: " . $lowincomeData['lowincome_findings'] . "\n";
    $logMessage .= "lowincome_or_num: " . $lowincomeData['lowincome_or_num'] . "\n";
    $logMessage .= "lowincome_payment: " . $lowincomeData['lowincome_payment'] . "\n";
    $logMessage .= "lowincome_status: " . $lowincomeData['lowincome_status'] . "\n";
    $logMessage .= "lowincome_officer_name: " . $lowincomeData['lowincome_officer_res_name'] . "\n";
    $logMessage .= "lowincome_officer_position_id: " . $lowincomeData['lowincome_officer_position_id'] . "\n";
    $logMessage .= "lowincome_date_added: " . $lowincomeData['lowincome_date_added'] . "\n";
    $logMessage .= "lowincome_date_edited: " . $lowincomeData['lowincome_date_edited'] . "\n";
    $logMessage .= "lowincome_date_requested: " . $lowincomeData['lowincome_date_requested'] . "\n";
    $logMessage .= "lowincome_date_approved: " . $lowincomeData['lowincome_date_approved'] . "\n";
    $logMessage .= "lowincome_date_disapproved: " . date('m/d/Y h:i A', strtotime($lowincomeData['lowincome_date_disapproved'])) . "\n";
    $logMessage .= "lowincome_added_by: " . $lowincomeData['lowincome_added_by'] . "\n";
    $logMessage .= "lowincome_edited_by: " . $lowincomeData['lowincome_edited_by'] . "\n";
    $logMessage .= "lowincome_requested_by: " . $lowincomeData['lowincome_requested_by'] . "\n";
    $logMessage .= "lowincome_approved_by: " . $lowincomeData['lowincome_approved_by'] . "\n";
    $logMessage .= "lowincome_disapproved_by: " . $lowincomeData['lowincome_disapproved_by'] . "\n\n";

    // log session role
    $logMessage .= "this disapprove is done by " . $_SESSION['fname'] . (empty($_SESSION['mname']) || $_SESSION['mname'] === 'n/a' ? "" : " ") . (empty($_SESSION['mname']) || $_SESSION['mname'] === 'n/a' ? "" : $_SESSION['mname']) . " " . $_SESSION['lname'] . " as " . $_SESSION['role'] . "\n";
    $logMessage .= "disapprove certificate of low income id number " . $lowincomeData['id'] . " requested by " . $lowincomeData['lowincome_resident_name'] . "\n";
    $logMessage .= "date and time disapproved " . date('m/d/Y h:i A') . "\n"; // include current date and time
    return rtrim($logMessage, ",\n") . "\n";
  }
}

if (isset($_POST['btn_disapprove'])) {
  $txt_dis_lowincome_user_id = $_POST['hidden_id'];
  $txt_dis_lowincome_findings = !empty($_POST['txt_dis_lowincome_findings']) ? strtolower($_POST['txt_dis_lowincome_findings']) : 'n/a';

  $txt_dis_lowincome_date_disapproved = date('m/d/Y h:i A');
  $txt_dis_lowincome_disapproved_by = $_SESSION['fname'] . (empty($_SESSION['mname']) || $_SESSION['mname'] === 'n/a' ? '' : ' ') . (empty($_SESSION['mname']) || $_SESSION['mname'] === 'n/a' ? '' : $_SESSION['mname']) . ' ' . $_SESSION['lname'] . ' as ' . $_SESSION['role'];
  $txt_dis_lowincome_user_type = $_SESSION['role'];

  // update query
  $disapprove_query = mysqli_prepare($con, "UPDATE tbllowincome SET lowincome_findings = ?, lowincome_status = 'disapproved', lowincome_date_disapproved = ?, lowincome_disapproved_by = ? WHERE id = ?");
  mysqli_stmt_bind_param($disapprove_query, "sssi", $txt_dis_lowincome_findings, $txt_dis_lowincome_date_disapproved, $txt_dis_lowincome_disapproved_by, $txt_dis_lowincome_user_id);

  if (mysqli_stmt_execute($disapprove_query)) {
    // fetch new data after the update
    $lowincomeDataQuery = mysqli_prepare($con, "SELECT p.*, 
    CASE
    WHEN r1.id IS NOT NULL THEN CONCAT(r1.resident_fname, 
    IF(r1.resident_mname = 'n/a', '', CONCAT(' ', SUBSTRING(r1.resident_mname, 1, 1), '.')), 
    ' ', r1.resident_lname)
    WHEN p.lowincome_res_id REGEXP '^[0-9]+$' THEN (SELECT CONCAT(resident_fname, 
    IF(resident_mname = 'n/a', '', CONCAT(' ', SUBSTRING(resident_mname, 1, 1), '.')), 
    ' ', resident_lname) FROM tblresident WHERE id = p.lowincome_res_id) 
        ELSE p.lowincome_res_id
        END AS lowincome_resident_name,
    CASE 
        WHEN r2.id IS NOT NULL THEN CONCAT(r2.resident_fname, 
    IF(r2.resident_mname = 'n/a', '', CONCAT(' ', SUBSTRING(r2.resident_mname, 1, 1), '.')), 
    ' ', r2.resident_lname)
        WHEN p.lowincome_children_res_id REGEXP '^[0-9]+$' THEN (SELECT CONCAT(resident_fname, 
    IF(resident_mname = 'n/a', '', CONCAT(' ', SUBSTRING(resident_mname, 1, 1), '.')), 
    ' ', resident_lname) FROM tblresident WHERE id = p.lowincome_children_res_id) 
        ELSE p.lowincome_children_res_id 
    END AS lowincome_children_res_name,
    CASE 
    WHEN p.lowincome_children_age = 'n/a' THEN r2.resident_age
    ELSE p.lowincome_children_age
    END AS lowincome_children_res_age,
    CASE 
        WHEN r3.id IS NOT NULL THEN CONCAT(r3.resident_fname, 
    IF(r3.resident_mname = 'n/a', '', CONCAT(' ', SUBSTRING(r3.resident_mname, 1, 1), '.')), 
    ' ', r3.resident_lname)
        WHEN p.lowincome_requester_res_id = 'n/a' THEN 'requester is not needed when making request'
        WHEN p.lowincome_requester_res_id REGEXP '^[0-9]+$' THEN (SELECT CONCAT(resident_fname, 
    IF(resident_mname = 'n/a', '', CONCAT(' ', SUBSTRING(resident_mname, 1, 1), '.')), 
    ' ', resident_lname) FROM tblresident WHERE id = p.lowincome_requester_res_id) 
        ELSE p.lowincome_requester_res_id 
    END AS lowincome_requester_res_name,
  
    CASE 
        WHEN r4.id IS NOT NULL THEN CONCAT(r4.officer_fname, 
    IF(r4.officer_mname = 'n/a', '', CONCAT(' ', SUBSTRING(r4.officer_mname, 1, 1), '.')), 
    ' ', r4.officer_lname)
        WHEN p.lowincome_officer_res_id IS NULL THEN 'officer of the day is not found in the database'
        WHEN p.lowincome_officer_res_id REGEXP '^[0-9]+$' THEN (SELECT CONCAT(officer_fname, 
    IF(officer_mname = 'n/a', '', CONCAT(' ', SUBSTRING(officer_mname, 1, 1), '.')), 
    ' ', officer_lname) FROM tblofficer WHERE id = p.lowincome_officer_res_id) 
        ELSE p.lowincome_officer_res_id 
    END AS lowincome_officer_res_name
  
    FROM tbllowincome p 
    LEFT JOIN tblresident r1 ON r1.id = p.lowincome_res_id 
    LEFT JOIN tblresident r2 ON r2.id = p.lowincome_children_res_id 
    LEFT JOIN tblresident r3 ON r3.id = p.lowincome_requester_res_id 
    LEFT JOIN tblofficer r4 ON r4.id = p.lowincome_officer_res_id 
    WHERE p.id = ?");

    mysqli_stmt_bind_param($lowincomeDataQuery, "i", $txt_dis_lowincome_user_id);
    mysqli_stmt_execute($lowincomeDataQuery);
    $lowincomeDataQueryResult = mysqli_stmt_get_result($lowincomeDataQuery);
    $lowincomeData = mysqli_fetch_array($lowincomeDataQueryResult, MYSQLI_ASSOC);
    mysqli_stmt_close($lowincomeDataQuery);

    if (isset($_SESSION['role'])) {
      // log the old and new data
      $action = disapprovedGenerateLogMessage($lowincomeData);
      $log_query = mysqli_prepare($con, "INSERT INTO tbllogs (logs_user_type, logs_fname, logs_lname, logs_logdate, logs_action) VALUES (?, ?, ?, ?, ?)");
      mysqli_stmt_bind_param($log_query, "sssss", $txt_dis_lowincome_user_type, $_SESSION['fname'], $_SESSION['lname'], $txt_dis_lowincome_date_disapproved, $action);
      mysqli_stmt_execute($log_query);
    }

    // send sms notification with the secret key
    try {
      // infobip config
      $configuration = new Configuration(host: getenv('INFOBIP_BASE_URL'), apiKey: getenv('INFOBIP_API_KEY'));
      $sendSmsApi = new SmsApi(config: $configuration);
      $destination = new SmsDestination(to: $lowincomeData['resident_mobile_num'] ? $lowincomeData['resident_mobile_num'] : '09123456789');

      $message = "Hi " . ucwords(strtolower(htmlspecialchars($lowincomeData['lowincome_res_name']))) . ", bad news! Your request is disapproved due to our findings " . htmlspecialchars($lowincomeData['lowincome_findings']) . ". You can try again later.";

      $message = new SmsTextualMessage(destinations: [$destination], from: 'NEWPANDAN', text: $message);
      $request = new SmsAdvancedTextualRequest(messages: [$message]);

      // send sms message
      $smsResponse = $sendSmsApi->sendSmsMessage($request);

      // retrieve a bulk id and a message id from the sms response object to use for troubleshooting or fetching a delivery report for a given message or a bulk
      $bulkId = $smsResponse->getBulkId();
      $messages = $smsResponse->getMessages();
      $messageId = (!empty($messages)) ? current($messages)->getMessageId() : null;

    } catch (ApiException $apiException) {
      // get the deserialized response body using get response object method
      $apiException->getCode();
      $apiException->getResponseHeaders();
      $apiException->getResponseBody();
      $apiException->getResponseObject();

      // log error
      error_log('API Error: ' . $apiException->getMessage());

      // user friendly error message here
      $message = "An error occurred while sending the auto generated sms notification. Please try again later.";
      $_SESSION['error'] = $message;
      header("location: " . $_SERVER['REQUEST_URI']);
      exit();
    }

    $message = "Success";
    $_SESSION['success'] = $message;
    header("location: " . $_SERVER['REQUEST_URI']);
    exit();

  } else {
    // handle the case where the statement execution failed
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
    // old data fetched
    $logMessage = "edited certificate of low income details...\n\n";
    $logMessage .= "old data:\n";
    $logMessage .= "id: " . $oldData['id'] . "\n";
    $logMessage .= "lowincome_num: " . $oldData['lowincome_num'] . "\n";
    $logMessage .= "lowincome_res_name: " . $oldData['lowincome_resident_name'] . "\n";
    $logMessage .= "lowincome_requester_res_name: " . $oldData['lowincome_requester_res_name'] . "\n";
    $logMessage .= "lowincome_children_res_name: " . $oldData['lowincome_children_res_name'] . "\n";
    $logMessage .= "lowincome_children_age: " . $oldData['lowincome_children_res_age'] . "\n";
    $logMessage .= "lowincome_num_of_children: " . $oldData['lowincome_num_of_children'] . "\n";
    $logMessage .= "lowincome_annual_income: " . $oldData['lowincome_annual_income'] . "\n";
    $logMessage .= "lowincome_gov_office: " . $oldData['lowincome_gov_office'] . "\n";
    $logMessage .= "lowincome_findings: " . $oldData['lowincome_findings'] . "\n";
    $logMessage .= "lowincome_or_num: " . $oldData['lowincome_or_num'] . "\n";
    $logMessage .= "lowincome_payment: " . $oldData['lowincome_payment'] . "\n";
    $logMessage .= "lowincome_status: " . $oldData['lowincome_status'] . "\n";
    $logMessage .= "lowincome_officer_name: " . $oldData['lowincome_officer_res_name'] . "\n";
    $logMessage .= "lowincome_officer_position_id: " . $oldData['lowincome_officer_position_id'] . "\n";
    $logMessage .= "lowincome_date_added: " . $oldData['lowincome_date_added'] . "\n";
    $logMessage .= "lowincome_date_edited: " . $oldData['lowincome_date_edited'] . "\n";
    $logMessage .= "lowincome_date_requested: " . $oldData['lowincome_date_requested'] . "\n";
    $logMessage .= "lowincome_date_approved: " . $oldData['lowincome_date_approved'] . "\n";
    $logMessage .= "lowincome_date_disapproved: " . $oldData['lowincome_date_disapproved'] . "\n";
    $logMessage .= "lowincome_added_by: " . $oldData['lowincome_added_by'] . "\n";
    $logMessage .= "lowincome_edited_by: " . $oldData['lowincome_edited_by'] . "\n";
    $logMessage .= "lowincome_requested_by: " . $oldData['lowincome_requested_by'] . "\n";
    $logMessage .= "lowincome_approved_by: " . $oldData['lowincome_approved_by'] . "\n";
    $logMessage .= "lowincome_disapproved_by: " . $oldData['lowincome_disapproved_by'] . "\n\n";

    // new data fetched
    $logMessage .= "\nnew data:\n";
    $logMessage .= "id: " . $newData['id'] . "\n";
    $logMessage .= "lowincome_num: " . $newData['lowincome_num'] . "\n";
    $logMessage .= "lowincome_res_name: " . $newData['lowincome_resident_name'] . "\n";
    $logMessage .= "lowincome_requester_res_name: " . $newData['lowincome_requester_res_name'] . "\n";
    $logMessage .= "lowincome_children_res_name: " . $newData['lowincome_children_res_name'] . "\n";
    $logMessage .= "lowincome_children_age: " . $newData['lowincome_children_res_age'] . "\n";
    $logMessage .= "lowincome_num_of_children: " . $newData['lowincome_num_of_children'] . "\n";
    $logMessage .= "lowincome_annual_income: " . $newData['lowincome_annual_income'] . "\n";
    $logMessage .= "lowincome_gov_office: " . $newData['lowincome_gov_office'] . "\n";
    $logMessage .= "lowincome_findings: " . $newData['lowincome_findings'] . "\n";
    $logMessage .= "lowincome_or_num: " . $newData['lowincome_or_num'] . "\n";
    $logMessage .= "lowincome_payment: " . $newData['lowincome_payment'] . "\n";
    $logMessage .= "lowincome_status: " . $newData['lowincome_status'] . "\n";
    $logMessage .= "lowincome_officer_name: " . $newData['lowincome_officer_res_name'] . "\n";
    $logMessage .= "lowincome_officer_position_id: " . $newData['lowincome_officer_position_id'] . "\n";
    $logMessage .= "lowincome_date_added: " . $newData['lowincome_date_added'] . "\n";
    $logMessage .= "lowincome_date_edited: " . date('m/d/Y h:i A', strtotime($newData['lowincome_date_edited'])) . "\n";
    $logMessage .= "lowincome_date_requested: " . $newData['lowincome_date_requested'] . "\n";
    $logMessage .= "lowincome_date_approved: " . $newData['lowincome_date_approved'] . "\n";
    $logMessage .= "lowincome_date_disapproved: " . $newData['lowincome_date_disapproved'] . "\n";
    $logMessage .= "lowincome_added_by: " . $newData['lowincome_added_by'] . "\n";
    $logMessage .= "lowincome_edited_by: " . $newData['lowincome_edited_by'] . "\n";
    $logMessage .= "lowincome_requested_by: " . $newData['lowincome_requested_by'] . "\n";
    $logMessage .= "lowincome_approved_by: " . $newData['lowincome_approved_by'] . "\n";
    $logMessage .= "lowincome_disapproved_by: " . $newData['lowincome_disapproved_by'] . "\n\n";

    // log session role
    $logMessage .= "this edit is done by " . $_SESSION['fname'] . (empty($_SESSION['mname']) || $_SESSION['mname'] === 'n/a' ? "" : " ") . (empty($_SESSION['mname']) || $_SESSION['mname'] === 'n/a' ? "" : $_SESSION['mname']) . " " . $_SESSION['lname'] . " as " . $_SESSION['role'] . "\n";
    $logMessage .= "edit certificate of low income id number " . $newData['id'] . " for resident " . $newData['lowincome_resident_name'] . "\n";
    $logMessage .= "date and time edited " . date('m/d/Y h:i A') . "\n"; // include current date and time
    return rtrim($logMessage, ",\n") . "\n";
  }
}

if (isset($_POST['btn_edit'])) {
  $txt_edit_lowincome_user_id = $_POST['hidden_id'];

  // fetch old data before the update
  $oldDataQuery = mysqli_prepare($con, "SELECT p.*, 
  CASE
  WHEN r1.id IS NOT NULL THEN CONCAT(r1.resident_fname, 
  IF(r1.resident_mname = 'n/a', '', CONCAT(' ', SUBSTRING(r1.resident_mname, 1, 1), '.')), 
  ' ', r1.resident_lname)
  WHEN p.lowincome_res_id REGEXP '^[0-9]+$' THEN (SELECT CONCAT(resident_fname, 
  IF(resident_mname = 'n/a', '', CONCAT(' ', SUBSTRING(resident_mname, 1, 1), '.')), 
  ' ', resident_lname) FROM tblresident WHERE id = p.lowincome_res_id) 
      ELSE p.lowincome_res_id
      END AS lowincome_resident_name,
  CASE 
      WHEN r2.id IS NOT NULL THEN CONCAT(r2.resident_fname, 
  IF(r2.resident_mname = 'n/a', '', CONCAT(' ', SUBSTRING(r2.resident_mname, 1, 1), '.')), 
  ' ', r2.resident_lname)
      WHEN p.lowincome_children_res_id REGEXP '^[0-9]+$' THEN (SELECT CONCAT(resident_fname, 
  IF(resident_mname = 'n/a', '', CONCAT(' ', SUBSTRING(resident_mname, 1, 1), '.')), 
  ' ', resident_lname) FROM tblresident WHERE id = p.lowincome_children_res_id) 
      ELSE p.lowincome_children_res_id 
  END AS lowincome_children_res_name,
  CASE 
  WHEN p.lowincome_children_age = 'n/a' THEN r2.resident_age
  ELSE p.lowincome_children_age
  END AS lowincome_children_res_age,
  CASE 
      WHEN r3.id IS NOT NULL THEN CONCAT(r3.resident_fname, 
  IF(r3.resident_mname = 'n/a', '', CONCAT(' ', SUBSTRING(r3.resident_mname, 1, 1), '.')), 
  ' ', r3.resident_lname)
      WHEN p.lowincome_requester_res_id = 'n/a' THEN 'requester is not needed when making request'
      WHEN p.lowincome_requester_res_id REGEXP '^[0-9]+$' THEN (SELECT CONCAT(resident_fname, 
  IF(resident_mname = 'n/a', '', CONCAT(' ', SUBSTRING(resident_mname, 1, 1), '.')), 
  ' ', resident_lname) FROM tblresident WHERE id = p.lowincome_requester_res_id) 
      ELSE p.lowincome_requester_res_id 
  END AS lowincome_requester_res_name,

  CASE 
      WHEN r4.id IS NOT NULL THEN CONCAT(r4.officer_fname, 
  IF(r4.officer_mname = 'n/a', '', CONCAT(' ', SUBSTRING(r4.officer_mname, 1, 1), '.')), 
  ' ', r4.officer_lname)
      WHEN p.lowincome_officer_res_id IS NULL THEN 'officer of the day is not found in the database'
      WHEN p.lowincome_officer_res_id REGEXP '^[0-9]+$' THEN (SELECT CONCAT(officer_fname, 
  IF(officer_mname = 'n/a', '', CONCAT(' ', SUBSTRING(officer_mname, 1, 1), '.')), 
  ' ', officer_lname) FROM tblofficer WHERE id = p.lowincome_officer_res_id) 
      ELSE p.lowincome_officer_res_id 
  END AS lowincome_officer_res_name

  FROM tbllowincome p 
  LEFT JOIN tblresident r1 ON r1.id = p.lowincome_res_id 
  LEFT JOIN tblresident r2 ON r2.id = p.lowincome_children_res_id 
  LEFT JOIN tblresident r3 ON r3.id = p.lowincome_requester_res_id 
  LEFT JOIN tblofficer r4 ON r4.id = p.lowincome_officer_res_id 
  WHERE p.id = ?");

  mysqli_stmt_bind_param($oldDataQuery, "i", $txt_edit_lowincome_user_id);
  mysqli_stmt_execute($oldDataQuery);
  $oldDataResult = mysqli_stmt_get_result($oldDataQuery);
  $oldData = mysqli_fetch_array($oldDataResult, MYSQLI_ASSOC);
  mysqli_stmt_close($oldDataQuery);

  $txt_edit_lowincome_num = !empty($_POST['txt_edit_lowincome_num']) ? strtolower($_POST['txt_edit_lowincome_num']) : 'n/a';
  $txt_edit_lowincome_requester_res_id = !empty($_POST['txt_edit_lowincome_requester_res_id']) ? $_POST['txt_edit_lowincome_requester_res_id'] : 'n/a';
  $txt_edit_lowincome_children_res_id = !empty($_POST['txt_edit_lowincome_children_res_id']) ? strtolower($_POST['txt_edit_lowincome_children_res_id']) : 'n/a';

  // check if children age is modified
  $chk_credentials = mysqli_query($con, "SELECT lowincome_children_age FROM tbllowincome WHERE id = '" . $txt_edit_lowincome_user_id . "'");
  $row_credentials = mysqli_fetch_array($chk_credentials);
  // if children age is not modified then use the existing values
  $txt_edit_lowincome_children_age = !empty($_POST['txt_edit_lowincome_children_age']) ? strtolower($_POST['txt_edit_lowincome_children_age']) : $row_credentials['lowincome_children_age'];

  $txt_edit_lowincome_num_of_children = !empty($_POST['txt_edit_lowincome_num_of_children']) ? strtolower($_POST['txt_edit_lowincome_num_of_children']) : 'n/a';
  $txt_edit_lowincome_annual_income = !empty($_POST['txt_edit_lowincome_annual_income']) ? strtolower('Php ' . number_format($_POST['txt_edit_lowincome_annual_income'], 2)) : 'Php 0.00';
  $txt_edit_lowincome_gov_office = !empty($_POST['txt_edit_lowincome_gov_office']) ? $_POST['txt_edit_lowincome_gov_office'] : 'n/a';
  $txt_edit_lowincome_or_num = !empty($_POST['txt_edit_lowincome_or_num']) ? strtolower($_POST['txt_edit_lowincome_or_num']) : 'n/a';
  $txt_edit_lowincome_payment = !empty($_POST['txt_edit_lowincome_payment']) ? strtolower('₱' . number_format($_POST['txt_edit_lowincome_payment'], 2)) : '₱0.00';
  $txt_edit_lowincome_officer_of_dday = !empty($_POST['txt_edit_lowincome_officer_of_dday']) ? strtolower($_POST['txt_edit_lowincome_officer_of_dday']) : 'n/a';
  $txt_edit_lowincome_officer_of_dday_pos = !empty($_POST['txt_edit_lowincome_officer_of_dday_pos']) ? strtolower($_POST['txt_edit_lowincome_officer_of_dday_pos']) : 'n/a';

  $txt_edit_lowincome_date_edited = date('m/d/Y h:i A');
  $txt_edit_lowincome_edited_by = $_SESSION['fname'] . (empty($_SESSION['mname']) || $_SESSION['mname'] === 'n/a' ? '' : ' ') . (empty($_SESSION['mname']) || $_SESSION['mname'] === 'n/a' ? '' : $_SESSION['mname']) . ' ' . $_SESSION['lname'] . ' as ' . $_SESSION['role'];
  $txt_edit_lowincome_user_type = $_SESSION['role'];

  // check duplicate lowincome num
  $check_query = mysqli_prepare($con, "SELECT lowincome_num FROM tbllowincome WHERE lowincome_num = ? AND id <> ?");
  mysqli_stmt_bind_param($check_query, "si", $txt_edit_lowincome_num, $txt_edit_lowincome_user_id);
  mysqli_stmt_execute($check_query);
  mysqli_stmt_store_result($check_query);
  $num_rows = mysqli_stmt_num_rows($check_query);

  if ($num_rows == 0) {
    // update query
    $update_query = mysqli_prepare($con, "UPDATE tbllowincome SET lowincome_num = ?, lowincome_requester_res_id = ?, lowincome_children_res_id = ?, lowincome_children_age = ?, lowincome_num_of_children = ?, lowincome_annual_income = ?, lowincome_gov_office = ?, lowincome_or_num = ?, lowincome_payment = ?, lowincome_officer_res_id = ?, lowincome_officer_position_id = ?, lowincome_date_edited = ?, lowincome_edited_by = ? WHERE id = ?");
    mysqli_stmt_bind_param($update_query, "sssssssssssssi", $txt_edit_lowincome_num, $txt_edit_lowincome_requester_res_id, $txt_edit_lowincome_children_res_id, $txt_edit_lowincome_children_age, $txt_edit_lowincome_num_of_children, $txt_edit_lowincome_annual_income, $txt_edit_lowincome_gov_office, $txt_edit_lowincome_or_num, $txt_edit_lowincome_payment, $txt_edit_lowincome_officer_of_dday, $txt_edit_lowincome_officer_of_dday_pos, $txt_edit_lowincome_date_edited, $txt_edit_lowincome_edited_by, $txt_edit_lowincome_user_id);
    $update_success = mysqli_stmt_execute($update_query);

    if ($update_success) {
      // fetch new data after the update
      $newDataQuery = mysqli_prepare($con, "SELECT p.*, 
      CASE
      WHEN r1.id IS NOT NULL THEN CONCAT(r1.resident_fname, 
      IF(r1.resident_mname = 'n/a', '', CONCAT(' ', SUBSTRING(r1.resident_mname, 1, 1), '.')), 
      ' ', r1.resident_lname)
      WHEN p.lowincome_res_id REGEXP '^[0-9]+$' THEN (SELECT CONCAT(resident_fname, 
      IF(resident_mname = 'n/a', '', CONCAT(' ', SUBSTRING(resident_mname, 1, 1), '.')), 
      ' ', resident_lname) FROM tblresident WHERE id = p.lowincome_res_id) 
          ELSE p.lowincome_res_id
          END AS lowincome_resident_name,
      CASE 
          WHEN r2.id IS NOT NULL THEN CONCAT(r2.resident_fname, 
      IF(r2.resident_mname = 'n/a', '', CONCAT(' ', SUBSTRING(r2.resident_mname, 1, 1), '.')), 
      ' ', r2.resident_lname)
          WHEN p.lowincome_children_res_id REGEXP '^[0-9]+$' THEN (SELECT CONCAT(resident_fname, 
      IF(resident_mname = 'n/a', '', CONCAT(' ', SUBSTRING(resident_mname, 1, 1), '.')), 
      ' ', resident_lname) FROM tblresident WHERE id = p.lowincome_children_res_id) 
          ELSE p.lowincome_children_res_id 
      END AS lowincome_children_res_name,
      CASE 
      WHEN p.lowincome_children_age = 'n/a' THEN r2.resident_age
      ELSE p.lowincome_children_age
      END AS lowincome_children_res_age,
      CASE 
          WHEN r3.id IS NOT NULL THEN CONCAT(r3.resident_fname, 
      IF(r3.resident_mname = 'n/a', '', CONCAT(' ', SUBSTRING(r3.resident_mname, 1, 1), '.')), 
      ' ', r3.resident_lname)
          WHEN p.lowincome_requester_res_id = 'n/a' THEN 'requester is not needed when making request'
          WHEN p.lowincome_requester_res_id REGEXP '^[0-9]+$' THEN (SELECT CONCAT(resident_fname, 
      IF(resident_mname = 'n/a', '', CONCAT(' ', SUBSTRING(resident_mname, 1, 1), '.')), 
      ' ', resident_lname) FROM tblresident WHERE id = p.lowincome_requester_res_id) 
          ELSE p.lowincome_requester_res_id 
      END AS lowincome_requester_res_name,

      CASE 
          WHEN r4.id IS NOT NULL THEN CONCAT(r4.officer_fname, 
      IF(r4.officer_mname = 'n/a', '', CONCAT(' ', SUBSTRING(r4.officer_mname, 1, 1), '.')), 
      ' ', r4.officer_lname)
          WHEN p.lowincome_officer_res_id IS NULL THEN 'officer of the day is not found in the database'
          WHEN p.lowincome_officer_res_id REGEXP '^[0-9]+$' THEN (SELECT CONCAT(officer_fname, 
      IF(officer_mname = 'n/a', '', CONCAT(' ', SUBSTRING(officer_mname, 1, 1), '.')), 
      ' ', officer_lname) FROM tblofficer WHERE id = p.lowincome_officer_res_id) 
          ELSE p.lowincome_officer_res_id 
      END AS lowincome_officer_res_name

      FROM tbllowincome p 
      LEFT JOIN tblresident r1 ON r1.id = p.lowincome_res_id 
      LEFT JOIN tblresident r2 ON r2.id = p.lowincome_children_res_id 
      LEFT JOIN tblresident r3 ON r3.id = p.lowincome_requester_res_id 
      LEFT JOIN tblofficer r4 ON r4.id = p.lowincome_officer_res_id 
      WHERE p.id = ?");

      mysqli_stmt_bind_param($newDataQuery, "i", $txt_edit_lowincome_user_id);
      mysqli_stmt_execute($newDataQuery);
      $newDataResult = mysqli_stmt_get_result($newDataQuery);
      $newData = mysqli_fetch_array($newDataResult, MYSQLI_ASSOC);
      mysqli_stmt_close($newDataQuery);

      if (isset($_SESSION['role'])) {
        // log the old and new data
        $action = editedGenerateLogMessage($oldData, $newData);
        $log_query = mysqli_prepare($con, "INSERT INTO tbllogs (logs_user_type, logs_fname, logs_lname, logs_logdate, logs_action) VALUES (?, ?, ?, ?, ?)");
        mysqli_stmt_bind_param($log_query, "sssss", $txt_edit_lowincome_user_type, $_SESSION['fname'], $_SESSION['lname'], $txt_edit_lowincome_date_edited, $action);
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
  function deletedGenerateLogMessage($lowincomeData)
  {
    // data fetched
    $logMessage = "deleted low income details before deletion...\n\n";
    $logMessage .= "id: " . $lowincomeData['id'] . "\n";
    $logMessage .= "lowincome_num: " . $lowincomeData['lowincome_num'] . "\n";
    $logMessage .= "lowincome_res_name: " . $lowincomeData['lowincome_resident_name'] . "\n";
    $logMessage .= "lowincome_requester_res_name: " . $lowincomeData['lowincome_requester_res_name'] . "\n";
    $logMessage .= "lowincome_children_res_name: " . $lowincomeData['lowincome_children_res_name'] . "\n";
    $logMessage .= "lowincome_children_age: " . $lowincomeData['lowincome_children_res_age'] . "\n";
    $logMessage .= "lowincome_num_of_children: " . $lowincomeData['lowincome_num_of_children'] . "\n";
    $logMessage .= "lowincome_annual_income: " . $lowincomeData['lowincome_annual_income'] . "\n";
    $logMessage .= "lowincome_gov_office: " . $lowincomeData['lowincome_gov_office'] . "\n";
    $logMessage .= "lowincome_findings: " . $lowincomeData['lowincome_findings'] . "\n";
    $logMessage .= "lowincome_or_num: " . $lowincomeData['lowincome_or_num'] . "\n";
    $logMessage .= "lowincome_payment: " . $lowincomeData['lowincome_payment'] . "\n";
    $logMessage .= "lowincome_status: " . $lowincomeData['lowincome_status'] . "\n";
    $logMessage .= "lowincome_officer_name: " . $lowincomeData['lowincome_officer_res_name'] . "\n";
    $logMessage .= "lowincome_officer_position_id: " . $lowincomeData['lowincome_officer_position_id'] . "\n";
    $logMessage .= "lowincome_date_added: " . $lowincomeData['lowincome_date_added'] . "\n";
    $logMessage .= "lowincome_date_edited: " . $lowincomeData['lowincome_date_edited'] . "\n";
    $logMessage .= "lowincome_date_requested: " . $lowincomeData['lowincome_date_requested'] . "\n";
    $logMessage .= "lowincome_date_approved: " . $lowincomeData['lowincome_date_approved'] . "\n";
    $logMessage .= "lowincome_date_disapproved: " . $lowincomeData['lowincome_date_disapproved'] . "\n";
    $logMessage .= "lowincome_added_by: " . $lowincomeData['lowincome_added_by'] . "\n";
    $logMessage .= "lowincome_edited_by: " . $lowincomeData['lowincome_edited_by'] . "\n";
    $logMessage .= "lowincome_requested_by: " . $lowincomeData['lowincome_requested_by'] . "\n";
    $logMessage .= "lowincome_approved_by: " . $lowincomeData['lowincome_approved_by'] . "\n";
    $logMessage .= "lowincome_disapproved_by: " . $lowincomeData['lowincome_disapproved_by'] . "\n\n";

    // log session role
    $logMessage .= "this delete is done by " . $_SESSION['fname'] . (empty($_SESSION['mname']) || $_SESSION['mname'] === 'n/a' ? "" : " ") . (empty($_SESSION['mname']) || $_SESSION['mname'] === 'n/a' ? "" : $_SESSION['mname']) . " " . $_SESSION['lname'] . " as " . $_SESSION['role'] . "\n";
    $logMessage .= "delete certificate of low income id number " . $lowincomeData['id'] . " for resident " . $lowincomeData['lowincome_resident_name'] . "\n";
    $logMessage .= "date and time deleted " . date('m/d/Y h:i A') . "\n"; // include current date and time
    return rtrim($logMessage, ",\n") . "\n";
  }
}

if (isset($_POST['btn_delete'])) {

  if (isset($_POST['chk_delete']) && is_array($_POST['chk_delete'])) {

    $txt_delete_lowincome_date_deleted = date('m/d/Y h:i A');
    // validate and sanitize each selected ids
    $validIds = array_map('intval', $_POST['chk_delete']);
    // remove non-numeric values
    $validIds = array_filter($validIds, 'is_numeric');

    if (!empty($validIds)) {
      // fetch the data before deleted for logging
      $placeholders = implode(', ', array_fill(0, count($validIds), '?'));

      // fetch the data to be deleted
      $deletedDataQuery = mysqli_prepare($con, "SELECT p.*, 
      CASE
      WHEN r1.id IS NOT NULL THEN CONCAT(r1.resident_fname, 
      IF(r1.resident_mname = 'n/a', '', CONCAT(' ', SUBSTRING(r1.resident_mname, 1, 1), '.')), 
      ' ', r1.resident_lname)
      WHEN p.lowincome_res_id REGEXP '^[0-9]+$' THEN (SELECT CONCAT(resident_fname, 
      IF(resident_mname = 'n/a', '', CONCAT(' ', SUBSTRING(resident_mname, 1, 1), '.')), 
      ' ', resident_lname) FROM tblresident WHERE id = p.lowincome_res_id) 
          ELSE p.lowincome_res_id
          END AS lowincome_resident_name,
      CASE 
          WHEN r2.id IS NOT NULL THEN CONCAT(r2.resident_fname, 
      IF(r2.resident_mname = 'n/a', '', CONCAT(' ', SUBSTRING(r2.resident_mname, 1, 1), '.')), 
      ' ', r2.resident_lname)
          WHEN p.lowincome_children_res_id REGEXP '^[0-9]+$' THEN (SELECT CONCAT(resident_fname, 
      IF(resident_mname = 'n/a', '', CONCAT(' ', SUBSTRING(resident_mname, 1, 1), '.')), 
      ' ', resident_lname) FROM tblresident WHERE id = p.lowincome_children_res_id) 
          ELSE p.lowincome_children_res_id 
      END AS lowincome_children_res_name,
      CASE 
      WHEN p.lowincome_children_age = 'n/a' THEN r2.resident_age
      ELSE p.lowincome_children_age
      END AS lowincome_children_res_age,
      CASE 
          WHEN r3.id IS NOT NULL THEN CONCAT(r3.resident_fname, 
      IF(r3.resident_mname = 'n/a', '', CONCAT(' ', SUBSTRING(r3.resident_mname, 1, 1), '.')), 
      ' ', r3.resident_lname)
          WHEN p.lowincome_requester_res_id = 'n/a' THEN 'requester is not needed when making request'
          WHEN p.lowincome_requester_res_id REGEXP '^[0-9]+$' THEN (SELECT CONCAT(resident_fname, 
      IF(resident_mname = 'n/a', '', CONCAT(' ', SUBSTRING(resident_mname, 1, 1), '.')), 
      ' ', resident_lname) FROM tblresident WHERE id = p.lowincome_requester_res_id) 
          ELSE p.lowincome_requester_res_id 
      END AS lowincome_requester_res_name,

      CASE 
          WHEN r4.id IS NOT NULL THEN CONCAT(r4.officer_fname, 
      IF(r4.officer_mname = 'n/a', '', CONCAT(' ', SUBSTRING(r4.officer_mname, 1, 1), '.')), 
      ' ', r4.officer_lname)
          WHEN p.lowincome_officer_res_id IS NULL THEN 'officer of the day is not found in the database'
          WHEN p.lowincome_officer_res_id REGEXP '^[0-9]+$' THEN (SELECT CONCAT(officer_fname, 
      IF(officer_mname = 'n/a', '', CONCAT(' ', SUBSTRING(officer_mname, 1, 1), '.')), 
      ' ', officer_lname) FROM tblofficer WHERE id = p.lowincome_officer_res_id) 
          ELSE p.lowincome_officer_res_id 
      END AS lowincome_officer_res_name

      FROM tbllowincome p 
      LEFT JOIN tblresident r1 ON r1.id = p.lowincome_res_id 
      LEFT JOIN tblresident r2 ON r2.id = p.lowincome_children_res_id 
      LEFT JOIN tblresident r3 ON r3.id = p.lowincome_requester_res_id 
      LEFT JOIN tblofficer r4 ON r4.id = p.lowincome_officer_res_id 
      WHERE p.id IN ($placeholders)");

      mysqli_stmt_bind_param($deletedDataQuery, str_repeat('i', count($validIds)), ...$validIds);
      mysqli_stmt_execute($deletedDataQuery);
      $deletedDataResult = mysqli_stmt_get_result($deletedDataQuery);

      // log each deleted record
      while ($deletedData = mysqli_fetch_array($deletedDataResult, MYSQLI_ASSOC)) {
        $action = deletedGenerateLogMessage($deletedData);
        $log_query = mysqli_prepare($con, "INSERT INTO tbllogs (logs_user_type, logs_fname, logs_lname, logs_logdate, logs_action) VALUES (?, ?, ?, ?, ?)");
        mysqli_stmt_bind_param($log_query, "sssss", $_SESSION['role'], $_SESSION['fname'], $_SESSION['lname'], $txt_delete_lowincome_date_deleted, $action);
        mysqli_stmt_execute($log_query);
      }

      // prepare and execute the deletion query
      $delete_query = mysqli_prepare($con, "DELETE FROM tbllowincome WHERE id IN ($placeholders)");

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