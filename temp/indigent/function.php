<?php

use Infobip\Configuration;
use Infobip\ApiException;
use Infobip\Api\SmsApi;
use Infobip\Model\SmsDestination;
use Infobip\Model\SmsTextualMessage;
use Infobip\Model\SmsAdvancedTextualRequest;

// use Dotenv\Dotenv;

require __DIR__ . "../../../vendor/autoload.php";

// $dotenv = Dotenv::createImmutable(__DIR__);
// $dotenv->load();

// check before declaring to see if it already exists
if (!function_exists('addedGenerateLogMessage')) {
  function addedGenerateLogMessage($indigentData)
  {
    // data fetched
    $logMessage = "added indigent details...\n\n";
    $logMessage .= "id: " . $indigentData['pid'] . "\n";
    $logMessage .= "indigent_num: " . $indigentData['indigent_num'] . "\n";
    $logMessage .= "indigent_res_id: " . $indigentData['indigent_res_name'] . "\n";
    $logMessage .= "indigent_purpose: " . $indigentData['indigent_purpose'] . "\n";
    $logMessage .= "indigent_gov_office: " . $indigentData['indigent_gov_office'] . "\n";
    $logMessage .= "indigent_findings: " . $indigentData['indigent_findings'] . "\n";
    $logMessage .= "indigent_or_num: " . $indigentData['indigent_or_num'] . "\n";
    $logMessage .= "indigent_amount: " . $indigentData['indigent_amount'] . "\n";
    $logMessage .= "indigent_status: " . $indigentData['indigent_status'] . "\n";
    $logMessage .= "indigent_date_added: " . date('m/d/Y h:i A', strtotime($indigentData['indigent_date_added'])) . "\n";
    $logMessage .= "indigent_date_edited: " . $indigentData['indigent_date_edited'] . "\n";
    $logMessage .= "indigent_date_requested: " . $indigentData['indigent_date_requested'] . "\n";
    $logMessage .= "indigent_date_approved: " . $indigentData['indigent_date_approved'] . "\n";
    $logMessage .= "indigent_date_disapproved: " . $indigentData['indigent_date_disapproved'] . "\n";
    $logMessage .= "indigent_added_by: " . $indigentData['indigent_added_by'] . "\n";
    $logMessage .= "indigent_edited_by: " . $indigentData['indigent_edited_by'] . "\n";
    $logMessage .= "indigent_requested_by: " . $indigentData['indigent_requested_by'] . "\n";
    $logMessage .= "indigent_approved_by: " . $indigentData['indigent_approved_by'] . "\n";
    $logMessage .= "indigent_disapproved_by: " . $indigentData['indigent_disapproved_by'] . "\n\n";

    // log session role
    $logMessage .= "this add is done by " . $_SESSION['fname'] . (empty($_SESSION['mname']) || $_SESSION['mname'] === 'n/a' ? "" : " ") . (empty($_SESSION['mname']) || $_SESSION['mname'] === 'n/a' ? "" : $_SESSION['mname']) . " " . $_SESSION['lname'] . " as " . $_SESSION['role'] . "\n";
    $logMessage .= "add indigent id number " . $indigentData['pid'] . " for resident " . $indigentData['indigent_res_name'] . "\n";
    $logMessage .= "date and time added " . date('m/d/Y h:i A') . "\n"; // include current date and time
    return rtrim($logMessage, ",\n") . "\n";
  }
}

