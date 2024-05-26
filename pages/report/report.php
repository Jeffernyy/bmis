<!DOCTYPE html>
<html lang="en">
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
    ob_start();
    include '../../include/global.inc.php' ?>

    <body class="hold-transition dark-mode sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
      <div class="wrapper">

        <!-- preloader -->
        <div class="preloader flex-column justify-content-center align-items-center">
          <img class="animation__wobble" src="../../assets/img/brgy-logo.png" alt="Brgy Logo" height="200" width="200">
        </div>

        <!-- navbar -->
        <?php include '../../include/db.inc.php' ?>
        <?php include '../header.php' ?>

        <!-- main sidebar -->
        <?php include '../sidebar.php' ?>

        <!-- content wrapper -->
        <div class="content-wrapper">
          <!-- content header -->
          <section class="content-header">
            <div class="container-fluid">
              <div class="row mb-2">
                <div class="col-sm-6">
                  <h1>Manage System Reports</h1>
                </div>
                <div class="col-sm-6">
                  <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Manage System Reports</li>
                  </ol>
                </div>
              </div>
            </div>
          </section>

          <!-- main content -->
          <section class="content">
            <div class="container-fluid">
              <div class="row">
                <div class="col-md-12">
                  <div class="card card-primary card-outline">
                    <div class="card-header">
                      <form action="export.php" method="post">
                        <button class="btn btn-primary" type="submit" name="export"><i class="fas fa-download"
                            aria-hidden="true"></i>&nbsp Export Report</button>
                      </form>
                    </div>
                  </div>
                </div>
                <div class="col-md-12">
                  <!-- purok area chart -->
                  <div class="card card-secondary">
                    <div class="card-header">
                      <h3 class="card-title">Resident Per Purok Area Chart</h3>
                      <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                          <i class="fas fa-minus"></i>
                        </button>
                      </div>
                    </div>
                    <div class="card-body">
                      <div class="chart">
                        <canvas id="purok" style="position: relative; height:40vh; width:80vw"></canvas>
                      </div>
                    </div>
                  </div>
                  <!-- educ pie chart -->
                  <div class="card card-secondary">
                    <div class="card-header">
                      <h3 class="card-title">Educational Attainment Pie Chart</h3>
                      <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                          <i class="fas fa-minus"></i>
                        </button>
                      </div>
                    </div>
                    <div class="card-body">
                      <div class="chart-container">
                        <div class="chart">
                          <canvas id="educ" style="position: relative; height:40vh; width:100%"></canvas>
                        </div>
                      </div>
                    </div>
                  </div>
                  <!-- age bar chart -->
                  <div class="card card-secondary">
                    <div class="card-header">
                      <h3 class="card-title">Resident with this Age Bar Chart</h3>
                      <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                          <i class="fas fa-minus"></i>
                        </button>
                      </div>
                    </div>
                    <div class="card-body">
                      <div class="chart">
                        <canvas id="age" style="position: relative; height:40vh; width:80vw"></canvas>
                      </div>
                    </div>
                  </div>
                  <!-- clearance bar chart -->
                  <div class="card card-secondary">
                    <div class="card-header">
                      <h3 class="card-title">Barangay Clearance Tracking Multi Functional Chart</h3>
                      <div class="card-tools">
                        <div class="btn-group">
                          <button type="button" class="btn btn-tool dropdown-toggle" data-toggle="dropdown">
                            <i class="fas fa-ellipsis-v"></i>
                          </button>
                          <div class="dropdown-menu dropdown-menu-right" role="menu">
                            <a role="button" class="dropdown-item" data-period="daily">Daily</a>
                            <hr class="dropdown-divider">
                            </hr>
                            <a role="button" class="dropdown-item" data-period="weekly">Weekly</a>
                            <hr class="dropdown-divider">
                            </hr>
                            <a role="button" class="dropdown-item" data-period="monthly">Monthly</a>
                            <hr class="dropdown-divider">
                            </hr>
                            <a role="button" class="dropdown-item" data-period="yearly">Yearly</a>
                          </div>
                        </div>
                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                          <i class="fas fa-minus"></i>
                        </button>
                      </div>
                    </div>
                    <div class="card-body">
                      <div class="chart">
                        <canvas id="clearanceReporting" style="position: relative; height:40vh; width:80vw"></canvas>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </section>
        </div>
      </div>
    <?php }
}
include '../../include/footer.inc.php';
include 'purok.php';
include 'educ.php';
include 'age.php';
?>
  <script>
    $(document).ready(function () {
      // initialize the chart
      var areaChartCanvas = document.getElementById('clearanceReporting').getContext('2d');
      window.clearanceChart = createChart(areaChartCanvas);

      // default to showing daily report
      fetchData('daily');

      // handle dropdown selection
      $('.dropdown-item').click(function () {
        var period = $(this).data('period');
        fetchData(period);
      });

      // ajax call to fetch data from db
      function fetchData(period) {
        var url;
        switch (period) {

          case 'daily':
            url = '../../ajax/daily.clrnc.ajax.php';
            break;

          case 'weekly':
            url = '../../ajax/weekly.clrnc.ajax.php';
            break;

          case 'monthly':
            url = '../../ajax/monthly.clrnc.ajax.php';
            break;

          case 'yearly':
            url = '../../ajax/yearly.clrnc.ajax.php';
            break;
        }

        $.ajax({
          url: url,
          type: 'GET',
          dataType: 'json',
          success: function (data) {
            updateChart(data);
          },
          error: function (xhr, status, error) {
            console.error('Error fetching data:', error);
          }
        });
      }

      function updateChart(data) {
        // debugging
        console.log('Received...', data);

        // convert data arrays to numeric values for daily report
        var daily_requested = data.daily_clearance_requested ? data.daily_clearance_requested.map(Number) : [];
        var daily_approved = data.daily_clearance_approved ? data.daily_clearance_approved.map(Number) : [];
        var daily_disapproved = data.daily_clearance_disapproved ? data.daily_clearance_disapproved.map(Number) : [];

        // update chart data for daily report
        clearanceChart.data.labels = data.daily_clearance_labels || [];
        clearanceChart.data.datasets[0].data = daily_requested;
        clearanceChart.data.datasets[1].data = daily_approved;
        clearanceChart.data.datasets[2].data = daily_disapproved;

        // update chart data for weekly report
        if (data.weekly_clearance_labels && data.weekly_clearance_requested && data.weekly_clearance_approved && data.weekly_clearance_disapproved) {
          var weekly_requested = data.weekly_clearance_requested.map(Number);
          var weekly_approved = data.weekly_clearance_approved.map(Number);
          var weekly_disapproved = data.weekly_clearance_disapproved.map(Number);

          clearanceChart.data.labels = data.weekly_clearance_labels;
          clearanceChart.data.datasets[0].data = weekly_requested;
          clearanceChart.data.datasets[1].data = weekly_approved;
          clearanceChart.data.datasets[2].data = weekly_disapproved;
        }

        // update chart data for monthly report
        if (data.monthly_clearance_labels && data.monthly_clearance_requested && data.monthly_clearance_approved && data.monthly_clearance_disapproved) {
          var monthly_requested = data.monthly_clearance_requested.map(Number);
          var monthly_approved = data.monthly_clearance_approved.map(Number);
          var monthly_disapproved = data.monthly_clearance_disapproved.map(Number);

          clearanceChart.data.labels = data.monthly_clearance_labels;
          clearanceChart.data.datasets[0].data = monthly_requested;
          clearanceChart.data.datasets[1].data = monthly_approved;
          clearanceChart.data.datasets[2].data = monthly_disapproved;
        }

        // update chart data for yearly report
        if (data.yearly_clearance_labels && data.yearly_clearance_requested && data.yearly_clearance_approved && data.yearly_clearance_disapproved) {
          var yearly_requested = data.yearly_clearance_requested.map(Number);
          var yearly_approved = data.yearly_clearance_approved.map(Number);
          var yearly_disapproved = data.yearly_clearance_disapproved.map(Number);

          clearanceChart.data.labels = data.yearly_clearance_labels;
          clearanceChart.data.datasets[0].data = yearly_requested;
          clearanceChart.data.datasets[1].data = yearly_approved;
          clearanceChart.data.datasets[2].data = yearly_disapproved;
        }

        clearanceChart.update();
      }

      function createChart(canvas) {
        // debugging
        console.log('Created...');
        var newGradient = canvas.createLinearGradient(0, 0, 0, 250);
        newGradient.addColorStop(0, 'rgba(255,205,86,1)');
        newGradient.addColorStop(1, 'rgba(255,205,86,0)');

        var disapprovedGradient = canvas.createLinearGradient(0, 0, 0, 250);
        disapprovedGradient.addColorStop(0, 'rgba(255,99,132,1)');
        disapprovedGradient.addColorStop(1, 'rgba(255,99,132,0)');

        return new Chart(canvas, {
          type: 'bar',
          data: {
            labels: [],
            datasets: [{
              label: 'New',
              data: [],
              backgroundColor: newGradient,
              order: 1
            },
            {
              label: 'Approved',
              data: [],
              backgroundColor: 'transparent',
              borderColor: 'rgba(54,162,235,1)',
              borderWidth: 5,
              pointRadius: 5,
              pointBackgroundColor: 'rgb(255,255,255)',
              pointBorderColor: 'rgb(255,255,255)',
              pointBorderWidth: 0,
              pointHoverRadius: 7,
              pointHoverBackgroundColor: 'rgb(220,220,220)',
              pointHoverBorderColor: 'rgb(220,220,220)',
              type: 'line',
              order: 0
            },
            {
              label: 'Disapproved',
              data: [],
              backgroundColor: disapprovedGradient,
              order: 1
            },
            ]
          },
          options: {
            maintainAspectRatio: false,
            responsive: true,
            animation: {
              duration: 1500
            },
            legend: {
              display: false
            },
            tooltips: {
              enabled: true,
              bodyFontSize: 14,
              backgroundColor: 'rgba(50, 50, 50, 0.7)',
              bodyFontColor: 'white',
              titleFontColor: 'white',
            },
            scales: {
              xAxes: [{
                gridLines: {
                  display: true,
                  color: '#4f4f4f'
                },
                ticks: {
                  fontColor: '#d6d6d6'
                }
              }],
              yAxes: [{
                gridLines: {
                  display: true,
                  color: '#4f4f4f'
                },
                ticks: {
                  fontColor: '#d6d6d6',
                  beginAtZero: true, // start y-axis from zero
                  stepSize: false, // specify the step size for y-axis labels
                  padding: 20
                }
              }]
            }
          }
        });
      }
    });
  </script>

</body>

</html>