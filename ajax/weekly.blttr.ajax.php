<?php
include '../include/db.inc.php';

$weeks = [];
$weekly_num_blotters = [];

$sql_solved = "SELECT YEARWEEK(STR_TO_DATE(blotter_date_added, '%m/%d/%Y %h:%i %p'), 1) AS week, COUNT(blotter_complainant) AS num_blotters FROM tblblotter WHERE blotter_status = 'solved' GROUP BY week";
$result_solved = $con->query($sql_solved);
while ($row = $result_solved->fetch_assoc()) {
  $weeks[$row['week']] = true;
  $weekly_num_blotters[$row['week']]['solved'] = $row['num_blotters'];
}

$sql_unsolved = "SELECT YEARWEEK(STR_TO_DATE(blotter_date_added, '%m/%d/%Y %h:%i %p'), 1) AS week, COUNT(blotter_complainant) AS num_blotters FROM tblblotter WHERE blotter_status = 'unsolved' GROUP BY week";
$result_unsolved = $con->query($sql_unsolved);
while ($row = $result_unsolved->fetch_assoc()) {
  $weeks[$row['week']] = true;
  $weekly_num_blotters[$row['week']]['unsolved'] = $row['num_blotters'];
}

// close the connection
$con->close();

// sort weeks in ascending order
ksort($weeks);

// initialize arrays for each blotter status
$weekly_num_solved_blotters = [];
$weekly_num_unsolved_blotters = [];

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

  $weekly_num_solved_blotters[] = isset($weekly_num_blotters[$week]['solved']) ? $weekly_num_blotters[$week]['solved'] : 0;
  $weekly_num_unsolved_blotters[] = isset($weekly_num_blotters[$week]['unsolved']) ? $weekly_num_blotters[$week]['unsolved'] : 0;
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
  'weekly_blotter_labels' => $week_labels,
  'weekly_blotter_solved' => $weekly_num_solved_blotters,
  'weekly_blotter_unsolved' => $weekly_num_unsolved_blotters
);

header('Content-Type: application/json');
echo json_encode($data);