<?php
include '../include/db.inc.php';

// check if the username parameter is set in the post request
if (isset($_POST['resident_uname'])) {
  $resident_uname = mysqli_real_escape_string($con, $_POST['resident_uname']);

  // use prepared statement to check if the username already exists in the table
  $query = "SELECT resident_uname FROM tblresident WHERE resident_uname = ?";

  // prepare the statement
  $stmt = mysqli_prepare($con, $query);

  // bind the parameters
  mysqli_stmt_bind_param($stmt, 's', $resident_uname);

  // execute the statement
  mysqli_stmt_execute($stmt);

  // get the result
  mysqli_stmt_store_result($stmt);
  $count = mysqli_stmt_num_rows($stmt);

  // close the statement
  mysqli_stmt_close($stmt);

  // send the result back to the client
  echo $count;
}

// check if the username parameter is set in the post request
if (isset($_POST['captain_uname'])) {
  $captain_uname = mysqli_real_escape_string($con, $_POST['captain_uname']);

  // use prepared statement to check if the username already exists in the table
  $query = "SELECT captain_uname FROM tblcaptain WHERE captain_uname = ?";

  // prepare the statement
  $stmt = mysqli_prepare($con, $query);

  // bind the parameters
  mysqli_stmt_bind_param($stmt, 's', $captain_uname);

  // execute the statement
  mysqli_stmt_execute($stmt);

  // get the result
  mysqli_stmt_store_result($stmt);
  $count = mysqli_stmt_num_rows($stmt);

  // close the statement
  mysqli_stmt_close($stmt);

  // send the result back to the client
  echo $count;
}

// check if the username parameter is set in the post request
if (isset($_POST['staff_uname'])) {
  $staff_uname = mysqli_real_escape_string($con, $_POST['staff_uname']);

  // use prepared statement to check if the username already exists in the table
  $query = "SELECT staff_uname FROM tblstaff WHERE staff_uname = ?";

  // prepare the statement
  $stmt = mysqli_prepare($con, $query);

  // bind the parameters
  mysqli_stmt_bind_param($stmt, 's', $staff_uname);

  // execute the statement
  mysqli_stmt_execute($stmt);

  // get the result
  mysqli_stmt_store_result($stmt);
  $count = mysqli_stmt_num_rows($stmt);

  // close the statement
  mysqli_stmt_close($stmt);

  // send the result back to the client
  echo $count;
}