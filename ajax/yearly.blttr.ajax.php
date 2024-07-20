<?php
include '../include/db.inc.php';

$years = []; // Array to store years
$yearly_num_blotters = []; // Array to store yearly blotter counts

// Query for approved blotters by year
$sql_solved = "SELECT blotter_date_added AS blotter_date, COUNT(blotter_complainant) AS num_blotters FROM tblblotter WHERE blotter_status = 'solved' GROUP BY YEAR(STR_TO_DATE(blotter_date_added, '%m/%d/%Y %h:%i %p'))";
$result_solved = $con->query($sql_solved);
while ($row = $result_solved->fetch_assoc()) {
  $year = date('Y', strtotime($row['blotter_date']));
  $years[$year] = true;
  $yearly_num_blotters[$year]['solved'] = $row['num_blotters'];
}

// Query for disapproved blotters by year
$sql_unsolved = "SELECT blotter_date_added AS blotter_date, COUNT(blotter_complainant) AS num_blotters FROM tblblotter WHERE blotter_status = 'unsolved' GROUP BY YEAR(STR_TO_DATE(blotter_date_added, '%m/%d/%Y %h:%i %p'))";
$result_unsolved = $con->query($sql_unsolved);
while ($row = $result_unsolved->fetch_assoc()) {
  $year = date('Y', strtotime($row['blotter_date']));
  $years[$year] = true;
  $yearly_num_blotters[$year]['unsolved'] = $row['num_blotters'];
}

// Close connection
$con->close();

// Sort years in ascending order
ksort($years);

// Initialize arrays for each blotter status
$yearly_num_new_blotters = [];
$yearly_num_solved_blotters = [];
$yearly_num_unsolved_blotters = [];

// Loop through years to format data
foreach ($years as $year => $value) {
  $yearly_num_solved_blotters[] = isset($yearly_num_blotters[$year]['solved']) ? $yearly_num_blotters[$year]['solved'] : 0;
  $yearly_num_unsolved_blotters[] = isset($yearly_num_blotters[$year]['unsolved']) ? $yearly_num_blotters[$year]['unsolved'] : 0;
}

// Format labels to include year
$yearly_blotter_labels = array_keys($years);

// Output the data as JSON
$data = array(
  'yearly_blotter_labels' => $yearly_blotter_labels,
  'yearly_blotter_solved' => $yearly_num_solved_blotters,
  'yearly_blotter_unsolved' => $yearly_num_unsolved_blotters
);

header('Content-Type: application/json');
echo json_encode($data);
?>