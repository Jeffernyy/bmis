<?php
include '../include/db.inc.php';

$days = [];
$daily_num_lowincomes = [];

$sql_new = "SELECT SUBSTRING(lowincome_date_requested, 1, 10) AS day, COUNT(lowincome_num) AS num_lowincomes FROM tbllowincome WHERE lowincome_status = 'new' GROUP BY day";
$result_new = $con->query($sql_new);
while ($row = $result_new->fetch_assoc()) {
  $days[$row['day']] = true;
  $daily_num_lowincomes[$row['day']]['new'] = $row['num_lowincomes'];
}

$sql_approved = "SELECT SUBSTRING(IF(lowincome_date_approved = 'n/a', lowincome_date_added, lowincome_date_approved), 1, 10) AS day, COUNT(lowincome_num) AS num_lowincomes FROM tbllowincome WHERE lowincome_status = 'approved' GROUP BY day";
$result_approved = $con->query($sql_approved);
while ($row = $result_approved->fetch_assoc()) {
  $days[$row['day']] = true;
  $daily_num_lowincomes[$row['day']]['approved'] = $row['num_lowincomes'];
}

$sql_disapproved = "SELECT SUBSTRING(lowincome_date_disapproved, 1, 10) AS day, COUNT(lowincome_num) AS num_lowincomes FROM tbllowincome WHERE lowincome_status = 'disapproved' GROUP BY day";
$result_disapproved = $con->query($sql_disapproved);
while ($row = $result_disapproved->fetch_assoc()) {
  $days[$row['day']] = true;
  $daily_num_lowincomes[$row['day']]['disapproved'] = $row['num_lowincomes'];
}

// close the conn
$con->close();

// sort days in ascending order
ksort($days);

// initialize arrays for each lowincome status
$daily_num_new_lowincomes = [];
$daily_num_approved_lowincomes = [];
$daily_num_disapproved_lowincomes = [];

// modify the arrays to store day values
$daily_lowincome_labels = [];
foreach ($days as $day => $value) {
  // convert the day value to a formatted date string
  $formattedDay = date('M j', strtotime($day));
  $daily_lowincome_labels[] = $formattedDay;

  $daily_lowincome_requested[] = isset($daily_num_lowincomes[$day]['new']) ? $daily_num_lowincomes[$day]['new'] : 0;
  $daily_lowincome_approved[] = isset($daily_num_lowincomes[$day]['approved']) ? $daily_num_lowincomes[$day]['approved'] : 0;
  $daily_lowincome_disapproved[] = isset($daily_num_lowincomes[$day]['disapproved']) ? $daily_num_lowincomes[$day]['disapproved'] : 0;
}

// output the data as JSON
$data = array(
  'daily_lowincome_labels' => $daily_lowincome_labels,
  'daily_lowincome_requested' => $daily_lowincome_requested,
  'daily_lowincome_approved' => $daily_lowincome_approved,
  'daily_lowincome_disapproved' => $daily_lowincome_disapproved
);

header('Content-Type: application/json');
echo json_encode($data);