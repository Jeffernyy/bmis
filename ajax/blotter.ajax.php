<?php
include '../include/db.inc.php';

// start or resume the session
// session for this file is not secure
// i am using the default session for this since this is not a page
include '../include/session.inc.php';

// redirect to login page if session role is not set or not allowed
if (!isset($_SESSION['role']) || !in_array($_SESSION['role'], ["administrator", "staff"])) {
  header("Location: ../login.php");
  exit();
}

// initialize the response array
$response = array();

// add complainant
if (isset($_GET['complainantId']) && is_numeric($_GET['complainantId'])) {
  $complainantId = $_GET['complainantId'];

  $qry = mysqli_query($con, "SELECT resident_age FROM tblresident WHERE id = $complainantId");

  if ($row = mysqli_fetch_array($qry)) {
    $response['complainantAge'] = $row['resident_age'];
  } else {
    $response['complainantAge'] = "N/A";
  }
} else {
  $response['complainantAge'] = "Error executing query for complainant: " . mysqli_error($con);
}

// add respondent
if (isset($_GET['respondentId']) && is_numeric($_GET['respondentId'])) {
  $respondentId = $_GET['respondentId'];

  $qry = mysqli_query($con, "SELECT resident_age FROM tblresident WHERE id = $respondentId");

  if ($row = mysqli_fetch_array($qry)) {
    $response['respondentAge'] = $row['resident_age'];
  } else {
    $response['respondentAge'] = "N/A";
  }
} else {
  $response['respondentAge'] = "Error executing query for respondent: " . mysqli_error($con);
}

// close the database connection
$con->close();

// output the result as JSON
header('Content-Type: application/json');
echo json_encode($response);