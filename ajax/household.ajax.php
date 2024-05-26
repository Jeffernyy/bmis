<?php
include '../include/db.inc.php';

if (isset ($_POST['household_id'])) {

	$household_id = $_POST['household_id'];
	$stmt = mysqli_prepare($con, "SELECT id AS household_res_id, CONCAT(resident_fname, IF(resident_mname = 'n/a', '', CONCAT(' ', resident_mname)), ' ', resident_lname) as household_res_name FROM tblresident WHERE resident_household_num = ?");
	mysqli_stmt_bind_param($stmt, "s", $household_id);
	mysqli_stmt_execute($stmt);
	$result = mysqli_stmt_get_result($stmt);

	if ($result) {

		echo '<option selected disabled>Please select the head of family</option>';
		while ($row = mysqli_fetch_assoc($result)) {
			echo '<option value="' . $row['household_res_id'] . '">' . $row['household_res_name'] . '</option>';
		}

	} else {
		echo '<option selected disabled>No existing head of family for household # entered</option>';
	}
	mysqli_stmt_close($stmt);
}

if (isset ($_POST['purok_id'])) {

	$purok_id = $_POST['purok_id'];
	$stmt = mysqli_prepare($con, "SELECT resident_purok FROM tblresident WHERE id = ?");
	mysqli_stmt_bind_param($stmt, "s", $purok_id);
	mysqli_stmt_execute($stmt);
	$result = mysqli_stmt_get_result($stmt);

	if ($result) {

		$row = mysqli_fetch_assoc($result);
		echo "<script>document.getElementsByName('txt_add_household_purok')[0].value = '" . $row['resident_purok'] . "';</script>";

	} else {
		echo '<option selected disabled>No existing head of family for household # entered</option>';
	}
	mysqli_stmt_close($stmt);
}

if (isset ($_POST['total_household_mem_id'])) {

	$total_household_mem_id = $_POST['total_household_mem_id'];
	$stmt = mysqli_prepare($con, "SELECT resident_total_household_mem FROM tblresident WHERE id = ?");
	mysqli_stmt_bind_param($stmt, "s", $total_household_mem_id);
	mysqli_stmt_execute($stmt);
	$result = mysqli_stmt_get_result($stmt);

	if ($result) {

		$row = mysqli_fetch_assoc($result);
		echo "<script>document.getElementsByName('txt_add_household_total_household_mem')[0].value = '" . $row['resident_total_household_mem'] . "';</script>";

	} else {
		echo '<option selected disabled>No existing head of family for household # entered</option>';
	}
	mysqli_stmt_close($stmt);
}