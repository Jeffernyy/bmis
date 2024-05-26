<?php
include '../include/db.inc.php';

// start or resume the session
// session for this file is not secure
// i am using the default session for this since this is not a page
include '../include/session.inc.php';

// redirect to login page if session role is not set or not allowed
if (!isset($_SESSION['role']) || !in_array($_SESSION['role'], ["administrator", "staff", "resident"])) {
  header("Location: ../login.php");
  exit();
}

// get session information
$user_id = $_SESSION['userid'];
$user_type = $_SESSION['role'];

// initialize the result array
$issuance_res = array(
  "clearance" => array("new" => 0, "approved" => 0, "disapproved" => 0),
  "indigent" => array("new" => 0, "approved" => 0, "disapproved" => 0),
  "lowincome" => array("new" => 0, "approved" => 0, "disapproved" => 0)
);

// initialize queries
$clearance_new_query = $clearance_approved_query = $clearance_disapproved_query = $indigent_new_query = $indigent_approved_query = $indigent_disapproved_query = $lowincome_new_query = $lowincome_approved_query = $lowincome_disapproved_query = "";

// check user type and update the queries accordingly
if ($user_type === "administrator" || $user_type === "staff") {
  // get all data from tblclearance
  $clearance_new_query = "SELECT id FROM tblclearance WHERE clearance_status = 'new'";
  $clearance_approved_query = "SELECT id FROM tblclearance WHERE clearance_status = 'approved'";
  $clearance_disapproved_query = "SELECT id FROM tblclearance WHERE clearance_status = 'disapproved'";

  // get all data from tblindigent
  $indigent_new_query = "SELECT id FROM tblindigent WHERE indigent_status = 'new'";
  $indigent_approved_query = "SELECT id FROM tblindigent WHERE indigent_status = 'approved'";
  $indigent_disapproved_query = "SELECT id FROM tblindigent WHERE indigent_status = 'disapproved'";

  // get all data from tblindigent
  $lowincome_new_query = "SELECT id FROM tbllowincome WHERE lowincome_status = 'new'";
  $lowincome_approved_query = "SELECT id FROM tbllowincome WHERE lowincome_status = 'approved'";
  $lowincome_disapproved_query = "SELECT id FROM tbllowincome WHERE lowincome_status = 'disapproved'";

} elseif ($user_type === "resident") {
  // get specific data for the resident from tblclearance
  $clearance_new_query = "SELECT * FROM tblclearance p left join tblresident r on r.id = p.clearance_res_id WHERE r.id = '$user_id' AND clearance_status = 'new'";
  $clearance_approved_query = "SELECT * FROM tblclearance p left join tblresident r on r.id = p.clearance_res_id WHERE r.id = '$user_id' AND clearance_status = 'approved'";
  $clearance_disapproved_query = "SELECT * FROM tblclearance p left join tblresident r on r.id = p.clearance_res_id WHERE r.id = '$user_id' AND clearance_status = 'disapproved'";

  // get specific data for the resident from tblindigent
  $indigent_new_query = "SELECT * FROM tblindigent p left join tblresident r on r.id = p.indigent_res_id WHERE r.id = '$user_id' AND indigent_status = 'new'";
  $indigent_approved_query = "SELECT * FROM tblindigent p left join tblresident r on r.id = p.indigent_res_id WHERE r.id = '$user_id' AND indigent_status = 'approved'";
  $indigent_disapproved_query = "SELECT * FROM tblindigent p left join tblresident r on r.id = p.indigent_res_id WHERE r.id = '$user_id' AND indigent_status = 'disapproved'";

  // get specific data for the resident from tblindigent
  $lowincome_new_query = "SELECT * FROM tbllowincome p left join tblresident r on r.id = p.lowincome_res_id WHERE r.id = '$user_id' AND lowincome_status = 'new'";
  $lowincome_approved_query = "SELECT * FROM tbllowincome p left join tblresident r on r.id = p.lowincome_res_id WHERE r.id = '$user_id' AND lowincome_status = 'approved'";
  $lowincome_disapproved_query = "SELECT * FROM tbllowincome p left join tblresident r on r.id = p.lowincome_res_id WHERE r.id = '$user_id' AND lowincome_status = 'disapproved'";
}

// execute queries and update the result array
// i am using a function for better code reliability
function executeQuery($con, $query)
{
  $result = $con->query($query);
  return ($result) ? $result->num_rows : 0;
}

$issuance_res["clearance"]["new"] = executeQuery($con, $clearance_new_query);
$issuance_res["clearance"]["approved"] = executeQuery($con, $clearance_approved_query);
$issuance_res["clearance"]["disapproved"] = executeQuery($con, $clearance_disapproved_query);

$issuance_res["indigent"]["new"] = executeQuery($con, $indigent_new_query);
$issuance_res["indigent"]["approved"] = executeQuery($con, $indigent_approved_query);
$issuance_res["indigent"]["disapproved"] = executeQuery($con, $indigent_disapproved_query);

$issuance_res["lowincome"]["new"] = executeQuery($con, $lowincome_new_query);
$issuance_res["lowincome"]["approved"] = executeQuery($con, $lowincome_approved_query);
$issuance_res["lowincome"]["disapproved"] = executeQuery($con, $lowincome_disapproved_query);

// close the database connection
$con->close();

// output the result as json
header('Content-Type: application/json');
echo json_encode($issuance_res);