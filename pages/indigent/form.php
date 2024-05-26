<!DOCTYPE html>
<html id="indigent">

<head>
  <style>
    body {
      margin: 25mm 25mm !important;
    }

    @media print {
      .noprint {
        visibility: hidden;
      }

      @page {
        size: auto;
        margin: 25mm 25mm 25mm 25mm;
      }

      body {
        margin: 0px !important;
      }
    }
  </style>
</head>

<?php
include ('../../include/session.inc.php');
if (!isset($_SESSION['role'])) {
  header("location: ../../login.php");
  exit();

} elseif (!isset($_GET['indigent']) || !isset($_GET['resident'])) {
  header("location: ../../login.php");
  exit();

} else {
  ob_start();
  $_SESSION['clr'] = $_GET['indigent'];
  include '../../include/global.inc.php';
  ?>

  <body>
    <div class="">
      <div class="d-flex align-items-start justify-content-between w-100 f-100">
        <div class="">
          <img style="width: 150px; height: 150px;" src="../../assets/img/city-logo.png" alt="Logo">
        </div>
        <div class="text-center">
          <h4><i>Republic of the Philippines</i></h4>
          <h4><i>Province of Davao del Norte</i></h4>
          <h4><i>City of Panabo</i></h4>
          <h4 class="text-uppercase text-bold font-italic">barangay new pandan</h4>
          <h4><i>---0---</i></h4>
          <h4 class="text-uppercase text-bold font-italic">office of the punong barangay</h4>
        </div>
        <div class="">
          <img style="width: 150px; height: 150px;" src="../../assets/img/brgy-logo.png" alt="Logo">
        </div>
      </div>
      <hr class="my-5" style="border: 2px solid #777777">
      <h1 class="text-center text-uppercase text-bold mb-5">certificate of indigency</h1>
      <h4 class="text-uppercase font-italic mb-4">to whom it may concern:</h4>
      <div class="d-flex align-items-center justify-content-center w-100 h-100">

        <?php
        function numberToWords($number)
        {
          $words = array(
            '',
            'one',
            'two',
            'three',
            'four',
            'five',
            'six',
            'seven',
            'eight',
            'nine',
            'ten',
            'eleven',
            'twelve',
            'thirteen',
            'fourteen',
            'fifteen',
            'sixteen',
            'seventeen',
            'eighteen',
            'nineteen',
            'twenty'
          );

          if ($number <= 20) {
            return $words[$number];
          }

          if ($number < 100) {
            return $words[($number / 10)] . ' ' . $words[$number % 10];
          }

          return '';
        }

        function addDaySuffix($day)
        {
          $day = ltrim($day, '0');

          if ($day >= 11 && $day <= 13) {

            return $day . '<sup>th</sup>';

          } else {
            switch ($day % 10) {

              case 1:
                return $day . '<sup>st</sup>';

              case 2:
                return $day . '<sup>nd</sup>';

              case 3:
                return $day . '<sup>rd</sup>';

              default:
                return $day . '<sup>th</sup>';
            }
          }
        }

        include '../../include/db.inc.php';

        $btncheck_stmt = mysqli_prepare($con, "SELECT *, CONCAT(resident_fname,
        IF(resident_mname = 'n/a', '', CONCAT(' ', resident_mname)), ' ', resident_lname) AS indigent_res_name
        FROM tblresident r
        LEFT JOIN tblindigent c ON c.indigent_res_id = r.id
        WHERE indigent_res_id = ? AND indigent_num = ?");

        mysqli_stmt_bind_param($btncheck_stmt, "is", $_GET['resident'], $_GET['indigent']);
        mysqli_stmt_execute($btncheck_stmt);
        $btncheck_stmt_res = mysqli_stmt_get_result($btncheck_stmt);

        $tblchck_stmt = mysqli_prepare($con, "SELECT p.*, 
        CASE
        WHEN r1.id IS NOT NULL THEN CONCAT(r1.resident_fname, 
        IF(r1.resident_mname = 'n/a', '', CONCAT(' ', SUBSTRING(r1.resident_mname, 1, 1), '.')), 
        ' ', r1.resident_lname)
        WHEN p.indigent_res_id REGEXP '^[0-9]+$' THEN (SELECT CONCAT(resident_fname, 
        IF(resident_mname = 'n/a', '', CONCAT(' ', SUBSTRING(resident_mname, 1, 1), '.')), 
        ' ', resident_lname) FROM tblresident WHERE id = p.indigent_res_id) 
            ELSE p.indigent_res_id
            END AS indigent_resident_name,
        CASE 
            WHEN r2.id IS NOT NULL THEN CONCAT(r2.resident_fname, 
        IF(r2.resident_mname = 'n/a', '', CONCAT(' ', SUBSTRING(r2.resident_mname, 1, 1), '.')), 
        ' ', r2.resident_lname)
            WHEN p.indigent_requester_res_id REGEXP '^[0-9]+$' THEN (SELECT CONCAT(resident_fname, 
        IF(resident_mname = 'n/a', '', CONCAT(' ', SUBSTRING(resident_mname, 1, 1), '.')), 
        ' ', resident_lname) FROM tblresident WHERE id = p.indigent_requester_res_id) 
            ELSE p.indigent_requester_res_id 
        END AS indigent_requester_res_name,
          r1.resident_birth_date,
          r1.resident_civil_status,
          r1.resident_relationship_to_head,
          r1.resident_age,
          r1.resident_purok
          FROM tblindigent p 
          LEFT JOIN tblresident r1 ON r1.id = p.indigent_res_id 
          LEFT JOIN tblresident r2 ON r2.id = p.indigent_requester_res_id 
          WHERE indigent_res_id = ? AND indigent_num = ?");

        mysqli_stmt_bind_param($tblchck_stmt, "is", $_GET['resident'], $_GET['indigent']);
        mysqli_stmt_execute($tblchck_stmt);
        $tblchck_stmt_res = mysqli_stmt_get_result($tblchck_stmt);

        // initialize the variable to false
        $disablePrintButton = false;

        if (mysqli_num_rows($btncheck_stmt_res) == 0) { ?>
          <?php

          $message = "<h3><em>Resident ID not found in the database.</em></h3>";
          echo $message;
          $disablePrintButton = true; ?>

          <?php
        } else { ?>
          <?php

          while ($row = mysqli_fetch_array($tblchck_stmt_res)) { ?>
            <?php
            $indigent_resident_name = $row['indigent_resident_name'];
            $indigent_resident_name_class = $indigent_resident_name === null ? 'text-danger text-lowercase' : '';

            $requester_res_name = $row['indigent_requester_res_name'];
            $requester_name_class = $requester_res_name === null ? 'text-danger text-lowercase' : '';

            $check_date = $row['indigent_date_approved'] != 'n/a' || $row['indigent_date_added'] == 'n/a' ? $row['indigent_date_approved'] : $row['indigent_date_added'];

            $date = date_create($check_date);
            $day = date_format($date, 'd');
            $month = date_format($date, 'F');
            $year = date_format($date, 'Y');
            $dayWithSuffix = addDaySuffix($day); ?>

            <div>
              <h4 class="mb-4" style="line-height: 1.55">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; This is to certify that
                <strong>
                  <?php echo ucwords(strtolower(htmlspecialchars($indigent_resident_name))) ?>,
                </strong>
                <strong>
                  <?php echo htmlspecialchars($row['resident_age']) ?>
                </strong> years
                old,
                <?php echo $row['resident_civil_status'] ?>, is a resident of
                Purok
                <?php echo ucwords(strtolower(htmlspecialchars($row['resident_purok']))) ?>, Barangay New Pandan,
                Panabo City.
              </h4>
              <h4 class="mb-4" style="line-height: 1.55">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; This is to certify further that
                the
                aforementioned name <strong>belongs to the indigent families,</strong> this barangay.
              </h4>

              <?php
              if ($row['indigent_requester_res_id'] == 'n/a') { ?>
                <h4 class="mb-4" style="line-height: 1.55">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; This certification is being issued
                  upon verbal request of the above-mentioned to seek/avail <strong>
                    <?php echo htmlspecialchars($row['indigent_purpose']) ?>
                  </strong> from
                  <strong>
                    <?php echo htmlspecialchars($row['indigent_gov_office']) ?>.
                  </strong>
                </h4>
              <?php } elseif (is_numeric($row['indigent_requester_res_name'])) { ?>
                <h4 class="mb-4" style="line-height: 1.55">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; This certification is being issued
                  upon the verbal request of the resident with ID
                  <strong>
                    <?php echo htmlspecialchars($row['indigent_requester_res_name']); ?>
                  </strong>
                  for whatever legal purposes it may serve him/her best.
                </h4>
              <?php } else { ?>
                <h4 class="mb-4" style="line-height: 1.55">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; This certification is being issued
                  upon verbal request of
                  <strong class="<?php echo $requester_name_class ?>">
                    <?php echo ucwords(strtolower(htmlspecialchars($row['indigent_requester_res_name']))) ?>,
                  </strong> <strong><?php echo htmlspecialchars($row['resident_relationship_to_head']) ?></strong> of the
                  above-mentioned to seek <strong><?php echo htmlspecialchars($row['indigent_purpose']) ?></strong> from
                  <strong>
                    <?php echo htmlspecialchars($row['indigent_gov_office']) ?>.
                  </strong>
                </h4>
              <?php } ?>

              <h4 style="line-height: 1.55">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Done/issued this
                <?php echo $dayWithSuffix ?> day of
                <?php echo htmlspecialchars($month) ?>,
                <?php echo htmlspecialchars($year) ?> at Barangay Hall, New Pandan, Panabo City.
              </h4>
            </div>
            <?php
          } ?>

        </div>
        <div class="d-flex align-items-center justify-content-end" style="margin: 175px 0 0">

          <?php
          $stmt = mysqli_prepare($con, "SELECT 
                  tblindigent.*, 
                  tblofficer.officer_fname, 
                  tblofficer.officer_mname, 
                  tblofficer.officer_lname, 
                  tblofficer.officer_position,
                  (SELECT COUNT(*) FROM tblofficial WHERE official_position = 'punong barangay') AS punong_barangay_count
                  FROM tblindigent 
                  JOIN tblofficer ON tblindigent.indigent_officer_res_id = tblofficer.id 
                  WHERE indigent_res_id = ? AND indigent_num = ?");

          mysqli_stmt_bind_param($stmt, "ii", $_GET['resident'], $_GET['indigent']);
          mysqli_stmt_execute($stmt);

          $result = mysqli_stmt_get_result($stmt);

          while ($get_officer_info = mysqli_fetch_array($result)) {
            if ($get_officer_info['indigent_officer_res_id'] !== 'n/a' && $get_officer_info['punong_barangay_count'] > 0) { ?>
              <div style="margin: 0 140px 0 0">
                <h5 class="text-center font-italic">
                  By Authority of the<br>
                  Punong Barangay:
                </h5>
              </div>
            <?php } else { ?>
              <div class="d-none" style="margin: 0 140px 0 0">
                <h5 class="text-center font-italic">
                  By Authority of the<br>
                  Punong Barangay:
                </h5>
              </div>
              <?php
            }
          } ?>


          <div style="margin: 0 40px 0 0">
            <?php
            // check if there is at least one official with the specified position
            $query_position = mysqli_query($con, "SELECT COUNT(*) AS count FROM tblofficial WHERE official_position = 'punong barangay'");
            $row_position = mysqli_fetch_assoc($query_position);
            $count_position = $row_position['count'];

            if ($count_position > 0) {
              // if there's at least one official with the specified position
              $query = mysqli_query($con, "SELECT tblofficial.*, tblresident.resident_fname, tblresident.resident_mname, tblresident.resident_lname FROM tblofficial JOIN tblresident ON tblofficial.official_res_id = tblresident.id WHERE official_position = 'punong barangay'");

              while ($row = mysqli_fetch_array($query)) {

                $middleName = $row['resident_mname'];

                if (!empty($middleName)) {

                  $middleInitial = substr($middleName, 0, 1);
                  $fullName = $row['resident_fname'] . ' ' . $middleInitial . '. ' . $row['resident_lname'];

                } else {
                  $fullName = $row['resident_fname'] . ' ' . $row['resident_lname'];
                } ?>

                <h4 class="text-center text-bold">
                  <?php echo ucwords(strtoupper(htmlspecialchars($fullName))); ?>
                </h4>

                <h4 class="text-capitalize text-center">
                  <?php echo ucwords(strtolower(htmlspecialchars($row['official_position']))); ?>
                </h4>

                <?php

                // check if the official status is not ongoing term
                if ($row['official_status'] !== 'ongoing term') {
                  ?>

                  <h4 class="text-center text-danger">Error:
                    <?php echo ucwords(strtolower(htmlspecialchars($fullName))); ?> official
                    <br>status is not ongoing term.
                  </h4>

                  <?php
                  $disablePrintButton = true;
                }

                ?>         <?php
                         $stmt = mysqli_prepare($con, "SELECT tblindigent.*, tblofficer.officer_fname, tblofficer.officer_mname, tblofficer.officer_lname, tblofficer.officer_position FROM tblindigent JOIN tblofficer ON tblindigent.indigent_officer_res_id = tblofficer.id WHERE indigent_res_id = ? AND indigent_num = ?");

                         mysqli_stmt_bind_param($stmt, "ii", $_GET['resident'], $_GET['indigent']);
                         mysqli_stmt_execute($stmt);

                         $result = mysqli_stmt_get_result($stmt) ?>
                <?php

                while ($get_officer_info = mysqli_fetch_array($result)) { ?>
                  <?php
                  if ($get_officer_info['indigent_officer_res_id'] !== 'n/a') { ?>
                    <br>
                    <br>
                    <br>
                    <?php
                  } ?>
                  <?php
                } ?>         <?php

                          $stmt = mysqli_prepare($con, "SELECT tblindigent.*, tblofficer.officer_fname, tblofficer.officer_mname, tblofficer.officer_lname, tblofficer.officer_position FROM tblindigent JOIN tblofficer ON tblindigent.indigent_officer_res_id = tblofficer.id WHERE indigent_res_id = ? AND indigent_num = ?");

                          mysqli_stmt_bind_param($stmt, "ii", $_GET['resident'], $_GET['indigent']);
                          mysqli_stmt_execute($stmt);

                          $result = mysqli_stmt_get_result($stmt);

                          while ($get_officer_info = mysqli_fetch_array($result)) {

                            $officer_mname = $get_officer_info['officer_mname'];

                            if (!empty($officer_mname)) {

                              $officer_minitial = substr($officer_mname, 0, 1);
                              $fullName = $get_officer_info['officer_fname'] . ' ' . $officer_minitial . '. ' . $get_officer_info['officer_lname'];

                            } else {

                              $fullName = $get_officer_info['officer_fname'] . ' ' . $get_officer_info['officer_lname'];

                            } ?>

                  <h4 class="text-center text-bold">
                    <?php echo ucwords(strtoupper(htmlspecialchars($fullName))); ?>
                  </h4>

                  <h4 class="text-center">
                    <?php
                    if ($get_officer_info['officer_position'] === 'Barangay kagawad') {
                      ?>
                      <em><?php echo ucwords(strtolower(htmlspecialchars($get_officer_info['officer_position']))); ?></em>/<em>Officer
                        of
                        the
                        day</em>
                      <?php
                    } else { ?>
                      <strong><em><?php echo ucwords(strtoupper(htmlspecialchars($get_officer_info['officer_position']))); ?></em></strong>/<em>Officer
                        of
                        the
                        day</em>
                      <?php
                    }
                    ?>
                  </h4>
                  <?php
                          }
              }

            } else { ?>

              <h4 class="text-center text-danger">Error: Please select punong barangay official
                <br>position with ongoing term.
              </h4>

              <?php
              $disablePrintButton = true;
            } ?>

          </div>
        </div>
        <button class="noprint btn btn-primary btn-block my-5" id="printpagebutton" <?php if ($disablePrintButton)
          echo 'disabled' ?> onclick="handlePrintButtonClick('#indigent')">Print</button>
        </div>
      </body>

      <script>
        function Popup(data) {
          var mywindow = window.open('', 'main', '');
          var printButton = document.getElementById("printpagebutton");
          printButton.style.visibility = 'hidden';
          mywindow.document.write(data);
          mywindow.document.close();
          mywindow.focus();
          mywindow.print();
          printButton.style.visibility = 'visible';
          mywindow.close();
          return true;
        }

        function handlePrintButtonClick() {
          if (<?php echo $disablePrintButton ? 'true' : 'false' ?>) {
          // prevent printing if the button is disabled
          $message = "The print button is disabled, this is a system feature...";
          console.log($message);
          return false;
        } else {
          // allow printing if the button is enabled
          window.print();
        }
      }
    </script>

    </html>
  <?php }
} ?>