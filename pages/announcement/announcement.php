<!DOCTYPE html>
<html lang="en">
<?php
if (!isset($_SESSION)) {
  include '../../include/session.inc.php';
  if (!isset($_SESSION['role'])) {
    header("Location: ../../login.php");
    exit();
  } elseif (($_SESSION['role'] !== "administrator") && ($_SESSION['role'] !== "staff") && ($_SESSION['role'] !== "captain") && ($_SESSION['role'] !== "resident")) {
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
                  <h1 class="m-0">Manage Announcement</h1>
                </div>
                <div class="col-sm-6">
                  <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Manage Announcement</li>
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
                  <?php
                  if ((isset($_SESSION['role']) && $_SESSION['role'] === "administrator") || (isset($_SESSION['role']) && $_SESSION['role'] === "staff")) {
                    ?>
                    <div class="card card-primary card-outline">
                      <div class="card-header">
                        <button type="button" class="btn btn-primary mr-1" data-toggle="modal" data-target="#addModal">
                          <i class="fa fa-user-plus" aria-hidden="true"></i>
                          &nbsp; Add Announcement</button>
                        <button type="button" class="btn btn-danger ml-1" data-toggle="modal" data-target="#deleteModal">
                          <i class="fas fa-trash-alt" aria-hidden="true"></i>
                          &nbsp; Delete Announcement</button>
                      </div>
                    </div>
                    <?php
                  } ?>
                  <div class="card card-primary card-outline">
                    <div class="card-body table-responsive">
                      <form method="post">
                        <table id="tblannouncement" class="table table-bordered table-striped">
                          <thead>
                            <tr>
                              <?php
                              if ((isset($_SESSION['role']) && $_SESSION['role'] == "administrator") || (isset($_SESSION['role']) && $_SESSION['role'] == "staff")) {
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
                              <th class="align-middle user-select-none">Announcement</th>
                              <th class="align-middle user-select-none">Description</th>
                              <th class="align-middle user-select-none">Added By</th>
                              <th class="align-middle user-select-none">Date Added</th>
                              <?php
                              if ((isset($_SESSION['role']) && $_SESSION['role'] === "administrator") || (isset($_SESSION['role']) && $_SESSION['role'] === "staff")) { ?>
                                <th class="align-middle user-select-none" width="175.75px">Option</th>
                              <?php } else { ?>
                                <th class="align-middle user-select-none" width="92px">Option</th>
                              <?php } ?>
                            </tr>
                          </thead>
                          <tbody>
                            <?php
                            if ((isset($_SESSION['role']) && $_SESSION['role'] === "administrator") || (isset($_SESSION['role']) && $_SESSION['role'] === "staff")) {
                              $squery = mysqli_query($con, "SELECT * FROM tblannouncement");
                              while ($row = mysqli_fetch_array($squery)) {
                                $checkboxId = 'cstm-chckbx' . $row['id'];
                                $dateFormatted = (new DateTime($row['announcement_date']))->format('m/d/Y h:i A'); ?>
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
                                  <td class="align-middle user-select-none">
                                    <?php echo htmlspecialchars($row['announcement']) ?>
                                  </td>
                                  <td class="align-middle user-select-none">
                                    <?php echo htmlspecialchars($row['announcement_description']) ?>
                                  </td>
                                  <td class="align-middle user-select-none">
                                    <?php echo htmlspecialchars($row['announcement_added_by']) ?>
                                  </td>
                                  <td class="align-middle user-select-none">
                                    <?php echo htmlspecialchars($dateFormatted) ?>
                                  </td>
                                  <td class="align-middle user-select-none">
                                    <button type="button" class="btn btn-primary mr-1"
                                      data-target="#editModal<?php echo htmlspecialchars($row['id']) ?>" data-toggle="modal">
                                      <i class="fas fa-edit" aria-hidden="true"></i>&nbsp Edit
                                    </button>
                                    <button type="button" class="btn btn-success ml-1"
                                      data-target="#viewModal<?php echo htmlspecialchars($row['id']) ?>" data-toggle="modal">
                                      <i class="fas fa-images" aria-hidden="true"></i>&nbsp Photos
                                    </button>
                                  </td>
                                </tr>
                                <?php
                                include 'modal/edit.mod.php';
                                include 'modal/view.mod.php';
                              }
                            } elseif (isset($_SESSION['role']) && $_SESSION['role'] === "resident") {
                              $squery = mysqli_query($con, "SELECT * FROM tblannouncement");
                              while ($row = mysqli_fetch_array($squery)) {
                                $dateFormatted = (new DateTime($row['announcement_date']))->format('m/d/Y h:i A'); ?>
                                <tr>
                                  <td class="align-middle user-select-none">
                                    <?php echo htmlspecialchars($row['announcement']) ?>
                                  </td>
                                  <td class="align-middle user-select-none">
                                    <?php echo htmlspecialchars($row['announcement_description']) ?>
                                  </td>
                                  <td class="align-middle user-select-none">
                                    <?php echo htmlspecialchars($row['announcement_added_by']) ?>
                                  </td>
                                  <td class="align-middle user-select-none">
                                    <?php echo htmlspecialchars($dateFormatted) ?>
                                  </td>
                                  <td class="align-middle user-select-none">
                                    <button type="button" class="btn btn-success ml-1"
                                      data-target="#viewModal<?php echo htmlspecialchars($row['id']) ?>" data-toggle="modal">
                                      <i class="fas fa-images" aria-hidden="true"></i>&nbsp Photos
                                    </button>
                                  </td>
                                </tr>
                                <?php
                                include 'modal/view.mod.php';
                              }
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
  <script type="text/javascript">
    <?php
    if ((isset($_SESSION['role']) && $_SESSION['role'] === "administrator") || (isset($_SESSION['role']) && $_SESSION['role'] === "staff")) {
      ?>
      $(function () { $("#tblannouncement").DataTable({ "responsive": true, "lengthChange": false, "autoWidth": false, "buttons": ["copy", "csv", "excel", "pdf", "print"], "paging": true, "lengthChange": false, "searching": true, "ordering": true, "info": true, "autoWidth": false, "responsive": true, "aoColumnDefs": [{ "bSortable": false, "aTargets": [0, 4] }, { "orderable": false, "targets": [0, 4] }], "aaSorting": [] }).buttons().container().appendTo('#tblannouncement_wrapper .col-md-6:eq(0)') }); <?php
    } elseif (isset($_SESSION['role']) && $_SESSION['role'] === "resident") {
      ?>
      $(function () { $("#tblannouncement").DataTable({ "responsive": true, "lengthChange": false, "autoWidth": false, "buttons": ["copy", "csv", "excel", "pdf", "print"], "paging": true, "lengthChange": false, "searching": true, "ordering": true, "info": true, "autoWidth": false, "responsive": true, "aoColumnDefs": [{ "bSortable": false, "aTargets": [3] }, { "orderable": false, "targets": [3] }], "aaSorting": [] }).buttons().container().appendTo('#tblannouncement_wrapper .col-md-6:eq(0)') }); <?php
    } else {
      ?>
      $(function () { $("#tblannouncement").DataTable({ "responsive": true, "lengthChange": false, "autoWidth": false, "buttons": ["copy", "csv", "excel", "pdf", "print"], "paging": true, "lengthChange": false, "searching": true, "ordering": true, "info": true, "autoWidth": false, "responsive": true, "aoColumnDefs": [{ "bSortable": false, "aTargets": [3] }, { "orderable": false, "targets": [3] }], "aaSorting": [] }).buttons().container().appendTo('#tblannouncement_wrapper .col-md-6:eq(0)') }); <?php
    } ?>

    document.addEventListener("DOMContentLoaded", function () {
      var mainCheckboxes = document.querySelectorAll(".cbxMainphoto");
      mainCheckboxes.forEach(function (mainCheckbox) {
        mainCheckbox.addEventListener("change", function () {
          var checkboxes = this.closest(".modal-content").querySelectorAll(".chk_deletephoto");
          checkboxes.forEach(function (checkbox) {
            checkbox.checked = mainCheckbox.checked;
          });
        });
      });

      var checkboxes = document.querySelectorAll(".chk_deletephoto");
      checkboxes.forEach(function (checkbox) {
        checkbox.addEventListener("change", function () {
          var mainCheckbox = this.closest(".modal-content").querySelector(".cbxMainphoto");
          var allChecked = true;
          checkboxes.forEach(function (checkbox) {
            if (!checkbox.checked) {
              allChecked = false;
            }
          });
          mainCheckbox.checked = allChecked;
        });
      });
    });
  </script>
</body>

</html>