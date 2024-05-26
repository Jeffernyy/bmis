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
  function addedGenerateLogMessage($residentData)
  {
    // household data fetched
    $logMessage = "added resident details...\n\n";
    $logMessage .= "id: " . $residentData['id'] . "\n";
    $logMessage .= "resident_fname: " . $residentData['resident_fname'] . "\n";
    $logMessage .= "resident_mname: " . $residentData['resident_mname'] . "\n";
    $logMessage .= "resident_lname: " . $residentData['resident_lname'] . "\n";
    $logMessage .= "resident_birth_date: " . $residentData['resident_birth_date'] . "\n";
    $logMessage .= "resident_age: " . $residentData['resident_age'] . "\n";
    $logMessage .= "resident_gender: " . $residentData['resident_gender'] . "\n";
    $logMessage .= "resident_household_num: " . $residentData['resident_household_num'] . "\n";
    $logMessage .= "resident_total_household_mem: " . $residentData['resident_total_household_mem'] . "\n";
    $logMessage .= "resident_civil_status: " . $residentData['resident_civil_status'] . "\n";
    $logMessage .= "resident_blood_type: " . $residentData['resident_blood_type'] . "\n";
    $logMessage .= "resident_renter: " . $residentData['resident_renter'] . "\n";
    $logMessage .= "resident_religion: " . $residentData['resident_religion'] . "\n";
    $logMessage .= "resident_nationality: " . $residentData['resident_nationality'] . "\n";
    $logMessage .= "resident_wra: " . $residentData['resident_wra'] . "\n";
    $logMessage .= "resident_educational_attainment: " . $residentData['resident_educational_attainment'] . "\n";
    $logMessage .= "resident_type_of_garbage_disposal: " . $residentData['resident_type_of_garbage_disposal'] . "\n";
    $logMessage .= "resident_interview_by: " . $residentData['resident_interview_by'] . "\n";
    $logMessage .= "resident_birth_place: " . $residentData['resident_birth_place'] . "\n";
    $logMessage .= "resident_purok: " . $residentData['resident_purok'] . "\n";
    $logMessage .= "resident_tribe: " . $residentData['resident_tribe'] . "\n";
    $logMessage .= "resident_ips: " . $residentData['resident_ips'] . "\n";
    $logMessage .= "resident_health_status: " . $residentData['resident_health_status'] . "\n";
    $logMessage .= "resident_length_of_stay: " . $residentData['resident_length_of_stay'] . "\n";
    $logMessage .= "resident_relationship_to_head: " . $residentData['resident_relationship_to_head'] . "\n";
    $logMessage .= "resident_occupation: " . $residentData['resident_occupation'] . "\n";
    $logMessage .= "resident_types_of_toilet: " . $residentData['resident_types_of_toilet'] . "\n";
    $logMessage .= "resident_sources_of_water_supply: " . $residentData['resident_sources_of_water_supply'] . "\n";
    $logMessage .= "resident_blind_drainage: " . $residentData['resident_blind_drainage'] . "\n";
    $logMessage .= "resident_mobile_num: " . $residentData['resident_mobile_num'] . "\n";
    $logMessage .= "resident_email_add: " . $residentData['resident_email_add'] . "\n";
    $logMessage .= "resident_uname: " . $residentData['resident_uname'] . "\n";
    $logMessage .= "resident_date_added: " . $residentData['resident_date_added'] . "\n";
    $logMessage .= "resident_date_edited: " . $residentData['resident_date_edited'] . "\n";
    $logMessage .= "resident_added_by: " . $residentData['resident_added_by'] . "\n";
    $logMessage .= "resident_edited_by: " . $residentData['resident_edited_by'] . "\n\n";

    // log session role
    $logMessage .= "this add is done by " . $_SESSION['fname'] . (empty($_SESSION['mname']) || $_SESSION['mname'] === 'n/a' ? "" : " ") . (empty($_SESSION['mname']) || $_SESSION['mname'] === 'n/a' ? "" : $_SESSION['mname']) . " " . $_SESSION['lname'] . " as " . $_SESSION['role'] . "\n";
    $logMessage .= "add resident id number " . $residentData['id'] . " for resident " . $residentData['resident_res_name'] . "\n";
    $logMessage .= "date and time added " . date('m/d/Y h:i A') . "\n";
    return rtrim($logMessage, ",\n") . "\n";
  }
}

