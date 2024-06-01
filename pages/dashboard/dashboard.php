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
                <div class="col-4">
                  <div class="small-box bg-custom"
                    style="box-shadow: 0 40px 55px rgba(31, 29, 29,0.25), 0 0px 12px rgba(31, 29, 29,0.25); border-top: 3px solid #3f6791;">
                    <div class="inner">
                      <h3>
                        <?php
                        $sql = mysqli_query($con, "SELECT * FROM tblofficial");
                        $num_rows = mysqli_num_rows($sql);
                        echo $num_rows;
                        ?>
                      </h3>
                      <p class="text-uppercase text-bold">total brgy official</p>
                    </div>
                    <div class="icon">
                      <i class="fas fa-user-friends text-light"></i>
                    </div>
                    <a href="../officials/officials.php" class="small-box-footer text-left custom-link text-bold"
                      style="padding: 10px 0 10px 10px">
                      MORE INFO <i class="fas fa-share ml-1"></i>
                    </a>
                  </div>
                </div>
                <div class="col-4">
                  <div class="small-box bg-custom"
                    style="box-shadow: 0 40px 55px rgba(31, 29, 29,0.25), 0 0px 12px rgba(31, 29, 29,0.25); border-top: 3px solid #3f6791;">
                    <div class="inner">
                      <h3>
                        <?php
                        $q = mysqli_query($con, "SELECT * FROM tblhousehold");
                        $num_rows = mysqli_num_rows($q);
                        echo $num_rows;
                        ?>
                      </h3>
                      <p class="text-uppercase text-bold">total brgy household</p>
                    </div>
                    <div class="icon">
                      <i class="fas fa-home text-light"></i>
                    </div>
                    <a href="../household/household.php" class="small-box-footer text-left custom-link text-bold"
                      style="padding: 10px 0 10px 10px">
                      MORE INFO <i class="fas fa-share ml-1"></i>
                    </a>
                  </div>
                </div>

                <!-- fix for small devices only -->
                <div class="clearfix hidden-md-up"></div>

                <div class="col-4">
                  <div class="small-box bg-custom"
                    style="box-shadow: 0 40px 55px rgba(31, 29, 29,0.25), 0 0px 12px rgba(31, 29, 29,0.25); border-top: 3px solid #3f6791;">
                    <div class="inner">
                      <h3>
                        <?php
                        $q = mysqli_query($con, "SELECT * FROM tblresident");
                        $num_rows = mysqli_num_rows($q);
                        echo $num_rows;
                        ?>
                      </h3>
                      <p class="text-uppercase text-bold">total brgy resident</p>
                    </div>
                    <div class="icon">
                      <i class="fas fa-users text-light"></i>
                    </div>
                    <a href="../resident/resident.php" class="small-box-footer text-left custom-link text-bold"
                      style="padding: 10px 0 10px 10px">
                      MORE INFO <i class="fas fa-share ml-1"></i>
                    </a>
                  </div>
                </div>
                <div class="col-4">
                  <div class="small-box bg-custom"
                    style="box-shadow: 0 40px 55px rgba(31, 29, 29,0.25), 0 0px 12px rgba(31, 29, 29,0.25); border-top: 3px solid #3f6791;">
                    <div class="inner">
                      <h3>
                        <?php
                        $q = mysqli_query($con, "SELECT * FROM tblblotter");
                        $num_rows = mysqli_num_rows($q);
                        echo $num_rows;
                        ?>
                      </h3>
                      <p class="text-uppercase text-bold">total brgy blotter</p>
                    </div>
                    <div class="icon">
                      <i class="fas fa-gavel text-light"></i>
                    </div>
                    <a href="../blotter/blotter.php" class="small-box-footer text-left custom-link text-bold"
                      style="padding: 10px 0 10px 10px">
                      MORE INFO <i class="fas fa-share ml-1"></i>
                    </a>
                  </div>
                </div>

                <!-- fix for small devices only -->
                <div class="clearfix hidden-md-up"></div>

                <div class="col-4">
                  <div class="small-box bg-custom"
                    style="box-shadow: 0 40px 55px rgba(31, 29, 29,0.25), 0 0px 12px rgba(31, 29, 29,0.25); border-top: 3px solid #3f6791;">
                    <div class="inner">
                      <h3>
                        <?php
                        $q = mysqli_query($con, "SELECT * FROM tblclearance WHERE clearance_status = 'approved'");
                        $num_rows = mysqli_num_rows($q);
                        echo $num_rows;
                        ?>
                      </h3>
                      <p class="text-uppercase text-bold">total brgy clearance</p>
                    </div>
                    <div class="icon">
                      <i class="fas fa-file-signature text-light"></i>
                    </div>
                    <a href="../clearance/clearance.php" class="small-box-footer text-left custom-link text-bold"
                      style="padding: 10px 0 10px 10px">
                      MORE INFO <i class="fas fa-share ml-1"></i>
                    </a>
                  </div>
                </div>
                <div class="col-4">
                  <div class="small-box bg-custom"
                    style="box-shadow: 0 40px 55px rgba(31, 29, 29,0.25), 0 0px 12px rgba(31, 29, 29,0.25); border-top: 3px solid #3f6791;">
                    <div class="inner">
                      <h3>
                        <?php
                        $q = mysqli_query($con, "SELECT * FROM tblindigent WHERE indigent_status = 'approved'");
                        $num_rows = mysqli_num_rows($q);
                        echo $num_rows;
                        ?>
                      </h3>
                      <p class="text-uppercase text-bold">total cert of indigent</p>
                    </div>
                    <div class="icon">
                      <i class="fas fa-file-signature text-light"></i>
                    </div>
                    <a href="../indigent/indigent.php" class="small-box-footer text-left custom-link text-bold"
                      style="padding: 10px 0 10px 10px">
                      MORE INFO <i class="fas fa-share ml-1"></i>
                    </a>
                  </div>
                </div>

                <!-- fix for small devices only -->
                <div class="clearfix hidden-md-up"></div>

                <div class="col-4">
                  <div class="small-box bg-custom"
                    style="box-shadow: 0 40px 55px rgba(31, 29, 29,0.25), 0 0px 12px rgba(31, 29, 29,0.25); border-top: 3px solid #3f6791;">
                    <div class="inner">
                      <h3>
                        <?php
                        $q = mysqli_query($con, "SELECT * FROM tbllowincome WHERE lowincome_status = 'approved'");
                        $num_rows = mysqli_num_rows($q);
                        echo $num_rows;
                        ?>
                      </h3>
                      <p class="text-uppercase text-bold">total cert of low-income</p>
                    </div>
                    <div class="icon">
                      <i class="fas fa-file-signature text-light"></i>
                    </div>
                    <a href="../lowincome/lowincome.php" class="small-box-footer text-left custom-link text-bold"
                      style="padding: 10px 0 10px 10px">
                      MORE INFO <i class="fas fa-share ml-1"></i>
                    </a>
                  </div>
                </div>
                <div class="col-4">
                  <div class="small-box bg-custom"
                    style="box-shadow: 0 40px 55px rgba(31, 29, 29,0.25), 0 0px 12px rgba(31, 29, 29,0.25); border-top: 3px solid #3f6791;">
                    <div class="inner">
                      <h3>
                        <?php
                        $q = mysqli_query($con, "SELECT * FROM tblcaptain");
                        $num_rows = mysqli_num_rows($q);
                        echo $num_rows;
                        ?>
                      </h3>
                      <p class="text-uppercase text-bold">total brgy captain</p>
                    </div>
                    <div class="icon">
                      <i class="fas fa-user-secret text-light"></i>
                    </div>
                    <a href="../captain/captain.php" class="small-box-footer text-left custom-link text-bold"
                      style="padding: 10px 0 10px 10px">
                      MORE INFO <i class="fas fa-share ml-1"></i>
                    </a>
                  </div>
                </div>
                <div class="col-4">
                  <div class="small-box bg-custom"
                    style="box-shadow: 0 40px 55px rgba(31, 29, 29,0.25), 0 0px 12px rgba(31, 29, 29,0.25); border-top: 3px solid #3f6791;">
                    <div class="inner">
                      <h3>
                        <?php
                        $q = mysqli_query($con, "SELECT * FROM tblstaff");
                        $num_rows = mysqli_num_rows($q);
                        echo $num_rows;
                        ?>
                      </h3>
                      <p class="text-uppercase text-bold">total brgy staff</p>
                    </div>
                    <div class="icon">
                      <i class="fas fa-user-tag text-light"></i>
                    </div>
                    <a href="../staff/staff.php" class="small-box-footer text-left custom-link text-bold"
                      style="padding: 10px 0 10px 10px">
                      MORE INFO <i class="fas fa-share ml-1"></i>
                    </a>
                  </div>
                </div>
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