if (isset($_POST['btn_add'])) {
  $txt_add_indigent_num = !empty($_POST['txt_add_indigent_num']) ? strtolower($_POST['txt_add_indigent_num']) : 'n/a';
  $txt_add_indigent_res_id = !empty($_POST['txt_add_indigent_res_id']) ? strtolower($_POST['txt_add_indigent_res_id']) : 'n/a';
  $txt_add_indigent_purpose = !empty($_POST['txt_add_indigent_purpose']) ? strtolower($_POST['txt_add_indigent_purpose']) : 'n/a';
  $txt_add_indigent_gov_office = !empty($_POST['txt_add_indigent_gov_office']) ? $_POST['txt_add_indigent_gov_office'] : 'n/a';
  $txt_add_indigent_findings = !empty($_POST['txt_add_indigent_findings']) ? strtolower($_POST['txt_add_indigent_findings']) : 'n/a';
  $txt_add_indigent_or_num = !empty($_POST['txt_add_indigent_or_num']) ? strtolower($_POST['txt_add_indigent_or_num']) : 'n/a';
  $txt_add_indigent_amount = !empty($_POST['txt_add_indigent_amount']) ? strtolower('₱' . number_format($_POST['txt_add_indigent_amount'], 2)) : '₱0.00';
  $txt_add_indigent_status = ($_SESSION['role'] === "administrator" || $_SESSION['role'] === "staff") ? 'approved' : 'new';

  $txt_add_indigent_date_added = date('m/d/Y h:i A');
  $txt_add_indigent_added_by = $_SESSION['fname'] . (empty($_SESSION['mname']) || $_SESSION['mname'] === 'n/a' ? '' : ' ') . (empty($_SESSION['mname']) || $_SESSION['mname'] === 'n/a' ? '' : $_SESSION['mname']) . ' ' . $_SESSION['lname'] . ' as ' . $_SESSION['role'];
  $txt_add_indigent_user_type = $_SESSION['role'];

  // check duplicate indigent num
  $check_query = mysqli_prepare($con, "SELECT indigent_num FROM tblindigent WHERE indigent_num = ?");
  mysqli_stmt_bind_param($check_query, "s", $txt_add_indigent_num);
  mysqli_stmt_execute($check_query);
  mysqli_stmt_store_result($check_query);
  $num_rows = mysqli_stmt_num_rows($check_query);

  if ($num_rows == 0) {
    // insert query
    $insert_query = mysqli_prepare($con, "INSERT INTO tblindigent (indigent_num, indigent_res_id, indigent_purpose, indigent_gov_office, indigent_findings, indigent_or_num, indigent_amount, indigent_status, indigent_date_added, indigent_date_edited, indigent_date_requested, indigent_date_approved, indigent_date_disapproved, indigent_added_by, indigent_edited_by, indigent_requested_by, indigent_approved_by, indigent_disapproved_by) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, 'n/a', 'n/a', 'n/a', 'n/a', ?, 'n/a', 'n/a', 'n/a', 'n/a')");
    mysqli_stmt_bind_param($insert_query, "ssssssssss", $txt_add_indigent_num, $txt_add_indigent_res_id, $txt_add_indigent_purpose, $txt_add_indigent_gov_office, $txt_add_indigent_findings, $txt_add_indigent_or_num, $txt_add_indigent_amount, $txt_add_indigent_status, $txt_add_indigent_date_added, $txt_add_indigent_added_by);

    if (mysqli_stmt_execute($insert_query)) {
      // fetch the last inserted record
      $lastInsertedId = mysqli_insert_id($con);

      // fetch new data after the update
      $indigentDataQuery = mysqli_prepare($con, "SELECT *, CONCAT(r.resident_fname, IF(r.resident_mname = 'n/a', '', CONCAT(' ', r.resident_mname)), ' ', r.resident_lname) as indigent_res_name, p.id as pid FROM tblindigent p LEFT JOIN tblresident r ON r.id = p.indigent_res_id WHERE p.id = ?");
      mysqli_stmt_bind_param($indigentDataQuery, "i", $lastInsertedId);
      mysqli_stmt_execute($indigentDataQuery);
      $indigentDataQueryResult = mysqli_stmt_get_result($indigentDataQuery);
      $indigentData = mysqli_fetch_array($indigentDataQueryResult, MYSQLI_ASSOC);
      mysqli_stmt_close($indigentDataQuery);

      if (isset($_SESSION['role'])) {
        // log the old and new data
        $action = addedGenerateLogMessage($indigentData);
        $log_query = mysqli_prepare($con, "INSERT INTO tbllogs (logs_user_type, logs_fname, logs_lname, logs_logdate, logs_action) VALUES (?, ?, ?, ?, ?)");
        mysqli_stmt_bind_param($log_query, "sssss", $txt_add_indigent_user_type, $_SESSION['fname'], $_SESSION['lname'], $txt_add_indigent_date_added, $action);
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
  function requestedGenerateLogMessage($indigentData)
  {
    // data fetched
    $logMessage = "requested indigent details...\n\n";
    $logMessage .= "id: " . $indigentData['pid'] . "\n";
    $logMessage .= "indigent_num: " . $indigentData['indigent_num'] . "\n";
    $logMessage .= "indigent_res_id: " . $indigentData['indigent_res_name'] . "\n";
    $logMessage .= "indigent_purpose: " . $indigentData['indigent_purpose'] . "\n";
    $logMessage .= "indigent_gov_office: " . $indigentData['indigent_gov_office'] . "\n";
    $logMessage .= "indigent_findings: " . $indigentData['indigent_findings'] . "\n";
    $logMessage .= "indigent_or_num: " . $indigentData['indigent_or_num'] . "\n";
    $logMessage .= "indigent_amount: " . $indigentData['indigent_amount'] . "\n";
    $logMessage .= "indigent_status: " . $indigentData['indigent_status'] . "\n";
    $logMessage .= "indigent_date_added: " . $indigentData['indigent_date_added'] . "\n";
    $logMessage .= "indigent_date_edited: " . $indigentData['indigent_date_edited'] . "\n";
    $logMessage .= "indigent_date_requested: " . date('m/d/Y h:i A', strtotime($indigentData['indigent_date_requested'])) . "\n";
    $logMessage .= "indigent_date_approved: " . $indigentData['indigent_date_approved'] . "\n";
    $logMessage .= "indigent_date_disapproved: " . $indigentData['indigent_date_disapproved'] . "\n";
    $logMessage .= "indigent_added_by: " . $indigentData['indigent_added_by'] . "\n";
    $logMessage .= "indigent_edited_by: " . $indigentData['indigent_edited_by'] . "\n";
    $logMessage .= "indigent_requested_by: " . $indigentData['indigent_requested_by'] . "\n";
    $logMessage .= "indigent_approved_by: " . $indigentData['indigent_approved_by'] . "\n";
    $logMessage .= "indigent_disapproved_by: " . $indigentData['indigent_disapproved_by'] . "\n\n";

    // log session role
    $logMessage .= "this request is done by " . $_SESSION['fname'] . (empty($_SESSION['mname']) || $_SESSION['mname'] === 'n/a' ? "" : " ") . (empty($_SESSION['mname']) || $_SESSION['mname'] === 'n/a' ? "" : $_SESSION['mname']) . " " . $_SESSION['lname'] . " as " . $_SESSION['role'] . "\n";
    $logMessage .= "request indigent id number " . $indigentData['pid'] . " for resident " . $indigentData['indigent_res_name'] . "\n";
    $logMessage .= "date and time requested " . date('m/d/Y h:i A') . "\n"; // include current date and time
    return rtrim($logMessage, ",\n") . "\n";
  }
}

if (isset($_POST['btn_request'])) {
  $txt_req_indigent_user_id = $_SESSION['userid'];

  // check if it is already requested within 24 hours
  $check_indigent_requests = "SELECT COUNT(*) AS request_count, MAX(indigent_date_requested) AS last_request_time FROM tblindigent WHERE indigent_res_id = ? AND STR_TO_DATE(indigent_date_requested, '%m/%d/%Y %h:%i %p') >= DATE_SUB(NOW(), INTERVAL 1 DAY)";
  $check_indigent_stmt = mysqli_prepare($con, $check_indigent_requests);
  mysqli_stmt_bind_param($check_indigent_stmt, "s", $txt_req_indigent_user_id);
  mysqli_stmt_execute($check_indigent_stmt);
  $result = mysqli_stmt_get_result($check_indigent_stmt);
  $row = mysqli_fetch_assoc($result);
  $request_count = $row['request_count'];

  if ($request_count >= 3) {
    // check if the last request was more than 24 hours ago
    $last_request_time = strtotime($row['last_request_time']);
    $next_request_time = $last_request_time + (24 * 60 * 60); // next request available after 24 hours
    $current_time = time();

    if ($current_time >= $next_request_time) {
      // reset the request count
      $request_count = 0;

    } else {
      // calculate the time remaining for the next request
      $time_remaining = $next_request_time - $current_time;
      $hours = floor($time_remaining / 3600);
      $minutes = floor(($time_remaining - ($hours * 3600)) / 60);
      $seconds = $time_remaining % 60;

      // display the time remaining to request again
      $message = "You've maxed out requests. Retry in $hours hours, $minutes minutes, and $seconds seconds. Thanks!";
      $_SESSION['warning'] = $message;
      header("location: " . $_SERVER['REQUEST_URI']);
      exit();
    }
  }

  // check if it is not a respondent in any unsolved blotter
  $check_blotter = "SELECT * FROM tblblotter WHERE blotter_status = 'unsolved' AND blotter_respondent = ?";
  $check_blotter_stmt = mysqli_prepare($con, $check_blotter);
  mysqli_stmt_bind_param($check_blotter_stmt, "s", $txt_req_indigent_user_id);

  if (mysqli_stmt_execute($check_blotter_stmt)) {
    $check_res = mysqli_stmt_get_result($check_blotter_stmt);

    // it is not a respondent in any unsolved blotter
    if (mysqli_num_rows($check_res) == 0) {
      // check length of stay
      $check_length = "SELECT * FROM tblresident WHERE id = ?";
      $check_length_stmt = mysqli_prepare($con, $check_length);
      mysqli_stmt_bind_param($check_length_stmt, "s", $txt_req_indigent_user_id);

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
            // user can request indigent
            $txt_req_indigent_purpose = !empty($_POST['txt_req_indigent_purpose']) ? strtolower($_POST['txt_req_indigent_purpose']) : 'n/a';
            $txt_req_indigent_gov_office = !empty($_POST['txt_req_indigent_gov_office']) ? $_POST['txt_req_indigent_gov_office'] : 'n/a';
            $txt_req_indigent_date_requested = date('m/d/Y h:i A');
            $txt_req_indigent_requested_by = $_SESSION['fname'] . (empty($_SESSION['mname']) || $_SESSION['mname'] === 'n/a' ? '' : ' ') . (empty($_SESSION['mname']) || $_SESSION['mname'] === 'n/a' ? '' : $_SESSION['mname']) . ' ' . $_SESSION['lname'] . ' as ' . $_SESSION['role'];
            $txt_req_indigent_user_type = $_SESSION['role'];

            // insert query
            $req_query = "INSERT INTO tblindigent (indigent_num, indigent_res_id, indigent_purpose, indigent_gov_office, indigent_findings, indigent_or_num, indigent_amount, indigent_status, indigent_date_added, indigent_date_edited, indigent_date_requested, indigent_date_approved, indigent_date_disapproved, indigent_added_by, indigent_edited_by, indigent_requested_by, indigent_approved_by, indigent_disapproved_by) VALUES ('n/a', ?, ?, ?, 'n/a', 'n/a', 'n/a', 'new', 'n/a', 'n/a', ?, 'n/a', 'n/a', 'n/a', 'n/a', ?, 'n/a', 'n/a')";
            $req_query_stmt = mysqli_prepare($con, $req_query);
            mysqli_stmt_bind_param($req_query_stmt, "issss", $txt_req_indigent_user_id, $txt_req_indigent_purpose, $txt_req_indigent_gov_office, $txt_req_indigent_date_requested, $txt_req_indigent_requested_by);

            // execute query statement
            if (mysqli_stmt_execute($req_query_stmt)) {

              if (mysqli_stmt_affected_rows($req_query_stmt) > 0) {
                // fetch the last inserted record
                $lastInsertedId = mysqli_insert_id($con);

                // fetch new data after the update
                $indigentDataQuery = mysqli_prepare($con, "SELECT *, CONCAT(r.resident_fname, IF(r.resident_mname = 'n/a', '', CONCAT(' ', r.resident_mname)), ' ', r.resident_lname) as indigent_res_name, p.id as pid FROM tblindigent p LEFT JOIN tblresident r ON r.id = p.indigent_res_id WHERE p.id = ?");
                mysqli_stmt_bind_param($indigentDataQuery, "i", $lastInsertedId);
                mysqli_stmt_execute($indigentDataQuery);
                $indigentDataQueryResult = mysqli_stmt_get_result($indigentDataQuery);
                $indigentData = mysqli_fetch_array($indigentDataQueryResult, MYSQLI_ASSOC);
                mysqli_stmt_close($indigentDataQuery);

                if (isset($_SESSION['role'])) {
                  // log the old and new data
                  $action = requestedGenerateLogMessage($indigentData);
                  $log_query = mysqli_prepare($con, "INSERT INTO tbllogs (logs_user_type, logs_fname, logs_lname, logs_logdate, logs_action) VALUES (?, ?, ?, ?, ?)");
                  mysqli_stmt_bind_param($log_query, "sssss", $txt_req_indigent_user_type, $_SESSION['fname'], $_SESSION['lname'], $txt_req_indigent_date_requested, $action);
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
      // request was unsuccessful because there's a respondent in the unsolved blotter
      $message = "Request was unsuccessful because there's a respondent in the unsolved blotter.";
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
    $reset_request_count_query = "UPDATE tblindigent SET request_count = 0 WHERE indigent_res_id = ?";
    $reset_request_count_stmt = mysqli_prepare($con, $reset_request_count_query);
    mysqli_stmt_bind_param($reset_request_count_stmt, "s", $txt_req_indigent_user_id);
    mysqli_stmt_execute($reset_request_count_stmt);

  } else {
    $message = "Error";
    $_SESSION['error'] = $message;
    header("location: " . $_SERVER['REQUEST_URI']);
    exit();
  }
}

// check before declaring to see if it already exists
if (!function_exists('approvedGenerateLogMessage')) {
  function approvedGenerateLogMessage($indigentData)
  {
    // data fetched
    $logMessage = "approved indigent details...\n\n";
    $logMessage .= "id: " . $indigentData['pid'] . "\n";
    $logMessage .= "indigent_num: " . $indigentData['indigent_num'] . "\n";
    $logMessage .= "indigent_res_id: " . $indigentData['indigent_res_name'] . "\n";
    $logMessage .= "indigent_purpose: " . $indigentData['indigent_purpose'] . "\n";
    $logMessage .= "indigent_gov_office: " . $indigentData['indigent_gov_office'] . "\n";
    $logMessage .= "indigent_findings: " . $indigentData['indigent_findings'] . "\n";
    $logMessage .= "indigent_or_num: " . $indigentData['indigent_or_num'] . "\n";
    $logMessage .= "indigent_amount: " . $indigentData['indigent_amount'] . "\n";
    $logMessage .= "indigent_status: " . $indigentData['indigent_status'] . "\n";
    $logMessage .= "indigent_date_added: " . $indigentData['indigent_date_added'] . "\n";
    $logMessage .= "indigent_date_edited: " . $indigentData['indigent_date_edited'] . "\n";
    $logMessage .= "indigent_date_requested: " . $indigentData['indigent_date_requested'] . "\n";
    $logMessage .= "indigent_date_approved: " . date('m/d/Y h:i A', strtotime($indigentData['indigent_date_approved'])) . "\n";
    $logMessage .= "indigent_date_disapproved: " . $indigentData['indigent_date_disapproved'] . "\n";
    $logMessage .= "indigent_added_by: " . $indigentData['indigent_added_by'] . "\n";
    $logMessage .= "indigent_edited_by: " . $indigentData['indigent_edited_by'] . "\n";
    $logMessage .= "indigent_requested_by: " . $indigentData['indigent_requested_by'] . "\n";
    $logMessage .= "indigent_approved_by: " . $indigentData['indigent_approved_by'] . "\n";
    $logMessage .= "indigent_disapproved_by: " . $indigentData['indigent_disapproved_by'] . "\n\n";

    // log session role
    $logMessage .= "this approve is done by " . $_SESSION['fname'] . (empty($_SESSION['mname']) || $_SESSION['mname'] === 'n/a' ? "" : " ") . (empty($_SESSION['mname']) || $_SESSION['mname'] === 'n/a' ? "" : $_SESSION['mname']) . " " . $_SESSION['lname'] . " as " . $_SESSION['role'] . "\n";
    $logMessage .= "approve indigent id number " . $indigentData['pid'] . " requested by " . $indigentData['indigent_res_name'] . "\n";
    $logMessage .= "date and time added " . date('m/d/Y h:i A') . "\n"; // include current date and time
    return rtrim($logMessage, ",\n") . "\n";
  }
}

if (isset($_POST['btn_approve'])) {
  $txt_app_indigent_user_id = $_POST['hidden_id'];
  $txt_app_indigent_num = !empty($_POST['txt_app_indigent_num']) ? strtolower($_POST['txt_app_indigent_num']) : 'n/a';
  $txt_app_indigent_findings = !empty($_POST['txt_app_indigent_findings']) ? strtolower($_POST['txt_app_indigent_findings']) : 'n/a';
  $txt_app_indigent_or_num = !empty($_POST['txt_app_indigent_or_num']) ? strtolower($_POST['txt_app_indigent_or_num']) : 'n/a';
  $txt_app_indigent_amount = !empty($_POST['txt_app_indigent_amount']) ? strtolower('₱' . number_format($_POST['txt_app_indigent_amount'], 2)) : '₱0.00';

  $txt_app_indigent_date_approved = date('m/d/Y h:i A');
  $txt_app_indigent_approved_by = $_SESSION['fname'] . (empty($_SESSION['mname']) || $_SESSION['mname'] === 'n/a' ? '' : ' ') . (empty($_SESSION['mname']) || $_SESSION['mname'] === 'n/a' ? '' : $_SESSION['mname']) . ' ' . $_SESSION['lname'] . ' as ' . $_SESSION['role'];
  $txt_app_indigent_user_type = $_SESSION['role'];

  $check_indigent_num = mysqli_prepare($con, "SELECT indigent_num FROM tblindigent WHERE indigent_num = ?");
  mysqli_stmt_bind_param($check_indigent_num, "s", $txt_app_indigent_num);
  mysqli_stmt_execute($check_indigent_num);
  mysqli_stmt_store_result($check_indigent_num);
  $num_rows = mysqli_stmt_num_rows($check_indigent_num);

  if ($num_rows == 0) {
    // update query
    $approve_query = mysqli_prepare($con, "UPDATE tblindigent SET indigent_num = ?, indigent_findings = ?, indigent_or_num = ?, indigent_amount = ?, indigent_status = 'approved', indigent_date_approved = ?, indigent_approved_by = ? WHERE id = ?");
    mysqli_stmt_bind_param($approve_query, "ssssssi", $txt_app_indigent_num, $txt_app_indigent_findings, $txt_app_indigent_or_num, $txt_app_indigent_amount, $txt_app_indigent_date_approved, $txt_app_indigent_approved_by, $txt_app_indigent_user_id);

    if (mysqli_stmt_execute($approve_query)) {
      // fetch new data after the update
      $indigentDataQuery = mysqli_prepare($con, "SELECT *, CONCAT(r.resident_fname, IF(r.resident_mname = 'n/a', '', CONCAT(' ', r.resident_mname)), ' ', r.resident_lname) as indigent_res_name, p.id as pid FROM tblindigent p LEFT JOIN tblresident r ON r.id = p.indigent_res_id	 WHERE p.id = ?");
      mysqli_stmt_bind_param($indigentDataQuery, "i", $txt_app_indigent_user_id);
      mysqli_stmt_execute($indigentDataQuery);
      $indigentDataQueryResult = mysqli_stmt_get_result($indigentDataQuery);
      $indigentData = mysqli_fetch_array($indigentDataQueryResult, MYSQLI_ASSOC);
      mysqli_stmt_close($indigentDataQuery);

      if (isset($_SESSION['role'])) {
        // log the old and new data
        $action = approvedGenerateLogMessage($indigentData);
        $log_query = mysqli_prepare($con, "INSERT INTO tbllogs (logs_user_type, logs_fname, logs_lname, logs_logdate, logs_action) VALUES (?, ?, ?, ?, ?)");
        mysqli_stmt_bind_param($log_query, "sssss", $txt_app_indigent_user_type, $_SESSION['fname'], $_SESSION['lname'], $txt_app_indigent_date_approved, $action);
        mysqli_stmt_execute($log_query);
      }

      // send sms notification with the secret key
      try {
        // infobip config
        $configuration = new Configuration(host: getenv('INFOBIP_BASE_URL'), apiKey: getenv('INFOBIP_API_KEY'));
        $sendSmsApi = new SmsApi(config: $configuration);
        $destination = new SmsDestination(to: $indigentData['resident_mobile_num']);

        $message = "Hi " . ucwords(strtolower(htmlspecialchars($indigentData['resident_fname']))) . ($indigentData['resident_mname'] === 'n/a' ? '' : " " . ucwords(strtolower(htmlspecialchars($indigentData['resident_mname'])))) . " " . ucwords(strtolower(htmlspecialchars($indigentData['resident_lname']))) . ", good news! Your request is approved. You can get your barangay indigent at the barangay hall now.";

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
        $message = "An error occurred while sending the SMS notification. Please try again later.";
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
  function disapprovedGenerateLogMessage($indigentData)
  {
    // data fetched
    $logMessage = "disapproved indigent details...\n\n";
    $logMessage .= "id: " . $indigentData['pid'] . "\n";
    $logMessage .= "indigent_num: " . $indigentData['indigent_num'] . "\n";
    $logMessage .= "indigent_res_id: " . $indigentData['indigent_res_name'] . "\n";
    $logMessage .= "indigent_purpose: " . $indigentData['indigent_purpose'] . "\n";
    $logMessage .= "indigent_gov_office: " . $indigentData['indigent_gov_office'] . "\n";
    $logMessage .= "indigent_findings: " . $indigentData['indigent_findings'] . "\n";
    $logMessage .= "indigent_or_num: " . $indigentData['indigent_or_num'] . "\n";
    $logMessage .= "indigent_amount: " . $indigentData['indigent_amount'] . "\n";
    $logMessage .= "indigent_status: " . $indigentData['indigent_status'] . "\n";
    $logMessage .= "indigent_date_added: " . $indigentData['indigent_date_added'] . "\n";
    $logMessage .= "indigent_date_edited: " . $indigentData['indigent_date_edited'] . "\n";
    $logMessage .= "indigent_date_requested: " . $indigentData['indigent_date_requested'] . "\n";
    $logMessage .= "indigent_date_approved: " . $indigentData['indigent_date_approved'] . "\n";
    $logMessage .= "indigent_date_disapproved: " . date('m/d/Y h:i A', strtotime($indigentData['indigent_date_disapproved'])) . "\n";
    $logMessage .= "indigent_added_by: " . $indigentData['indigent_added_by'] . "\n";
    $logMessage .= "indigent_edited_by: " . $indigentData['indigent_edited_by'] . "\n";
    $logMessage .= "indigent_requested_by: " . $indigentData['indigent_requested_by'] . "\n";
    $logMessage .= "indigent_approved_by: " . $indigentData['indigent_approved_by'] . "\n";
    $logMessage .= "indigent_disapproved_by: " . $indigentData['indigent_disapproved_by'] . "\n\n";

    // log session role
    $logMessage .= "this disapprove is done by " . $_SESSION['fname'] . (empty($_SESSION['mname']) || $_SESSION['mname'] === 'n/a' ? "" : " ") . (empty($_SESSION['mname']) || $_SESSION['mname'] === 'n/a' ? "" : $_SESSION['mname']) . " " . $_SESSION['lname'] . " as " . $_SESSION['role'] . "\n";
    $logMessage .= "disapprove indigent id number " . $indigentData['pid'] . " requested by " . $indigentData['indigent_res_name'] . "\n";
    $logMessage .= "date and time added " . date('m/d/Y h:i A') . "\n"; // include current date and time
    return rtrim($logMessage, ",\n") . "\n";
  }
}

if (isset($_POST['btn_disapprove'])) {
  $txt_dis_indigent_user_id = $_POST['hidden_id'];
  $txt_dis_indigent_findings = !empty($_POST['txt_dis_indigent_findings']) ? strtolower($_POST['txt_dis_indigent_findings']) : 'n/a';

  $txt_dis_indigent_date_disapproved = date('m/d/Y h:i A');
  $txt_dis_indigent_disapproved_by = $_SESSION['fname'] . (empty($_SESSION['mname']) || $_SESSION['mname'] === 'n/a' ? '' : ' ') . (empty($_SESSION['mname']) || $_SESSION['mname'] === 'n/a' ? '' : $_SESSION['mname']) . ' ' . $_SESSION['lname'] . ' as ' . $_SESSION['role'];
  $txt_dis_indigent_user_type = $_SESSION['role'];

  // update query
  $disapprove_query = mysqli_prepare($con, "UPDATE tblindigent SET indigent_findings = ?, indigent_status = 'disapproved', indigent_date_disapproved = ?, indigent_disapproved_by = ? WHERE id = ?");
  mysqli_stmt_bind_param($disapprove_query, "sssi", $txt_dis_indigent_findings, $txt_dis_indigent_date_disapproved, $txt_dis_indigent_disapproved_by, $txt_dis_indigent_user_id);

  if (mysqli_stmt_execute($disapprove_query)) {
    // fetch new data after the update
    $indigentDataQuery = mysqli_prepare($con, "SELECT *, CONCAT(r.resident_fname, IF(r.resident_mname = 'n/a', '', CONCAT(' ', r.resident_mname)), ' ', r.resident_lname) as indigent_res_name, p.id as pid FROM tblindigent p LEFT JOIN tblresident r ON r.id = p.indigent_res_id WHERE p.id = ?");
    mysqli_stmt_bind_param($indigentDataQuery, "i", $txt_dis_indigent_user_id);
    mysqli_stmt_execute($indigentDataQuery);
    $indigentDataQueryResult = mysqli_stmt_get_result($indigentDataQuery);
    $indigentData = mysqli_fetch_array($indigentDataQueryResult, MYSQLI_ASSOC);
    mysqli_stmt_close($indigentDataQuery);

    if (isset($_SESSION['role'])) {
      // log the old and new data
      $action = disapprovedGenerateLogMessage($indigentData);
      $log_query = mysqli_prepare($con, "INSERT INTO tbllogs (logs_user_type, logs_fname, logs_lname, logs_logdate, logs_action) VALUES (?, ?, ?, ?, ?)");
      mysqli_stmt_bind_param($log_query, "sssss", $txt_dis_indigent_user_type, $_SESSION['fname'], $_SESSION['lname'], $txt_dis_indigent_date_disapproved, $action);
      mysqli_stmt_execute($log_query);
    }

    // send sms notification with the secret key
    try {
      // infobip config
      $configuration = new Configuration(host: getenv('INFOBIP_BASE_URL'), apiKey: getenv('INFOBIP_API_KEY'));
      $sendSmsApi = new SmsApi(config: $configuration);
      $destination = new SmsDestination(to: $indigentData['resident_mobile_num']);

      $message = "Hi " . ucwords(strtolower(htmlspecialchars($indigentData['resident_fname']))) . ($indigentData['resident_mname'] === 'n/a' ? '' : " " . ucwords(strtolower(htmlspecialchars($indigentData['resident_mname'])))) . " " . ucwords(strtolower(htmlspecialchars($indigentData['resident_lname']))) . ", bad news! Your request is disapproved due to our findings of " . htmlspecialchars($indigentData['indigent_findings']) . ". You can try again later.";

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
      $message = "An error occurred while sending the SMS notification. Please try again later.";
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
    $logMessage = "edited indigent details...\n\n";
    $logMessage .= "old data:\n";
    $logMessage .= "id: " . $oldData['pid'] . "\n";
    $logMessage .= "indigent_num: " . $oldData['indigent_num'] . "\n";
    $logMessage .= "indigent_res_id: " . $oldData['indigent_res_name'] . "\n";
    $logMessage .= "indigent_purpose: " . $oldData['indigent_purpose'] . "\n";
    $logMessage .= "indigent_gov_office: " . $oldData['indigent_gov_office'] . "\n";
    $logMessage .= "indigent_findings: " . $oldData['indigent_findings'] . "\n";
    $logMessage .= "indigent_or_num: " . $oldData['indigent_or_num'] . "\n";
    $logMessage .= "indigent_amount: " . $oldData['indigent_amount'] . "\n";
    $logMessage .= "indigent_status: " . $oldData['indigent_status'] . "\n";
    $logMessage .= "indigent_date_added: " . $oldData['indigent_date_added'] . "\n";
    $logMessage .= "indigent_date_edited: " . $oldData['indigent_date_edited'] . "\n";
    $logMessage .= "indigent_date_requested: " . $oldData['indigent_date_requested'] . "\n";
    $logMessage .= "indigent_date_approved: " . $oldData['indigent_date_approved'] . "\n";
    $logMessage .= "indigent_date_disapproved: " . $oldData['indigent_date_disapproved'] . "\n";
    $logMessage .= "indigent_added_by: " . $oldData['indigent_added_by'] . "\n";
    $logMessage .= "indigent_edited_by: " . $oldData['indigent_edited_by'] . "\n";
    $logMessage .= "indigent_requested_by: " . $oldData['indigent_requested_by'] . "\n";
    $logMessage .= "indigent_approved_by: " . $oldData['indigent_approved_by'] . "\n";
    $logMessage .= "indigent_disapproved_by: " . $oldData['indigent_disapproved_by'] . "\n\n";

    // new data fetched
    $logMessage .= "\nnew data:\n";
    $logMessage .= "id: " . $newData['pid'] . "\n";
    $logMessage .= "indigent_num: " . $newData['indigent_num'] . "\n";
    $logMessage .= "indigent_res_id: " . $newData['indigent_res_name'] . "\n";
    $logMessage .= "indigent_purpose: " . $newData['indigent_purpose'] . "\n";
    $logMessage .= "indigent_gov_office: " . $newData['indigent_gov_office'] . "\n";
    $logMessage .= "indigent_findings: " . $newData['indigent_findings'] . "\n";
    $logMessage .= "indigent_or_num: " . $newData['indigent_or_num'] . "\n";
    $logMessage .= "indigent_amount: " . $newData['indigent_amount'] . "\n";
    $logMessage .= "indigent_status: " . $newData['indigent_status'] . "\n";
    $logMessage .= "indigent_date_added: " . $newData['indigent_date_added'] . "\n";
    $logMessage .= "indigent_date_edited: " . date('m/d/Y h:i A', strtotime($newData['indigent_date_edited'])) . "\n";
    $logMessage .= "indigent_date_requested: " . $newData['indigent_date_requested'] . "\n";
    $logMessage .= "indigent_date_approved: " . $newData['indigent_date_approved'] . "\n";
    $logMessage .= "indigent_date_disapproved: " . $newData['indigent_date_disapproved'] . "\n";
    $logMessage .= "indigent_added_by: " . $newData['indigent_added_by'] . "\n";
    $logMessage .= "indigent_edited_by: " . $newData['indigent_edited_by'] . "\n";
    $logMessage .= "indigent_requested_by: " . $newData['indigent_requested_by'] . "\n";
    $logMessage .= "indigent_approved_by: " . $newData['indigent_approved_by'] . "\n";
    $logMessage .= "indigent_disapproved_by: " . $newData['indigent_disapproved_by'] . "\n\n";

    // log session role
    $logMessage .= "this edit is done by " . $_SESSION['fname'] . (empty($_SESSION['mname']) || $_SESSION['mname'] === 'n/a' ? "" : " ") . (empty($_SESSION['mname']) || $_SESSION['mname'] === 'n/a' ? "" : $_SESSION['mname']) . " " . $_SESSION['lname'] . " as " . $_SESSION['role'] . "\n";
    $logMessage .= "edit indigent id number " . $newData['pid'] . " for resident " . $newData['indigent_res_name'] . "\n";
    $logMessage .= "date and time edited " . date('m/d/Y h:i A') . "\n"; // include current date and time
    return rtrim($logMessage, ",\n") . "\n";
  }
}

if (isset($_POST['btn_edit'])) {
  $txt_edit_indigent_user_id = $_POST['hidden_id'];

  // fetch old data before the update
  $oldDataQuery = mysqli_prepare($con, "SELECT *, CONCAT(r.resident_fname, IF(r.resident_mname = 'n/a', '', CONCAT(' ', r.resident_mname)), ' ', r.resident_lname) as indigent_res_name, p.id as pid FROM tblindigent p LEFT JOIN tblresident r ON r.id = p.indigent_res_id WHERE p.id = ?");
  mysqli_stmt_bind_param($oldDataQuery, "i", $txt_edit_indigent_user_id);
  mysqli_stmt_execute($oldDataQuery);
  $oldDataResult = mysqli_stmt_get_result($oldDataQuery);
  $oldData = mysqli_fetch_array($oldDataResult, MYSQLI_ASSOC);
  mysqli_stmt_close($oldDataQuery);

  $txt_edit_indigent_num = !empty($_POST['txt_edit_indigent_num']) ? strtolower($_POST['txt_edit_indigent_num']) : 'n/a';
  $txt_edit_indigent_purpose = !empty($_POST['txt_edit_indigent_purpose']) ? strtolower($_POST['txt_edit_indigent_purpose']) : 'n/a';
  $txt_edit_indigent_gov_office = !empty($_POST['txt_edit_indigent_gov_office']) ? $_POST['txt_edit_indigent_gov_office'] : 'n/a';
  $txt_edit_indigent_findings = !empty($_POST['txt_edit_indigent_findings']) ? strtolower($_POST['txt_edit_indigent_findings']) : 'n/a';
  $txt_edit_indigent_or_num = !empty($_POST['txt_edit_indigent_or_num']) ? strtolower($_POST['txt_edit_indigent_or_num']) : 'n/a';
  $txt_edit_indigent_amount = !empty($_POST['txt_edit_indigent_amount']) ? strtolower('₱' . number_format($_POST['txt_edit_indigent_amount'], 2)) : '₱0.00';

  $txt_edit_indigent_date_edited = date('m/d/Y h:i A');
  $txt_edit_indigent_edited_by = $_SESSION['fname'] . (empty($_SESSION['mname']) || $_SESSION['mname'] === 'n/a' ? '' : ' ') . (empty($_SESSION['mname']) || $_SESSION['mname'] === 'n/a' ? '' : $_SESSION['mname']) . ' ' . $_SESSION['lname'] . ' as ' . $_SESSION['role'];
  $txt_edit_indigent_user_type = $_SESSION['role'];

  // check duplicate indigent num
  $check_query = mysqli_prepare($con, "SELECT indigent_num FROM tblindigent WHERE indigent_num = ? AND id <> ?");
  mysqli_stmt_bind_param($check_query, "si", $txt_edit_indigent_num, $txt_edit_indigent_user_id);
  mysqli_stmt_execute($check_query);
  mysqli_stmt_store_result($check_query);
  $num_rows = mysqli_stmt_num_rows($check_query);

  if ($num_rows == 0) {
    // update query
    $update_query = mysqli_prepare($con, "UPDATE tblindigent SET indigent_num = ?, indigent_purpose = ?, indigent_gov_office = ?, indigent_findings = ?, indigent_or_num = ?, indigent_amount = ?, indigent_date_edited = ?, indigent_edited_by = ? WHERE id = ?");
    mysqli_stmt_bind_param($update_query, "ssssssssi", $txt_edit_indigent_num, $txt_edit_indigent_purpose, $txt_edit_indigent_gov_office, $txt_edit_indigent_findings, $txt_edit_indigent_or_num, $txt_edit_indigent_amount, $txt_edit_indigent_date_edited, $txt_edit_indigent_edited_by, $txt_edit_indigent_user_id);
    $update_success = mysqli_stmt_execute($update_query);

    if ($update_success) {
      // fetch new data after the update
      $newDataQuery = mysqli_prepare($con, "SELECT *, CONCAT(r.resident_fname, IF(r.resident_mname = 'n/a', '', CONCAT(' ', r.resident_mname)), ' ', r.resident_lname) as indigent_res_name, p.id as pid FROM tblindigent p LEFT JOIN tblresident r ON r.id = p.indigent_res_id WHERE p.id = ?");
      mysqli_stmt_bind_param($newDataQuery, "i", $txt_edit_indigent_user_id);
      mysqli_stmt_execute($newDataQuery);
      $newDataResult = mysqli_stmt_get_result($newDataQuery);
      $newData = mysqli_fetch_array($newDataResult, MYSQLI_ASSOC);
      mysqli_stmt_close($newDataQuery);

      if (isset($_SESSION['role'])) {
        // log the old and new data
        $action = editedGenerateLogMessage($oldData, $newData);
        $log_query = mysqli_prepare($con, "INSERT INTO tbllogs (logs_user_type, logs_fname, logs_lname, logs_logdate, logs_action) VALUES (?, ?, ?, ?, ?)");
        mysqli_stmt_bind_param($log_query, "sssss", $txt_edit_indigent_user_type, $_SESSION['fname'], $_SESSION['lname'], $txt_edit_indigent_date_edited, $action);
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
  function deletedGenerateLogMessage($indigentData)
  {
    // data fetched
    $logMessage = "deleted indigent details before deletion...\n\n";
    $logMessage .= "id: " . $indigentData['pid'] . "\n";
    $logMessage .= "indigent_num: " . $indigentData['indigent_num'] . "\n";
    $logMessage .= "indigent_res_id: " . $indigentData['indigent_res_name'] . "\n";
    $logMessage .= "indigent_purpose: " . $indigentData['indigent_purpose'] . "\n";
    $logMessage .= "indigent_gov_office: " . $indigentData['indigent_gov_office'] . "\n";
    $logMessage .= "indigent_findings: " . $indigentData['indigent_findings'] . "\n";
    $logMessage .= "indigent_or_num: " . $indigentData['indigent_or_num'] . "\n";
    $logMessage .= "indigent_amount: " . $indigentData['indigent_amount'] . "\n";
    $logMessage .= "indigent_status: " . $indigentData['indigent_status'] . "\n";
    $logMessage .= "indigent_date_added: " . $indigentData['indigent_date_added'] . "\n";
    $logMessage .= "indigent_date_edited: " . $indigentData['indigent_date_edited'] . "\n";
    $logMessage .= "indigent_date_requested: " . $indigentData['indigent_date_requested'] . "\n";
    $logMessage .= "indigent_date_approved: " . $indigentData['indigent_date_approved'] . "\n";
    $logMessage .= "indigent_date_disapproved: " . $indigentData['indigent_date_disapproved'] . "\n";
    $logMessage .= "indigent_added_by: " . $indigentData['indigent_added_by'] . "\n";
    $logMessage .= "indigent_edited_by: " . $indigentData['indigent_edited_by'] . "\n";
    $logMessage .= "indigent_requested_by: " . $indigentData['indigent_requested_by'] . "\n";
    $logMessage .= "indigent_approved_by: " . $indigentData['indigent_approved_by'] . "\n";
    $logMessage .= "indigent_disapproved_by: " . $indigentData['indigent_disapproved_by'] . "\n\n";

    // log session role
    $logMessage .= "this delete is done by " . $_SESSION['fname'] . (empty($_SESSION['mname']) || $_SESSION['mname'] === 'n/a' ? "" : " ") . (empty($_SESSION['mname']) || $_SESSION['mname'] === 'n/a' ? "" : $_SESSION['mname']) . " " . $_SESSION['lname'] . " as " . $_SESSION['role'] . "\n";
    $logMessage .= "delete indigent id number " . $indigentData['pid'] . " for resident " . $indigentData['indigent_res_name'] . "\n";
    $logMessage .= "date and time deleted " . date('m/d/Y h:i A') . "\n"; // include current date and time
    return rtrim($logMessage, ",\n") . "\n";
  }
}

if (isset($_POST['btn_delete'])) {

  if (isset($_POST['chk_delete']) && is_array($_POST['chk_delete'])) {

    $txt_delete_indigent_date_deleted = date('m/d/Y h:i A');
    // validate and sanitize each selected ids
    $validIds = array_map('intval', $_POST['chk_delete']);
    // remove non-numeric values
    $validIds = array_filter($validIds, 'is_numeric');

    if (!empty($validIds)) {
      // fetch the data before deleted for logging
      $placeholders = implode(', ', array_fill(0, count($validIds), '?'));

      // fetch the data to be deleted
      $deletedDataQuery = mysqli_prepare($con, "SELECT *, CONCAT(r.resident_fname, IF(r.resident_mname = 'n/a', '', CONCAT(' ', r.resident_mname)), ' ', r.resident_lname) as indigent_res_name, p.id as pid FROM tblindigent p LEFT JOIN tblresident r ON r.id = p.indigent_res_id WHERE p.id IN ($placeholders)");
      mysqli_stmt_bind_param($deletedDataQuery, str_repeat('i', count($validIds)), ...$validIds);
      mysqli_stmt_execute($deletedDataQuery);
      $deletedDataResult = mysqli_stmt_get_result($deletedDataQuery);

      // log each deleted record
      while ($deletedData = mysqli_fetch_array($deletedDataResult, MYSQLI_ASSOC)) {
        $action = deletedGenerateLogMessage($deletedData);
        $log_query = mysqli_prepare($con, "INSERT INTO tbllogs (logs_user_type, logs_fname, logs_lname, logs_logdate, logs_action) VALUES (?, ?, ?, ?, ?)");
        mysqli_stmt_bind_param($log_query, "sssss", $_SESSION['role'], $_SESSION['fname'], $_SESSION['lname'], $txt_delete_indigent_date_deleted, $action);
        mysqli_stmt_execute($log_query);
      }

      // prepare and execute the deletion query
      $delete_query = mysqli_prepare($con, "DELETE FROM tblindigent WHERE id IN ($placeholders)");

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