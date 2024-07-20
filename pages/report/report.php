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
                  <!-- blotter bar chart -->
                  <div class="card card-secondary">
                    <div class="card-header">
                      <h3 class="card-title">Barangay Blotter Tracking Multi Functional Chart</h3>
                      <div class="card-tools">
                        <div class="btn-group">
                          <button type="button" class="btn btn-tool dropdown-toggle" data-toggle="dropdown"></button>
                          <div class="dropdown-menu dropdown-menu-right custom-dropdown-menu" role="menu">
                            <a role="button" class="dropdown-item" data-blotter="daily">Daily</a>
                            <hr class="dropdown-divider">
                            <a role="button" class="dropdown-item" data-blotter="weekly">Weekly</a>
                            <hr class="dropdown-divider">
                            <a role="button" class="dropdown-item" data-blotter="monthly">Monthly</a>
                            <hr class="dropdown-divider">
                            <a role="button" class="dropdown-item" data-blotter="yearly">Yearly</a>
                            <hr class="dropdown-divider">
                            <form id="exportBlotter" action="blotter_report.php" method="post">
                              <button role="button" class="dropdown-item" type="submit"
                                name="export_blotter">Export</button>
                            </form>
                          </div>
                        </div>
                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                          <i class="fas fa-minus"></i>
                        </button>
                      </div>
                    </div>
                    <div class="card-body">
                      <div class="chart">
                        <canvas id="blotter" style="position: relative; height:40vh; width:80vw"></canvas>
                      </div>
                    </div>
                  </div>
                  <!-- clearance bar chart -->
                  <div class="card card-secondary">
                    <div class="card-header">
                      <h3 class="card-title">Barangay Clearance Tracking Multi Functional Chart</h3>
                      <div class="card-tools">
                        <div class="btn-group">
                          <button type="button" class="btn btn-tool dropdown-toggle" data-toggle="dropdown"></button>
                          <div class="dropdown-menu dropdown-menu-right custom-dropdown-menu" role="menu">
                            <a role="button" class="dropdown-item" data-clearance="daily">Daily</a>
                            <hr class="dropdown-divider">
                            <a role="button" class="dropdown-item" data-clearance="weekly">Weekly</a>
                            <hr class="dropdown-divider">
                            <a role="button" class="dropdown-item" data-clearance="monthly">Monthly</a>
                            <hr class="dropdown-divider">
                            <a role="button" class="dropdown-item" data-clearance="yearly">Yearly</a>
                            <hr class="dropdown-divider">
                            <form id="exportClearance" action="clearance_report.php" method="post">
                              <button role="button" class="dropdown-item" type="submit"
                                name="export_clearance">Export</button>
                            </form>
                          </div>
                        </div>
                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                          <i class="fas fa-minus"></i>
                        </button>
                      </div>
                    </div>
                    <div class="card-body">
                      <div class="chart">
                        <canvas id="clearance" style="position: relative; height:40vh; width:80vw"></canvas>
                      </div>
                    </div>
                  </div>
                  <!-- indigent bar chart -->
                  <div class="card card-secondary">
                    <div class="card-header">
                      <h3 class="card-title">Barangay Indigent Certification Tracking Multi Functional Chart</h3>
                      <div class="card-tools">
                        <div class="btn-group">
                          <button type="button" class="btn btn-tool dropdown-toggle" data-toggle="dropdown"></button>
                          <div class="dropdown-menu dropdown-menu-right custom-dropdown-menu" role="menu">
                            <a role="button" class="dropdown-item" data-indigent="daily">Daily</a>
                            <hr class="dropdown-divider">
                            <a role="button" class="dropdown-item" data-indigent="weekly">Weekly</a>
                            <hr class="dropdown-divider">
                            <a role="button" class="dropdown-item" data-indigent="monthly">Monthly</a>
                            <hr class="dropdown-divider">
                            <a role="button" class="dropdown-item" data-indigent="yearly">Yearly</a>
                            <hr class="dropdown-divider">
                            <form id="exportIndigent" action="indigent_report.php" method="post">
                              <button role="button" class="dropdown-item" type="submit"
                                name="export_indigent">Export</button>
                            </form>
                          </div>
                        </div>
                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                          <i class="fas fa-minus"></i>
                        </button>
                      </div>
                    </div>
                    <div class="card-body">
                      <div class="chart">
                        <canvas id="indigent" style="position: relative; height:40vh; width:80vw"></canvas>
                      </div>
                    </div>
                  </div>
                  <!-- lowincome bar chart -->
                  <div class="card card-secondary">
                    <div class="card-header">
                      <h3 class="card-title">Barangay Lowincome Certification Tracking Multi Functional Chart</h3>
                      <div class="card-tools">
                        <div class="btn-group">
                          <button type="button" class="btn btn-tool dropdown-toggle" data-toggle="dropdown"></button>
                          <div class="dropdown-menu dropdown-menu-right custom-dropdown-menu" role="menu">
                            <a role="button" class="dropdown-item" data-lowincome="daily">Daily</a>
                            <hr class="dropdown-divider">
                            <a role="button" class="dropdown-item" data-lowincome="weekly">Weekly</a>
                            <hr class="dropdown-divider">
                            <a role="button" class="dropdown-item" data-lowincome="monthly">Monthly</a>
                            <hr class="dropdown-divider">
                            <a role="button" class="dropdown-item" data-lowincome="yearly">Yearly</a>
                            <hr class="dropdown-divider">
                            <form id="exportLowincome" action="lowincome_report.php" method="post">
                              <button role="button" class="dropdown-item" type="submit"
                                name="export_lowincome">Export</button>
                            </form>
                          </div>
                        </div>
                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                          <i class="fas fa-minus"></i>
                        </button>
                      </div>
                    </div>
                    <div class="card-body">
                      <div class="chart">
                        <canvas id="lowincome" style="position: relative; height:40vh; width:80vw"></canvas>
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
include 'blotter.php';
include 'clearance.php';
include 'indigent.php';
include 'lowincome.php';
?>
  <script>
    function openExportWindow(formId) {
      const formElement = document.getElementById(formId);
      formElement.addEventListener('submit', function (event) {
        event.preventDefault(); // prevent the form from submitting the default way
        window.open('', 'exportWindow'); // open a new window

        // create a hidden form and submit it to the new window
        const form = document.createElement('form');
        form.action = this.action;
        form.method = this.method;
        form.target = 'exportWindow';

        // create and append the second input element
        const input1 = document.createElement('input');
        input1.type = 'hidden';
        input1.name = 'export_blotter';
        input1.value = 'true'; // you can set this to any value you need
        form.appendChild(input1);

        // create and append the first input element
        const input2 = document.createElement('input');
        input2.type = 'hidden';
        input2.name = 'export_clearance';
        input2.value = 'true'; // you can set this to any value you need
        form.appendChild(input2);

        // create and append the second input element
        const input3 = document.createElement('input');
        input3.type = 'hidden';
        input3.name = 'export_indigent';
        input3.value = 'true'; // you can set this to any value you need
        form.appendChild(input3);

        // create and append the second input element
        const input4 = document.createElement('input');
        input4.type = 'hidden';
        input4.name = 'export_lowincome';
        input4.value = 'true'; // you can set this to any value you need
        form.appendChild(input4);

        document.body.appendChild(form);
        form.submit();
        document.body.removeChild(form); // clean up the hidden form
      });
    }

    // Add event listeners to the forms
    openExportWindow('exportBlotter');
    openExportWindow('exportClearance');
    openExportWindow('exportIndigent');
    openExportWindow('exportLowincome');
  </script>
</body>

</html>