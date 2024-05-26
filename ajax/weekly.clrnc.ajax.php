<?php
include '../include/db.inc.php';

$weeks = [];
$weekly_num_clearances = [];

$sql_new = "SELECT YEARWEEK(STR_TO_DATE(clearance_date_requested, '%m/%d/%Y %h:%i %p')) AS week, COUNT(clearance_num) AS num_clearances FROM tblclearance WHERE clearance_status = 'new' GROUP BY week";
$result_new = $con->query($sql_new);
while ($row = $result_new->fetch_assoc()) {
  $weeks[$row['week']] = true;
  $weekly_num_clearances[$row['week']]['new'] = $row['num_clearances'];
}

$sql_approved = "SELECT YEARWEEK(IF(clearance_date_approved = 'n/a', STR_TO_DATE(clearance_date_added, '%m/%d/%Y %h:%i %p'), STR_TO_DATE(clearance_date_approved, '%m/%d/%Y %h:%i %p'))) AS week, COUNT(clearance_num) AS num_clearances FROM tblclearance WHERE clearance_status = 'approved' GROUP BY week";
$result_approved = $con->query($sql_approved);
while ($row = $result_approved->fetch_assoc()) {
  $weeks[$row['week']] = true;
  $weekly_num_clearances[$row['week']]['approved'] = $row['num_clearances'];
}

$sql_disapproved = "SELECT YEARWEEK(STR_TO_DATE(clearance_date_disapproved, '%m/%d/%Y %h:%i %p')) AS week, COUNT(clearance_num) AS num_clearances FROM tblclearance WHERE clearance_status = 'disapproved' GROUP BY week";
$result_disapproved = $con->query($sql_disapproved);
while ($row = $result_disapproved->fetch_assoc()) {
  $weeks[$row['week']] = true;
  $weekly_num_clearances[$row['week']]['disapproved'] = $row['num_clearances'];
}

// close the connection
$con->close();

// sort weeks in ascending order
ksort($weeks);

// initialize arrays for each clearance status
$weekly_num_new_clearances = [];
$weekly_num_approved_clearances = [];
$weekly_num_disapproved_clearances = [];

// modify the arrays to store month and week values
$week_labels = [];
foreach ($weeks as $week => $value) {
  // Convert week value to date object
  $date = date_create_from_format('Y-W', date('Y-\W', strtotime($week . '-1')));

  // Get the week number within the month
  $weekOfMonth = ceil((date('d', strtotime($week . '1'))) / 7);

  // Determine the suffix for the week number
  $suffix = getWeekSuffix($weekOfMonth);

  // Format the label with the suffix
  $formattedWeek = $weekOfMonth . $suffix . " week of " . $date->format('F Y');
  $week_labels[] = $formattedWeek;

  $weekly_num_new_clearances[] = isset($weekly_num_clearances[$week]['new']) ? $weekly_num_clearances[$week]['new'] : 0;
  $weekly_num_approved_clearances[] = isset($weekly_num_clearances[$week]['approved']) ? $weekly_num_clearances[$week]['approved'] : 0;
  $weekly_num_disapproved_clearances[] = isset($weekly_num_clearances[$week]['disapproved']) ? $weekly_num_clearances[$week]['disapproved'] : 0;
}

// Function to get the suffix for the week number
function getWeekSuffix($weekNumber)
{
  $weekNumber = ltrim($weekNumber, '0');
  if ($weekNumber >= 11 && $weekNumber <= 13) {
    return 'th';
  } else {
    switch ($weekNumber % 10) {
      case 1:
        return 'st';
      case 2:
        return 'nd';
      case 3:
        return 'rd';
      default:
        return 'th';
    }
  }
}

// output the data as JSON
$data = array(
  'weekly_clearance_labels' => $week_labels,
  'weekly_clearance_requested' => $weekly_num_new_clearances,
  'weekly_clearance_approved' => $weekly_num_approved_clearances,
  'weekly_clearance_disapproved' => $weekly_num_disapproved_clearances
);

header('Content-Type: application/json');
echo json_encode($data);