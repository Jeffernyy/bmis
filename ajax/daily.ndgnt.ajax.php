<?php
include '../include/db.inc.php';

$days = [];
$daily_num_indigents = [];

$sql_new = "SELECT SUBSTRING(indigent_date_requested, 1, 10) AS day, COUNT(indigent_num) AS num_indigents FROM tblindigent WHERE indigent_status = 'new' GROUP BY day";
$result_new = $con->query($sql_new);
while ($row = $result_new->fetch_assoc()) {
  $days[$row['day']] = true;
  $daily_num_indigents[$row['day']]['new'] = $row['num_indigents'];
}

$sql_approved = "SELECT SUBSTRING(IF(indigent_date_approved = 'n/a', indigent_date_added, indigent_date_approved), 1, 10) AS day, COUNT(indigent_num) AS num_indigents FROM tblindigent WHERE indigent_status = 'approved' GROUP BY day";
$result_approved = $con->query($sql_approved);
while ($row = $result_approved->fetch_assoc()) {
  $days[$row['day']] = true;
  $daily_num_indigents[$row['day']]['approved'] = $row['num_indigents'];
}

$sql_disapproved = "SELECT SUBSTRING(indigent_date_disapproved, 1, 10) AS day, COUNT(indigent_num) AS num_indigents FROM tblindigent WHERE indigent_status = 'disapproved' GROUP BY day";
$result_disapproved = $con->query($sql_disapproved);
while ($row = $result_disapproved->fetch_assoc()) {
  $days[$row['day']] = true;
  $daily_num_indigents[$row['day']]['disapproved'] = $row['num_indigents'];
}

// close the conn
$con->close();

// sort days in ascending order
ksort($days);

// initialize arrays for each indigent status
$daily_num_new_indigents = [];
$daily_num_approved_indigents = [];
$daily_num_disapproved_indigents = [];

// modify the arrays to store day values
$daily_indigent_labels = [];
foreach ($days as $day => $value) {
  // convert the day value to a formatted date string
  $formattedDay = date('M j', strtotime($day));
  $daily_indigent_labels[] = $formattedDay;

  $daily_indigent_requested[] = isset($daily_num_indigents[$day]['new']) ? $daily_num_indigents[$day]['new'] : 0;
  $daily_indigent_approved[] = isset($daily_num_indigents[$day]['approved']) ? $daily_num_indigents[$day]['approved'] : 0;
  $daily_indigent_disapproved[] = isset($daily_num_indigents[$day]['disapproved']) ? $daily_num_indigents[$day]['disapproved'] : 0;
}

// output the data as JSON
$data = array(
  'daily_indigent_labels' => $daily_indigent_labels,
  'daily_indigent_requested' => $daily_indigent_requested,
  'daily_indigent_approved' => $daily_indigent_approved,
  'daily_indigent_disapproved' => $daily_indigent_disapproved
);

header('Content-Type: application/json');
echo json_encode($data);