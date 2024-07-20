<?php
include '../include/db.inc.php';

$days = [];
$daily_num_blotters = [];

$sql_solved = "SELECT SUBSTRING(blotter_date_added, 1, 10) AS day, COUNT(blotter_complainant) AS num_blotters FROM tblblotter WHERE blotter_status = 'solved' GROUP BY day";
$result_unsolved = $con->query($sql_solved);
while ($row = $result_unsolved->fetch_assoc()) {
  $days[$row['day']] = true;
  $daily_num_blotters[$row['day']]['solved'] = $row['num_blotters'];
}

$sql_unsolved = "SELECT SUBSTRING(blotter_date_added, 1, 10) AS day, COUNT(blotter_complainant) AS num_blotters FROM tblblotter WHERE blotter_status = 'unsolved' GROUP BY day";
$result_unsolved = $con->query($sql_unsolved);
while ($row = $result_unsolved->fetch_assoc()) {
  $days[$row['day']] = true;
  $daily_num_blotters[$row['day']]['unsolved'] = $row['num_blotters'];
}

// close the conn
$con->close();

// sort days in ascending order
ksort($days);

// initialize arrays for each blotter status
$daily_num_solved_blotters = [];
$daily_num_unsolved_blotters = [];

// modify the arrays to store day values
$daily_blotter_labels = [];
foreach ($days as $day => $value) {
  // convert the day value to a formatted date string
  $formattedDay = date('M j', strtotime($day));
  $daily_blotter_labels[] = $formattedDay;

  $daily_blotter_solved[] = isset($daily_num_blotters[$day]['solved']) ? $daily_num_blotters[$day]['solved'] : 0;
  $daily_blotter_unsolved[] = isset($daily_num_blotters[$day]['unsolved']) ? $daily_num_blotters[$day]['unsolved'] : 0;
}

// output the data as JSON
$data = array(
  'daily_blotter_labels' => $daily_blotter_labels,
  'daily_blotter_solved' => $daily_blotter_solved,
  'daily_blotter_unsolved' => $daily_blotter_unsolved
);

header('Content-Type: application/json');
echo json_encode($data);