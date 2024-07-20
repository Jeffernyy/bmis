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
    include '../../include/global.inc.php';
    if (isset($_POST['export_indigent'])) { ?>

      <!DOCTYPE html>
      <html lang="en">

      <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=7">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <style>
          body {
            margin: 25mm 25mm;
          }

          @media print {
            .noprint {
              display: none;
            }

            @page {
              size: A4;
              margin: 18mm;
            }

            body {
              margin: 0px !important;
            }

            .header {
              display: flex;
              align-items: flex-start;
              justify-content: space-between;
            }

            .header img {
              width: 150px;
              height: 150px;
            }

            .content .dataTables_wrapper {
              margin: 0 0 5rem 0;
            }
          }

          .header {
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
          }

          .header img {
            width: 150px;
            height: 150px;
          }

          .content .dataTables_wrapper,
          .content #daily-report.table,
          .content #weekly-report.table,
          .content #monthly-report.table,
          .content #yearly-report.table {
            margin: 0 0 5rem 0;
          }

          .page-item.disabled .page-link {
            color: #6c757d !important;
          }
        </style>
      </head>

      <body>
        <div class="container">
          <div class="header">
            <img src="../../assets/img/city-logo.png" alt="City Logo">
            <div class="text-center">
              <h4><i>Republic of the Philippines</i></h4>
              <h4><i>Province of Davao del Norte</i></h4>
              <h4><i>City of Panabo</i></h4>
              <h4 class="text-uppercase text-bold font-italic">barangay new pandan</h4>
              <h4><i>---0---</i></h4>
              <h4 class="text-uppercase text-bold font-italic">office of the punong barangay</h4>
            </div>
            <img src="../../assets/img/brgy-logo.png" alt="Brgy Logo">
          </div>
          <hr class="my-5" style="border: 2px solid #777777">
          <h1 class="text-center text-uppercase text-bold font-italic mb-5">barangay indigent report</h1>
          <div class="content">
            <!-- display the table data here from the indigent report -->
            <h2>Daily Report</h2>
            <table id="daily-report" class="table table-bordered table-striped table-hover">
              <thead>
                <tr>
                  <th>Date</th>
                  <th>Requested</th>
                  <th>Approved</th>
                  <th>Disapproved</th>
                </tr>
              </thead>
              <tbody>
                <!-- daily report data will be inserted here -->
              </tbody>
            </table>

            <h2>Weekly Report</h2>
            <table id="weekly-report" class="table table-bordered table-striped table-hover">
              <thead>
                <tr>
                  <th>Week</th>
                  <th>Requested</th>
                  <th>Approved</th>
                  <th>Disapproved</th>
                </tr>
              </thead>
              <tbody>
                <!-- weekly report data will be inserted here -->
              </tbody>
            </table>

            <h2>Monthly Report</h2>
            <table id="monthly-report" class="table table-bordered table-striped table-hover">
              <thead>
                <tr>
                  <th>Month</th>
                  <th>Requested</th>
                  <th>Approved</th>
                  <th>Disapproved</th>
                </tr>
              </thead>
              <tbody>
                <!-- monthly report data will be inserted here -->
              </tbody>
            </table>

            <h2>Yearly Report</h2>
            <table id="yearly-report" class="table table-bordered table-striped table-hover">
              <thead>
                <tr>
                  <th>Year</th>
                  <th>Requested</th>
                  <th>Approved</th>
                  <th>Disapproved</th>
                </tr>
              </thead>
              <tbody>
                <!-- yearly report data will be inserted here -->
              </tbody>
            </table>
          </div>
          <button class="noprint btn btn-primary btn-block my-5" id="printpagebutton"
            onclick="handlePrintButtonClick()">Print</button>
        </div>

        <?php include '../../include/footer.inc.php' ?>

        <script>
          $(document).ready(function () {
            function fetchData(period, tableId) {
              let url;
              switch (period) {
                case 'daily':
                  url = '../../ajax/daily.ndgnt.ajax.php';
                  break;
                case 'weekly':
                  url = '../../ajax/weekly.ndgnt.ajax.php';
                  break;
                case 'monthly':
                  url = '../../ajax/monthly.ndgnt.ajax.php';
                  break;
                case 'yearly':
                  url = '../../ajax/yearly.ndgnt.ajax.php';
                  break;
              }

              $.ajax({
                url: url,
                type: 'GET',
                dataType: 'json',
                success: function (data) {
                  populateTable(data, tableId, period);
                  initializeDataTable(tableId);
                },
                error: function (xhr, status, error) {
                  console.error('Error fetching data:', error);
                }
              });
            }

            function populateTable(data, tableId, period) {
              const tableBody = $('#' + tableId + ' tbody');
              tableBody.empty();

              let labels, requested, approved, disapproved;

              switch (period) {
                case 'daily':
                  labels = data.daily_indigent_labels || [];
                  requested = data.daily_indigent_requested || [];
                  approved = data.daily_indigent_approved || [];
                  disapproved = data.daily_indigent_disapproved || [];
                  break;
                case 'weekly':
                  labels = data.weekly_indigent_labels || [];
                  requested = data.weekly_indigent_requested || [];
                  approved = data.weekly_indigent_approved || [];
                  disapproved = data.weekly_indigent_disapproved || [];
                  break;
                case 'monthly':
                  labels = data.monthly_indigent_labels || [];
                  requested = data.monthly_indigent_requested || [];
                  approved = data.monthly_indigent_approved || [];
                  disapproved = data.monthly_indigent_disapproved || [];
                  break;
                case 'yearly':
                  labels = data.yearly_indigent_labels || [];
                  requested = data.yearly_indigent_requested || [];
                  approved = data.yearly_indigent_approved || [];
                  disapproved = data.yearly_indigent_disapproved || [];
                  break;
              }

              for (let i = 0; i < labels.length; i++) {
                const row = `<tr><td>${labels[i]}</td><td>${requested[i] || 0}</td><td>${approved[i] || 0}</td><td>${disapproved[i] || 0}</td></tr>`;
                tableBody.append(row);
              }
            }

            function initializeDataTable(tableId) {
              $('#' + tableId).DataTable({
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
                "buttons": [
                  {
                    extend: 'copy',
                    text: 'Copy'
                  },
                  {
                    extend: 'csv',
                    text: 'CSV'
                  },
                  {
                    extend: 'excel',
                    text: 'Excel',
                    customize: function (xlsx) {
                      const sheet = xlsx.xl.worksheets['sheet1.xml'];
                      $('row c[r^="C"]', sheet).attr('s', '2');
                    }
                  },
                  {
                    extend: 'pdf',
                    text: 'PDF',
                    customize: function (doc) {
                      doc.content.splice(0, 0, {
                        text: 'Barangay Certificate of Indigency Report',
                        style: 'header'
                      });
                    }
                  },
                  {
                    extend: 'print',
                    text: 'Print',
                    customize: function (win) {
                      const template = '<div class="container">' +
                        '<div class="header">' +
                        '<img src="../../assets/img/city-logo.png" alt="City Logo">' +
                        '<div class="text-center">' +
                        '<h4><i>Republic of the Philippines</i></h4>' +
                        '<h4><i>Province of Davao del Norte</i></h4>' +
                        '<h4><i>City of Panabo</i></h4>' +
                        '<h4 class="text-uppercase text-bold font-italic">barangay new pandan</h4>' +
                        '<h4><i>---0---</i></h4>' +
                        '<h4 class="text-uppercase text-bold font-italic">office of the punong barangay</h4>' +
                        '</div>' +
                        '<img src="../../assets/img/brgy-logo.png" alt="Brgy Logo">' +
                        '</div>' +
                        '<hr class="my-5" style="border: 2px solid #777777">' +
                        '<h1 class="text-center text-uppercase text-bold font-italic mb-5">barangay blotter report</h1>' +
                        '<div>' + $(win.document.body).find('table')[0].outerHTML + '</div>' +
                        '</div>';
                      $(win.document.body).empty().append(template);
                    }
                  },
                ],
                "paging": true,
                "searching": true,
                "ordering": true,
                "info": true,
                "aaSorting": []
              }).buttons().container().appendTo('#' + tableId + '_wrapper .col-md-6:eq(0)');
            }

            // fetch data for all reports and initialize DataTables
            fetchData('daily', 'daily-report');
            fetchData('weekly', 'weekly-report');
            fetchData('monthly', 'monthly-report');
            fetchData('yearly', 'yearly-report');
          });

          function handlePrintButtonClick() {
            window.print();
          }
        </script>
      </body>

      </html>
      <?php
    }
  }
}