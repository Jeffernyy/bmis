<!DOCTYPE html>
<html lang="en">
<?php
if (!isset($_SESSION)) {
  include '../../include/session.inc.php';
  if (!isset($_SESSION['role'])) {
    header("Location: ../../login.php");
    exit();
  } elseif (($_SESSION['role'] !== "administrator") && ($_SESSION['role'] !== "staff") || ($_SESSION['role'] === "captain") || ($_SESSION['role'] === "resident")) {
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
                  <h1 class="m-0">Manage Officer of the Day</h1>
                </div>
                <div class="col-sm-6">
                  <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Manage Officer of the Day</li>
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
                      <button type="button" class="btn btn-primary mr-1" data-toggle="modal" data-target="#addModal">
                        <i class="fa fa-user-plus" aria-hidden="true"></i>
                        &nbsp; Add Officer
                      </button>
                      <button type="button" class="btn btn-danger ml-1" data-toggle="modal" data-target="#deleteModal">
                        <i class="fas fa-trash-alt" aria-hidden="true"></i>
                        &nbsp; Delete Officer
                      </button>
                    </div>
                  </div>
                  <div class="card card-primary card-outline">
                    <div class="card-body table-responsive">
                      <form method="post">
                        <table id="tblgovoffice" class="table table-bordered table-striped table-hover">
                          <thead>
                            <tr>
                              <th class="align-middle user-select-none" style="width: 0px !important">
                                <div class="custom-control custom-checkbox" style="padding: 0 0 0 30.75px">
                                  <input class="cbxMain custom-control-input" name="chk_delete[]" type="checkbox"
                                    id="cstm-chckbx" onchange="checkMain(this)">
                                  <label for="cstm-chckbx" class="custom-control-label custom-label"></label>
                                </div>
                              </th>
                              <th class="align-middle">Position</th>
                              <th class="align-middle">Officer Name</th>
                              <th class="align-middle">Added By</th>
                              <th class="align-middle">Date Added</th>
                              <th class="align-middle" width="62px">Option</th>
                            </tr>
                          </thead>
                          <tbody>
                            <?php
                            $squery = mysqli_query($con, "SELECT *,CONCAT(officer_fname, IF(officer_mname = 'n/a', '', CONCAT(' ', officer_mname)), ' ', officer_lname) AS officer_res_name FROM tblofficer");
                            while ($row = mysqli_fetch_array($squery)) {
                              $checkboxId = 'cstm-chckbx' . $row['id']; ?>
                              <tr>
                                <td class="align-middle user-select-none" style="width: 0px !important">
                                  <div class="custom-control custom-checkbox" style="padding: 0 0 0 31px">
                                    <input type="checkbox" name="chk_delete[]" class="chk_delete custom-control-input"
                                      id="<?php echo htmlspecialchars($checkboxId) ?>"
                                      value="<?php echo htmlspecialchars($row['id']) ?>">
                                    <label for="<?php echo htmlspecialchars($checkboxId) ?>"
                                      class="custom-control-label"></label>
                                  </div>
                                </td>
                                <td class="align-middle">
                                  <?php echo strtolower(htmlspecialchars($row['officer_position'])) ?>
                                </td>
                                <td class="align-middle">
                                  <?php echo htmlspecialchars($row['officer_res_name']) ?>
                                </td>
                                <td class="align-middle">
                                  <?php echo htmlspecialchars($row['officer_date_added']) ?>
                                </td>
                                <td class="align-middle">
                                  <?php echo htmlspecialchars($row['officer_added_by']) ?>
                                </td>
                                <td class="align-middle">
                                  <button type="button" class="btn btn-primary"
                                    data-target="#editModal<?php echo htmlspecialchars($row['id']) ?>" data-toggle="modal">
                                    <i class="fas fa-edit" aria-hidden="true"></i>&nbsp Edit
                                  </button>
                                </td>
                              </tr>
                              <?php
                              include 'modal/edit.mod.php';
                            } ?>
                          </tbody>
                        </table>
                        <?php include 'modal/delete.mod.php' ?>
                      </form>
                    </div>
                  </div>
                  <?php include '../../include/notification.inc.php' ?>
                  <?php include 'modal/add.mod.php' ?>
                  <?php include 'function.php' ?>
                </div>
              </div>
            </div>
          </section>
        </div>
      </div>
    <?php }
}
include '../../include/footer.inc.php' ?>
</body>

</html>