<?php
include '../include/db.inc.php';

$weeks = [];
$weekly_num_lowincomes = [];

$sql_new = "SELECT YEARWEEK(STR_TO_DATE(lowincome_date_requested, '%m/%d/%Y %h:%i %p'), 1) AS week, COUNT(lowincome_num) AS num_lowincomes FROM tbllowincome WHERE lowincome_status = 'new' GROUP BY week";
$result_new = $con->query($sql_new);
while ($row = $result_new->fetch_assoc()) {
  $weeks[$row['week']] = true;
  $weekly_num_lowincomes[$row['week']]['new'] = $row['num_lowincomes'];
}

$sql_approved = "SELECT YEARWEEK(IF(lowincome_date_approved = 'n/a', STR_TO_DATE(lowincome_date_added, '%m/%d/%Y %h:%i %p'), STR_TO_DATE(lowincome_date_approved, '%m/%d/%Y %h:%i %p')), 1) AS week, COUNT(lowincome_num) AS num_lowincomes FROM tbllowincome WHERE lowincome_status = 'approved' GROUP BY week";
$result_approved = $con->query($sql_approved);
while ($row = $result_approved->fetch_assoc()) {
  $weeks[$row['week']] = true;
  $weekly_num_lowincomes[$row['week']]['approved'] = $row['num_lowincomes'];
}

$sql_disapproved = "SELECT YEARWEEK(STR_TO_DATE(lowincome_date_disapproved, '%m/%d/%Y %h:%i %p'), 1) AS week, COUNT(lowincome_num) AS num_lowincomes FROM tbllowincome WHERE lowincome_status = 'disapproved' GROUP BY week";
$result_disapproved = $con->query($sql_disapproved);
while ($row = $result_disapproved->fetch_assoc()) {
  $weeks[$row['week']] = true;
  $weekly_num_lowincomes[$row['week']]['disapproved'] = $row['num_lowincomes'];
}

// close the connection
$con->close();

// sort weeks in ascending order
ksort($weeks);

// initialize arrays for each lowincome status
$weekly_num_new_lowincomes = [];
$weekly_num_approved_lowincomes = [];
$weekly_num_disapproved_lowincomes = [];

// modify the arrays to store month and week values
$week_labels = [];
foreach ($weeks as $week => $value) {

  // convert week value to date object
  $year = substr($week, 0, 4);
  $weekNum = substr($week, 4, 2);
  $date = new DateTime();
  $date->setISODate($year, $weekNum);

  // get the month and first day of that week
  $month = $date->format('F Y');
  $firstDayOfWeek = $date->format('j');

  // calculate week of the month
  $weekOfMonth = ceil($firstDayOfWeek / 7);

  // determine the suffix for the week number
  $suffix = getWeekSuffix($weekOfMonth);

  // format the label with the suffix
  $formattedWeek = $weekOfMonth . $suffix . " week of " . $month;
  $week_labels[] = $formattedWeek;

  $weekly_num_new_lowincomes[] = isset($weekly_num_lowincomes[$week]['new']) ? $weekly_num_lowincomes[$week]['new'] : 0;
  $weekly_num_approved_lowincomes[] = isset($weekly_num_lowincomes[$week]['approved']) ? $weekly_num_lowincomes[$week]['approved'] : 0;
  $weekly_num_disapproved_lowincomes[] = isset($weekly_num_lowincomes[$week]['disapproved']) ? $weekly_num_lowincomes[$week]['disapproved'] : 0;
}

// function to get the suffix for the week number
function getWeekSuffix($weekNumber)
{
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
  'weekly_lowincome_labels' => $week_labels,
  'weekly_lowincome_requested' => $weekly_num_new_lowincomes,
  'weekly_lowincome_approved' => $weekly_num_approved_lowincomes,
  'weekly_lowincome_disapproved' => $weekly_num_disapproved_lowincomes
);

header('Content-Type: application/json');
echo json_encode($data);