<!DOCTYPE html>
<html lang="en">
<?php
if (!isset($_SESSION)) {
  include '../../include/session.inc.php';
  if (!isset($_SESSION['role'])) {
    header("Location: ../../login.php");
    exit();
  } elseif (($_SESSION['role'] !== "administrator") || ($_SESSION['role'] === "captain") || ($_SESSION['role'] === "staff") || ($_SESSION['role'] === "resident")) {
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
                  <h1 class="m-0">Dashboard</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                  <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Dashboard</li>
                  </ol>
                </div>
              </div>
            </div>
          </section>

          <!-- main content -->
          <section class="content">
            <div class="container-fluid">
              <div class="row">
                <div class="col-12 col-sm-6 col-md-3">
                  <div class="small-box bg-info">
                    <div class="inner">
                      <h3>
                        <?php
                        $sql = mysqli_query($con, "SELECT * FROM tblhousehold");
                        $num_rows = mysqli_num_rows($sql);
                        echo $num_rows;
                        ?>
                      </h3>
                      <p class="text-uppercase">Total Household</p>
                    </div>
                    <div class="icon">
                      <i class="fas fa-home"></i>
                    </div>
                    <a href="../household/household.php" class="small-box-footer">
                      MORE INFO <i class="fas fa-arrow-circle-right ml-1"></i>
                    </a>
                  </div>
                </div>
                <div class="col-12 col-sm-6 col-md-3">
                  <div class="small-box bg-success">
                    <div class="inner">
                      <h3>
                        <?php
                        $q = mysqli_query($con, "SELECT * FROM tblresident");
                        $num_rows = mysqli_num_rows($q);
                        echo $num_rows;
                        ?>
                      </h3>
                      <p class="text-uppercase">Total Residents</p>
                    </div>
                    <div class="icon">
                      <i class="fas fa-users"></i>
                    </div>
                    <a href="../resident/resident.php" class="small-box-footer">
                      MORE INFO <i class="fas fa-arrow-circle-right ml-1"></i>
                    </a>
                  </div>
                </div>

                <!-- fix for small devices only -->
                <div class="clearfix hidden-md-up"></div>

                <div class="col-12 col-sm-6 col-md-3">
                  <div class="small-box bg-warning">
                    <div class="inner">
                      <h3>
                        <?php
                        $q = mysqli_query($con, "SELECT * FROM tblclearance WHERE clearance_status = 'approved' ");
                        $num_rows = mysqli_num_rows($q);
                        echo $num_rows;
                        ?>
                      </h3>
                      <p class="text-uppercase">Total Clearance</p>
                    </div>
                    <div class="icon">
                      <i class="fas fa-file-alt"></i>
                    </div>
                    <a href="../clearance/clearance.php" class="small-box-footer">
                      MORE INFO <i class="fas fa-arrow-circle-right ml-1"></i>
                    </a>
                  </div>
                </div>
                <div class="col-12 col-sm-6 col-md-3">
                  <div class="small-box bg-danger">
                    <div class="inner">
                      <h3>
                        <?php
                        $q = mysqli_query($con, "SELECT * FROM tblbldgpermit WHERE bldgpermit_status = 'approved' ");
                        $num_rows = mysqli_num_rows($q);
                        echo $num_rows;
                        ?>
                      </h3>
                      <p class="text-uppercase">Total Building Permit</p>
                    </div>
                    <div class="icon">
                      <i class="fas fa-file-contract"></i>
                    </div>
                    <a href="../permit/permit.php" class="small-box-footer">
                      MORE INFO <i class="fas fa-arrow-circle-right ml-1"></i>
                    </a>
                  </div>
                </div>

                <!-- fix for small devices only -->
                <div class="clearfix hidden-md-up"></div>

                <div class="col-12 col-sm-6 col-md-3">
                  <div class="small-box bg-danger">
                    <div class="inner">
                      <h3>
                        <?php
                        $q = mysqli_query($con, "SELECT * FROM tblblotter");
                        $num_rows = mysqli_num_rows($q);
                        echo $num_rows;
                        ?>
                      </h3>
                      <p class="text-uppercase">Total Blotter</p>
                    </div>
                    <div class="icon">
                      <i class="fas fa-gavel"></i>
                    </div>
                    <a href="../blotter/blotter.php" class="small-box-footer">
                      MORE INFO <i class="fas fa-arrow-circle-right ml-1"></i>
                    </a>
                  </div>
                </div>
                <div class="col-12 col-sm-6 col-md-3">
                  <div class="small-box bg-warning">
                    <div class="inner">
                      <h3>
                        <?php
                        $q = mysqli_query($con, "SELECT * FROM tblblotter");
                        $num_rows = mysqli_num_rows($q);
                        echo $num_rows;
                        ?>
                      </h3>
                      <p class="text-uppercase">Total Low Income</p>
                    </div>
                    <div class="icon">
                      <i class="fas fa-file-alt"></i>
                    </div>
                    <a href="../blotter/blotter.php" class="small-box-footer">
                      MORE INFO <i class="fas fa-arrow-circle-right ml-1"></i>
                    </a>
                  </div>
                </div>

                <!-- fix for small devices only -->
                <div class="clearfix hidden-md-up"></div>

                <div class="col-12 col-sm-6 col-md-3">
                  <div class="small-box bg-success">
                    <div class="inner">
                      <h3>
                        <?php
                        $q = mysqli_query($con, "SELECT * FROM tblblotter");
                        $num_rows = mysqli_num_rows($q);
                        echo $num_rows;
                        ?>
                      </h3>
                      <p class="text-uppercase">Total Certificates</p>
                    </div>
                    <div class="icon">
                      <i class="fas fa-file-alt"></i>
                    </div>
                    <a href="../blotter/blotter.php" class="small-box-footer">
                      MORE INFO <i class="fas fa-arrow-circle-right ml-1"></i>
                    </a>
                  </div>
                </div>
                <div class="col-12 col-sm-6 col-md-3">
                  <div class="small-box bg-info">
                    <div class="inner">
                      <h3>
                        <?php
                        $q = mysqli_query($con, "SELECT * FROM tblblotter");
                        $num_rows = mysqli_num_rows($q);
                        echo $num_rows;
                        ?>
                      </h3>
                      <p class="text-uppercase">Total Indigent</p>
                    </div>
                    <div class="icon">
                      <i class="fas fa-file-alt"></i>
                    </div>
                    <a href="../blotter/blotter.php" class="small-box-footer">
                      MORE INFO <i class="fas fa-arrow-circle-right ml-1"></i>
                    </a>
                  </div>
                </div>
                <?php include '../../include/notification.inc.php' ?>
              </div>
            </div>
          </section>
        </div>
      </div>
    </body>
  <?php }
}
include '../../include/footer.inc.php' ?>

</html>