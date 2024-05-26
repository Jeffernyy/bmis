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
    include '../../include/db.inc.php';

    $tables = array();
    $sql = "SHOW TABLES";
    $result = mysqli_query($con, $sql);

    while ($row = mysqli_fetch_row($result)) {
      $tables[] = $row[0];
    }

    $sqlScript = "";
    foreach ($tables as $table) {
      $query = "SHOW CREATE TABLE " . mysqli_real_escape_string($con, $table);
      $result = mysqli_query($con, $query);
      $row = mysqli_fetch_row($result);
      $sqlScript .= "\n\n" . $row[1] . ";\n\n";
      $query = "SELECT * FROM " . mysqli_real_escape_string($con, $table);
      $result = mysqli_query($con, $query);
      $columnCount = mysqli_num_fields($result);

      for ($i = 0; $i < $columnCount; $i++) {
        while ($row = mysqli_fetch_row($result)) {
          $sqlScript .= "INSERT INTO " . mysqli_real_escape_string($con, $table) . " VALUES(";
          for ($j = 0; $j < $columnCount; $j++) {
            if (isset($row[$j])) {
              $sqlScript .= '"' . mysqli_real_escape_string($con, $row[$j]) . '"';
            } else {
              $sqlScript .= '""';
            }
            if ($j < ($columnCount - 1)) {
              $sqlScript .= ',';
            }
          }
          $sqlScript .= ");\n";
        }
      }
      $sqlScript .= "\n";
    }

    if (!empty($sqlScript)) {
      // get the current date and time in a specific format (e.g., YYYY-MM-DD_His)
      $currentDatetime = date('m-d-Y h-i A');

      // Sanitize the database name for the backup file
      $backup_file_name = 'backup ' . $currentDatetime . '.sql';
      $backup_path = '/backup/' . $backup_file_name; // Adjust the backup directory as needed

      // Ensure the backup directory exists
      if (!file_exists($_SERVER['DOCUMENT_ROOT'] . '/backup')) {
        mkdir($_SERVER['DOCUMENT_ROOT'] . '/backup', 0777, true);
      }

      // Attempt to open the backup file for writing
      $fileHandler = fopen($_SERVER['DOCUMENT_ROOT'] . $backup_path, 'w+');

      if ($fileHandler) {
        // Write the SQL script to the backup file
        $number_of_lines = fwrite($fileHandler, $sqlScript);

        // Close the file handler
        fclose($fileHandler);

        // Check if the file was written successfully
        if ($number_of_lines !== false) {
          // Download the SQL backup file to the browser
          header('Content-Description: File Transfer');
          header('Content-Type: application/octet-stream');
          header('Content-Disposition: attachment; filename=' . basename($backup_file_name));
          header('Content-Transfer-Encoding: binary');
          header('Expires: 0');
          header('Cache-Control: must-revalidate');
          header('Pragma: public');
          header('Content-Length: ' . filesize($_SERVER['DOCUMENT_ROOT'] . $backup_path));
          ob_clean();
          flush();
          readfile($_SERVER['DOCUMENT_ROOT'] . $backup_path);

          // Securely delete the backup file
          unlink($_SERVER['DOCUMENT_ROOT'] . $backup_path);
          exit; // Terminate script execution after downloading the file
        } else {
          echo "Failed to write data to the backup file.";
        }
      } else {
        echo "Failed to create the backup file.";
      }
    } else {
      echo "No data to backup.";
    }
  }
}