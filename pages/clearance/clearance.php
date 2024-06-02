<!DOCTYPE html>
<html lang="en">
<?php
if (!isset($_SESSION)) {
  include '../../include/session.inc.php';
  if (!isset($_SESSION['role'])) {
    header("Location: ../../login.php");
    exit();
  } elseif (($_SESSION['role'] !== "administrator") && ($_SESSION['role'] !== "staff") && ($_SESSION['role'] !== "resident") || ($_SESSION['role'] === "captain")) {
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
                  <h1 class="m-0">Manage Clearance</h1>
                </div>
                <div class="col-sm-6">
                  <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Manage Clearance</li>
                  </ol>
                </div>
              </div>
            </div>
          </section>

          <!-- main content -->
          <section class="content">
            <div class="container-fluid">
              <div class="row">
                <?php
                if ((isset($_SESSION['role']) && $_SESSION['role'] === "administrator") || (isset($_SESSION['role']) && $_SESSION['role'] === "staff") || (isset($_SESSION['role']) && $_SESSION['role'] !== "captain") && (isset($_SESSION['role']) && $_SESSION['role'] !== "resident")) {
                  ?>
                  <div class="col-12 col-sm-12">
                    <div class="card card-primary card-outline">
                      <div class="card-header">
                        <button type="button" class="btn btn-primary mr-1" data-toggle="modal" data-target="#addModal"><i
                            class="fa fa-user-plus" aria-hidden="true"></i>
                          &nbsp; Add Clearance</button>
                        <?php if ((isset($_SESSION['role']) && $_SESSION['role'] === "administrator") || (isset($_SESSION['role']) && $_SESSION['role'] === "staff")) { ?>
                          <button type="button" class="btn btn-danger ml-1" data-toggle="modal" data-target="#deleteModal"><i
                              class="fas fa-trash-alt" aria-hidden="true"></i>
                            &nbsp; Delete Clearance</button>
                        <?php } ?>
                      </div>
                    </div>
                    <div class="card card-primary card-outline card-outline-tabs">
                      <div class="card-header p-0 border-bottom-0">
                        <ul class="nav nav-tabs" id="custom-tabs-four-tab" role="tablist">
                          <!-- new -->
                          <li class="nav-item">
                            <a class="nav-link active" id="new-cstm-tab" data-target="#new" data-toggle="pill" role="button"
                              aria-controls="new-cstm-tab" aria-selected="true">New <span id="clearance-new-loadBadge"
                                class="badge badge-info ml-1" style="font-size: 14px">...</span></a>
                          </li>
                          <!-- approved -->
                          <li class="nav-item">
                            <a class="nav-link" id="approved-cstm-tab" data-target="#approved" data-toggle="pill"
                              role="button" aria-controls="approved-cstm-tab" aria-selected="false">Approrved
                              <span id="clearance-approved-loadBadge" class="badge badge-success ml-1"
                                style="font-size: 14px">...</span></a>
                          </li>
                          <!-- disapproved -->
                          <li class="nav-item">
                            <a class="nav-link" id="disapproved-cstm-tab" data-target="#disapproved" data-toggle="pill"
                              role="button" aria-controls="disapproved-cstm-tab" aria-selected="false">Disapprove <span
                                id="clearance-disapproved-loadBadge" class="badge badge-danger ml-1"
                                style="font-size: 14px">...</span></a>
                          </li>
                        </ul>
                      </div>
                      <div class="card-body table-responsive">
                        <form method="post">
                          <div class="tab-content" id="custom-tabs-four-tabContent">
                            <!-- new -->
                            <div class="tab-pane fade show active" id="new" role="tabpanel" aria-labelledby="new-cstm-tab">
                              <table id="tblclearance" class="table table-bordered table-striped table-hover">
                                <thead>
                                  <tr>
                                    <th class="align-middle user-select-none" style="width: 0px !important">
                                      <div class="custom-control custom-checkbox" style="padding: 0 0 0 30.75px">
                                        <input class="cbxMain custom-control-input" name="chk_delete[]" type="checkbox"
                                          id="cstm-chckbx" onchange="checkMain(this)">
                                        <label for="cstm-chckbx" class="custom-control-label custom-label"></label>
                                      </div>
                                    </th>
                                    <th class="align-middle user-select-none">Resident Name</th>
                                    <th class="align-middle user-select-none">Purpose</th>
                                    <th class="align-middle user-select-none">Request Date</th>
                                    <th class="align-middle user-select-none" width="255px">Option</th>
                                  </tr>
                                </thead>
                                <tbody>
                                  <?php
                                  $squery = mysqli_query($con, "SELECT *,
                                                                CASE WHEN r.id IS NULL THEN 'not found or deleted'
                                                                ELSE CONCAT(r.resident_fname,
                                                                IF(r.resident_mname = 'n/a', '', CONCAT(' ', r.resident_mname)), ' ', r.resident_lname)
                                                                END AS clearance_res_name, p.id AS pid
                                                                FROM tblclearance p
                                                                LEFT JOIN tblresident r ON r.id = p.clearance_res_id
                                                                WHERE clearance_status = 'new'
                                                                ORDER BY pid DESC") or die('Error: ' . mysqli_error($con));

                                  while ($row = mysqli_fetch_array($squery)) { ?>
                                    <?php
                                    $checkboxId = 'cstm-chckbx' . $row['pid'];
                                    $dateFormatted = (new DateTime($row['clearance_date_requested']))->format('m/d/Y h:i A');
                                    $clearance_res_name = $row['clearance_res_name'];
                                    $nameClass = $clearance_res_name === 'not found or deleted' ? 'text-warning' : ''; // Add class for 'n/a' text
                                    ?>
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
                                      <td class="align-middle user-select-none <?php echo $nameClass ?>">
                                        <?php echo htmlspecialchars($clearance_res_name) ?>
                                      </td>
                                      <td class="align-middle user-select-none">
                                        <?php echo htmlspecialchars($row['clearance_purpose']) ?>
                                      </td>
                                      <td class="align-middle user-select-none">
                                        <?php echo htmlspecialchars($dateFormatted) ?>
                                      </td>
                                      <td class="align-middle user-select-none">
                                        <button type="button" class="btn btn-success mr-1"
                                          data-target="#approveModal<?php echo htmlspecialchars($row['pid']) ?>"
                                          data-toggle="modal">
                                          <i class="fas fa-thumbs-up" aria-hidden="true"></i>&nbsp Approve
                                        </button>
                                        <button type="button" class="btn btn-danger ml-1"
                                          data-target="#disapproveModal<?php echo htmlspecialchars($row['pid']) ?>"
                                          data-toggle="modal">
                                          <i class="fas fa-thumbs-down" aria-hidden="true"></i>&nbsp Disapprove
                                        </button>
                                      </td>
                                    </tr>
                                    <?php
                                    include 'modal/approve.mod.php';
                                    include 'modal/disapprove.mod.php';
                                  } ?>
                                </tbody>

                                <?php include 'function.php' ?>
                              </table>
                            </div>
                            <!-- approved -->
                            <div class="tab-pane fade" id="approved" role="tabpanel" aria-labelledby="approved-cstm-tab">
                              <table id="tblclearance1" class="table table-bordered table-striped table-hover">
                                <thead>
                                  <tr>
                                    <?php
                                    if ((isset($_SESSION['role']) && $_SESSION['role'] === "administrator") || (isset($_SESSION['role']) && $_SESSION['role'] === "staff")) {
                                      ?>
                                      <th class="align-middle" style="width: 0px !important">
                                        <div class="custom-control custom-checkbox" style="padding: 0 0 0 30.75px">
                                          <input class="cbxMain custom-control-input" name="chk_delete[]" type="checkbox"
                                            id="cstm-chckbx" onchange="checkMain(this)">
                                          <label for="cstm-chckbx" class="custom-control-label custom-label"></label>
                                        </div>
                                      </th>
                                      <?php
                                    } ?>
                                    <th class="align-middle user-select-none">Clearance #</th>
                                    <th class="align-middle user-select-none">Resident Name</th>
                                    <th class="align-middle user-select-none">Findings</th>
                                    <th class="align-middle user-select-none">Purpose</th>
                                    <th class="align-middle user-select-none">OR Number</th>
                                    <th class="align-middle user-select-none">Amount</th>
                                    <th class="align-middle user-select-none" width="208px">Option</th>
                                  </tr>
                                </thead>
                                <tbody>
                                  <?php
                                  $squery = mysqli_query($con, "SELECT *,
                                                                CASE WHEN r.id IS NULL THEN 'not found or deleted'
                                                                ELSE CONCAT(r.resident_fname,
                                                                IF(r.resident_mname = 'n/a', '', CONCAT(' ', r.resident_mname)), ' ', r.resident_lname)
                                                                END AS clearance_res_name, p.id AS pid
                                                                FROM tblclearance p
                                                                LEFT JOIN tblresident r ON r.id = p.clearance_res_id
                                                                WHERE clearance_status = 'approved'
                                                                ORDER BY pid DESC") or die('Error: ' . mysqli_error($con));
                                  while ($row = mysqli_fetch_array($squery)) { ?>
                                    <?php
                                    $checkboxId = 'cstm-chckbx' . $row['pid'];
                                    $clearance_res_name = $row['clearance_res_name'];
                                    $nameClass = $clearance_res_name === 'not found or deleted' ? 'text-warning' : ''; ?>
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
                                        <?php echo htmlspecialchars($row['clearance_num']) ?>
                                      </td>
                                      <td class="align-middle user-select-none <?php echo $nameClass ?>">
                                        <?php echo htmlspecialchars($clearance_res_name) ?>
                                      </td>
                                      <td class="align-middle user-select-none">
                                        <?php echo htmlspecialchars($row['clearance_findings']) ?>
                                      </td>
                                      <td class="align-middle user-select-none">
                                        <?php echo htmlspecialchars($row['clearance_purpose']) ?>
                                      </td>
                                      <td class="align-middle user-select-none">
                                        <?php echo htmlspecialchars($row['clearance_or_num']) ?>
                                      </td>
                                      <td class="align-middle user-select-none">
                                        <?php echo htmlspecialchars($row['clearance_amount']) ?>
                                      </td>
                                      <td class="align-middle user-select-none">
                                        <button type="button" class="btn btn-primary mr-1"
                                          data-target="#editModal<?php echo htmlspecialchars($row['pid']) ?>"
                                          data-toggle="modal">
                                          <i class="fas fa-edit" aria-hidden="true"></i>&nbsp Edit
                                        </button>
                                        <a target="_blank"
                                          href="form.php?resident=<?php echo htmlspecialchars($row['clearance_res_id']) ?>&clearance=<?php echo htmlspecialchars($row['clearance_num']) ?>&value=<?php echo base64_encode(htmlspecialchars($row['clearance_num']) . '|' . htmlspecialchars($row['clearance_res_name']) . '|' . htmlspecialchars($row['clearance_date_added']) . ' | ' . htmlspecialchars($row['clearance_date_approved'])) ?>"
                                          class="
                                          btn btn-success ml-1">
                                          <i class="fas fa-download" aria-hidden="true"></i>&nbsp Generate
                                        </a>
                                      </td>
                                    </tr>
                                    <?php
                                    include 'modal/edit.mod.php';
                                  } ?>
                                </tbody>
                              </table>
                            </div>
                            <!-- disapproved -->
                            <div class="tab-pane fade" id="disapproved" role="tabpanel"
                              aria-labelledby="disapproved-cstm-tab">
                              <table id="tblclearance2" class="table table-bordered table-striped table-hover">
                                <thead>
                                  <?php
                                  if ((isset($_SESSION['role']) && $_SESSION['role'] === "administrator") || (isset($_SESSION['role']) && $_SESSION['role'] === "staff")) {
                                    ?>
                                    <th class="align-middle" style="width: 0px !important">
                                      <div class="custom-control custom-checkbox" style="padding: 0 0 0 30.75px">
                                        <input class="cbxMain custom-control-input" name="chk_delete[]" type="checkbox"
                                          id="cstm-chckbx" onchange="checkMain(this)">
                                        <label for="cstm-chckbx" class="custom-control-label custom-label"></label>
                                      </div>
                                    </th>
                                    <?php
                                  } ?>
                                  <th>Resident Name</th>
                                  <th>Findings</th>
                                  <th>Purpose</th>
                                </thead>
                                <tbody>
                                  <?php
                                  $squery = mysqli_query($con, "SELECT *,
                                                                CASE WHEN r.id IS NULL THEN 'not found or deleted'
                                                                ELSE CONCAT(r.resident_fname,
                                                                IF(r.resident_mname = 'n/a', '', CONCAT(' ', r.resident_mname)), ' ', r.resident_lname)
                                                                END AS clearance_res_name, p.id AS pid
                                                                FROM tblclearance p
                                                                LEFT JOIN tblresident r ON r.id = p.clearance_res_id
                                                                WHERE clearance_status = 'disapproved'
                                                                ORDER BY pid DESC") or die('Error: ' . mysqli_error($con));
                                  while ($row = mysqli_fetch_array($squery)) { ?>
                                    <?php
                                    $checkboxId = 'cstm-chckbx' . $row['pid'];
                                    $clearance_res_name = $row['clearance_res_name'];
                                    $nameClass = $clearance_res_name === 'not found or deleted' ? 'text-warning' : ''; ?>
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
                                      <td class="align-middle user-select-none <?php echo $nameClass ?>">
                                        <?php echo htmlspecialchars($clearance_res_name) ?>
                                      </td>
                                      <td class="align-middle user-select-none">
                                        <?php echo htmlspecialchars($row['clearance_findings']) ?>
                                      </td>
                                      <td class="align-middle user-select-none">
                                        <?php echo htmlspecialchars($row['clearance_purpose']) ?>
                                      </td>
                                    </tr>
                                    <?php
                                  } ?>
                                </tbody>
                              </table>
                            </div>
                          </div>
                          <?php include 'modal/delete.mod.php' ?>
                        </form>
                      </div>
                    </div>
                    <?php include '../../include/notification.inc.php' ?>
                    <?php include 'modal/add.mod.php' ?>
                    <?php include 'function.php' ?>
                  </div>
                  <?php
                } elseif ((isset($_SESSION['role']) && $_SESSION['role'] === "resident") || (isset($_SESSION['role']) && $_SESSION['role'] !== "administrator") && (isset($_SESSION['role']) && $_SESSION['role'] !== "captain") && (isset($_SESSION['role']) && $_SESSION['role'] !== "staff")) {
                  ?>
                  <div class="col-12 col-sm-12">
                    <div class="card card-primary card-outline">
                      <div class="card-header">
                        <button type="button" class="btn btn-primary mr-1" data-toggle="modal" data-target="#reqModal"><i
                            class="fa fa-user-plus" aria-hidden="true"></i>
                          &nbsp; Request Clearance</button>
                        <?php if ((isset($_SESSION['role']) && $_SESSION['role'] === "administrator") || (isset($_SESSION['role']) && $_SESSION['role'] === "staff")) { ?>
                          <button type="button" class="btn btn-danger ml-1" data-toggle="modal" data-target="#deleteModal"><i
                              class="fas fa-trash-alt" aria-hidden="true"></i>
                            &nbsp; Delete Clearance</button>
                        <?php } ?>
                      </div>
                    </div>
                    <div class="card card-primary card-outline card-outline-tabs">
                      <div class="card-header p-0 border-bottom-0">
                        <ul class="nav nav-tabs" id="custom-tabs-four-tab" role="tablist">
                          <!-- new -->
                          <li class="nav-item">
                            <a class="nav-link active" id="new-cstm-tab" data-target="#new" data-toggle="pill" role="button"
                              aria-controls="new-cstm-tab" aria-selected="true">New <span id="clearance-new-loadBadge"
                                class="badge badge-info ml-1" style="font-size: 14px">...</span></a>
                          </li>
                          <!-- approved -->
                          <li class="nav-item">
                            <a class="nav-link" id="approved-cstm-tab" data-target="#approved" data-toggle="pill"
                              role="button" aria-controls="approved-cstm-tab" aria-selected="false">Approrved
                              <span id="clearance-approved-loadBadge" class="badge badge-success ml-1"
                                style="font-size: 14px">...</span></a>
                          </li>
                          <!-- disapproved -->
                          <li class="nav-item">
                            <a class="nav-link" id="disapproved-cstm-tab" data-target="#disapproved" data-toggle="pill"
                              role="button" aria-controls="disapproved-cstm-tab" aria-selected="false">Disapprove <span
                                id="clearance-disapproved-loadBadge" class="badge badge-danger ml-1"
                                style="font-size: 14px">...</span></a>
                          </li>
                        </ul>
                      </div>
                      <div class="card-body table-responsive">
                        <form method="post">
                          <div class="tab-content" id="custom-tabs-four-tabContent">
                            <!-- new -->
                            <div class="tab-pane fade show active" id="new" role="tabpanel" aria-labelledby="new-cstm-tab">
                              <table id="tblclearance" class="table table-bordered table-striped">
                                <thead>
                                  <tr>
                                    <th class="align-middle user-select-none">Purpose</th>
                                    <th class="align-middle user-select-none" width="82px">Option</th>
                                  </tr>
                                </thead>
                                <tbody>
                                  <?php
                                  $squery = mysqli_query($con, "SELECT *,CONCAT(r.resident_fname,
                                                                IF(r.resident_mname, '', CONCAT(' ', r.resident_mname)), ' ', resident_lname) AS clearance_res_name, p.id AS pid
                                                                FROM tblclearance p
                                                                LEFT JOIN tblresident r ON r.id = p.clearance_res_id
                                                                WHERE r.id = " . $_SESSION['userid'] . " AND clearance_status = 'new'
                                                                ORDER BY pid DESC") or die('Error: ' . mysqli_error($con));
                                  if (mysqli_num_rows($squery) > 0) {
                                    while ($row = mysqli_fetch_array($squery)) { ?>
                                      <tr>
                                        <td class="align-middle user-select-none">
                                          <?php echo htmlspecialchars($row['clearance_purpose']) ?>
                                        </td>
                                        <td class="align-middle user-select-none">
                                          <button type="button" class="btn btn-primary"
                                            data-target="#editReqModal<?php echo htmlspecialchars($row['pid']) ?>"
                                            data-toggle="modal">
                                            <i class="fas fa-edit" aria-hidden="true"></i>&nbsp Edit
                                          </button>
                                        </td>
                                      </tr>
                                      <?php
                                      include 'modal/edit.res.mod.php';
                                    }
                                  } ?>
                                </tbody>
                              </table>
                            </div>
                            <!-- approved -->
                            <div class="tab-pane fade" id="approved" role="tabpanel" aria-labelledby="approved-cstm-tab">
                              <table id="tblclearance1" class="table table-bordered table-striped">
                                <thead>
                                  <tr>
                                    <th class="align-middle user-select-none">Clearance #</th>
                                    <th class="align-middle user-select-none">Findings</th>
                                    <th class="align-middle user-select-none">Purpose</th>
                                    <th class="align-middle user-select-none">OR Number</th>
                                    <th class="align-middle user-select-none">Amount</th>
                                  </tr>
                                </thead>
                                <tbody>
                                  <?php
                                  $squery = mysqli_query($con, "SELECT *, p.id AS pid
                                                                FROM tblclearance p LEFT JOIN tblresident r ON r.id = p.clearance_res_id
                                                                WHERE r.id = " . $_SESSION['userid'] . " AND clearance_status = 'approved'
                                                                ORDER BY pid DESC") or die('Error: ' . mysqli_error($con));
                                  if (mysqli_num_rows($squery) > 0) {
                                    while ($row = mysqli_fetch_array($squery)) { ?>
                                      <tr>
                                        <td class="align-middle user-select-none">
                                          <?php echo htmlspecialchars($row['clearance_num']) ?>
                                        </td>
                                        <td class="align-middle user-select-none">
                                          <?php echo htmlspecialchars($row['clearance_findings']) ?>
                                        </td>
                                        <td class="align-middle user-select-none">
                                          <?php echo htmlspecialchars($row['clearance_purpose']) ?>
                                        </td>
                                        <td class="align-middle user-select-none">
                                          <?php echo htmlspecialchars($row['clearance_or_num']) ?>
                                        </td>
                                        <td class="align-middle user-select-none">
                                          <?php echo htmlspecialchars($row['clearance_amount']) ?>
                                        </td>
                                      </tr>
                                    <?php }
                                  } ?>
                                </tbody>
                              </table>
                            </div>
                            <!-- disapproved -->
                            <div class="tab-pane fade" id="disapproved" role="tabpanel"
                              aria-labelledby="disapproved-cstm-tab">
                              <table id="tblclearance2" class="table table-bordered table-striped">
                                <thead>
                                  <th class="align-middle user-select-none">Findings</th>
                                  <th class="align-middle user-select-none">Purpose</th>
                                </thead>
                                <tbody>
                                  <?php
                                  $squery = mysqli_query($con, "SELECT *, p.id AS pid
                                                                FROM tblclearance p LEFT JOIN tblresident r ON r.id = p.clearance_res_id
                                                                WHERE r.id = " . $_SESSION['userid'] . " AND clearance_status = 'disapproved'
                                                                ORDER BY pid DESC") or die('Error: ' . mysqli_error($con));
                                  if (mysqli_num_rows($squery) > 0) {
                                    while ($row = mysqli_fetch_array($squery)) { ?>
                                      <tr>
                                        <td class="align-middle user-select-none">
                                          <?php echo htmlspecialchars($row['clearance_findings']) ?>
                                        </td>
                                        <td class="align-middle user-select-none">
                                          <?php echo htmlspecialchars($row['clearance_purpose']) ?>
                                        </td>
                                      </tr>
                                    <?php }
                                  } ?>
                                </tbody>
                              </table>
                            </div>
                          </div>
                        </form>
                      </div>
                    </div>
                    <?php
                    include '../../include/notification.inc.php';
                    include 'modal/request.mod.php';
                    include 'function.php';
                    ?>
                  </div>
                  <?php
                } ?>
              </div>
            </div>
          </section>
        </div>
      </div>
    <?php }
}
include '../../include/footer.inc.php' ?>
  <script type="text/javascript">
    document.addEventListener('DOMContentLoaded', function() {
      const urlParams = new URLSearchParams(window.location.search);
      const clearanceStatus = urlParams.get('clearance_status');

      if (clearanceStatus) {
          const tabLinks = document.querySelectorAll('.nav-tabs .nav-link');

          tabLinks.forEach(link => link.classList.remove('active'));
          document.querySelectorAll('.tab-pane').forEach(pane => pane.classList.remove('show', 'active'));

          let targetTabId = '#new';
          if (clearanceStatus === 'approved') {
              targetTabId = '#approved';
          } else if (clearanceStatus === 'disapproved') {
              targetTabId = '#disapproved';
          }

          document.querySelector(`[data-target="${targetTabId}"]`).classList.add('active');
          document.querySelector(targetTabId).classList.add('show', 'active');
      }
  });

    function loadBadge() {
      let xhttp = new XMLHttpRequest();
      xhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
          const response = JSON.parse(this.responseText);
          // access clearance counts
          document.getElementById("clearance-new-loadBadge").innerHTML = response.clearance.new;
          document.getElementById("clearance-approved-loadBadge").innerHTML = response.clearance.approved;
          document.getElementById("clearance-disapproved-loadBadge").innerHTML = response.clearance.disapproved;
        }
      }
      xhttp.open("GET", "../../ajax/issuance.ajax.php", true);
      xhttp.send();
    }

    <?php
    if ((isset($_SESSION['role']) && $_SESSION['role'] === "administrator") || (isset($_SESSION['role']) && $_SESSION['role'] === "staff")) {
      ?>
      loadBadge();
      $(function () {
        $("#tblclearance").DataTable({
          "responsive": true, "lengthChange": false, "autoWidth": false,
          "buttons": ["copy", "csv", "excel", "pdf", "print"],
          "paging": true,
          "lengthChange": false,
          "searching": true,
          "ordering": true,
          "info": true,
          "autoWidth": false,
          "responsive": true,
          "aoColumnDefs": [
            { "bSortable": false, "aTargets": [0, 4] },
            { "orderable": true, "targets": 0 }
          ],
          "aaSorting": []
        }).buttons().container().appendTo('#tblclearance_wrapper .col-md-6:eq(0)')
        $("#tblclearance1").DataTable({
          "responsive": true, "lengthChange": false, "autoWidth": false,
          "buttons": ["copy", "csv", "excel", "pdf", "print"],
          "paging": true,
          "lengthChange": false,
          "searching": true,
          "ordering": true,
          "info": true,
          "autoWidth": false,
          "responsive": true,
          "aoColumnDefs": [
            { "bSortable": false, "aTargets": [0, 7] },
            { "orderable": true, "targets": 0 }
          ],
          "aaSorting": []
        }).buttons().container().appendTo('#tblclearance1_wrapper .col-md-6:eq(0)')
        $("#tblclearance2").DataTable({
          "responsive": true, "lengthChange": false, "autoWidth": false,
          "buttons": ["copy", "csv", "excel", "pdf", "print"],
          "paging": true,
          "lengthChange": false,
          "searching": true,
          "ordering": true,
          "info": true,
          "autoWidth": false,
          "responsive": true,
          "aoColumnDefs": [
            { "bSortable": false, "aTargets": [0, 3] },
            { "orderable": true, "targets": 0 }
          ],
          "aaSorting": []
        }).buttons().container().appendTo('#tblclearance2_wrapper .col-md-6:eq(0)')
      });
      <?php
    } elseif ((isset($_SESSION['role']) && $_SESSION['role'] === "resident")) {
      ?>
      loadBadge();
      $(function () {
        $("#tblclearance").DataTable({
          "responsive": true, "lengthChange": false, "autoWidth": false,
          "buttons": ["copy", "csv", "excel", "pdf", "print"],
          "paging": true,
          "lengthChange": false,
          "searching": true,
          "ordering": true,
          "info": true,
          "autoWidth": false,
          "responsive": true,
          "aoColumnDefs": [
            { "bSortable": false, "aTargets": [1] },
            { "orderable": true, "targets": [0] }
          ],
          "aaSorting": []
        }).buttons().container().appendTo('#tblclearance_wrapper .col-md-6:eq(0)')
        $("#tblclearance1").DataTable({
          "responsive": true, "lengthChange": false, "autoWidth": false,
          "buttons": ["copy", "csv", "excel", "pdf", "print"],
          "paging": true,
          "lengthChange": false,
          "searching": true,
          "ordering": true,
          "info": true,
          "autoWidth": false,
          "responsive": true,
          "aoColumnDefs": [
            { "bSortable": false, "aTargets": [4] },
            { "orderable": true, "targets": [0] }
          ],
          "aaSorting": []
        }).buttons().container().appendTo('#tblclearance1_wrapper .col-md-6:eq(0)')
        $("#tblclearance2").DataTable({
          "responsive": true, "lengthChange": false, "autoWidth": false,
          "buttons": ["copy", "csv", "excel", "pdf", "print"],
          "paging": true,
          "lengthChange": false,
          "searching": true,
          "ordering": true,
          "info": true,
          "autoWidth": false,
          "responsive": true,
          "aoColumnDefs": [
            { "bSortable": false, "aTargets": [1] },
            { "orderable": true, "targets": [0] }
          ],
          "aaSorting": []
        }).buttons().container().appendTo('#tblclearance2_wrapper .col-md-6:eq(0)')
      });
      <?php
    } ?>
  </script>
</body>

</html>