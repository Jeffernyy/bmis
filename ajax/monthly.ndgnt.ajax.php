<?php
include '../include/db.inc.php';

$months = [];
$monthly_num_indigents = [];

$sql_new = "SELECT SUBSTRING(indigent_date_requested, 1, 2) AS month, COUNT(indigent_num) AS num_indigents FROM tblindigent WHERE indigent_status = 'new' GROUP BY month";
$result_new = $con->query($sql_new);
while ($row = $result_new->fetch_assoc()) {
  $months[$row['month']] = true;
  $monthly_num_indigents[$row['month']]['new'] = $row['num_indigents'];
}

$sql_approved = "SELECT SUBSTRING(IF(indigent_date_approved = 'n/a', indigent_date_added, indigent_date_approved), 1, 2) AS month, COUNT(indigent_num) AS num_indigents FROM tblindigent WHERE indigent_status = 'approved' GROUP BY month";
$result_approved = $con->query($sql_approved);
while ($row = $result_approved->fetch_assoc()) {
  $months[$row['month']] = true;
  $monthly_num_indigents[$row['month']]['approved'] = $row['num_indigents'];
}

$sql_disapproved = "SELECT SUBSTRING(indigent_date_disapproved, 1, 2) AS month, COUNT(indigent_num) AS num_indigents FROM tblindigent WHERE indigent_status = 'disapproved' GROUP BY month";
$result_disapproved = $con->query($sql_disapproved);
while ($row = $result_disapproved->fetch_assoc()) {
  $months[$row['month']] = true;
  $monthly_num_indigents[$row['month']]['disapproved'] = $row['num_indigents'];
}

// close conn
$con->close();

// sort months in ascending order
ksort($months);

// initialize arrays for each indigent status
$monthly_num_new_indigents = [];
$monthly_num_approved_indigents = [];
$monthly_num_disapproved_indigents = [];

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

  $monthly_num_new_indigents[] = isset($monthly_num_indigents[$month]['new']) ? $monthly_num_indigents[$month]['new'] : 0;
  $monthly_num_approved_indigents[] = isset($monthly_num_indigents[$month]['approved']) ? $monthly_num_indigents[$month]['approved'] : 0;
  $monthly_num_disapproved_indigents[] = isset($monthly_num_indigents[$month]['disapproved']) ? $monthly_num_indigents[$month]['disapproved'] : 0;

  $month_labels[] = $formattedMonth;
}

// output the data as JSON
$data = array(
  'monthly_indigent_labels' => $month_labels,
  'monthly_indigent_requested' => $monthly_num_new_indigents,
  'monthly_indigent_approved' => $monthly_num_approved_indigents,
  'monthly_indigent_disapproved' => $monthly_num_disapproved_indigents
);

header('Content-Type: application/json');
echo json_encode($data);