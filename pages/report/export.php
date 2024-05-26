<?php
if (!isset($_SESSION)) {
  include '../../include/session.inc.php';
  if (!isset($_SESSION['role'])) {
    header("Location: ../../login.php");
    exit();
  } elseif (($_SESSION['role'] !== "administrator") && ($_SESSION['role'] !== "captain") || ($_SESSION['role'] === "staff") || ($_SESSION['role'] === "resident")) {
    header("Location: ../../login.php");
    exit();
  } else {
    if (isset($_POST['export'])) {

      include '../../include/db.inc.php';

      // queries for generating excel report
      $SQL1 = "SELECT count(*) as 'numbers_of_resident', resident_purok FROM tblresident r GROUP BY r.resident_purok";
      $SQL2 = "SELECT count(*) as 'numbers_of_resident', resident_educational_attainment FROM tblresident GROUP BY resident_educational_attainment";
      $SQL3 = "SELECT COUNT(*) as 'numbers_of_resident', resident_age FROM tblresident GROUP BY resident_age";
      $SQL4 = "SELECT 
                SUM(CASE WHEN clearance_status = 'new' THEN 1 ELSE 0 END) as 'new_clearances',
                SUM(CASE WHEN clearance_status = 'approved' THEN 1 ELSE 0 END) as 'approved_clearances',
                SUM(CASE WHEN clearance_status = 'disapproved' THEN 1 ELSE 0 END) as 'disapproved_clearances'
              FROM tblclearance";

      // combine queries and headers
      $arrsql = array($SQL1, $SQL2, $SQL3, $SQL4);
      $arrhead = array("Resident Per Purok", "Resident Educational Attainment", "Resident with this Age", "Barangay Clearance Tracking");

      foreach (array_combine($arrsql, $arrhead) as $value => $headers) {

        $header = "$headers\n";
        $result = '';
        $exportData = mysqli_query($con, $value) or die("Sql error : " . mysqli_error($con));
        $fields = mysqli_num_fields($exportData);

        for ($i = 0; $i < $fields; $i++) {
          $header .= mysqli_fetch_field_direct($exportData, $i)->name . "\t";
        }

        while ($row = mysqli_fetch_row($exportData)) {
          $line = '';
          foreach ($row as $value) {
            if ((!isset($value)) || ($value == "")) {
              $value = "\t";
            } else {
              $value = str_replace('"', '""', $value);
              $value = '"' . $value . '"' . "\t";
            }
            $line .= $value;
          }
          $result .= trim($line) . "\n";
        }

        $result = str_replace("\r", "", $result);

        if ($result == "") {
          $result = "\nNo Record(s) Found!\n";
        }

        header("Content-type: application/octet-stream");
        header("Content-Disposition: attachment; filename=generated-report.xls");
        header("Pragma: no-cache");
        header("Expires: 0");
        print "$header\n$result\n\n";
      }
    }
  }
}