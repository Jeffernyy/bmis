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
  function addedGenerateLogMessage($blotterData)
  {
    // data fetched
    $logMessage = "added blotter details...\n\n";
    $logMessage .= "id: " . $blotterData['id'] . "\n";
    $logMessage .= "blotter_complainant: " . $blotterData['blotter_complainant_res_name'] . "\n";
    $logMessage .= "blotter_complainant_age: " . $blotterData['blotter_complainant_age'] . "\n";
    $logMessage .= "blotter_complainant_contact_num: " . $blotterData['blotter_complainant_contact_num'] . "\n";
    $logMessage .= "blotter_complainant_address: " . $blotterData['blotter_complainant_address'] . "\n";
    $logMessage .= "blotter_respondent: " . $blotterData['blotter_respondent_res_name'] . "\n";
    $logMessage .= "blotter_respondent_age: " . $blotterData['blotter_respondent_age'] . "\n";
    $logMessage .= "blotter_respondent_contact_num: " . $blotterData['blotter_respondent_contact_num'] . "\n";
    $logMessage .= "blotter_respondent_address: " . $blotterData['blotter_respondent_address'] . "\n";
    $logMessage .= "blotter_first_complaint: " . $blotterData['blotter_first_complaint'] . "\n";
    $logMessage .= "blotter_second_complaint: " . $blotterData['blotter_second_complaint'] . "\n";
    $logMessage .= "blotter_action_taken: " . $blotterData['blotter_action_taken'] . "\n";
    $logMessage .= "blotter_status: " . $blotterData['blotter_status'] . "\n";
    $logMessage .= "blotter_location_of_incident: " . $blotterData['blotter_location_of_incident'] . "\n";
    $logMessage .= "blotter_case_num: " . $blotterData['blotter_case_num'] . "\n";
    $logMessage .= "blotter_for: " . $blotterData['blotter_for'] . "\n";
    $logMessage .= "blotter_date_added: " . $blotterData['blotter_date_added'] . "\n";
    $logMessage .= "blotter_date_edited: " . $blotterData['blotter_date_edited'] . "\n";
    $logMessage .= "blotter_added_by: " . $blotterData['blotter_added_by'] . "\n";
    $logMessage .= "blotter_edited_by: " . $blotterData['blotter_edited_by'] . "\n\n";

    // log session role
    $logMessage .= "this add is done by " . $_SESSION['fname'] . (empty($_SESSION['mname']) || $_SESSION['mname'] === 'n/a' ? "" : " ") . (empty($_SESSION['mname']) || $_SESSION['mname'] === 'n/a' ? "" : $_SESSION['mname']) . " " . $_SESSION['lname'] . " as " . $_SESSION['role'] . "\n";
    $logMessage .= "add blotter id number " . $blotterData['id'] . " for complainant " . $blotterData['blotter_complainant_res_name'] . "\n";
    $logMessage .= "date and time added " . date('m/d/Y h:i A') . "\n";
    return rtrim($logMessage, ",\n") . "\n";
  }
}

