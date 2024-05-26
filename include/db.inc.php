<?php
// set default timezone to philippines timezone asia/manila
date_default_timezone_set('Asia/Manila');

// retrieve database credentials from environment variables
$db_host = getenv('DB_HOST');
$db_name = getenv('DB_NAME');
$db_user = getenv('DB_USER');
$db_pass = getenv('DB_PASS');

// create a mysqli connection
$con = new mysqli($db_host, $db_user, $db_pass, $db_name);

// check connection
if ($con->connect_error) {
	die("Connection failed: " . $con->connect_error);
}

// function to execute a query with prepared statements
function execute_query($con, $sql, $params = [])
{
	$stmt = $con->prepare($sql);

	if ($stmt === false) {
		die("Error preparing statement: " . $con->error);
	}

	if (!empty($params)) {

		$types = '';
		$bindParams = [&$types];

		foreach ($params as $param) {

			if (is_int($param)) {
				$types .= 'i';

			} elseif (is_float($param)) {
				$types .= 'd';

			} elseif (is_string($param)) {
				$types .= 's';

			} else {
				$types .= 's'; // default to string
			}

			$bindParams[] = &$param;

		}

		call_user_func_array([$stmt, 'bind_param'], $bindParams);

	}

	if (!$stmt->execute()) {
		die("Error executing statement: " . $stmt->error);
	}

	if ($stmt->field_count > 0) {
		$result = $stmt->get_result();
		return $result->fetch_all(MYSQLI_ASSOC);
	}

	return true; // for successful non select queries

}