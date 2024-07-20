<?php
include '../include/db.inc.php';

$months = [];
$monthly_num_blotters = [];

$sql_solved = "SELECT SUBSTRING(blotter_date_added, 1, 2) AS month, COUNT(blotter_complainant) AS num_blotters FROM tblblotter WHERE blotter_status = 'solved' GROUP BY month";
$result_solved = $con->query($sql_solved);
while ($row = $result_solved->fetch_assoc()) {
  $months[$row['month']] = true;
  $monthly_num_blotters[$row['month']]['solved'] = $row['num_blotters'];
}

$sql_unsolved = "SELECT SUBSTRING(blotter_date_added, 1, 2) AS month, COUNT(blotter_complainant) AS num_blotters FROM tblblotter WHERE blotter_status = 'unsolved' GROUP BY month";
$result_unsolved = $con->query($sql_unsolved);
while ($row = $result_unsolved->fetch_assoc()) {
  $months[$row['month']] = true;
  $monthly_num_blotters[$row['month']]['unsolved'] = $row['num_blotters'];
}

// close conn
$con->close();

// sort months in ascending order
ksort($months);

// initialize arrays for each blotter status
$monthly_num_solved_blotters = [];
$monthly_num_unsolved_blotters = [];

// function to convert numeric month to actual month name
function numericToMonthName($numericMonth)
{
  if ($numericMonth && is_numeric($numericMonth)) {
    $dateObj = DateTime::createFromFormat('!m', $numericMonth);
    return $dateObj->format('F');
  }
  return ''; // return empty string if input is invalid
}

// modify the arrays to store month names instead of numeric values
$month_labels = [];
foreach ($months as $month => $value) {
  // Convert numeric month to actual month name
  $month_name = date('M', mktime(0, 0, 0, $month, 1));
  $formattedMonth = $month_name . ' ' . date('Y');

  $monthly_num_solved_blotters[] = isset($monthly_num_blotters[$month]['solved']) ? $monthly_num_blotters[$month]['solved'] : 0;
  $monthly_num_unsolved_blotters[] = isset($monthly_num_blotters[$month]['unsolved']) ? $monthly_num_blotters[$month]['unsolved'] : 0;

  $month_labels[] = $formattedMonth;
}

// output the data as JSON
$data = array(
  'monthly_blotter_labels' => $month_labels,
  'monthly_blotter_solved' => $monthly_num_solved_blotters,
  'monthly_blotter_unsolved' => $monthly_num_unsolved_blotters
);

header('Content-Type: application/json');
echo json_encode($data);