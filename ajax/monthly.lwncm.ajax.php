<?php
include '../include/db.inc.php';

$months = [];
$monthly_num_lowincomes = [];

$sql_new = "SELECT SUBSTRING(lowincome_date_requested, 1, 2) AS month, COUNT(lowincome_num) AS num_lowincomes FROM tbllowincome WHERE lowincome_status = 'new' GROUP BY month";
$result_new = $con->query($sql_new);
while ($row = $result_new->fetch_assoc()) {
  $months[$row['month']] = true;
  $monthly_num_lowincomes[$row['month']]['new'] = $row['num_lowincomes'];
}

$sql_approved = "SELECT SUBSTRING(IF(lowincome_date_approved = 'n/a', lowincome_date_added, lowincome_date_approved), 1, 2) AS month, COUNT(lowincome_num) AS num_lowincomes FROM tbllowincome WHERE lowincome_status = 'approved' GROUP BY month";
$result_approved = $con->query($sql_approved);
while ($row = $result_approved->fetch_assoc()) {
  $months[$row['month']] = true;
  $monthly_num_lowincomes[$row['month']]['approved'] = $row['num_lowincomes'];
}

$sql_disapproved = "SELECT SUBSTRING(lowincome_date_disapproved, 1, 2) AS month, COUNT(lowincome_num) AS num_lowincomes FROM tbllowincome WHERE lowincome_status = 'disapproved' GROUP BY month";
$result_disapproved = $con->query($sql_disapproved);
while ($row = $result_disapproved->fetch_assoc()) {
  $months[$row['month']] = true;
  $monthly_num_lowincomes[$row['month']]['disapproved'] = $row['num_lowincomes'];
}

// close conn
$con->close();

// sort months in ascending order
ksort($months);

// initialize arrays for each lowincome status
$monthly_num_new_lowincomes = [];
$monthly_num_approved_lowincomes = [];
$monthly_num_disapproved_lowincomes = [];

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

  $monthly_num_new_lowincomes[] = isset($monthly_num_lowincomes[$month]['new']) ? $monthly_num_lowincomes[$month]['new'] : 0;
  $monthly_num_approved_lowincomes[] = isset($monthly_num_lowincomes[$month]['approved']) ? $monthly_num_lowincomes[$month]['approved'] : 0;
  $monthly_num_disapproved_lowincomes[] = isset($monthly_num_lowincomes[$month]['disapproved']) ? $monthly_num_lowincomes[$month]['disapproved'] : 0;

  $month_labels[] = $formattedMonth;
}

// output the data as JSON
$data = array(
  'monthly_lowincome_labels' => $month_labels,
  'monthly_lowincome_requested' => $monthly_num_new_lowincomes,
  'monthly_lowincome_approved' => $monthly_num_approved_lowincomes,
  'monthly_lowincome_disapproved' => $monthly_num_disapproved_lowincomes
);

header('Content-Type: application/json');
echo json_encode($data);