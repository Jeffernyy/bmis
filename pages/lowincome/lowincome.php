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
                  <h1 class="m-0">Manage Certificate of Low Income</h1>
                </div>
                <div class="col-sm-6">
                  <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Manage Certificate of Low Income</li>
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
                          &nbsp; Add Certificate of Low Income</button>
                        <?php if ((isset($_SESSION['role']) && $_SESSION['role'] === "administrator") || (isset($_SESSION['role']) && $_SESSION['role'] === "staff")) { ?>
                          <button type="button" class="btn btn-danger ml-1" data-toggle="modal" data-target="#deleteModal"><i
                              class="fas fa-trash-alt" aria-hidden="true"></i>
                            &nbsp; Delete Certificate of Low Income</button>
                        <?php } ?>
                      </div>
                    </div>
                    <div class="card card-primary card-outline card-outline-tabs">
                      <div class="card-header p-0 border-bottom-0">
                        <ul class="nav nav-tabs" id="custom-tabs-four-tab" role="tablist">
                          <!-- new -->
                          <li class="nav-item">
                            <a class="nav-link active" id="new-cstm-tab" data-target="#new" data-toggle="pill" role="button"
                              aria-controls="new-cstm-tab" aria-selected="true">New <span id="lowincome-new-loadBadge"
                                class="badge badge-info ml-1" style="font-size: 14px">...</span></a>
                          </li>
                          <!-- approved -->
                          <li class="nav-item">
                            <a class="nav-link" id="approved-cstm-tab" data-target="#approved" data-toggle="pill"
                              role="button" aria-controls="approved-cstm-tab" aria-selected="false">Approrved
                              <span id="lowincome-approved-loadBadge" class="badge badge-success ml-1"
                                style="font-size: 14px">...</span></a>
                          </li>
                          <!-- disapproved -->
                          <li class="nav-item">
                            <a class="nav-link" id="disapproved-cstm-tab" data-target="#disapproved" data-toggle="pill"
                              role="button" aria-controls="disapproved-cstm-tab" aria-selected="false">Disapprove <span
                                id="lowincome-disapproved-loadBadge" class="badge badge-danger ml-1"
                                style="font-size: 14px">...</span></a>
                          </li>
                        </ul>
                      </div>
                      <div class="card-body table-responsive">
                        <form method="post">
                          <div class="tab-content" id="custom-tabs-four-tabContent">
                            <!-- new -->
                            <div class="tab-pane fade show active" id="new" role="tabpanel" aria-labelledby="new-cstm-tab">
                              <table id="tbllowincome" class="table table-bordered table-striped table-hover">
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
                                    <th class="align-middle user-select-none">Children Name</th>
                                    <th class="align-middle user-select-none">Num of Children</th>
                                    <th class="align-middle user-select-none">Annual Income</th>
                                    <th class="align-middle user-select-none" width="235.5px">Option</th>
                                  </tr>
                                </thead>
                                <tbody>
                                  <?php
                                  $squery = mysqli_query($con, "SELECT p.*, 
                                  CASE
                                  WHEN r1.id IS NOT NULL THEN CONCAT(r1.resident_fname, 
                                  IF(r1.resident_mname = 'n/a', '', CONCAT(' ', SUBSTRING(r1.resident_mname, 1, 1), '.')), 
                                  ' ', r1.resident_lname)
                                  WHEN p.lowincome_res_id REGEXP '^[0-9]+$' THEN (SELECT CONCAT(resident_fname, 
                                  IF(resident_mname = 'n/a', '', CONCAT(' ', SUBSTRING(resident_mname, 1, 1), '.')), 
                                  ' ', resident_lname) FROM tblresident WHERE id = p.lowincome_res_id) 
                                      ELSE p.lowincome_res_id
                                      END AS lowincome_resident_name,
                                  CASE 
                                      WHEN r2.id IS NOT NULL THEN CONCAT(r2.resident_fname, 
                                  IF(r2.resident_mname = 'n/a', '', CONCAT(' ', SUBSTRING(r2.resident_mname, 1, 1), '.')), 
                                  ' ', r2.resident_lname)
                                      WHEN p.lowincome_children_res_id REGEXP '^[0-9]+$' THEN (SELECT CONCAT(resident_fname, 
                                  IF(resident_mname = 'n/a', '', CONCAT(' ', SUBSTRING(resident_mname, 1, 1), '.')), 
                                  ' ', resident_lname) FROM tblresident WHERE id = p.lowincome_children_res_id) 
                                      ELSE p.lowincome_children_res_id 
                                  END AS lowincome_children_res_name,
                                  r2.resident_age as lowincome_children_res_age,
                                  CASE 
                                      WHEN r3.id IS NOT NULL THEN CONCAT(r3.resident_fname, 
                                  IF(r3.resident_mname = 'n/a', '', CONCAT(' ', SUBSTRING(r3.resident_mname, 1, 1), '.')), 
                                  ' ', r3.resident_lname)
                                      WHEN p.lowincome_requester_res_id REGEXP '^[0-9]+$' THEN (SELECT CONCAT(resident_fname, 
                                  IF(resident_mname = 'n/a', '', CONCAT(' ', SUBSTRING(resident_mname, 1, 1), '.')), 
                                  ' ', resident_lname) FROM tblresident WHERE id = p.lowincome_requester_res_id) 
                                      ELSE p.lowincome_requester_res_id 
                                  END AS lowincome_requester_res_name,
                                  r1.resident_birth_date,
                                  r1.resident_civil_status,
                                  r1.resident_age,
                                  r1.resident_purok
                                    FROM tbllowincome p 
                                    LEFT JOIN tblresident r1 ON r1.id = p.lowincome_res_id 
                                    LEFT JOIN tblresident r2 ON r2.id = p.lowincome_children_res_id 
                                    LEFT JOIN tblresident r3 ON r3.id = p.lowincome_requester_res_id 
                                    WHERE lowincome_status = 'new'
                                  ORDER BY id DESC") or die('Error: ' . mysqli_error($con));

                                  while ($row = mysqli_fetch_array($squery)) { ?>
                                    <?php
                                    $checkboxId = 'cstm-chckbx' . $row['id'];

                                    $lowincome_resident_name = $row['lowincome_resident_name'];
                                    $lowincome_resident_name_class = $lowincome_resident_name === null ? 'text-warning text-lowercase' : '';

                                    $children_res_name = $row['lowincome_children_res_name'];
                                    $children_name_class = $children_res_name === null ? 'text-warning text-lowercase' : '';

                                    $dateFormatted = (new DateTime($row['lowincome_date_requested']))->format('m/d/Y h:i A'); ?>
                                    <tr>
                                      <!-- CHECKBOX -->
                                      <td class="align-middle user-select-none" style="width: 0px !important">
                                        <div class="custom-control custom-checkbox" style="padding: 0 0 0 31px">
                                          <input type="checkbox" name="chk_delete[]" class="chk_delete custom-control-input"
                                            id="<?php echo htmlspecialchars($checkboxId) ?>"
                                            value="<?php echo htmlspecialchars($row['id']) ?>">
                                          <label for="<?php echo htmlspecialchars($checkboxId) ?>"
                                            class="custom-control-label"></label>
                                        </div>
                                      </td>
                                      <!-- RESIDENT NAME -->
                                      <td class="align-middle user-select-none <?php echo $lowincome_resident_name_class ?>">
                                        <?php echo $lowincome_resident_name === null ? 'resident not found in the database' : htmlspecialchars($lowincome_resident_name) ?>
                                      </td>
                                      <!-- CHILDREN NAME -->
                                      <td class="align-middle user-select-none <?php echo $children_name_class ?>">
                                        <?php echo $children_res_name === null ? 'children not found in the database' : htmlspecialchars($children_res_name) ?>
                                      </td>
                                      <!-- NUMBER OF CHILDREN -->
                                      <td class="align-middle user-select-none">
                                        <?php echo htmlspecialchars($row['lowincome_num_of_children']) ?>
                                      </td>
                                      <!-- ANNUAL INCOME -->
                                      <td class="align-middle user-select-none">
                                        <?php echo htmlspecialchars($row['lowincome_annual_income']) ?>
                                      </td>
                                      <td class="align-middle user-select-none">
                                        <!-- APPROVE -->
                                        <button type="button" class="btn btn-success mr-1"
                                          data-target="#approveModal<?php echo htmlspecialchars($row['id']) ?>"
                                          data-toggle="modal">
                                          <i class="fas fa-thumbs-up" aria-hidden="true"></i>&nbsp Approve
                                        </button>
                                        <!-- DISAPPROVE -->
                                        <button type="button" class="btn btn-danger ml-1"
                                          data-target="#disapproveModal<?php echo htmlspecialchars($row['id']) ?>"
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
                              <table id="tbllowincome1" class="table table-bordered table-striped table-hover">
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
                                    <th class="align-middle user-select-none">Low Income #</th>
                                    <th class="align-middle user-select-none">Resident Name</th>
                                    <th class="align-middle user-select-none">Requester Name</th>
                                    <th class="align-middle user-select-none">Children Name</th>
                                    <th class="align-middle user-select-none">Annual Income</th>
                                    <th class="align-middle user-select-none">Payment</th>
                                    <th class="align-middle user-select-none" width="207px">Option</th>
                                  </tr>
                                </thead>
                                <tbody>
                                  <?php
                                  $squery = mysqli_query($con, "SELECT p.*, 
                                  CASE
                                  WHEN r1.id IS NOT NULL THEN CONCAT(r1.resident_fname, 
                                  IF(r1.resident_mname = 'n/a', '', CONCAT(' ', SUBSTRING(r1.resident_mname, 1, 1), '.')), 
                                  ' ', r1.resident_lname)
                                  WHEN p.lowincome_res_id REGEXP '^[0-9]+$' THEN (SELECT CONCAT(resident_fname, 
                                  IF(resident_mname = 'n/a', '', CONCAT(' ', SUBSTRING(resident_mname, 1, 1), '.')), 
                                  ' ', resident_lname) FROM tblresident WHERE id = p.lowincome_res_id) 
                                      ELSE p.lowincome_res_id
                                      END AS lowincome_resident_name,
                                  CASE 
                                      WHEN r2.id IS NOT NULL THEN CONCAT(r2.resident_fname, 
                                  IF(r2.resident_mname = 'n/a', '', CONCAT(' ', SUBSTRING(r2.resident_mname, 1, 1), '.')), 
                                  ' ', r2.resident_lname)
                                      WHEN p.lowincome_children_res_id REGEXP '^[0-9]+$' THEN (SELECT CONCAT(resident_fname, 
                                  IF(resident_mname = 'n/a', '', CONCAT(' ', SUBSTRING(resident_mname, 1, 1), '.')), 
                                  ' ', resident_lname) FROM tblresident WHERE id = p.lowincome_children_res_id) 
                                      ELSE p.lowincome_children_res_id 
                                  END AS lowincome_children_res_name,
                                  CASE 
                                  WHEN p.lowincome_children_age = 'n/a' THEN r2.resident_age
                                  ELSE p.lowincome_children_age
                                  END AS lowincome_children_res_age,
                                  CASE 
                                      WHEN r3.id IS NOT NULL THEN CONCAT(r3.resident_fname, 
                                  IF(r3.resident_mname = 'n/a', '', CONCAT(' ', SUBSTRING(r3.resident_mname, 1, 1), '.')), 
                                  ' ', r3.resident_lname)
                                      WHEN p.lowincome_requester_res_id REGEXP '^[0-9]+$' THEN (SELECT CONCAT(resident_fname, 
                                  IF(resident_mname = 'n/a', '', CONCAT(' ', SUBSTRING(resident_mname, 1, 1), '.')), 
                                  ' ', resident_lname) FROM tblresident WHERE id = p.lowincome_requester_res_id) 
                                      ELSE p.lowincome_requester_res_id 
                                  END AS lowincome_requester_res_name,
                            
                                  CASE 
                                      WHEN r4.id IS NOT NULL THEN CONCAT(r4.officer_fname, 
                                  IF(r4.officer_mname = 'n/a', '', CONCAT(' ', SUBSTRING(r4.officer_mname, 1, 1), '.')), 
                                  ' ', r4.officer_lname)
                                      WHEN p.lowincome_officer_res_id IS NULL THEN 'officer of the day is not found in the database'
                                      WHEN p.lowincome_officer_res_id REGEXP '^[0-9]+$' THEN (SELECT CONCAT(officer_fname, 
                                  IF(officer_mname = 'n/a', '', CONCAT(' ', SUBSTRING(officer_mname, 1, 1), '.')), 
                                  ' ', officer_lname) FROM tblofficer WHERE id = p.lowincome_officer_res_id) 
                                      ELSE p.lowincome_officer_res_id 
                                  END AS lowincome_officer_res_name
                            
                                  FROM tbllowincome p 
                                  LEFT JOIN tblresident r1 ON r1.id = p.lowincome_res_id 
                                  LEFT JOIN tblresident r2 ON r2.id = p.lowincome_children_res_id 
                                  LEFT JOIN tblresident r3 ON r3.id = p.lowincome_requester_res_id 
                                  LEFT JOIN tblofficer r4 ON r4.id = p.lowincome_officer_res_id 
                                  WHERE p.lowincome_status = 'approved'
                                  ORDER BY p.id DESC") or die('Error: ' . mysqli_error($con));

                                  while ($row = mysqli_fetch_array($squery)) { ?>
                                    <?php
                                    $checkboxId = 'cstm-chckbx' . $row['id'];

                                    $lowincome_resident_name = $row['lowincome_resident_name'];
                                    $lowincome_resident_name_class = $lowincome_resident_name === null ? 'text-warning text-lowercase' : '';

                                    $children_res_name = $row['lowincome_children_res_name'];
                                    $children_name_class = $children_res_name === null ? 'text-warning text-lowercase' : '';

                                    $children_res_age = $row['lowincome_children_res_age'];
                                    $children_age_name_class = $children_res_age === null ? 'text-warning text-lowercase' : '';

                                    $requester_res_name = $row['lowincome_requester_res_name'];
                                    $requester_name_class_na = $requester_res_name === 'n/a' ? 'text-warning text-lowercase' : '';
                                    $requester_name_class_null = $requester_res_name === null ? 'text-warning text-lowercase' : ''; ?>
                                    <tr>
                                      <!-- CHECKBOX -->
                                      <td class="align-middle user-select-none" style="width: 0px !important">
                                        <div class="custom-control custom-checkbox" style="padding: 0 0 0 31px">
                                          <input type="checkbox" name="chk_delete[]" class="chk_delete custom-control-input"
                                            id="<?php echo htmlspecialchars($checkboxId) ?>"
                                            value="<?php echo htmlspecialchars($row['id']) ?>">
                                          <label for="<?php echo htmlspecialchars($checkboxId) ?>"
                                            class="custom-control-label"></label>
                                        </div>
                                      </td>
                                      <!-- LOW INCOME NUMBER -->
                                      <td class="align-middle user-select-none">
                                        <?php echo htmlspecialchars($row['lowincome_num']) ?>
                                      </td>
                                      <!-- RESIDENT NAME -->
                                      <td class="align-middle user-select-none <?php echo $lowincome_resident_name_class ?>">
                                        <?php echo $lowincome_resident_name === null ? 'resident not found in the database' : htmlspecialchars($lowincome_resident_name) ?>
                                      </td>
                                      <!-- REQUESTER NAME -->
                                      <?php
                                      if ($requester_res_name === 'n/a') {
                                        ?>
                                        <!-- REQUESTER IS NOT APPLICABLE -->
                                        <td class="align-middle user-select-none <?php echo $requester_name_class_na ?>">
                                          <?php echo $requester_res_name === 'n/a' ? 'requester is not needed when making request' : htmlspecialchars($requester_res_name) ?>
                                        </td>
                                        <?php
                                      } else {
                                        ?>
                                        <!-- REQUESTER IS NOT FOUND -->
                                        <td class="align-middle user-select-none <?php echo $requester_name_class_null ?>">
                                          <?php echo $requester_res_name === null ? 'requester not found in the database' : htmlspecialchars($requester_res_name) ?>
                                        </td>
                                        <?php
                                      } ?>
                                      <!-- CHILDREN NAME -->
                                      <td class="align-middle user-select-none <?php echo $children_name_class ?>">
                                        <?php echo $children_res_name === null ? 'children not found in the database' : htmlspecialchars($children_res_name) ?>
                                      </td>
                                      <!-- ANNUAL INCOME -->
                                      <td class="align-middle user-select-none">
                                        <?php echo strtolower(htmlspecialchars($row['lowincome_annual_income'])) ?>
                                      </td>
                                      <!-- PAYMENT -->
                                      <td class="align-middle user-select-none">
                                        <?php echo htmlspecialchars($row['lowincome_payment']) ?>
                                      </td>
                                      <td class="align-middle user-select-none">
                                        <!-- EDIT -->
                                        <button type="button" class="btn btn-primary mr-1"
                                          data-target="#editModal<?php echo htmlspecialchars($row['id']) ?>"
                                          data-toggle="modal">
                                          <i class="fas fa-edit" aria-hidden="true"></i>&nbsp Edit
                                        </button>
                                        <!-- GENERATE -->
                                        <a target="_blank"
                                          href="form.php?resident=<?php echo htmlspecialchars($row['lowincome_res_id']) ?>&lowincome=<?php echo htmlspecialchars($row['lowincome_num']) ?>&value=<?php echo base64_encode(htmlspecialchars($row['lowincome_num']) . '|' . htmlspecialchars($row['lowincome_resident_name']) . '|' . htmlspecialchars($row['lowincome_date_added']) . ' | ' . htmlspecialchars($row['lowincome_date_approved'])) ?>"
                                          class="btn btn-success ml-1">
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
                              <table id="tbllowincome2" class="table table-bordered table-striped table-hover">
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
                                  <th class="align-middle user-select-none">Resident Name</th>
                                  <th class="align-middle user-select-none">Children Name</th>
                                  <th class="align-middle user-select-none">Num of Children</th>
                                  <th class="align-middle user-select-none">Annual Income</th>
                                  <th class="align-middle user-select-none">Findings</th>
                                </thead>
                                <tbody>
                                  <?php
                                  $squery = mysqli_query($con, "SELECT p.*, 
                                  CASE
                                  WHEN r1.id IS NOT NULL THEN CONCAT(r1.resident_fname, 
                                  IF(r1.resident_mname = 'n/a', '', CONCAT(' ', SUBSTRING(r1.resident_mname, 1, 1), '.')), 
                                  ' ', r1.resident_lname)
                                  WHEN p.lowincome_res_id REGEXP '^[0-9]+$' THEN (SELECT CONCAT(resident_fname, 
                                  IF(resident_mname = 'n/a', '', CONCAT(' ', SUBSTRING(resident_mname, 1, 1), '.')), 
                                  ' ', resident_lname) FROM tblresident WHERE id = p.lowincome_res_id) 
                                      ELSE p.lowincome_res_id
                                      END AS lowincome_resident_name,
                                  CASE 
                                      WHEN r2.id IS NOT NULL THEN CONCAT(r2.resident_fname, 
                                  IF(r2.resident_mname = 'n/a', '', CONCAT(' ', SUBSTRING(r2.resident_mname, 1, 1), '.')), 
                                  ' ', r2.resident_lname)
                                      WHEN p.lowincome_children_res_id REGEXP '^[0-9]+$' THEN (SELECT CONCAT(resident_fname, 
                                  IF(resident_mname = 'n/a', '', CONCAT(' ', SUBSTRING(resident_mname, 1, 1), '.')), 
                                  ' ', resident_lname) FROM tblresident WHERE id = p.lowincome_children_res_id) 
                                      ELSE p.lowincome_children_res_id 
                                  END AS lowincome_children_res_name,
                                  r2.resident_age as lowincome_children_res_age,
                                  CASE 
                                      WHEN r3.id IS NOT NULL THEN CONCAT(r3.resident_fname, 
                                  IF(r3.resident_mname = 'n/a', '', CONCAT(' ', SUBSTRING(r3.resident_mname, 1, 1), '.')), 
                                  ' ', r3.resident_lname)
                                      WHEN p.lowincome_requester_res_id REGEXP '^[0-9]+$' THEN (SELECT CONCAT(resident_fname, 
                                  IF(resident_mname = 'n/a', '', CONCAT(' ', SUBSTRING(resident_mname, 1, 1), '.')), 
                                  ' ', resident_lname) FROM tblresident WHERE id = p.lowincome_requester_res_id) 
                                      ELSE p.lowincome_requester_res_id 
                                  END AS lowincome_requester_res_name,
                                  r1.resident_birth_date,
                                  r1.resident_civil_status,
                                  r1.resident_age,
                                  r1.resident_purok
                                    FROM tbllowincome p 
                                    LEFT JOIN tblresident r1 ON r1.id = p.lowincome_res_id 
                                    LEFT JOIN tblresident r2 ON r2.id = p.lowincome_children_res_id 
                                    LEFT JOIN tblresident r3 ON r3.id = p.lowincome_requester_res_id 
                                    WHERE lowincome_status = 'disapproved'
                                  ORDER BY id DESC") or die('Error: ' . mysqli_error($con));

                                  while ($row = mysqli_fetch_array($squery)) { ?>
                                    <?php
                                    $checkboxId = 'cstm-chckbx' . $row['id'];

                                    $lowincome_resident_name = $row['lowincome_resident_name'];
                                    $lowincome_resident_name_class = $lowincome_resident_name === null ? 'text-warning text-lowercase' : '';

                                    $children_res_name = $row['lowincome_children_res_name'];
                                    $children_name_class = $children_res_name === null ? 'text-warning text-lowercase' : ''; ?>
                                    <tr>
                                      <!-- CHECKBOX -->
                                      <td class="align-middle user-select-none" style="width: 0px !important">
                                        <div class="custom-control custom-checkbox" style="padding: 0 0 0 31px">
                                          <input type="checkbox" name="chk_delete[]" class="chk_delete custom-control-input"
                                            id="<?php echo htmlspecialchars($checkboxId) ?>"
                                            value="<?php echo htmlspecialchars($row['id']) ?>">
                                          <label for="<?php echo htmlspecialchars($checkboxId) ?>"
                                            class="custom-control-label"></label>
                                        </div>
                                      </td>
                                      <!-- RESIDENT NAME -->
                                      <td class="align-middle user-select-none <?php echo $lowincome_resident_name_class ?>">
                                        <?php echo $lowincome_resident_name === null ? 'resident not found in the database' : htmlspecialchars($lowincome_resident_name) ?>
                                      </td>
                                      <!-- CHILDREN NAME -->
                                      <td class="align-middle user-select-none <?php echo $children_name_class ?>">
                                        <?php echo $children_res_name === null ? 'children not found in the database' : htmlspecialchars($children_res_name) ?>
                                      </td>
                                      <!-- NUMBER OF CHILDREN -->
                                      <td class="align-middle user-select-none">
                                        <?php echo htmlspecialchars($row['lowincome_num_of_children']) ?>
                                      </td>
                                      <!-- ANNUAL INCOME -->
                                      <td class="align-middle user-select-none">
                                        <?php echo htmlspecialchars($row['lowincome_annual_income']) ?>
                                      </td>
                                      <!-- FINDINGS -->
                                      <td class="align-middle user-select-none">
                                        <?php echo htmlspecialchars($row['lowincome_findings']) ?>
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
                          &nbsp; Request Certificate of Low Income</button>
                        <?php if ((isset($_SESSION['role']) && $_SESSION['role'] === "administrator") || (isset($_SESSION['role']) && $_SESSION['role'] === "staff")) { ?>
                          <button type="button" class="btn btn-danger ml-1" data-toggle="modal" data-target="#deleteModal"><i
                              class="fas fa-trash-alt" aria-hidden="true"></i>
                            &nbsp; Delete Certificate of Low Income</button>
                        <?php } ?>
                      </div>
                    </div>
                    <div class="card card-primary card-outline card-outline-tabs">
                      <div class="card-header p-0 border-bottom-0">
                        <ul class="nav nav-tabs" id="custom-tabs-four-tab" role="tablist">
                          <!-- new -->
                          <li class="nav-item">
                            <a class="nav-link active" id="new-cstm-tab" data-target="#new" data-toggle="pill" role="button"
                              aria-controls="new-cstm-tab" aria-selected="true">New <span id="lowincome-new-loadBadge"
                                class="badge badge-info ml-1" style="font-size: 14px">...</span></a>
                          </li>
                          <!-- approved -->
                          <li class="nav-item">
                            <a class="nav-link" id="approved-cstm-tab" data-target="#approved" data-toggle="pill"
                              role="button" aria-controls="approved-cstm-tab" aria-selected="false">Approrved
                              <span id="lowincome-approved-loadBadge" class="badge badge-success ml-1"
                                style="font-size: 14px">...</span></a>
                          </li>
                          <!-- disapproved -->
                          <li class="nav-item">
                            <a class="nav-link" id="disapproved-cstm-tab" data-target="#disapproved" data-toggle="pill"
                              role="button" aria-controls="disapproved-cstm-tab" aria-selected="false">Disapprove <span
                                id="lowincome-disapproved-loadBadge" class="badge badge-danger ml-1"
                                style="font-size: 14px">...</span></a>
                          </li>
                        </ul>
                      </div>
                      <div class="card-body table-responsive">
                        <form method="post">
                          <div class="tab-content" id="custom-tabs-four-tabContent">
                            <!-- new -->
                            <div class="tab-pane fade show active" id="new" role="tabpanel" aria-labelledby="new-cstm-tab">
                              <table id="tbllowincome" class="table table-bordered table-striped">
                                <thead>
                                  <tr>
                                    <th class="align-middle user-select-none">Children Name</th>
                                    <th class="align-middle user-select-none">Children Age</th>
                                    <th class="align-middle user-select-none">Num of Children</th>
                                    <th class="align-middle user-select-none">Gov Office</th>
                                    <th class="align-middle user-select-none">Annual Income</th>
                                  </tr>
                                </thead>
                                <tbody>
                                  <?php
                                  $squery = mysqli_query($con, "SELECT p.*, 
                                  CASE
                                  WHEN r1.id IS NOT NULL THEN CONCAT(r1.resident_fname, 
                                  IF(r1.resident_mname = 'n/a', '', CONCAT(' ', SUBSTRING(r1.resident_mname, 1, 1), '.')), 
                                  ' ', r1.resident_lname)
                                  WHEN p.lowincome_res_id REGEXP '^[0-9]+$' THEN (SELECT CONCAT(resident_fname, 
                                  IF(resident_mname = 'n/a', '', CONCAT(' ', SUBSTRING(resident_mname, 1, 1), '.')), 
                                  ' ', resident_lname) FROM tblresident WHERE id = p.lowincome_res_id) 
                                      ELSE p.lowincome_res_id
                                      END AS lowincome_resident_name,
                                  CASE 
                                      WHEN r2.id IS NOT NULL THEN CONCAT(r2.resident_fname, 
                                  IF(r2.resident_mname = 'n/a', '', CONCAT(' ', SUBSTRING(r2.resident_mname, 1, 1), '.')), 
                                  ' ', r2.resident_lname)
                                      WHEN p.lowincome_children_res_id REGEXP '^[0-9]+$' THEN (SELECT CONCAT(resident_fname, 
                                  IF(resident_mname = 'n/a', '', CONCAT(' ', SUBSTRING(resident_mname, 1, 1), '.')), 
                                  ' ', resident_lname) FROM tblresident WHERE id = p.lowincome_children_res_id) 
                                      ELSE p.lowincome_children_res_id 
                                  END AS lowincome_children_res_name,
                                  CASE 
                                  WHEN p.lowincome_children_age = 'n/a' THEN r2.resident_age
                                  ELSE p.lowincome_children_age
                                  END AS lowincome_children_res_age,
                                  CASE 
                                      WHEN r3.id IS NOT NULL THEN CONCAT(r3.resident_fname, 
                                  IF(r3.resident_mname = 'n/a', '', CONCAT(' ', SUBSTRING(r3.resident_mname, 1, 1), '.')), 
                                  ' ', r3.resident_lname)
                                      WHEN p.lowincome_requester_res_id REGEXP '^[0-9]+$' THEN (SELECT CONCAT(resident_fname, 
                                  IF(resident_mname = 'n/a', '', CONCAT(' ', SUBSTRING(resident_mname, 1, 1), '.')), 
                                  ' ', resident_lname) FROM tblresident WHERE id = p.lowincome_requester_res_id) 
                                      ELSE p.lowincome_requester_res_id 
                                  END AS lowincome_requester_res_name,
                                    r1.resident_birth_date,
                                    r1.resident_civil_status,
                                    r1.resident_age,
                                    r1.resident_purok
                                    FROM tbllowincome p 
                                    LEFT JOIN tblresident r1 ON r1.id = p.lowincome_res_id 
                                    LEFT JOIN tblresident r2 ON r2.id = p.lowincome_children_res_id 
                                    LEFT JOIN tblresident r3 ON r3.id = p.lowincome_requester_res_id 
                                    WHERE p.lowincome_res_id = " . $_SESSION['userid'] . " AND lowincome_status = 'new' ORDER BY p.lowincome_res_id DESC") or die('Error: ' . mysqli_error($con));

                                  if (mysqli_num_rows($squery) > 0) {
                                    while ($row = mysqli_fetch_array($squery)) {
                                      $lowincome_resident_name = $row['lowincome_resident_name'];
                                      $lowincome_resident_name_class = $lowincome_resident_name === null ? 'text-warning text-lowercase' : '';

                                      $children_res_name = $row['lowincome_children_res_name'];
                                      $children_name_class = $children_res_name === null ? 'text-warning text-lowercase' : '';

                                      $children_res_age = $row['lowincome_children_res_age'];
                                      $children_age_name_class = $children_res_age === null ? 'text-warning text-lowercase' : '';

                                      $requester_res_name = $row['lowincome_requester_res_name'];
                                      $requester_name_class_na = $requester_res_name === 'n/a' ? 'text-warning text-lowercase' : '';
                                      $requester_name_class_null = $requester_res_name === null ? 'text-warning text-lowercase' : ''; ?>
                                      <tr>
                                        <!-- CHILDREN NAME -->
                                        <td class="align-middle user-select-none <?php echo $children_name_class ?>">
                                          <?php echo $children_res_name === null ? 'children not found in the database' : htmlspecialchars($children_res_name) ?>
                                        </td>
                                        <!-- CHILDREN AGE -->
                                        <td class="align-middle user-select-none <?php echo $children_age_name_class ?>">
                                          <?php echo $children_res_age === null ? 'children not found in the database' : htmlspecialchars($children_res_age) ?>
                                        </td>
                                        <!-- NUMBER OF CHILDREN -->
                                        <td class="align-middle user-select-none">
                                          <?php echo htmlspecialchars($row['lowincome_num_of_children']) ?>
                                        </td>
                                        <!-- GOVERNMENT OFFICE -->
                                        <td class="align-middle user-select-none">
                                          <?php echo htmlspecialchars($row['lowincome_gov_office']) ?>
                                        </td>
                                        <!-- ANNUAL INCOME -->
                                        <td class="align-middle user-select-none">
                                          <?php echo htmlspecialchars($row['lowincome_annual_income']) ?>
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
                              <table id="tbllowincome1" class="table table-bordered table-striped">
                                <thead>
                                  <tr>
                                    <th class="align-middle user-select-none">Low Income #</th>
                                    <th class="align-middle user-select-none">Resident Name</th>
                                    <th class="align-middle user-select-none">Requester Name</th>
                                    <th class="align-middle user-select-none">Children Name</th>
                                    <th class="align-middle user-select-none">Annual Income</th>
                                    <th class="align-middle user-select-none">Payment</th>
                                  </tr>
                                </thead>
                                <tbody>
                                  <?php
                                  $squery = mysqli_query($con, "SELECT p.*, 
                                  CASE
                                  WHEN r1.id IS NOT NULL THEN CONCAT(r1.resident_fname, 
                                  IF(r1.resident_mname = 'n/a', '', CONCAT(' ', SUBSTRING(r1.resident_mname, 1, 1), '.')), 
                                  ' ', r1.resident_lname)
                                  WHEN p.lowincome_res_id REGEXP '^[0-9]+$' THEN (SELECT CONCAT(resident_fname, 
                                  IF(resident_mname = 'n/a', '', CONCAT(' ', SUBSTRING(resident_mname, 1, 1), '.')), 
                                  ' ', resident_lname) FROM tblresident WHERE id = p.lowincome_res_id) 
                                      ELSE p.lowincome_res_id
                                      END AS lowincome_resident_name,
                                  CASE 
                                      WHEN r2.id IS NOT NULL THEN CONCAT(r2.resident_fname, 
                                  IF(r2.resident_mname = 'n/a', '', CONCAT(' ', SUBSTRING(r2.resident_mname, 1, 1), '.')), 
                                  ' ', r2.resident_lname)
                                      WHEN p.lowincome_children_res_id REGEXP '^[0-9]+$' THEN (SELECT CONCAT(resident_fname, 
                                  IF(resident_mname = 'n/a', '', CONCAT(' ', SUBSTRING(resident_mname, 1, 1), '.')), 
                                  ' ', resident_lname) FROM tblresident WHERE id = p.lowincome_children_res_id) 
                                      ELSE p.lowincome_children_res_id 
                                  END AS lowincome_children_res_name,
                                  r2.resident_age as lowincome_children_res_age,
                                  CASE 
                                      WHEN r3.id IS NOT NULL THEN CONCAT(r3.resident_fname, 
                                  IF(r3.resident_mname = 'n/a', '', CONCAT(' ', SUBSTRING(r3.resident_mname, 1, 1), '.')), 
                                  ' ', r3.resident_lname)
                                      WHEN p.lowincome_requester_res_id REGEXP '^[0-9]+$' THEN (SELECT CONCAT(resident_fname, 
                                  IF(resident_mname = 'n/a', '', CONCAT(' ', SUBSTRING(resident_mname, 1, 1), '.')), 
                                  ' ', resident_lname) FROM tblresident WHERE id = p.lowincome_requester_res_id) 
                                      ELSE p.lowincome_requester_res_id 
                                  END AS lowincome_requester_res_name,
                                  r1.resident_birth_date,
                                  r1.resident_civil_status,
                                  r1.resident_age,
                                  r1.resident_purok
                                    FROM tbllowincome p 
                                    LEFT JOIN tblresident r1 ON r1.id = p.lowincome_res_id 
                                    LEFT JOIN tblresident r2 ON r2.id = p.lowincome_children_res_id 
                                    LEFT JOIN tblresident r3 ON r3.id = p.lowincome_requester_res_id 
                                    WHERE p.lowincome_res_id = " . $_SESSION['userid'] . " AND lowincome_status = 'approved' ORDER BY p.lowincome_res_id DESC") or die('Error: ' . mysqli_error($con));

                                  if (mysqli_num_rows($squery) > 0) {
                                    while ($row = mysqli_fetch_array($squery)) {

                                      $lowincome_resident_name = $row['lowincome_resident_name'];
                                      $lowincome_resident_name_class = $lowincome_resident_name === null ? 'text-warning text-lowercase' : '';

                                      $children_res_name = $row['lowincome_children_res_name'];
                                      $children_name_class = $children_res_name === null ? 'text-warning text-lowercase' : '';

                                      $children_res_age = $row['lowincome_children_res_age'];
                                      $children_age_name_class = $children_res_age === null ? 'text-warning text-lowercase' : '';

                                      $requester_res_name = $row['lowincome_requester_res_name'];
                                      $requester_name_class_na = $requester_res_name === 'n/a' ? 'text-warning text-lowercase' : '';
                                      $requester_name_class_null = $requester_res_name === null ? 'text-warning text-lowercase' : '';
                                      ?>
                                      <tr>
                                        <!-- LOW INCOME NUMBER -->
                                        <td class="align-middle user-select-none">
                                          <?php echo htmlspecialchars($row['lowincome_num']) ?>
                                        </td>
                                        <!-- RESIDENT NAME -->
                                        <td class="align-middle user-select-none <?php echo $lowincome_resident_name_class ?>">
                                          <?php echo $lowincome_resident_name === null ? 'resident not found in the database' : htmlspecialchars($lowincome_resident_name) ?>
                                        </td>
                                        <!-- REQUESTER NAME -->
                                        <?php
                                        if ($requester_res_name === 'n/a') {
                                          ?>
                                          <!-- REQUESTER IS NOT APPLICABLE -->
                                          <td class="align-middle user-select-none <?php echo $requester_name_class_na ?>">
                                            <?php echo $requester_res_name === 'n/a' ? 'requester is not needed' : htmlspecialchars($requester_res_name) ?>
                                          </td>
                                          <?php
                                        } else {
                                          ?>
                                          <!-- REQUESTER IS NOT FOUND -->
                                          <td class="align-middle user-select-none <?php echo $requester_name_class_null ?>">
                                            <?php echo $requester_res_name === null ? 'requester not found in the database' : htmlspecialchars($requester_res_name) ?>
                                          </td>
                                          <?php
                                        } ?>
                                        <!-- CHILDREN NAME -->
                                        <td class="align-middle user-select-none <?php echo $children_name_class ?>">
                                          <?php echo $children_res_name === null ? 'children not found in the database' : htmlspecialchars($children_res_name) ?>
                                        </td>
                                        <!-- ANNUAL INCOME -->
                                        <td class="align-middle user-select-none">
                                          <?php echo strtolower(htmlspecialchars($row['lowincome_annual_income'])) ?>
                                        </td>
                                        <!-- PAYMENT -->
                                        <td class="align-middle user-select-none">
                                          <?php echo htmlspecialchars($row['lowincome_payment']) ?>
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
                              <table id="tbllowincome2" class="table table-bordered table-striped">
                                <thead>
                                  <th class="align-middle user-select-none">Resident Name</th>
                                  <th class="align-middle user-select-none">Children Name</th>
                                  <th class="align-middle user-select-none">Annual Income</th>
                                  <th class="align-middle user-select-none">Findings</th>
                                </thead>
                                <tbody>
                                  <?php
                                  $squery = mysqli_query($con, "SELECT p.*, 
                                  CASE
                                  WHEN r1.id IS NOT NULL THEN CONCAT(r1.resident_fname, 
                                  IF(r1.resident_mname = 'n/a', '', CONCAT(' ', SUBSTRING(r1.resident_mname, 1, 1), '.')), 
                                  ' ', r1.resident_lname)
                                  WHEN p.lowincome_res_id REGEXP '^[0-9]+$' THEN (SELECT CONCAT(resident_fname, 
                                  IF(resident_mname = 'n/a', '', CONCAT(' ', SUBSTRING(resident_mname, 1, 1), '.')), 
                                  ' ', resident_lname) FROM tblresident WHERE id = p.lowincome_res_id) 
                                      ELSE p.lowincome_res_id
                                      END AS lowincome_resident_name,
                                  CASE 
                                      WHEN r2.id IS NOT NULL THEN CONCAT(r2.resident_fname, 
                                  IF(r2.resident_mname = 'n/a', '', CONCAT(' ', SUBSTRING(r2.resident_mname, 1, 1), '.')), 
                                  ' ', r2.resident_lname)
                                      WHEN p.lowincome_children_res_id REGEXP '^[0-9]+$' THEN (SELECT CONCAT(resident_fname, 
                                  IF(resident_mname = 'n/a', '', CONCAT(' ', SUBSTRING(resident_mname, 1, 1), '.')), 
                                  ' ', resident_lname) FROM tblresident WHERE id = p.lowincome_children_res_id) 
                                      ELSE p.lowincome_children_res_id 
                                  END AS lowincome_children_res_name,
                                  r2.resident_age as lowincome_children_res_age,
                                  CASE 
                                      WHEN r3.id IS NOT NULL THEN CONCAT(r3.resident_fname, 
                                  IF(r3.resident_mname = 'n/a', '', CONCAT(' ', SUBSTRING(r3.resident_mname, 1, 1), '.')), 
                                  ' ', r3.resident_lname)
                                      WHEN p.lowincome_requester_res_id REGEXP '^[0-9]+$' THEN (SELECT CONCAT(resident_fname, 
                                  IF(resident_mname = 'n/a', '', CONCAT(' ', SUBSTRING(resident_mname, 1, 1), '.')), 
                                  ' ', resident_lname) FROM tblresident WHERE id = p.lowincome_requester_res_id) 
                                      ELSE p.lowincome_requester_res_id 
                                  END AS lowincome_requester_res_name
                                    FROM tbllowincome p 
                                    LEFT JOIN tblresident r1 ON r1.id = p.lowincome_res_id 
                                    LEFT JOIN tblresident r2 ON r2.id = p.lowincome_children_res_id 
                                    LEFT JOIN tblresident r3 ON r3.id = p.lowincome_requester_res_id 
                                    WHERE p.lowincome_res_id = " . $_SESSION['userid'] . " AND lowincome_status = 'disapproved' ORDER BY p.lowincome_res_id DESC") or die('Error: ' . mysqli_error($con));

                                  if (mysqli_num_rows($squery) > 0) {
                                    while ($row = mysqli_fetch_array($squery)) {
                                      $lowincome_resident_name = $row['lowincome_resident_name'];
                                      $lowincome_resident_name_class = $lowincome_resident_name === null ? 'text-warning text-lowercase' : '';

                                      $children_res_name = $row['lowincome_children_res_name'];
                                      $children_name_class = $children_res_name === null ? 'text-warning text-lowercase' : '';

                                      $children_res_age = $row['lowincome_children_res_age'];
                                      $children_age_name_class = $children_res_age === null ? 'text-warning text-lowercase' : '';

                                      $requester_res_name = $row['lowincome_requester_res_name'];
                                      $requester_name_class_na = $requester_res_name === 'n/a' ? 'text-warning text-lowercase' : '';
                                      $requester_name_class_null = $requester_res_name === null ? 'text-warning text-lowercase' : ''; ?>
                                      <tr>
                                        <!-- RESIDENT NAME -->
                                        <td class="align-middle user-select-none <?php echo $lowincome_resident_name_class ?>">
                                          <?php echo $lowincome_resident_name === null ? 'resident not found in the database' : htmlspecialchars($lowincome_resident_name) ?>
                                        </td>
                                        <!-- CHILDREN NAME -->
                                        <td class="align-middle user-select-none <?php echo $children_name_class ?>">
                                          <?php echo $children_res_name === null ? 'children not found in the database' : htmlspecialchars($children_res_name) ?>
                                        </td>
                                        <!-- ANNUAL INCOME -->
                                        <td class="align-middle user-select-none">
                                          <?php echo htmlspecialchars($row['lowincome_annual_income']) ?>
                                        </td>
                                        <!-- FINDINGS -->
                                        <td class="align-middle user-select-none">
                                          <?php echo htmlspecialchars($row['lowincome_findings']) ?>
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
    // https://www.w3schools.com/xml/ajax_xmlhttprequest_send.asp
    function loadBadge() {
      let xhttp = new XMLHttpRequest();
      xhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
          const response = JSON.parse(this.responseText);
          // access lowincome counts
          document.getElementById("lowincome-new-loadBadge").innerHTML = response.lowincome.new;
          document.getElementById("lowincome-approved-loadBadge").innerHTML = response.lowincome.approved;
          document.getElementById("lowincome-disapproved-loadBadge").innerHTML = response.lowincome.disapproved;
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
        $("#tbllowincome").DataTable({
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
        }).buttons().container().appendTo('#tbllowincome_wrapper .col-md-6:eq(0)')
        $("#tbllowincome1").DataTable({
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
        }).buttons().container().appendTo('#tbllowincome1_wrapper .col-md-6:eq(0)')
        $("#tbllowincome2").DataTable({
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
        }).buttons().container().appendTo('#tbllowincome2_wrapper .col-md-6:eq(0)')
      });
      <?php
    } elseif ((isset($_SESSION['role']) && $_SESSION['role'] === "resident")) {
      ?>
      loadBadge();
      $(function () {
        $("#tbllowincome").DataTable({
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
            { "bSortable": true, "aTargets": [0] },
            { "orderable": true, "targets": [0] }
          ],
          "aaSorting": []
        }).buttons().container().appendTo('#tbllowincome_wrapper .col-md-6:eq(0)')
        $("#tbllowincome1").DataTable({
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
            { "bSortable": true, "aTargets": [0] },
            { "orderable": true, "targets": [0] }
          ],
          "aaSorting": []
        }).buttons().container().appendTo('#tbllowincome1_wrapper .col-md-6:eq(0)')
        $("#tbllowincome2").DataTable({
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
            { "bSortable": true, "aTargets": [0] },
            { "orderable": true, "targets": [0] }
          ],
          "aaSorting": []
        }).buttons().container().appendTo('#tbllowincome2_wrapper .col-md-6:eq(0)')
      });
      <?php
    } ?>
  </script>
</body>

</html>