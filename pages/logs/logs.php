<!DOCTYPE html>
<html lang="en">
<?php
if (!isset ($_SESSION)) {
  include '../../include/session.inc.php';
  if (!isset ($_SESSION['role'])) {
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
                  <h1 class="m-0">Barangay System Logs</h1>
                </div>
                <div class="col-sm-6">
                  <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Barangay System Logs</li>
                  </ol>
                </div>
              </div>
            </div>
          </section>

          <!-- Main content -->
          <section class="content">
            <div class="container-fluid">
              <div class="row">
                <div class="col-12 col-sm-12">
                  <div class="card card-primary card-outline">
                    <div class="card-body table-responsive">
                      <form method="post">
                        <table id="tbllogs" class="table table-bordered table-striped table-hover">
                          <thead>
                            <tr>
                              <th class="align-middle user-select-none" width="13%">Type</th>
                              <th class="align-middle user-select-none" width="13%">First name</th>
                              <th class="align-middle user-select-none" width="13%">Last name</th>
                              <th class="align-middle user-select-none" width="15%">Date</th>
                              <th class="align-middle user-select-none" width="46%">Action</th>
                            </tr>
                          </thead>
                          <tbody>
                            <?php
                            $squery = mysqli_query($con, "SELECT * FROM tbllogs ORDER BY id DESC");
                            while ($row = mysqli_fetch_array($squery)) {
                              // Limit the length of action to 175 characters
                              $shortened = (strlen(htmlentities($row['logs_action'])) > 200) ? substr(htmlentities($row['logs_action']), 0, 200) . '...' : htmlentities($row['logs_action']);
                              $dateFormatted = (new DateTime($row['logs_logdate']))->format('m/d/Y h:i A');
                              echo '
                                  <tr>
                                    <td class="align-middle user-select-none">' . $row['logs_user_type'] . '</td>
                                    <td class="align-middle user-select-none">' . $row['logs_fname'] . '</td>
                                    <td class="align-middle user-select-none">' . $row['logs_lname'] . '</td>
                                    <td class="align-middle user-select-none">' . $dateFormatted . '</td>
                                    <td title="' . strtolower(htmlentities($row['logs_action'])) . '" class="align-middle user-select-none">' . strtolower($shortened) . '</td>
                                  </tr>
                                ';
                            } ?>
                          </tbody>
                        </table>
                      </form>
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
include "../../include/footer.inc.php" ?>
</body>

</html>