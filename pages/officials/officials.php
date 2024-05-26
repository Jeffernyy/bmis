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
                  <h1 class="m-0">Manage Barangay Officials</h1>
                </div>
                <div class="col-sm-6">
                  <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Manage Barangay Officials</li>
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
                        &nbsp; Add Officials
                      </button>
                      <?php
                      if ((isset($_SESSION['role']) && $_SESSION['role'] === "administrator") || (isset($_SESSION['role']) && $_SESSION['role'] === "staff")) {
                        ?>
                        <button type="button" class="btn btn-danger ml-1" data-toggle="modal" data-target="#deleteModal">
                          <i class="fas fa-trash-alt" aria-hidden="true"></i>
                          &nbsp; Delete Officials
                        </button>
                        <?php
                      } ?>
                    </div>
                  </div>
                  <div class="card card-primary card-outline">
                    <div class="card-body table-responsive">
                      <form method="post" enctype="multipart/form-data">
                        <table id="tblofficials" class="table table-bordered table-striped table-hover">
                          <thead>
                            <tr>
                              <?php
                              if ((isset($_SESSION['role']) && $_SESSION['role'] === "administrator") || (isset($_SESSION['role']) && $_SESSION['role'] === "staff")) {
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
                              <th class="align-middle user-select-none">Position</th>
                              <th class="align-middle user-select-none">Official Name</th>
                              <th class="align-middle user-select-none">Contact</th>
                              <th class="align-middle user-select-none">Address</th>
                              <th class="align-middle user-select-none" width="90px">Start Term</th>
                              <th class="align-middle user-select-none" width="90px">End Term</th>
                              <th class="align-middle user-select-none" width="212.75px">Option</th>
                            </tr>
                          </thead>
                          <tbody>
                            <?php
                            if ((isset($_SESSION['role']) && $_SESSION['role'] === "administrator") || (isset($_SESSION['role']) && $_SESSION['role'] === "staff")) {
                              $squery = mysqli_query($con, "SELECT *,CONCAT(resident_fname, IF(resident_mname = 'n/a', '', CONCAT(' ', resident_mname)), ' ', resident_lname) as official_name, p.id as pid FROM tblofficial p left join tblresident r on r.id = p.official_res_id");
                              while ($row = mysqli_fetch_array($squery)) {
                                $checkboxId = 'cstm-chckbx' . $row['pid']; ?>
                                <tr>
                                  <td class="align-middle user-select-none" style="width: 0px !important">
                                    <div class="custom-control custom-checkbox" style="padding: 0 0 0 31px">
                                      <input type="checkbox" name="chk_delete[]" class="chk_delete custom-control-input"
                                        id="<?php echo htmlspecialchars($checkboxId) ?>"
                                        value="<?php echo htmlspecialchars($row['pid']) ?>">
                                      <label for="<?php echo htmlspecialchars($checkboxId) ?>"
                                        class="custom-control-label"></label>
                                    </div>
                                  </td>
                                  <td class="align-middle user-select-none">
                                    <?php echo htmlspecialchars($row['official_position']) ?>
                                  </td>
                                  <td class="align-middle user-select-none">
                                    <?php echo htmlspecialchars($row['official_name']) ?>
                                  </td>
                                  <td class="align-middle user-select-none">
                                    <?php echo htmlspecialchars($row['official_contact_num']) ?>
                                  </td>
                                  <td class="align-middle user-select-none">
                                    <?php echo htmlspecialchars($row['official_address']) ?>
                                  </td>
                                  <td class="align-middle user-select-none">
                                    <?php echo htmlspecialchars($row['official_term_start']) ?>
                                  </td>
                                  <td class="align-middle user-select-none">
                                    <?php echo htmlspecialchars($row['official_term_end']) ?>
                                  </td>
                                  <td class="align-middle user-select-none">
                                    <button type="button" class="btn btn-primary mr-1"
                                      data-target="#editModal<?php echo htmlspecialchars($row['pid']) ?>" data-toggle="modal">
                                      <i class="fas fa-edit" aria-hidden="true"></i>&nbsp Edit
                                    </button> <?php
                                    if ($row['official_status'] === 'ongoing term') { ?>
                                      <button type="button" class="btn btn-danger ml-1"
                                        data-target="#endModal<?php echo htmlspecialchars($row['pid']) ?>" data-toggle="modal">
                                        <i class="far fa-calendar-times" aria-hidden="true"></i>&nbsp; End Term
                                      </button>
                                      <?php
                                    } else { ?>
                                      <button type="button" class="btn btn-success ml-1"
                                        data-target="#startModal<?php echo htmlspecialchars($row['pid']) ?>" data-toggle="modal">
                                        <i class="far fa-calendar-check" aria-hidden="true"></i>&nbsp; Start Term
                                      </button>
                                      <?php
                                    } ?>
                                  </td>
                                </tr> <?php
                                include 'modal/edit.mod.php';
                                include 'modal/end.mod.php';
                                include 'modal/start.mod.php';
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
</body>

</html>