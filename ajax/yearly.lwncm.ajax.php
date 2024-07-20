<?php
include '../include/db.inc.php';

$years = []; // Array to store years
$yearly_num_lowincomes = []; // Array to store yearly lowincome counts

// Query for new lowincomes by year
$sql_new = "SELECT lowincome_date_requested, COUNT(lowincome_num) AS num_lowincomes FROM tbllowincome WHERE lowincome_status = 'new' GROUP BY YEAR(STR_TO_DATE(lowincome_date_requested, '%m/%d/%Y %h:%i %p'))";
$result_new = $con->query($sql_new);
while ($row = $result_new->fetch_assoc()) {
  $year = date('Y', strtotime($row['lowincome_date_requested']));
  $years[$year] = true;
  $yearly_num_lowincomes[$year]['new'] = $row['num_lowincomes'];
}

// Query for approved lowincomes by year
$sql_approved = "SELECT IF(lowincome_date_approved = 'n/a', lowincome_date_added, lowincome_date_approved) AS lowincome_date, COUNT(lowincome_num) AS num_lowincomes FROM tbllowincome WHERE lowincome_status = 'approved' GROUP BY YEAR(STR_TO_DATE(lowincome_date_approved, '%m/%d/%Y %h:%i %p'))";
$result_approved = $con->query($sql_approved);
while ($row = $result_approved->fetch_assoc()) {
  $year = date('Y', strtotime($row['lowincome_date']));
  $years[$year] = true;
  $yearly_num_lowincomes[$year]['approved'] = $row['num_lowincomes'];
}

// Query for disapproved lowincomes by year
$sql_disapproved = "SELECT lowincome_date_disapproved AS lowincome_date, COUNT(lowincome_num) AS num_lowincomes FROM tbllowincome WHERE lowincome_status = 'disapproved' GROUP BY YEAR(STR_TO_DATE(lowincome_date_disapproved, '%m/%d/%Y %h:%i %p'))";
$result_disapproved = $con->query($sql_disapproved);
while ($row = $result_disapproved->fetch_assoc()) {
  $year = date('Y', strtotime($row['lowincome_date']));
  $years[$year] = true;
  $yearly_num_lowincomes[$year]['disapproved'] = $row['num_lowincomes'];
}

// Close connection
$con->close();

// Sort years in ascending order
ksort($years);

// Initialize arrays for each lowincome status
$yearly_num_new_lowincomes = [];
$yearly_num_approved_lowincomes = [];
$yearly_num_disapproved_lowincomes = [];

// Loop through years to format data
foreach ($years as $year => $value) {
  $yearly_num_new_lowincomes[] = isset($yearly_num_lowincomes[$year]['new']) ? $yearly_num_lowincomes[$year]['new'] : 0;
  $yearly_num_approved_lowincomes[] = isset($yearly_num_lowincomes[$year]['approved']) ? $yearly_num_lowincomes[$year]['approved'] : 0;
  $yearly_num_disapproved_lowincomes[] = isset($yearly_num_lowincomes[$year]['disapproved']) ? $yearly_num_lowincomes[$year]['disapproved'] : 0;
}

// Format labels to include year
$yearly_lowincome_labels = array_keys($years);

// Output the data as JSON
$data = array(
  'yearly_lowincome_labels' => $yearly_lowincome_labels,
  'yearly_lowincome_requested' => $yearly_num_new_lowincomes,
  'yearly_lowincome_approved' => $yearly_num_approved_lowincomes,
  'yearly_lowincome_disapproved' => $yearly_num_disapproved_lowincomes
);

header('Content-Type: application/json');
echo json_encode($data);
?>