if (isset($_POST['btn_add'])) {
  $txt_add_blotter_complainant_res_id = !empty($_POST['txt_add_blotter_complainant_res_id']) ? strtolower($_POST['txt_add_blotter_complainant_res_id']) : 'n/a';
  $txt_add_blotter_complainant_age = !empty($_POST['txt_add_blotter_complainant_age']) ? strtolower($_POST['txt_add_blotter_complainant_age']) : 'n/a';
  $txt_add_blotter_complainant_contact_num = !empty($_POST['txt_add_blotter_complainant_contact_num']) ? strtolower($_POST['txt_add_blotter_complainant_contact_num']) : 'n/a';
  $txt_add_blotter_complainant_address = !empty($_POST['txt_add_blotter_complainant_address']) ? strtolower($_POST['txt_add_blotter_complainant_address']) : 'n/a';

  $txt_add_blotter_respondent_id = !empty($_POST['txt_add_blotter_respondent_id']) ? strtolower($_POST['txt_add_blotter_respondent_id']) : 'n/a';
  $txt_add_blotter_respondent_age = !empty($_POST['txt_add_blotter_respondent_age']) ? strtolower($_POST['txt_add_blotter_respondent_age']) : 'n/a';
  $txt_add_blotter_respondent_contact_num = !empty($_POST['txt_add_blotter_respondent_contact_num']) ? strtolower($_POST['txt_add_blotter_respondent_contact_num']) : 'n/a';
  $txt_add_blotter_respondent_address = !empty($_POST['txt_add_blotter_respondent_address']) ? strtolower($_POST['txt_add_blotter_respondent_address']) : 'n/a';

  $txt_add_blotter_first_complaint = !empty($_POST['txt_add_blotter_first_complaint']) ? strtolower($_POST['txt_add_blotter_first_complaint']) : 'n/a';
  $txt_add_blotter_second_complaint = !empty($_POST['txt_add_blotter_second_complaint']) ? strtolower($_POST['txt_add_blotter_second_complaint']) : 'n/a';

  $txt_add_blotter_action = !empty($_POST['txt_add_blotter_action']) ? strtolower($_POST['txt_add_blotter_action']) : 'n/a';
  $txt_add_blotter_status = !empty($_POST['txt_add_blotter_status']) ? strtolower($_POST['txt_add_blotter_status']) : 'n/a';
  $txt_add_blotter_location = !empty($_POST['txt_add_blotter_location']) ? strtolower($_POST['txt_add_blotter_location']) : 'n/a';
  $txt_add_blotter_case_num = !empty($_POST['txt_add_blotter_case_num']) ? strtolower($_POST['txt_add_blotter_case_num']) : 'n/a';
  $txt_add_blotter_for = !empty($_POST['txt_add_blotter_for']) ? strtolower($_POST['txt_add_blotter_for']) : 'n/a';

  $txt_add_blotter_date_added = date('m/d/Y h:i A');
  $txt_add_blotter_added_by = $_SESSION['fname'] . (empty($_SESSION['mname']) || $_SESSION['mname'] === 'n/a' ? '' : ' ') . (empty($_SESSION['mname']) || $_SESSION['mname'] === 'n/a' ? '' : $_SESSION['mname']) . ' ' . $_SESSION['lname'] . ' as ' . $_SESSION['role'];
  $txt_add_blotter_user_type = $_SESSION['role'];

  $checkBlotterCaseNum = mysqli_prepare($con, "SELECT blotter_case_num FROM tblblotter WHERE blotter_case_num = ?");
  mysqli_stmt_bind_param($checkBlotterCaseNum, "s", $txt_add_blotter_case_num);
  mysqli_stmt_execute($checkBlotterCaseNum);
  mysqli_stmt_store_result($checkBlotterCaseNum);
  $num_rows = mysqli_stmt_num_rows($checkBlotterCaseNum);

  if ($num_rows == 0) {
    $query = mysqli_query($con, "INSERT INTO tblblotter (blotter_complainant, blotter_complainant_age, blotter_complainant_contact_num, blotter_complainant_address, blotter_respondent, blotter_respondent_age, blotter_respondent_contact_num, blotter_respondent_address, blotter_first_complaint, blotter_second_complaint, blotter_action_taken, blotter_status, blotter_location_of_incident, blotter_case_num, blotter_for, blotter_date_added, blotter_date_edited, blotter_added_by, blotter_edited_by) VALUES ('$txt_add_blotter_complainant_res_id', '$txt_add_blotter_complainant_age', '$txt_add_blotter_complainant_contact_num', '$txt_add_blotter_complainant_address', '$txt_add_blotter_respondent_id', '$txt_add_blotter_respondent_age', '$txt_add_blotter_respondent_contact_num', '$txt_add_blotter_respondent_address', '$txt_add_blotter_first_complaint', '$txt_add_blotter_second_complaint', '$txt_add_blotter_action', '$txt_add_blotter_status', '$txt_add_blotter_location', '$txt_add_blotter_case_num', '$txt_add_blotter_for', '$txt_add_blotter_date_added', 'n/a', '$txt_add_blotter_added_by', 'n/a')") or die('Error: ' . mysqli_error($con));

    if ($query == true) {
      $last_inserted_id = mysqli_insert_id($con);

      $blotter_data_query = mysqli_prepare($con, "SELECT b.*, r_complainant.id AS rid_complainant, CASE WHEN b.blotter_complainant REGEXP '^[0-9]+$' THEN (SELECT CONCAT(resident_fname, IF(resident_mname = 'n/a', '', CONCAT(' ', resident_mname)), ' ', resident_lname) FROM tblresident WHERE id = b.blotter_complainant) ELSE b.blotter_complainant END AS blotter_complainant_res_name, r_respondent.id AS rid_respondent, CASE WHEN b.blotter_respondent REGEXP '^[0-9]+$' THEN (SELECT CONCAT(resident_fname, IF(resident_mname = 'n/a', '', CONCAT(' ', resident_mname)), ' ', resident_lname) FROM tblresident WHERE id = b.blotter_respondent) ELSE b.blotter_respondent END AS blotter_respondent_res_name FROM tblblotter b LEFT JOIN tblresident r_complainant ON b.blotter_complainant = r_complainant.id LEFT JOIN tblresident r_respondent ON b.blotter_respondent = r_respondent.id WHERE b.id = ?");
      mysqli_stmt_bind_param($blotter_data_query, "i", $last_inserted_id);
      mysqli_stmt_execute($blotter_data_query);
      $blotter_data_query_res = mysqli_stmt_get_result($blotter_data_query);
      $blotterData = mysqli_fetch_array($blotter_data_query_res, MYSQLI_ASSOC);
      mysqli_stmt_close($blotter_data_query);

      if (isset($_SESSION['role'])) {
        $action = addedGenerateLogMessage($blotterData);
        $log_query = mysqli_prepare($con, "INSERT INTO tbllogs (logs_user_type, logs_fname, logs_lname, logs_logdate, logs_action) VALUES (?, ?, ?, ?, ?)");
        mysqli_stmt_bind_param($log_query, "sssss", $txt_add_blotter_user_type, $_SESSION['fname'], $_SESSION['lname'], $txt_add_blotter_date_added, $action);
        mysqli_stmt_execute($log_query);
      }

      // send sms notification with the secret key
      try {
        // infobip config
        $configuration = new Configuration(host: getenv('INFOBIP_BASE_URL'), apiKey: getenv('INFOBIP_API_KEY'));
        $sendSmsApi = new SmsApi(config: $configuration);
        $destination1 = new SmsDestination(to: $txt_add_blotter_complainant_contact_num);
        $destination2 = new SmsDestination(to: $txt_add_blotter_respondent_contact_num);

        $message = "You're being blotter.";

        $message = new SmsTextualMessage(destinations: [$destination1, $destination2], from: 'NEWPANDAN', text: $message);
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
if (!function_exists('editedGenerateLogMessage')) {
  function editedGenerateLogMessage($oldData, $newData)
  {
    // old data fetched
    $logMessage = "edited blotter details...\n\n";
    $logMessage .= "old data:\n";
    $logMessage .= "id: " . $oldData['id'] . "\n";
    $logMessage .= "blotter_complainant: " . $oldData['blotter_complainant_res_name'] . "\n";
    $logMessage .= "blotter_complainant_age: " . $oldData['blotter_complainant_age'] . "\n";
    $logMessage .= "blotter_complainant_contact_num: " . $oldData['blotter_complainant_contact_num'] . "\n";
    $logMessage .= "blotter_complainant_address: " . $oldData['blotter_complainant_address'] . "\n";
    $logMessage .= "blotter_respondent: " . $oldData['blotter_respondent_res_name'] . "\n";
    $logMessage .= "blotter_respondent_age: " . $oldData['blotter_respondent_age'] . "\n";
    $logMessage .= "blotter_respondent_contact_num: " . $oldData['blotter_respondent_contact_num'] . "\n";
    $logMessage .= "blotter_respondent_address: " . $oldData['blotter_respondent_address'] . "\n";
    $logMessage .= "blotter_first_complaint: " . $oldData['blotter_first_complaint'] . "\n";
    $logMessage .= "blotter_second_complaint: " . $oldData['blotter_second_complaint'] . "\n";
    $logMessage .= "blotter_action_taken: " . $oldData['blotter_action_taken'] . "\n";
    $logMessage .= "blotter_status: " . $oldData['blotter_status'] . "\n";
    $logMessage .= "blotter_location_of_incident: " . $oldData['blotter_location_of_incident'] . "\n";
    $logMessage .= "blotter_case_num: " . $oldData['blotter_case_num'] . "\n";
    $logMessage .= "blotter_for: " . $oldData['blotter_for'] . "\n";
    $logMessage .= "blotter_date_added: " . $oldData['blotter_date_added'] . "\n";
    $logMessage .= "blotter_date_edited: " . $oldData['blotter_date_edited'] . "\n";
    $logMessage .= "blotter_added_by: " . $oldData['blotter_added_by'] . "\n";
    $logMessage .= "blotter_edited_by: " . $oldData['blotter_edited_by'] . "\n\n";

    // new data fetched
    $logMessage .= "new data:\n";
    $logMessage .= "id: " . $newData['id'] . "\n";
    $logMessage .= "blotter_complainant: " . $newData['blotter_complainant_res_name'] . "\n";
    $logMessage .= "blotter_complainant_age: " . $newData['blotter_complainant_age'] . "\n";
    $logMessage .= "blotter_complainant_contact_num: " . $newData['blotter_complainant_contact_num'] . "\n";
    $logMessage .= "blotter_complainant_address: " . $newData['blotter_complainant_address'] . "\n";
    $logMessage .= "blotter_respondent: " . $newData['blotter_respondent_res_name'] . "\n";
    $logMessage .= "blotter_respondent_age: " . $newData['blotter_respondent_age'] . "\n";
    $logMessage .= "blotter_respondent_contact_num: " . $newData['blotter_respondent_contact_num'] . "\n";
    $logMessage .= "blotter_respondent_address: " . $newData['blotter_respondent_address'] . "\n";
    $logMessage .= "blotter_first_complaint: " . $newData['blotter_first_complaint'] . "\n";
    $logMessage .= "blotter_second_complaint: " . $newData['blotter_second_complaint'] . "\n";
    $logMessage .= "blotter_action_taken: " . $newData['blotter_action_taken'] . "\n";
    $logMessage .= "blotter_status: " . $newData['blotter_status'] . "\n";
    $logMessage .= "blotter_location_of_incident: " . $newData['blotter_location_of_incident'] . "\n";
    $logMessage .= "blotter_case_num: " . $newData['blotter_case_num'] . "\n";
    $logMessage .= "blotter_for: " . $newData['blotter_for'] . "\n";
    $logMessage .= "blotter_date_added: " . $newData['blotter_date_added'] . "\n";
    $logMessage .= "blotter_date_edited: " . $newData['blotter_date_edited'] . "\n";
    $logMessage .= "blotter_added_by: " . $newData['blotter_added_by'] . "\n";
    $logMessage .= "blotter_edited_by: " . $newData['blotter_edited_by'] . "\n\n";

    // log session role
    $logMessage .= "this edit is done by " . $_SESSION['fname'] . (empty($_SESSION['mname']) || $_SESSION['mname'] === 'n/a' ? "" : " ") . (empty($_SESSION['mname']) || $_SESSION['mname'] === 'n/a' ? "" : $_SESSION['mname']) . " " . $_SESSION['lname'] . " as " . $_SESSION['role'] . "\n";
    $logMessage .= "edit blotter id number " . $newData['id'] . " for complainant " . $newData['blotter_complainant_res_name'] . "\n";
    $logMessage .= "date and time edited " . date('m/d/Y h:i A') . "\n";
    return rtrim($logMessage, ",\n") . "\n";
  }
}

if (isset($_POST['btn_edit'])) {
  $txt_edit_blotter_user_id = $_POST['hidden_id'];

  $oldDataQuery = mysqli_prepare($con, "SELECT b.*, r_complainant.id AS rid_complainant, CASE WHEN b.blotter_complainant REGEXP '^[0-9]+$' THEN (SELECT CONCAT(resident_fname, IF(resident_mname = 'n/a', '', CONCAT(' ', resident_mname)), ' ', resident_lname) FROM tblresident WHERE id = b.blotter_complainant) ELSE b.blotter_complainant END AS blotter_complainant_res_name, r_respondent.id AS rid_respondent, CASE WHEN b.blotter_respondent REGEXP '^[0-9]+$' THEN (SELECT CONCAT(resident_fname, IF(resident_mname = 'n/a', '', CONCAT(' ', resident_mname)), ' ', resident_lname) FROM tblresident WHERE id = b.blotter_respondent) ELSE b.blotter_respondent END AS blotter_respondent_res_name FROM tblblotter b LEFT JOIN tblresident r_complainant ON b.blotter_complainant = r_complainant.id LEFT JOIN tblresident r_respondent ON b.blotter_respondent = r_respondent.id WHERE b.id = ?");
  mysqli_stmt_bind_param($oldDataQuery, "i", $txt_edit_blotter_user_id);
  mysqli_stmt_execute($oldDataQuery);
  $oldDataResult = mysqli_stmt_get_result($oldDataQuery);
  $oldData = mysqli_fetch_array($oldDataResult, MYSQLI_ASSOC);
  mysqli_stmt_close($oldDataQuery);

  $txt_edit_blotter_complainant_contact_num = !empty($_POST['txt_edit_blotter_complainant_contact_num']) ? strtolower($_POST['txt_edit_blotter_complainant_contact_num']) : 'n/a';
  $txt_edit_blotter_complainant_address = !empty($_POST['txt_edit_blotter_complainant_address']) ? strtolower($_POST['txt_edit_blotter_complainant_address']) : 'n/a';

  $txt_edit_blotter_respondent_contact_num = !empty($_POST['txt_edit_blotter_respondent_contact_num']) ? strtolower($_POST['txt_edit_blotter_respondent_contact_num']) : 'n/a';
  $txt_edit_blotter_respondent_address = !empty($_POST['txt_edit_blotter_respondent_address']) ? strtolower($_POST['txt_edit_blotter_respondent_address']) : 'n/a';

  $txt_edit_blotter_first_complaint = !empty($_POST['txt_edit_blotter_first_complaint']) ? strtolower($_POST['txt_edit_blotter_first_complaint']) : 'n/a';
  $txt_edit_blotter_second_complaint = !empty($_POST['txt_edit_blotter_second_complaint']) ? strtolower($_POST['txt_edit_blotter_second_complaint']) : 'n/a';

  $txt_edit_blotter_action = !empty($_POST['txt_edit_blotter_action']) ? strtolower($_POST['txt_edit_blotter_action']) : 'n/a';
  $txt_edit_blotter_status = !empty($_POST['txt_edit_blotter_status']) ? strtolower($_POST['txt_edit_blotter_status']) : 'n/a';
  $txt_edit_blotter_location = !empty($_POST['txt_edit_blotter_location']) ? strtolower($_POST['txt_edit_blotter_location']) : 'n/a';
  $txt_edit_blotter_case_num = !empty($_POST['txt_edit_blotter_case_num']) ? strtolower($_POST['txt_edit_blotter_case_num']) : 'n/a';
  $txt_edit_blotter_for = !empty($_POST['txt_edit_blotter_for']) ? strtolower($_POST['txt_edit_blotter_for']) : 'n/a';

  $txt_edit_blotter_date_edited = date('m/d/Y h:i A');
  $txt_edit_blotter_edited_by = $_SESSION['fname'] . (empty($_SESSION['mname']) || $_SESSION['mname'] === 'n/a' ? '' : ' ') . (empty($_SESSION['mname']) || $_SESSION['mname'] === 'n/a' ? '' : $_SESSION['mname']) . ' ' . $_SESSION['lname'] . ' as ' . $_SESSION['role'];
  $txt_edit_blotter_user_type = $_SESSION['role'];

  $check_query = mysqli_prepare($con, "SELECT blotter_case_num FROM tblblotter WHERE blotter_case_num = ? AND id <> ?");
  mysqli_stmt_bind_param($check_query, "si", $txt_edit_blotter_case_num, $txt_edit_blotter_user_id);
  mysqli_stmt_execute($check_query);
  mysqli_stmt_store_result($check_query);
  $num_rows = mysqli_stmt_num_rows($check_query);

  if ($num_rows == 0) {
    $update_query = mysqli_query($con, "UPDATE tblblotter SET blotter_complainant_contact_num = '" . $txt_edit_blotter_complainant_contact_num . "', blotter_complainant_address = '" . $txt_edit_blotter_complainant_address . "', blotter_respondent_contact_num = '" . $txt_edit_blotter_respondent_contact_num . "', blotter_respondent_address = '" . $txt_edit_blotter_respondent_address . "', blotter_first_complaint = '" . $txt_edit_blotter_first_complaint . "', blotter_second_complaint = '" . $txt_edit_blotter_second_complaint . "', blotter_action_taken = '" . $txt_edit_blotter_action . "', blotter_status = '" . $txt_edit_blotter_status . "', blotter_location_of_incident = '" . $txt_edit_blotter_location . "', blotter_case_num = '" . $txt_edit_blotter_case_num . "', blotter_for = '" . $txt_edit_blotter_for . "', blotter_date_edited = '" . $txt_edit_blotter_date_edited . "', blotter_edited_by = '" . $txt_edit_blotter_edited_by . "'  WHERE id = '" . $txt_edit_blotter_user_id . "' ") or die('Error: ' . mysqli_error($con));

    if ($update_query) {
      $newDataQuery = mysqli_prepare($con, "SELECT b.*, r_complainant.id AS rid_complainant, CASE WHEN b.blotter_complainant REGEXP '^[0-9]+$' THEN (SELECT CONCAT(resident_fname, IF(resident_mname = 'n/a', '', CONCAT(' ', resident_mname)), ' ', resident_lname) FROM tblresident WHERE id = b.blotter_complainant) ELSE b.blotter_complainant END AS blotter_complainant_res_name, r_respondent.id AS rid_respondent, CASE WHEN b.blotter_respondent REGEXP '^[0-9]+$' THEN (SELECT CONCAT(resident_fname, IF(resident_mname = 'n/a', '', CONCAT(' ', resident_mname)), ' ', resident_lname) FROM tblresident WHERE id = b.blotter_respondent) ELSE b.blotter_respondent END AS blotter_respondent_res_name FROM tblblotter b LEFT JOIN tblresident r_complainant ON b.blotter_complainant = r_complainant.id LEFT JOIN tblresident r_respondent ON b.blotter_respondent = r_respondent.id WHERE b.id = ?");
      mysqli_stmt_bind_param($newDataQuery, "i", $txt_edit_blotter_user_id);
      mysqli_stmt_execute($newDataQuery);
      $newDataResult = mysqli_stmt_get_result($newDataQuery);
      $newData = mysqli_fetch_array($newDataResult, MYSQLI_ASSOC);
      mysqli_stmt_close($newDataQuery);

      if (isset($_SESSION['role'])) {
        $action = editedGenerateLogMessage($oldData, $newData);
        $log_query = mysqli_prepare($con, "INSERT INTO tbllogs (logs_user_type, logs_fname, logs_lname, logs_logdate, logs_action) VALUES (?, ?, ?, ?, ?)");
        mysqli_stmt_bind_param($log_query, "sssss", $txt_edit_blotter_user_type, $_SESSION['fname'], $_SESSION['lname'], $txt_edit_blotter_date_edited, $action);
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
  function deletedGenerateLogMessage($blotterData)
  {
    // data fetched
    $logMessage = "deleted blotter details before deletion...\n\n";
    $logMessage .= "id: " . $blotterData['id'] . "\n";
    $logMessage .= "blotter_complainant: " . $blotterData['complainant_name'] . "\n";
    $logMessage .= "blotter_complainant_age: " . $blotterData['blotter_complainant_age'] . "\n";
    $logMessage .= "blotter_complainant_contact_num: " . $blotterData['blotter_complainant_contact_num'] . "\n";
    $logMessage .= "blotter_complainant_address: " . $blotterData['blotter_complainant_address'] . "\n";
    $logMessage .= "blotter_respondent: " . $blotterData['respondent_name'] . "\n";
    $logMessage .= "blotter_respondent_age: " . $blotterData['blotter_respondent_age'] . "\n";
    $logMessage .= "blotter_respondent_contact_num: " . $blotterData['blotter_respondent_contact_num'] . "\n";
    $logMessage .= "blotter_respondent_address: " . $blotterData['blotter_respondent_address'] . "\n";
    $logMessage .= "blotter_first_complaint: " . $blotterData['blotter_first_complaint'] . "\n";
    $logMessage .= "blotter_second_complaint: " . $blotterData['blotter_second_complaint'] . "\n";
    $logMessage .= "blotter_action_taken: " . $blotterData['blotter_action_taken'] . "\n";
    $logMessage .= "blotter_status: " . $blotterData['blotter_status'] . "\n";
    $logMessage .= "blotter_location_of_incident: " . $blotterData['blotter_location_of_incident'] . "\n";
    $logMessage .= "blotter_case_num: " . $blotterData['blotter_case_num'] . "\n";
    $logMessage .= "blotter_for: " . $blotterData['blotter_for'] . "\n";
    $logMessage .= "blotter_date_added: " . $blotterData['blotter_date_added'] . "\n";
    $logMessage .= "blotter_date_edited: " . $blotterData['blotter_date_edited'] . "\n";
    $logMessage .= "blotter_added_by: " . $blotterData['blotter_added_by'] . "\n";
    $logMessage .= "blotter_edited_by: " . $blotterData['blotter_edited_by'] . "\n\n";

    // log session role
    $logMessage .= "this delete is done by " . $_SESSION['fname'] . (empty($_SESSION['mname']) || $_SESSION['mname'] === 'n/a' ? "" : " ") . (empty($_SESSION['mname']) || $_SESSION['mname'] === 'n/a' ? "" : $_SESSION['mname']) . " " . $_SESSION['lname'] . " as " . $_SESSION['role'] . "\n";
    $logMessage .= "delete blotter id number " . $blotterData['id'] . " for complainant " . $blotterData['complainant_name'] . "\n";
    $logMessage .= "date and time deleted " . date('m/d/Y h:i A') . "\n";
    return rtrim($logMessage, ",\n") . "\n";
  }
}

if (isset($_POST['btn_delete'])) {

  if (isset($_POST['chk_delete']) && is_array($_POST['chk_delete'])) {

    $txt_delete_blotter_date_deleted = date('m/d/Y h:i A');
    // validate and sanitize each selected ids
    $validIds = array_map('intval', $_POST['chk_delete']);
    // remove non-numeric values
    $validIds = array_filter($validIds, 'is_numeric');

    if (!empty($validIds)) {
      // fetch the data before deleted for logging
      $placeholders = implode(', ', array_fill(0, count($validIds), '?'));
      // fetch the data to be deleted
      $deletedDataQuery = mysqli_prepare($con, "SELECT b.*, r_complainant.id AS rid_complainant, CASE WHEN b.blotter_complainant REGEXP '^[0-9]+$' THEN (SELECT CONCAT(resident_fname, IF(resident_mname = 'n/a', '', CONCAT(' ', resident_mname)), ' ', resident_lname) FROM tblresident WHERE id = b.blotter_complainant) ELSE b.blotter_complainant END AS complainant_name, r_respondent.id AS rid_respondent, CASE WHEN b.blotter_respondent REGEXP '^[0-9]+$' THEN (SELECT CONCAT(resident_fname, IF(resident_mname = 'n/a', '', CONCAT(' ', resident_mname)), ' ', resident_lname) FROM tblresident WHERE id = b.blotter_respondent) ELSE b.blotter_respondent END AS respondent_name FROM tblblotter b LEFT JOIN tblresident r_complainant ON b.blotter_complainant = r_complainant.id LEFT JOIN tblresident r_respondent ON b.blotter_respondent = r_respondent.id WHERE b.id IN ($placeholders)");
      mysqli_stmt_bind_param($deletedDataQuery, str_repeat('i', count($validIds)), ...$validIds);
      mysqli_stmt_execute($deletedDataQuery);
      $deletedDataResult = mysqli_stmt_get_result($deletedDataQuery);

      // log each deleted record
      while ($deletedData = mysqli_fetch_array($deletedDataResult, MYSQLI_ASSOC)) {
        $action = deletedGenerateLogMessage($deletedData);
        $log_query = mysqli_prepare($con, "INSERT INTO tbllogs (logs_user_type, logs_fname, logs_lname, logs_logdate, logs_action) VALUES (?, ?, ?, ?, ?)");
        mysqli_stmt_bind_param($log_query, "sssss", $_SESSION['role'], $_SESSION['fname'], $_SESSION['lname'], $txt_delete_blotter_date_deleted, $action);
        mysqli_stmt_execute($log_query);
      }

      // prepare and execute the deletion query
      $delete_query = mysqli_prepare($con, "DELETE FROM tblblotter WHERE id IN ($placeholders)");

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