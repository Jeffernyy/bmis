<?php
include '../include/db.inc.php';

$months = [];
$monthly_num_clearances = [];

$sql_new = "SELECT SUBSTRING(clearance_date_requested, 1, 2) AS month, COUNT(clearance_num) AS num_clearances FROM tblclearance WHERE clearance_status = 'new' GROUP BY month";
$result_new = $con->query($sql_new);
while ($row = $result_new->fetch_assoc()) {
  $months[$row['month']] = true;
  $monthly_num_clearances[$row['month']]['new'] = $row['num_clearances'];
}

$sql_approved = "SELECT SUBSTRING(IF(clearance_date_approved = 'n/a', clearance_date_added, clearance_date_approved), 1, 2) AS month, COUNT(clearance_num) AS num_clearances FROM tblclearance WHERE clearance_status = 'approved' GROUP BY month";
$result_approved = $con->query($sql_approved);
while ($row = $result_approved->fetch_assoc()) {
  $months[$row['month']] = true;
  $monthly_num_clearances[$row['month']]['approved'] = $row['num_clearances'];
}

$sql_disapproved = "SELECT SUBSTRING(clearance_date_disapproved, 1, 2) AS month, COUNT(clearance_num) AS num_clearances FROM tblclearance WHERE clearance_status = 'disapproved' GROUP BY month";
$result_disapproved = $con->query($sql_disapproved);
while ($row = $result_disapproved->fetch_assoc()) {
  $months[$row['month']] = true;
  $monthly_num_clearances[$row['month']]['disapproved'] = $row['num_clearances'];
}

// close conn
$con->close();

// sort months in ascending order
ksort($months);

// initialize arrays for each clearance status
$monthly_num_new_clearances = [];
$monthly_num_approved_clearances = [];
$monthly_num_disapproved_clearances = [];

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

  $monthly_num_new_clearances[] = isset($monthly_num_clearances[$month]['new']) ? $monthly_num_clearances[$month]['new'] : 0;
  $monthly_num_approved_clearances[] = isset($monthly_num_clearances[$month]['approved']) ? $monthly_num_clearances[$month]['approved'] : 0;
  $monthly_num_disapproved_clearances[] = isset($monthly_num_clearances[$month]['disapproved']) ? $monthly_num_clearances[$month]['disapproved'] : 0;

  $month_labels[] = $formattedMonth;
}

// output the data as JSON
$data = array(
  'monthly_clearance_labels' => $month_labels,
  'monthly_clearance_requested' => $monthly_num_new_clearances,
  'monthly_clearance_approved' => $monthly_num_approved_clearances,
  'monthly_clearance_disapproved' => $monthly_num_disapproved_clearances
);

header('Content-Type: application/json');
echo json_encode($data);