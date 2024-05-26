<!DOCTYPE html>
<html id="clearance">

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
  header("Location: ../../login.php");
  exit();

} elseif (!isset($_GET['clearance']) || !isset($_GET['resident'])) {
  header("Location: ../../login.php");
  exit();

} else {
  ob_start();
  $_SESSION['clr'] = $_GET['clearance'];
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
      <h1 class="text-center text-uppercase text-bold font-italic mb-5">barangay clearance</h1>
      <h4 class="text-uppercase font-italic mb-4">to whom it may concern:</h4>
      <div class="d-flex align-items-center justify-content-center w-100 h-100">

        <?php
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

        $query = mysqli_query($con, "SELECT *, CONCAT(resident_fname,
                                     IF(resident_mname = 'n/a', '', CONCAT(' ', resident_mname)), ' ', resident_lname) AS clearance_res_name
                                     FROM tblresident r
                                     LEFT JOIN tblclearance c ON c.clearance_res_id = r.id
                                     WHERE clearance_res_id = " . $_GET['resident'] . " AND clearance_num = '" . $_GET['clearance'] . "' ");

        // initialize the variable to false
        $disablePrintButton = false;

        if (mysqli_num_rows($query) == 0) { ?>
          <?php
          $message = "<h4><em>Message: Clearance resident ID or resident name is not found.</em></h4>";
          echo $message;
          $disablePrintButton = true; ?>
          <?php
        } else { ?>
          <?php
          while ($row = mysqli_fetch_array($query)) { ?>
            <?php
            $check_date = $row['clearance_date_approved'] != 'n/a' || $row['clearance_date_added'] == 'n/a' ? $row['clearance_date_approved'] : $row['clearance_date_added'];
            $date = date_create($check_date);
            $day = date_format($date, 'd');
            $month = date_format($date, 'F');
            $year = date_format($date, 'Y');
            $dayWithSuffix = addDaySuffix($day);
            $res_civil_status = ucfirst(strtolower(htmlspecialchars($row['resident_civil_status'])));
            $echo_res_civil_status = $res_civil_status . '/' . $res_civil_status; ?>
            <div>
              <h4 class="mb-4" style="line-height: 1.55">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; This is to certify that
                <?php echo ucwords(strtolower(htmlspecialchars($row['clearance_res_name']))) ?>,
                <?php echo htmlspecialchars($row['resident_age']) ?>, years
                old,
                <?php echo $echo_res_civil_status ?> a bonafide resident of
                Purok
                <?php echo ucwords(strtolower(htmlspecialchars($row['resident_purok']))) ?>, Barangay New Pandan,
                Panabo City.
              </h4>
              <h4 class="mb-4" style="line-height: 1.55">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; This is to certify further that
                the
                above-mentioned has no criminal/civil records or any pending case filed against him/her.</h4>
              <h4 class="mb-4" style="line-height: 1.55">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; This certification is being issued
                upon
                the verbal request of the above-mentioned for whatever legal purposes it may serve him/her best.</h4>
              <h4 class="mb-4" style="line-height: 1.55">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Purpose:
                <?php echo htmlspecialchars(ucwords(strtolower($row['clearance_purpose']))) ?>
              </h4>
              <h4 style="line-height: 1.55">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Issued this on
                <?php echo $dayWithSuffix ?> day of
                <?php echo htmlspecialchars($month) ?>,
                <?php echo htmlspecialchars($year) ?> Barangay New Pandan, Panabo City.
              </h4>
            </div>
            <?php
          } ?>

        </div>
        <div class="d-flex align-items-center justify-content-end" style="margin: 175px 0 0">
          <div class="">
            <?php
            // Check if there is at least one official with the specified position
            $query_position = mysqli_query($con, "SELECT COUNT(*) AS count 
                                                  FROM tblofficial
                                                  WHERE official_position = 'punong barangay'");
            $row_position = mysqli_fetch_assoc($query_position);
            $count_position = $row_position['count'];

            if ($count_position > 0) {
              // If there's at least one official with the specified position
              $query = mysqli_query($con, "SELECT tblofficial.*, tblresident.resident_fname, tblresident.resident_mname, tblresident.resident_lname
                                           FROM tblofficial
                                           JOIN tblresident ON tblofficial.official_res_id = tblresident.id
                                           WHERE official_position = 'punong barangay'");

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
                // Check if the official status is not "ongoing term"
                if ($row['official_status'] !== 'ongoing term') {
                  ?>

                  <h4 class="text-center text-danger">Error:
                    <?php echo ucwords(strtolower(htmlspecialchars($fullName))); ?> official
                    <br>status is not ongoing term.
                  </h4>

                  <?php
                  $disablePrintButton = true;
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
          echo 'disabled' ?> onclick="handlePrintButtonClick('#clearance')">Print</button>
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