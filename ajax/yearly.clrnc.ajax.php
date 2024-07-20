<?php
include '../include/db.inc.php';

$years = []; // Array to store years
$yearly_num_clearances = []; // Array to store yearly clearance counts

// Query for new clearances by year
$sql_new = "SELECT clearance_date_requested, COUNT(clearance_num) AS num_clearances FROM tblclearance WHERE clearance_status = 'new' GROUP BY YEAR(STR_TO_DATE(clearance_date_requested, '%m/%d/%Y %h:%i %p'))";
$result_new = $con->query($sql_new);
while ($row = $result_new->fetch_assoc()) {
  $year = date('Y', strtotime($row['clearance_date_requested']));
  $years[$year] = true;
  $yearly_num_clearances[$year]['new'] = $row['num_clearances'];
}

// Query for approved clearances by year
$sql_approved = "SELECT IF(clearance_date_approved = 'n/a', clearance_date_added, clearance_date_approved) AS clearance_date, COUNT(clearance_num) AS num_clearances FROM tblclearance WHERE clearance_status = 'approved' GROUP BY YEAR(STR_TO_DATE(clearance_date_approved, '%m/%d/%Y %h:%i %p'))";
$result_approved = $con->query($sql_approved);
while ($row = $result_approved->fetch_assoc()) {
  $year = date('Y', strtotime($row['clearance_date']));
  $years[$year] = true;
  $yearly_num_clearances[$year]['approved'] = $row['num_clearances'];
}

// Query for disapproved clearances by year
$sql_disapproved = "SELECT clearance_date_disapproved AS clearance_date, COUNT(clearance_num) AS num_clearances FROM tblclearance WHERE clearance_status = 'disapproved' GROUP BY YEAR(STR_TO_DATE(clearance_date_disapproved, '%m/%d/%Y %h:%i %p'))";
$result_disapproved = $con->query($sql_disapproved);
while ($row = $result_disapproved->fetch_assoc()) {
  $year = date('Y', strtotime($row['clearance_date']));
  $years[$year] = true;
  $yearly_num_clearances[$year]['disapproved'] = $row['num_clearances'];
}

// Close connection
$con->close();

// Sort years in ascending order
ksort($years);

// Initialize arrays for each clearance status
$yearly_num_new_clearances = [];
$yearly_num_approved_clearances = [];
$yearly_num_disapproved_clearances = [];

// Loop through years to format data
foreach ($years as $year => $value) {
  $yearly_num_new_clearances[] = isset($yearly_num_clearances[$year]['new']) ? $yearly_num_clearances[$year]['new'] : 0;
  $yearly_num_approved_clearances[] = isset($yearly_num_clearances[$year]['approved']) ? $yearly_num_clearances[$year]['approved'] : 0;
  $yearly_num_disapproved_clearances[] = isset($yearly_num_clearances[$year]['disapproved']) ? $yearly_num_clearances[$year]['disapproved'] : 0;
}

// Format labels to include year
$yearly_clearance_labels = array_keys($years);

// Output the data as JSON
$data = array(
  'yearly_clearance_labels' => $yearly_clearance_labels,
  'yearly_clearance_requested' => $yearly_num_new_clearances,
  'yearly_clearance_approved' => $yearly_num_approved_clearances,
  'yearly_clearance_disapproved' => $yearly_num_disapproved_clearances
);

header('Content-Type: application/json');
echo json_encode($data);
?>