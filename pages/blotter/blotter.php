<!DOCTYPE html>
<html lang="en">
<?php
if (!isset ($_SESSION)) {
  include '../../include/session.inc.php';
  if (!isset ($_SESSION['role'])) {
    header("Location: ../../login.php");
    exit();
  } elseif (($_SESSION['role'] !== "administrator") && ($_SESSION['role'] !== "staff") || ($_SESSION['role'] === "captain") || ($_SESSION['role'] === "resident")) {
    header("Location: ../../login.php");
    exit();
  } else {
    ob_start();
    include '../../include/global.inc.php'; ?>

    <body class="hold-transition dark-mode sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
      <div class="wrapper">

        <!-- preloader -->
        <div class="preloader flex-column justify-content-center align-items-center">
          <img class="animation__wobble" src="../../assets/img/brgy-logo.png" alt="Brgy Logo" height="200" width="200">
        </div>

        <!-- navbar -->
        <?php include '../../include/db.inc.php'; ?>
        <?php include '../header.php'; ?>

        <!-- main sidebar -->
        <?php include '../sidebar.php'; ?>

        <!-- content wrapper -->
        <div class="content-wrapper">
          <!-- content header -->
          <section class="content-header">
            <div class="container-fluid">
              <div class="row mb-2">
                <div class="col-sm-6">
                  <h1 class="m-0">Manage Blotter</h1>
                </div>
                <div class="col-sm-6">
                  <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Manage Blotter</li>
                  </ol>
                </div>
              </div>
            </div>
          </section>

          <!-- main content -->
          <section class="content">
            <div class="container-fluid">
              <div class="row">
                <div class="col-12 col-sm-12">
                  <div class="card card-primary card-outline">
                    <div class="card-header">
                      <?php
                      if ((!isset ($_SESSION['role'])) || ($_SESSION['role'] == "administrator") || (!isset ($_SESSION['role'])) || ($_SESSION['role'] == "staff")) {
                        ?>
                        <button type="button" class="btn btn-primary mr-1" data-toggle="modal" data-target="#addModal">
                          <i class="fa fa-user-plus" aria-hidden="true"></i>
                          &nbsp; Add Blotter
                        </button>
                        <?php
                        if ((isset ($_SESSION['role']) && $_SESSION['role'] == "administrator") || (isset ($_SESSION['role']) && $_SESSION['role'] == "staff")) {
                          ?>
                          <button type="button" class="btn btn-danger ml-1" data-toggle="modal" data-target="#deleteModal">
                            <i class="fas fa-trash-alt" aria-hidden="true"></i>
                            &nbsp; Delete Blotter
                          </button>
                          <?php
                        }
                      } ?>
                    </div>
                  </div>
                  <div class="card card-primary card-outline">
                    <div class="card-body table-responsive">
                      <form method="post">
                        <table id="tblblotter" class="table table-bordered table-striped">
                          <thead>
                            <tr>
                              <?php
                              if ((isset ($_SESSION['role']) && $_SESSION['role'] == "administrator") || (isset ($_SESSION['role']) && $_SESSION['role'] == "staff")) {
                                ?>
                                <th class="align-middle user-select-none" style="width: 0px !important">
                                  <div class="custom-control custom-checkbox" style="padding: 0 0 0 30.75px">
                                    <input class="cbxMain custom-control-input" name="chk_delete[]" type="checkbox"
                                      id="cstm-chckbx" onchange="checkMain(this)">
                                    <label for="cstm-chckbx" class="custom-control-label custom-label"></label>
                                  </div>
                                </th>
                                <?php
                              } ?>
                              <th class="align-middle">Complainant</th>
                              <th class="align-middle">Respondent</th>
                              <th class="align-middle">Complaint</th>
                              <th class="align-middle">Action</th>
                              <th class="align-middle">Status</th>
                              <th class="align-middle">Location</th>
                              <th class="align-middle" width="80.25px">Option</th>
                            </tr>
                          </thead>
                          <tbody>
                            <?php
                            if ((isset ($_SESSION['role']) && $_SESSION['role'] === "administrator") || (isset ($_SESSION['role']) && $_SESSION['role'] === "staff")) {
                              $squery = mysqli_query($con, "SELECT b.*, CASE WHEN b.blotter_complainant REGEXP '^[0-9]+$' THEN (SELECT CONCAT(resident_fname, IF(resident_mname = 'n/a', '', CONCAT(' ', resident_mname)), ' ', resident_lname) FROM tblresident WHERE id = b.blotter_complainant) ELSE b.blotter_complainant END AS rname_complainant, CASE WHEN b.blotter_respondent REGEXP '^[0-9]+$' THEN (SELECT CONCAT(resident_fname, IF(resident_mname = 'n/a', '', CONCAT(' ', resident_mname)), ' ', resident_lname) FROM tblresident WHERE id = b.blotter_respondent) ELSE b.blotter_respondent END AS rname_respondent FROM tblblotter b LEFT JOIN tblresident r_complainant ON b.blotter_complainant = r_complainant.id LEFT JOIN tblresident r_respondent ON b.blotter_respondent = r_respondent.id ORDER BY id DESC") or die ('Error: ' . mysqli_error($con));
                              while ($row = mysqli_fetch_array($squery)) {
                                $checkboxId = 'cstm-chckbx' . $row['id'];
                                ?>
                                <tr>
                                  <td class="align-middle user-select-none" style="width: 0px !important">
                                    <div class="custom-control custom-checkbox" style="padding: 0 0 0 31px">
                                      <input type="checkbox" name="chk_delete[]" class="chk_delete custom-control-input"
                                        id="<?php echo $checkboxId; ?>" value="<?php echo $row['id']; ?>">
                                      <label for="<?php echo $checkboxId; ?>" class="custom-control-label"></label>
                                    </div>
                                  </td>
                                  <td class="align-middle">
                                    <?php echo $row['rname_complainant']; ?>
                                  </td>
                                  <td class="align-middle">
                                    <?php echo $row['rname_respondent']; ?>
                                  </td>
                                  <td class="align-middle">
                                    <?php echo $row['blotter_first_complaint'] . ' ' . $row['blotter_second_complaint']; ?>
                                  </td>
                                  <td class="align-middle">
                                    <?php echo $row['blotter_action_taken']; ?>
                                  </td>
                                  <td class="align-middle">
                                    <?php echo $row['blotter_status']; ?>
                                  </td>
                                  <td class="align-middle">
                                    <?php echo $row['blotter_location_of_incident']; ?>
                                  </td>
                                  <td class="align-middle">
                                    <button type="button" class="btn btn-primary"
                                      data-target="#editModal<?php echo $row['id']; ?>" data-toggle="modal">
                                      <i class="fas fa-edit" aria-hidden="true"></i>&nbsp Edit
                                    </button>
                                  </td>
                                </tr>
                                <?php include 'modal/edit.mod.php'; ?>
                              <?php }
                            } ?>
                          </tbody>
                        </table>
                        <?php include 'modal/delete.mod.php'; ?>
                      </form>
                    </div>
                  </div>
                  <?php include '../../include/notification.inc.php'; ?>
                  <?php include 'modal/add.mod.php'; ?>
                  <?php include 'function.php'; ?>
                </div>
              </div>
            </div>
          </section>
        </div>
      </div>
    <?php }
}
include '../../include/footer.inc.php'; ?>
</body>

</html>