if (isset($_POST['btn_add'])) {
  $txt_add_resident_lname = !empty($_POST['txt_add_resident_lname']) ? strtolower($_POST['txt_add_resident_lname']) : 'n/a';
  $txt_add_resident_fname = !empty($_POST['txt_add_resident_fname']) ? strtolower($_POST['txt_add_resident_fname']) : 'n/a';
  $txt_add_resident_mname = !empty($_POST['txt_add_resident_mname']) ? strtolower($_POST['txt_add_resident_mname']) : 'n/a';
  $txt_add_resident_birth_date = !empty($_POST['txt_add_resident_birth_date']) ? strtolower($_POST['txt_add_resident_birth_date']) : 'n/a';

  // validate the date format
  if (($txt_bd_handle_err = strtotime($txt_add_resident_birth_date)) === false) {
    // handle invalid date format
    $message = "You have enter an invalid birth date.";
    $_SESSION['warning'] = $message;
    header("location: " . $_SERVER['REQUEST_URI']);
    exit();
  }

  $dateOfBirth = date("Y-m-d", $txt_bd_handle_err);
  $today = date("Y-m-d");
  $diff = date_diff(date_create($dateOfBirth), date_create($today));
  $txt_age = $diff->format('%y');

  $txt_add_resident_gender = !empty($_POST['txt_add_resident_gender']) ? strtolower($_POST['txt_add_resident_gender']) : 'n/a';
  $txt_add_resident_household_num = !empty($_POST['txt_add_resident_household_num']) ? strtolower($_POST['txt_add_resident_household_num']) : 'n/a';
  $txt_add_resident_total_household_mem = !empty($_POST['txt_add_resident_total_household_mem']) ? strtolower($_POST['txt_add_resident_total_household_mem']) : 'n/a';
  $txt_add_resident_civil_stat = !empty($_POST['txt_add_resident_civil_stat']) ? strtolower($_POST['txt_add_resident_civil_stat']) : 'n/a';
  $txt_add_resident_blood_type = !empty($_POST['txt_add_resident_blood_type']) ? strtolower($_POST['txt_add_resident_blood_type']) : 'n/a';
  $txt_add_resident_renter = !empty($_POST['txt_add_resident_renter']) ? strtolower($_POST['txt_add_resident_renter']) : 'n/a';
  $txt_add_resident_religion = !empty($_POST['txt_add_resident_religion']) ? strtolower($_POST['txt_add_resident_religion']) : 'n/a';
  $txt_add_resident_nationality = !empty($_POST['txt_add_resident_nationality']) ? strtolower($_POST['txt_add_resident_nationality']) : 'n/a';
  $txt_add_resident_wra = !empty($_POST['txt_add_resident_wra']) ? strtolower($_POST['txt_add_resident_wra']) : 'n/a';
  $txt_add_resident_educational_attain = !empty($_POST['txt_add_resident_educational_attain']) ? strtolower($_POST['txt_add_resident_educational_attain']) : 'n/a';
  $txt_add_resident_type_of_garbage_dispos = !empty($_POST['txt_add_resident_type_of_garbage_dispos']) ? strtolower($_POST['txt_add_resident_type_of_garbage_dispos']) : 'n/a';
  $txt_add_resident_interview_by = !empty($_POST['txt_add_resident_interview_by']) ? strtolower($_POST['txt_add_resident_interview_by']) : 'n/a';
  $txt_add_resident_email_add = !empty($_POST['txt_add_resident_email_add']) ? strtolower($_POST['txt_add_resident_email_add']) : 'n/a';
  $txt_add_resident_uname = !empty($_POST['txt_add_resident_uname']) ? strtolower($_POST['txt_add_resident_uname']) : 'n/a';
  $txt_add_resident_birt_place = !empty($_POST['txt_add_resident_birt_place']) ? strtolower($_POST['txt_add_resident_birt_place']) : 'n/a';
  $txt_add_resident_purok = !empty($_POST['txt_add_resident_purok']) ? strtolower($_POST['txt_add_resident_purok']) : 'n/a';
  $txt_add_resident_tribe = !empty($_POST['txt_add_resident_tribe']) ? strtolower($_POST['txt_add_resident_tribe']) : 'n/a';
  $txt_add_resident_ips = !empty($_POST['txt_add_resident_ips']) ? strtolower($_POST['txt_add_resident_ips']) : 'n/a';
  $txt_add_resident_health_stat = !empty($_POST['txt_add_resident_health_stat']) ? strtolower($_POST['txt_add_resident_health_stat']) : 'n/a';
  $txt_add_resident_length_of_stay = !empty($_POST['txt_add_resident_length_of_stay']) ? strtolower($_POST['txt_add_resident_length_of_stay']) : 'n/a';
  $txt_add_resident_relationship_to_head = !empty($_POST['txt_add_resident_relationship_to_head']) ? strtolower($_POST['txt_add_resident_relationship_to_head']) : 'n/a';
  $txt_add_resident_occupation = !empty($_POST['txt_add_resident_occupation']) ? strtolower($_POST['txt_add_resident_occupation']) : 'n/a';
  $txt_add_resident_sources_of_water_supp = isset($_POST['txt_add_resident_sources_of_water_supp']) && is_array($_POST['txt_add_resident_sources_of_water_supp']) ? implode(', ', $_POST['txt_add_resident_sources_of_water_supp']) : 'n/a';
  $txt_add_resident_types_of_toilet = !empty($_POST['txt_add_resident_types_of_toilet']) ? strtolower($_POST['txt_add_resident_types_of_toilet']) : 'n/a';
  $txt_add_resident_blind_drainage = !empty($_POST['txt_add_resident_blind_drainage']) ? strtolower($_POST['txt_add_resident_blind_drainage']) : 'n/a';
  $txt_add_resident_mobile_num = !empty($_POST['txt_add_resident_mobile_num']) ? $_POST['txt_add_resident_mobile_num'] : 'n/a';
  $txt_add_resident_upass = !empty($_POST['txt_add_resident_upass']) ? $_POST['txt_add_resident_upass'] : 'n/a';

  $txt_add_resident_date_added = date('m/d/Y h:i A');
  $txt_add_resident_added_by = $_SESSION['fname'] . (empty($_SESSION['mname']) || $_SESSION['mname'] === 'n/a' ? '' : ' ') . (empty($_SESSION['mname']) || $_SESSION['mname'] === 'n/a' ? '' : $_SESSION['mname']) . ' ' . $_SESSION['lname'] . ' as ' . $_SESSION['role'];
  $txt_add_resident_user_type = $_SESSION['role'];

  $name = basename($_FILES['txt_add_resident_image']['name']);
  $temp = $_FILES['txt_add_resident_image']['tmp_name'];
  $imagetype = $_FILES['txt_add_resident_image']['type'];
  $size = $_FILES['txt_add_resident_image']['size'];

  $milliseconds = round(microtime(true) * 1000);
  $image = $milliseconds . '_' . $name;

  // hash the password using PASSWORD_DEFAULT
  $txt_add_resident_hashed_pass = password_hash($txt_add_resident_upass, PASSWORD_DEFAULT);
  $txt_add_resident_hashed_secret_key = bin2hex(random_bytes(16));

  $stmt = mysqli_prepare($con, "SELECT resident_uname FROM tblresident WHERE resident_uname = ?");
  mysqli_stmt_bind_param($stmt, 's', $txt_add_resident_uname);
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
            $txt_add_resident_image = $image;

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
      $txt_add_resident_image = 'default.png';
    }

    $query = mysqli_prepare($con, "INSERT INTO tblresident (resident_lname, resident_fname, resident_mname, resident_birth_date, resident_age, resident_gender, resident_household_num, resident_total_household_mem, resident_civil_status, resident_blood_type, resident_renter, resident_religion, resident_nationality, resident_wra, resident_educational_attainment, resident_type_of_garbage_disposal, resident_interview_by, resident_birth_place, resident_purok, resident_tribe, resident_ips, resident_health_status, resident_length_of_stay, resident_relationship_to_head, resident_occupation, resident_types_of_toilet, resident_sources_of_water_supply, resident_blind_drainage, resident_email_add, resident_uname, resident_mobile_num, resident_upass, resident_secret_key, resident_image, resident_date_added, resident_date_edited, resident_added_by, resident_edited_by) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, 'n/a', ?, 'n/a')");
    mysqli_stmt_bind_param($query, 'ssssssssssssssssssssssssssssssssssss', $txt_add_resident_lname, $txt_add_resident_fname, $txt_add_resident_mname, $txt_add_resident_birth_date, $txt_age, $txt_add_resident_gender, $txt_add_resident_household_num, $txt_add_resident_total_household_mem, $txt_add_resident_civil_stat, $txt_add_resident_blood_type, $txt_add_resident_renter, $txt_add_resident_religion, $txt_add_resident_nationality, $txt_add_resident_wra, $txt_add_resident_educational_attain, $txt_add_resident_type_of_garbage_dispos, $txt_add_resident_interview_by, $txt_add_resident_birt_place, $txt_add_resident_purok, $txt_add_resident_tribe, $txt_add_resident_ips, $txt_add_resident_health_stat, $txt_add_resident_length_of_stay, $txt_add_resident_relationship_to_head, $txt_add_resident_occupation, $txt_add_resident_types_of_toilet, $txt_add_resident_sources_of_water_supp, $txt_add_resident_blind_drainage, $txt_add_resident_email_add, $txt_add_resident_uname, $txt_add_resident_mobile_num, $txt_add_resident_hashed_pass, $txt_add_resident_hashed_secret_key, $txt_add_resident_image, $txt_add_resident_date_added, $txt_add_resident_added_by);
    mysqli_stmt_execute($query);

    if (mysqli_stmt_affected_rows($query) > 0) {
      // fetch the last inserted household record
      $lastInsertedId = mysqli_insert_id($con);

      // fetch new data after the update
      $residentDataQuery = mysqli_prepare($con, "SELECT *,CONCAT(resident_fname, IF(resident_mname = 'n/a', '', CONCAT(' ', resident_mname)), ' ', resident_lname) as resident_res_name FROM tblresident WHERE id = ?");
      mysqli_stmt_bind_param($residentDataQuery, "i", $lastInsertedId);
      mysqli_stmt_execute($residentDataQuery);
      $residentDataQueryResult = mysqli_stmt_get_result($residentDataQuery);
      $residentData = mysqli_fetch_array($residentDataQueryResult, MYSQLI_ASSOC);
      mysqli_stmt_close($residentDataQuery);

      if (isset($_SESSION['role'])) {
        // log the old and new data
        $action = addedGenerateLogMessage($residentData);
        $log_query = mysqli_prepare($con, "INSERT INTO tbllogs (logs_user_type, logs_fname, logs_lname, logs_logdate, logs_action) VALUES (?, ?, ?, ?, ?)");
        mysqli_stmt_bind_param($log_query, "sssss", $txt_add_resident_user_type, $_SESSION['fname'], $_SESSION['lname'], $txt_add_resident_date_added, $action);
        mysqli_stmt_execute($log_query);
      }

      // send sms notification with the secret key
      try {
        // infobip config
        $configuration = new Configuration(host: getenv('INFOBIP_BASE_URL'), apiKey: getenv('INFOBIP_API_KEY'));
        $sendSmsApi = new SmsApi(config: $configuration);
        $destination = new SmsDestination(to: $txt_add_resident_mobile_num);

        $message = "Congrats! " . ucwords(strtolower($txt_add_resident_fname)) . ($txt_add_resident_mname === 'n/a' ? '' : " " . ucwords(strtolower($txt_add_resident_mname))) . " " . ucwords(strtolower($txt_add_resident_lname)) . ". Your account has been successfully created.\n\nHere's your secret key: $txt_add_resident_hashed_secret_key\n\nPlease, keep it safe for future use. You'll need the secret key if you want to change your password. Blee!";

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
if (!function_exists('editedGenerateLogMessage')) {
  function editedGenerateLogMessage($oldData, $newData)
  {
    // old data fetched
    $logMessage = "edited resident details...\n\n";
    $logMessage .= "old data:\n";
    $logMessage .= "id: " . $oldData['id'] . "\n";
    $logMessage .= "resident_fname: " . $oldData['resident_fname'] . "\n";
    $logMessage .= "resident_mname: " . $oldData['resident_mname'] . "\n";
    $logMessage .= "resident_lname: " . $oldData['resident_lname'] . "\n";
    $logMessage .= "resident_birth_date: " . $oldData['resident_birth_date'] . "\n";
    $logMessage .= "resident_age: " . $oldData['resident_age'] . "\n";
    $logMessage .= "resident_gender: " . $oldData['resident_gender'] . "\n";
    $logMessage .= "resident_household_num: " . $oldData['resident_household_num'] . "\n";
    $logMessage .= "resident_total_household_mem: " . $oldData['resident_total_household_mem'] . "\n";
    $logMessage .= "resident_civil_status: " . $oldData['resident_civil_status'] . "\n";
    $logMessage .= "resident_blood_type: " . $oldData['resident_blood_type'] . "\n";
    $logMessage .= "resident_renter: " . $oldData['resident_renter'] . "\n";
    $logMessage .= "resident_religion: " . $oldData['resident_religion'] . "\n";
    $logMessage .= "resident_nationality: " . $oldData['resident_nationality'] . "\n";
    $logMessage .= "resident_wra: " . $oldData['resident_wra'] . "\n";
    $logMessage .= "resident_educational_attainment: " . $oldData['resident_educational_attainment'] . "\n";
    $logMessage .= "resident_type_of_garbage_disposal: " . $oldData['resident_type_of_garbage_disposal'] . "\n";
    $logMessage .= "resident_interview_by: " . $oldData['resident_interview_by'] . "\n";
    $logMessage .= "resident_birth_place: " . $oldData['resident_birth_place'] . "\n";
    $logMessage .= "resident_purok: " . $oldData['resident_purok'] . "\n";
    $logMessage .= "resident_tribe: " . $oldData['resident_tribe'] . "\n";
    $logMessage .= "resident_ips: " . $oldData['resident_ips'] . "\n";
    $logMessage .= "resident_health_status: " . $oldData['resident_health_status'] . "\n";
    $logMessage .= "resident_length_of_stay: " . $oldData['resident_length_of_stay'] . "\n";
    $logMessage .= "resident_relationship_to_head: " . $oldData['resident_relationship_to_head'] . "\n";
    $logMessage .= "resident_occupation: " . $oldData['resident_occupation'] . "\n";
    $logMessage .= "resident_types_of_toilet: " . $oldData['resident_types_of_toilet'] . "\n";
    $logMessage .= "resident_sources_of_water_supply: " . $oldData['resident_sources_of_water_supply'] . "\n";
    $logMessage .= "resident_blind_drainage: " . $oldData['resident_blind_drainage'] . "\n";
    $logMessage .= "resident_mobile_num: " . $oldData['resident_mobile_num'] . "\n";
    $logMessage .= "resident_email_add: " . $oldData['resident_email_add'] . "\n";
    $logMessage .= "resident_uname: " . $oldData['resident_uname'] . "\n";
    $logMessage .= "resident_date_added: " . $oldData['resident_date_added'] . "\n";
    $logMessage .= "resident_date_edited: " . $oldData['resident_date_edited'] . "\n";
    $logMessage .= "resident_added_by: " . $oldData['resident_added_by'] . "\n";
    $logMessage .= "resident_edited_by: " . $oldData['resident_edited_by'] . "\n\n";

    // new data fetched
    $logMessage .= "new data:\n";
    $logMessage .= "id: " . $newData['id'] . "\n";
    $logMessage .= "resident_fname: " . $newData['resident_fname'] . "\n";
    $logMessage .= "resident_mname: " . $newData['resident_mname'] . "\n";
    $logMessage .= "resident_lname: " . $newData['resident_lname'] . "\n";
    $logMessage .= "resident_birth_date: " . $newData['resident_birth_date'] . "\n";
    $logMessage .= "resident_age: " . $newData['resident_age'] . "\n";
    $logMessage .= "resident_gender: " . $newData['resident_gender'] . "\n";
    $logMessage .= "resident_household_num: " . $newData['resident_household_num'] . "\n";
    $logMessage .= "resident_total_household_mem: " . $newData['resident_total_household_mem'] . "\n";
    $logMessage .= "resident_civil_status: " . $newData['resident_civil_status'] . "\n";
    $logMessage .= "resident_blood_type: " . $newData['resident_blood_type'] . "\n";
    $logMessage .= "resident_renter: " . $newData['resident_renter'] . "\n";
    $logMessage .= "resident_religion: " . $newData['resident_religion'] . "\n";
    $logMessage .= "resident_nationality: " . $newData['resident_nationality'] . "\n";
    $logMessage .= "resident_wra: " . $newData['resident_wra'] . "\n";
    $logMessage .= "resident_educational_attainment: " . $newData['resident_educational_attainment'] . "\n";
    $logMessage .= "resident_type_of_garbage_disposal: " . $newData['resident_type_of_garbage_disposal'] . "\n";
    $logMessage .= "resident_interview_by: " . $newData['resident_interview_by'] . "\n";
    $logMessage .= "resident_birth_place: " . $newData['resident_birth_place'] . "\n";
    $logMessage .= "resident_purok: " . $newData['resident_purok'] . "\n";
    $logMessage .= "resident_tribe: " . $newData['resident_tribe'] . "\n";
    $logMessage .= "resident_ips: " . $newData['resident_ips'] . "\n";
    $logMessage .= "resident_health_status: " . $newData['resident_health_status'] . "\n";
    $logMessage .= "resident_length_of_stay: " . $newData['resident_length_of_stay'] . "\n";
    $logMessage .= "resident_relationship_to_head: " . $newData['resident_relationship_to_head'] . "\n";
    $logMessage .= "resident_occupation: " . $newData['resident_occupation'] . "\n";
    $logMessage .= "resident_types_of_toilet: " . $newData['resident_types_of_toilet'] . "\n";
    $logMessage .= "resident_sources_of_water_supply: " . $newData['resident_sources_of_water_supply'] . "\n";
    $logMessage .= "resident_blind_drainage: " . $newData['resident_blind_drainage'] . "\n";
    $logMessage .= "resident_mobile_num: " . $newData['resident_mobile_num'] . "\n";
    $logMessage .= "resident_email_add: " . $newData['resident_email_add'] . "\n";
    $logMessage .= "resident_uname: " . $newData['resident_uname'] . "\n";
    $logMessage .= "resident_date_added: " . $newData['resident_date_added'] . "\n";
    $logMessage .= "resident_date_edited: " . $newData['resident_date_edited'] . "\n";
    $logMessage .= "resident_added_by: " . $newData['resident_added_by'] . "\n";
    $logMessage .= "resident_edited_by: " . $newData['resident_edited_by'] . "\n\n";

    // log session role
    $logMessage .= "this edit is done by " . $_SESSION['fname'] . (empty($_SESSION['mname']) || $_SESSION['mname'] === 'n/a' ? "" : " ") . (empty($_SESSION['mname']) || $_SESSION['mname'] === 'n/a' ? "" : $_SESSION['mname']) . " " . $_SESSION['lname'] . " as " . $_SESSION['role'] . "\n";
    $logMessage .= "edit resident id number " . $newData['id'] . " for resident " . $newData['resident_res_name'] . "\n";
    $logMessage .= "date and time edited " . date('m/d/Y h:i A') . "\n";
    return rtrim($logMessage, ",\n") . "\n";
  }
}

if (isset($_POST['btn_edit'])) {
  $txt_edit_resident_user_id = $_POST['hidden_id'];

  // fetch old data before the update using prepared statement
  $oldDataQuery = mysqli_prepare($con, "SELECT *,CONCAT(resident_fname, IF(resident_mname = 'n/a', '', CONCAT(' ', resident_mname)), ' ', resident_lname) as resident_res_name FROM tblresident WHERE id = ?");
  mysqli_stmt_bind_param($oldDataQuery, "i", $txt_edit_resident_user_id);
  mysqli_stmt_execute($oldDataQuery);
  $oldDataResult = mysqli_stmt_get_result($oldDataQuery);
  $oldData = mysqli_fetch_array($oldDataResult, MYSQLI_ASSOC);
  mysqli_stmt_close($oldDataQuery);

  $txt_edit_resident_lname = !empty($_POST['txt_edit_resident_lname']) ? strtolower($_POST['txt_edit_resident_lname']) : 'n/a';
  $txt_edit_resident_fname = !empty($_POST['txt_edit_resident_fname']) ? strtolower($_POST['txt_edit_resident_fname']) : 'n/a';
  $txt_edit_resident_mname = !empty($_POST['txt_edit_resident_mname']) ? strtolower($_POST['txt_edit_resident_mname']) : 'n/a';

  $txt_edit_resident_birth_date = !empty($_POST['txt_edit_resident_birth_date']) ? strtolower($_POST['txt_edit_resident_birth_date']) : 'n/a';
  $dateOfBirth = $txt_edit_resident_birth_date;
  $today = date("Y-m-d");
  $diff = date_diff(date_create($dateOfBirth), date_create($today));
  $txt_edit_resident_age = $diff->format('%y');

  $txt_edit_resident_gender = !empty($_POST['txt_edit_resident_gender']) ? strtolower($_POST['txt_edit_resident_gender']) : 'n/a';
  $txt_edit_resident_household_num = !empty($_POST['txt_edit_resident_household_num']) ? strtolower($_POST['txt_edit_resident_household_num']) : 'n/a';
  $txt_edit_resident_total_household_mem = !empty($_POST['txt_edit_resident_total_household_mem']) ? strtolower($_POST['txt_edit_resident_total_household_mem']) : 'n/a';
  $txt_edit_resident_civil_stat = !empty($_POST['txt_edit_resident_civil_stat']) ? strtolower($_POST['txt_edit_resident_civil_stat']) : 'n/a';
  $txt_edit_resident_blood_type = !empty($_POST['txt_edit_resident_blood_type']) ? strtolower($_POST['txt_edit_resident_blood_type']) : 'n/a';
  $txt_edit_resident_renter = !empty($_POST['txt_edit_resident_renter']) ? strtolower($_POST['txt_edit_resident_renter']) : 'n/a';
  $txt_edit_resident_religion = !empty($_POST['txt_edit_resident_religion']) ? strtolower($_POST['txt_edit_resident_religion']) : 'n/a';
  $txt_edit_resident_nationality = !empty($_POST['txt_edit_resident_nationality']) ? strtolower($_POST['txt_edit_resident_nationality']) : 'n/a';
  $txt_edit_resident_wra = !empty($_POST['txt_edit_resident_wra']) ? strtolower($_POST['txt_edit_resident_wra']) : 'n/a';
  $txt_edit_resident_educational_attain = !empty($_POST['txt_edit_resident_educational_attain']) ? strtolower($_POST['txt_edit_resident_educational_attain']) : 'n/a';
  $txt_edit_resident_type_of_garbage_dispos = !empty($_POST['txt_edit_resident_type_of_garbage_dispos']) ? strtolower($_POST['txt_edit_resident_type_of_garbage_dispos']) : 'n/a';
  $txt_edit_resident_interview_by = !empty($_POST['txt_edit_resident_interview_by']) ? strtolower($_POST['txt_edit_resident_interview_by']) : 'n/a';
  $txt_edit_resident_email_add = !empty($_POST['txt_edit_resident_email_add']) ? strtolower($_POST['txt_edit_resident_email_add']) : 'n/a';
  $txt_edit_resident_birt_place = !empty($_POST['txt_edit_resident_birt_place']) ? strtolower($_POST['txt_edit_resident_birt_place']) : 'n/a';
  $txt_edit_resident_purok = !empty($_POST['txt_edit_resident_purok']) ? strtolower($_POST['txt_edit_resident_purok']) : 'n/a';
  $txt_edit_resident_tribe = !empty($_POST['txt_edit_resident_tribe']) ? strtolower($_POST['txt_edit_resident_tribe']) : 'n/a';
  $txt_edit_resident_ips = !empty($_POST['txt_edit_resident_ips']) ? strtolower($_POST['txt_edit_resident_ips']) : 'n/a';
  $txt_edit_resident_health_stat = !empty($_POST['txt_edit_resident_health_stat']) ? strtolower($_POST['txt_edit_resident_health_stat']) : 'n/a';
  $txt_edit_resident_length_of_stay = !empty($_POST['txt_edit_resident_length_of_stay']) ? strtolower($_POST['txt_edit_resident_length_of_stay']) : 'n/a';
  $txt_edit_resident_relationship_to_head = !empty($_POST['txt_edit_resident_relationship_to_head']) ? strtolower($_POST['txt_edit_resident_relationship_to_head']) : 'n/a';
  $txt_edit_resident_occupation = !empty($_POST['txt_edit_resident_occupation']) ? strtolower($_POST['txt_edit_resident_occupation']) : 'n/a';
  $txt_edit_resident_sources_of_water_supp = isset($_POST['txt_edit_resident_sources_of_water_supp']) && is_array($_POST['txt_edit_resident_sources_of_water_supp']) ? implode(', ', $_POST['txt_edit_resident_sources_of_water_supp']) : 'n/a';
  $txt_edit_resident_types_of_toilet = !empty($_POST['txt_edit_resident_types_of_toilet']) ? strtolower($_POST['txt_edit_resident_types_of_toilet']) : 'n/a';
  $txt_edit_resident_blind_drainage = !empty($_POST['txt_edit_resident_blind_drainage']) ? strtolower($_POST['txt_edit_resident_blind_drainage']) : 'n/a';
  $txt_edit_resident_mobile_num = !empty($_POST['txt_edit_resident_mobile_num']) ? strtolower($_POST['txt_edit_resident_mobile_num']) : 'n/a';

  // Check if username or password is modified
  $chk_credentials = mysqli_query($con, "SELECT resident_uname, resident_upass FROM tblresident WHERE id = '" . $txt_edit_resident_user_id . "'");
  $row_credentials = mysqli_fetch_array($chk_credentials);
  // If username or password is not modified, use the existing values
  $txt_edit_resident_uname = !empty($_POST['txt_edit_resident_uname']) ? strtolower($_POST['txt_edit_resident_uname']) : $row_credentials['resident_uname'];
  $txt_edit_resident_upass = !empty($_POST['txt_edit_resident_upass']) ? $_POST['txt_edit_resident_upass'] : $row_credentials['resident_upass'];
  // Hash the password only if it is modified
  $txt_edit_resident_hashed_upass = !empty($_POST['txt_edit_resident_upass']) ? password_hash($txt_edit_resident_upass, PASSWORD_DEFAULT) : $row_credentials['resident_upass'];

  $txt_edit_resident_date_edited = date('m/d/Y h:i A');
  $txt_edit_resident_edited_by = $_SESSION['fname'] . (empty($_SESSION['mname']) || $_SESSION['mname'] === 'n/a' ? '' : ' ') . (empty($_SESSION['mname']) || $_SESSION['mname'] === 'n/a' ? '' : $_SESSION['mname']) . ' ' . $_SESSION['lname'] . ' as ' . $_SESSION['role'];
  $txt_edit_resident_user_type = $_SESSION['role'];

  $name = basename($_FILES['txt_edit_resident_image']['name']);
  $temp = $_FILES['txt_edit_resident_image']['tmp_name'];
  $imagetype = $_FILES['txt_edit_resident_image']['type'];
  $size = $_FILES['txt_edit_resident_image']['size'];

  $milliseconds = round(microtime(true) * 1000);
  $image = $milliseconds . '_' . $name;

  // check if the username already exists after edited
  // planning to use email instead of using local username because email is more unique and secure for users
  $stmt = mysqli_prepare($con, "SELECT resident_uname FROM tblresident WHERE resident_uname = ? AND id <> ?");
  mysqli_stmt_bind_param($stmt, 'si', $txt_edit_resident_uname, $txt_edit_resident_user_id);
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
            $txt_edit_resident_image = $image;
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
      $chk_image = mysqli_query($con, "SELECT * FROM tblresident WHERE id = '" . $_POST['hidden_id'] . "'");
      $rowimg = mysqli_fetch_array($chk_image);
      $txt_edit_resident_image = $rowimg['resident_image'];
    }

    $update_query = mysqli_query($con, "UPDATE tblresident SET resident_lname = '" . $txt_edit_resident_lname . "', resident_fname = '" . $txt_edit_resident_fname . "', resident_mname = '" . $txt_edit_resident_mname . "', resident_birth_date = '" . $txt_edit_resident_birth_date . "', resident_age = '" . $txt_edit_resident_age . "', resident_gender = '" . $txt_edit_resident_gender . "', resident_household_num = '" . $txt_edit_resident_household_num . "', resident_total_household_mem = '" . $txt_edit_resident_total_household_mem . "', resident_civil_status = '" . $txt_edit_resident_civil_stat . "', resident_blood_type = '" . $txt_edit_resident_blood_type . "', resident_renter = '" . $txt_edit_resident_renter . "', resident_religion = '" . $txt_edit_resident_religion . "', resident_nationality = '" . $txt_edit_resident_nationality . "', resident_wra = '" . $txt_edit_resident_wra . "', resident_educational_attainment = '" . $txt_edit_resident_educational_attain . "', resident_type_of_garbage_disposal = '" . $txt_edit_resident_type_of_garbage_dispos . "', resident_interview_by = '" . $txt_edit_resident_interview_by . "', resident_birth_place = '" . $txt_edit_resident_birt_place . "', resident_purok = '" . $txt_edit_resident_purok . "', resident_tribe = '" . $txt_edit_resident_tribe . "', resident_ips = '" . $txt_edit_resident_ips . "', resident_health_status = '" . $txt_edit_resident_health_stat . "', resident_length_of_stay = '" . $txt_edit_resident_length_of_stay . "', resident_relationship_to_head = '" . $txt_edit_resident_relationship_to_head . "', resident_occupation = '" . $txt_edit_resident_occupation . "', resident_types_of_toilet = '" . $txt_edit_resident_types_of_toilet . "', resident_sources_of_water_supply = '" . $txt_edit_resident_sources_of_water_supp . "', resident_blind_drainage = '" . $txt_edit_resident_blind_drainage . "', resident_email_add = '" . $txt_edit_resident_email_add . "', resident_uname = '" . $txt_edit_resident_uname . "', resident_mobile_num = '" . $txt_edit_resident_mobile_num . "', resident_upass = '" . $txt_edit_resident_hashed_upass . "', resident_image = '" . $txt_edit_resident_image . "', resident_date_edited = '" . $txt_edit_resident_date_edited . "', resident_edited_by = '" . $txt_edit_resident_edited_by . "' WHERE id = '" . $txt_edit_resident_user_id . "'") or die('Error: ' . mysqli_error($con));

    if ($update_query == true) {
      // fetch new data after the update
      $newDataQuery = mysqli_prepare($con, "SELECT *,CONCAT(resident_fname, IF(resident_mname = 'n/a', '', CONCAT(' ', resident_mname)), ' ', resident_lname) as resident_res_name FROM tblresident WHERE id = ?");
      mysqli_stmt_bind_param($newDataQuery, "i", $txt_edit_resident_user_id);
      mysqli_stmt_execute($newDataQuery);
      $newDataResult = mysqli_stmt_get_result($newDataQuery);
      $newData = mysqli_fetch_array($newDataResult, MYSQLI_ASSOC);
      mysqli_stmt_close($newDataQuery);

      if (isset($_SESSION['role'])) {
        // log the old and new data
        $action = editedGenerateLogMessage($oldData, $newData);
        $log_query = mysqli_prepare($con, "INSERT INTO tbllogs (logs_user_type, logs_fname, logs_lname, logs_logdate, logs_action) VALUES (?, ?, ?, ?, ?)");
        mysqli_stmt_bind_param($log_query, "sssss", $txt_edit_resident_user_type, $_SESSION['fname'], $_SESSION['lname'], $txt_edit_resident_date_edited, $action);
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
  function deletedGenerateLogMessage($residentData)
  {
    // data fetched
    $logMessage = "deleted resident details before deletion...\n\n";
    $logMessage .= "id: " . $residentData['id'] . "\n";
    $logMessage .= "resident_fname: " . $residentData['resident_fname'] . "\n";
    $logMessage .= "resident_mname: " . $residentData['resident_mname'] . "\n";
    $logMessage .= "resident_lname: " . $residentData['resident_lname'] . "\n";
    $logMessage .= "resident_birth_date: " . $residentData['resident_birth_date'] . "\n";
    $logMessage .= "resident_age: " . $residentData['resident_age'] . "\n";
    $logMessage .= "resident_gender: " . $residentData['resident_gender'] . "\n";
    $logMessage .= "resident_household_num: " . $residentData['resident_household_num'] . "\n";
    $logMessage .= "resident_total_household_mem: " . $residentData['resident_total_household_mem'] . "\n";
    $logMessage .= "resident_civil_status: " . $residentData['resident_civil_status'] . "\n";
    $logMessage .= "resident_blood_type: " . $residentData['resident_blood_type'] . "\n";
    $logMessage .= "resident_renter: " . $residentData['resident_renter'] . "\n";
    $logMessage .= "resident_religion: " . $residentData['resident_religion'] . "\n";
    $logMessage .= "resident_nationality: " . $residentData['resident_nationality'] . "\n";
    $logMessage .= "resident_wra: " . $residentData['resident_wra'] . "\n";
    $logMessage .= "resident_educational_attainment: " . $residentData['resident_educational_attainment'] . "\n";
    $logMessage .= "resident_type_of_garbage_disposal: " . $residentData['resident_type_of_garbage_disposal'] . "\n";
    $logMessage .= "resident_interview_by: " . $residentData['resident_interview_by'] . "\n";
    $logMessage .= "resident_birth_place: " . $residentData['resident_birth_place'] . "\n";
    $logMessage .= "resident_purok: " . $residentData['resident_purok'] . "\n";
    $logMessage .= "resident_tribe: " . $residentData['resident_tribe'] . "\n";
    $logMessage .= "resident_ips: " . $residentData['resident_ips'] . "\n";
    $logMessage .= "resident_health_status: " . $residentData['resident_health_status'] . "\n";
    $logMessage .= "resident_length_of_stay: " . $residentData['resident_length_of_stay'] . "\n";
    $logMessage .= "resident_relationship_to_head: " . $residentData['resident_relationship_to_head'] . "\n";
    $logMessage .= "resident_occupation: " . $residentData['resident_occupation'] . "\n";
    $logMessage .= "resident_types_of_toilet: " . $residentData['resident_types_of_toilet'] . "\n";
    $logMessage .= "resident_sources_of_water_supply: " . $residentData['resident_sources_of_water_supply'] . "\n";
    $logMessage .= "resident_blind_drainage: " . $residentData['resident_blind_drainage'] . "\n";
    $logMessage .= "resident_mobile_num: " . $residentData['resident_mobile_num'] . "\n";
    $logMessage .= "resident_email_add: " . $residentData['resident_email_add'] . "\n";
    $logMessage .= "resident_uname: " . $residentData['resident_uname'] . "\n";
    $logMessage .= "resident_date_added: " . $residentData['resident_date_added'] . "\n";
    $logMessage .= "resident_date_edited: " . $residentData['resident_date_edited'] . "\n";
    $logMessage .= "resident_added_by: " . $residentData['resident_added_by'] . "\n";
    $logMessage .= "resident_edited_by: " . $residentData['resident_edited_by'] . "\n\n";

    // log session role
    $logMessage .= "this delete is done by " . $_SESSION['fname'] . (empty($_SESSION['mname']) || $_SESSION['mname'] === 'n/a' ? "" : " ") . (empty($_SESSION['mname']) || $_SESSION['mname'] === 'n/a' ? "" : $_SESSION['mname']) . " " . $_SESSION['lname'] . " as " . $_SESSION['role'] . "\n";
    $logMessage .= "delete resident id number " . $residentData['id'] . " for resident " . $residentData['resident_res_name'] . "\n";
    $logMessage .= "date and time deleted " . date('m/d/Y h:i A') . "\n";
    return rtrim($logMessage, ",\n") . "\n";
  }
}

if (isset($_POST['btn_delete'])) {

  if (isset($_POST['chk_delete']) && is_array($_POST['chk_delete'])) {

    $txt_delete_resident_date_deleted = date('m/d/Y h:i A');
    // validate and sanitize each selected ids
    $validIds = array_map('intval', $_POST['chk_delete']);
    // remove non-numeric values
    $validIds = array_filter($validIds, 'is_numeric');

    if (!empty($validIds)) {
      // fetch the data before deleted for logging
      $placeholders = implode(', ', array_fill(0, count($validIds), '?'));

      // fetch the data to be deleted
      $deletedDataQuery = mysqli_prepare($con, "SELECT *, CONCAT(resident_fname, IF(resident_mname = 'n/a', '', CONCAT(' ', resident_mname)), ' ', resident_lname) as resident_res_name FROM tblresident WHERE id IN ($placeholders)");
      mysqli_stmt_bind_param($deletedDataQuery, str_repeat('i', count($validIds)), ...$validIds);
      mysqli_stmt_execute($deletedDataQuery);
      $deletedDataResult = mysqli_stmt_get_result($deletedDataQuery);

      // log each deleted record
      while ($deletedData = mysqli_fetch_array($deletedDataResult, MYSQLI_ASSOC)) {
        $action = deletedGenerateLogMessage($deletedData);
        $log_query = mysqli_prepare($con, "INSERT INTO tbllogs (logs_user_type, logs_fname, logs_lname, logs_logdate, logs_action) VALUES (?, ?, ?, ?, ?)");
        mysqli_stmt_bind_param($log_query, "sssss", $_SESSION['role'], $_SESSION['fname'], $_SESSION['lname'], $txt_delete_resident_date_deleted, $action);
        mysqli_stmt_execute($log_query);
      }

      // prepare and execute the deletion query
      $delete_query = mysqli_prepare($con, "DELETE FROM tblresident WHERE id IN ($placeholders)");

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