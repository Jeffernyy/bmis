<?php
include '../include/db.inc.php';

$years = []; // Array to store years
$yearly_num_indigents = []; // Array to store yearly indigent counts

// Query for new indigents by year
$sql_new = "SELECT indigent_date_requested, COUNT(indigent_num) AS num_indigents FROM tblindigent WHERE indigent_status = 'new' GROUP BY YEAR(STR_TO_DATE(indigent_date_requested, '%m/%d/%Y %h:%i %p'))";
$result_new = $con->query($sql_new);
while ($row = $result_new->fetch_assoc()) {
  $year = date('Y', strtotime($row['indigent_date_requested']));
  $years[$year] = true;
  $yearly_num_indigents[$year]['new'] = $row['num_indigents'];
}

// Query for approved indigents by year
$sql_approved = "SELECT IF(indigent_date_approved = 'n/a', indigent_date_added, indigent_date_approved) AS indigent_date, COUNT(indigent_num) AS num_indigents FROM tblindigent WHERE indigent_status = 'approved' GROUP BY YEAR(STR_TO_DATE(indigent_date_approved, '%m/%d/%Y %h:%i %p'))";
$result_approved = $con->query($sql_approved);
while ($row = $result_approved->fetch_assoc()) {
  $year = date('Y', strtotime($row['indigent_date']));
  $years[$year] = true;
  $yearly_num_indigents[$year]['approved'] = $row['num_indigents'];
}

// Query for disapproved indigents by year
$sql_disapproved = "SELECT indigent_date_disapproved AS indigent_date, COUNT(indigent_num) AS num_indigents FROM tblindigent WHERE indigent_status = 'disapproved' GROUP BY YEAR(STR_TO_DATE(indigent_date_disapproved, '%m/%d/%Y %h:%i %p'))";
$result_disapproved = $con->query($sql_disapproved);
while ($row = $result_disapproved->fetch_assoc()) {
  $year = date('Y', strtotime($row['indigent_date']));
  $years[$year] = true;
  $yearly_num_indigents[$year]['disapproved'] = $row['num_indigents'];
}

// Close connection
$con->close();

// Sort years in ascending order
ksort($years);

// Initialize arrays for each indigent status
$yearly_num_new_indigents = [];
$yearly_num_approved_indigents = [];
$yearly_num_disapproved_indigents = [];

// Loop through years to format data
foreach ($years as $year => $value) {
  $yearly_num_new_indigents[] = isset($yearly_num_indigents[$year]['new']) ? $yearly_num_indigents[$year]['new'] : 0;
  $yearly_num_approved_indigents[] = isset($yearly_num_indigents[$year]['approved']) ? $yearly_num_indigents[$year]['approved'] : 0;
  $yearly_num_disapproved_indigents[] = isset($yearly_num_indigents[$year]['disapproved']) ? $yearly_num_indigents[$year]['disapproved'] : 0;
}

// Format labels to include year
$yearly_indigent_labels = array_keys($years);

// Output the data as JSON
$data = array(
  'yearly_indigent_labels' => $yearly_indigent_labels,
  'yearly_indigent_requested' => $yearly_num_new_indigents,
  'yearly_indigent_approved' => $yearly_num_approved_indigents,
  'yearly_indigent_disapproved' => $yearly_num_disapproved_indigents
);

header('Content-Type: application/json');
echo json_encode($data);
?>