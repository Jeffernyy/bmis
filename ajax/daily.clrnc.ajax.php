<?php
include '../include/db.inc.php';

$days = [];
$daily_num_clearances = [];

$sql_new = "SELECT SUBSTRING(clearance_date_requested, 1, 10) AS day, COUNT(clearance_num) AS num_clearances FROM tblclearance WHERE clearance_status = 'new' GROUP BY day";
$result_new = $con->query($sql_new);
while ($row = $result_new->fetch_assoc()) {
    $days[$row['day']] = true;
    $daily_num_clearances[$row['day']]['new'] = $row['num_clearances'];
}

$sql_approved = "SELECT SUBSTRING(IF(clearance_date_approved = 'n/a', clearance_date_added, clearance_date_approved), 1, 10) AS day, COUNT(clearance_num) AS num_clearances FROM tblclearance WHERE clearance_status = 'approved' GROUP BY day";
$result_approved = $con->query($sql_approved);
while ($row = $result_approved->fetch_assoc()) {
    $days[$row['day']] = true;
    $daily_num_clearances[$row['day']]['approved'] = $row['num_clearances'];
}

$sql_disapproved = "SELECT SUBSTRING(clearance_date_disapproved, 1, 10) AS day, COUNT(clearance_num) AS num_clearances FROM tblclearance WHERE clearance_status = 'disapproved' GROUP BY day";
$result_disapproved = $con->query($sql_disapproved);
while ($row = $result_disapproved->fetch_assoc()) {
    $days[$row['day']] = true;
    $daily_num_clearances[$row['day']]['disapproved'] = $row['num_clearances'];
}

// close the conn
$con->close();

// sort days in ascending order
ksort($days);

// initialize arrays for each clearance status
$daily_num_new_clearances = [];
$daily_num_approved_clearances = [];
$daily_num_disapproved_clearances = [];

// modify the arrays to store day values
$daily_clearance_labels = [];
foreach ($days as $day => $value) {
    // convert the day value to a formatted date string
    $formattedDay = date('M j', strtotime($day));
    $daily_clearance_labels[] = $formattedDay;

    $daily_clearance_requested[] = isset($daily_num_clearances[$day]['new']) ? $daily_num_clearances[$day]['new'] : 0;
    $daily_clearance_approved[] = isset($daily_num_clearances[$day]['approved']) ? $daily_num_clearances[$day]['approved'] : 0;
    $daily_clearance_disapproved[] = isset($daily_num_clearances[$day]['disapproved']) ? $daily_num_clearances[$day]['disapproved'] : 0;
}

// output the data as JSON
$data = array(
    'daily_clearance_labels' => $daily_clearance_labels,
    'daily_clearance_requested' => $daily_clearance_requested,
    'daily_clearance_approved' => $daily_clearance_approved,
    'daily_clearance_disapproved' => $daily_clearance_disapproved
);

header('Content-Type: application/json');
echo json_encode($data);