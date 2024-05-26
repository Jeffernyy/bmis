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
                  <h1 class="m-0">Manage Barangay Staff</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                  <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Manage Barangay Staff</li>
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
                      <div class="row">
                        <div class="col-6 col-sm-6">
                          <button type="button" class="btn btn-primary mr-1" data-toggle="modal" data-target="#addModal">
                            <i class="fa fa-user-plus" aria-hidden="true"></i>&nbsp; Add Captain
                          </button>
                          <?php
                          if ((isset($_SESSION['role']) && $_SESSION['role'] === "administrator") || (isset($_SESSION['role']) && $_SESSION['role'] === "staff")) {
                            ?>
                            <button type="button" class="btn btn-danger ml-1" data-toggle="modal" data-target="#deleteModal">
                              <i class="fas fa-trash-alt" aria-hidden="true"></i>&nbsp; Delete Captain
                            </button>
                            <?php
                          } ?>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="card card-primary card-outline">
                    <div class="card-body table-responsive">
                      <form method="post" enctype="multipart/form-data">
                        <table id="tblstaff" class="table table-bordered table-striped table-hover">
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
                              <th class="align-middle user-select-none">Image</th>
                              <th class="align-middle user-select-none">Name</th>
                              <th class="align-middle user-select-none">Username</th>
                              <th class="align-middle user-select-none">Added By</th>
                              <th class="align-middle user-select-none">Date Added</th>
                              <th class="align-middle user-select-none" width="82px">Option</th>
                            </tr>
                          </thead>
                          <tbody>
                            <?php
                            if ((isset($_SESSION['role']) && $_SESSION['role'] === "administrator")) {
                              $squery = mysqli_query($con, "SELECT *,CONCAT(staff_fname, IF(staff_mname = 'n/a', '', CONCAT(' ', staff_mname)), ' ', staff_lname) AS staff_res_name FROM tblstaff");
                              while ($row = mysqli_fetch_array($squery)) {
                                $checkboxId = 'cstm-chckbx' . $row['id']; ?>
                                <tr>
                                  <td class="align-middle user-select-none" style="width: 0px !important">
                                    <div class="custom-control custom-checkbox" style="padding: 0 0 0 31px">
                                      <input type="checkbox" name="chk_delete[]" class="chk_delete custom-control-input"
                                        id="<?php echo $checkboxId ?>" value="<?php echo $row['id'] ?>">
                                      <label for="<?php echo $checkboxId ?>" class="custom-control-label"></label>
                                    </div>
                                  </td>
                                  <td class="align-middle user-select-none p-2 m-0" width="50px">
                                    <image src="images/<?php echo basename($row['staff_image']) ?>" width="70px" height="70px">
                                  </td>
                                  <td class="align-middle user-select-none">
                                    <?php echo $row['staff_res_name'] ?>
                                  </td>
                                  <td class="align-middle user-select-none">
                                    <?php echo $row['staff_uname'] ?>
                                  </td>
                                  <td class="align-middle user-select-none">
                                    <?php echo $row['staff_added_by'] ?>
                                  </td>
                                  <td class="align-middle user-select-none">
                                    <?php echo $row['staff_date_added'] ?>
                                  </td>
                                  <td class="align-middle user-select-none">
                                    <button type="button" class="btn btn-primary"
                                      data-target="#editModal<?php echo $row['id'] ?>" data-toggle="modal">
                                      <i class="fas fa-edit" aria-hidden="true"></i>&nbsp Edit
                                    </button>
                                  </td>
                                </tr>
                                <?php
                                include 'modal/edit.mod.php';
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
  <script>
    $(document).ready(function () {
      var addTimeOut = { timeout: null };
      $("#add_username").keyup(function (e) {
        handleKeyUp("#add_username", "#add_user_msg", addTimeOut, e, "btn_add");
      });
    });

    // check the username availability and query the result
    function handleKeyUp(usernameSelector, userMsgSelector, timeOutRef, event, btnId) {
      var username = $(usernameSelector).val();
      var loading_html = '<img src="../../assets/loader/loader.gif" style="width: 25px; height: 25px;">';
      if (username === "") {
        $(userMsgSelector).html('<span class="text-warning">Username cannot be empty.</span>');
        // disable button if username is empty
        disableButton(btnId);
        return;
      }

      if (event.key === "Backspace") {
        // handle backspace separately
        // the only problem here if the input is empty by holding alt + a then backspace
        // but it is working properly
        // execute ...
        is_available(username, userMsgSelector, btnId);
        return;
      }

      if (timeOutRef.timeout != null) clearTimeout(timeOutRef.timeout);

      // show loader before making the ajax request
      // if it is not then the loader didn't show after the ajax call
      $(userMsgSelector).html(loading_html);
      timeOutRef.timeout = setTimeout(function () {
        is_available(username, userMsgSelector, btnId);
      }, 1000);
    }

    function is_available(username, userMsgSelector, btnId) {
      var btn = document.getElementById(btnId);
      // send an ajax request to the server-side
      $.post("../../ajax/username.ajax.php", { staff_uname: username }, function (result) {
        console.log(result);
        if (result != 0) {
          $(userMsgSelector).html('<span style="color: #ff8080">This username is already taken.</span>');
          // disable button if username is taken
          disableButton(btnId);
        } else {
          $(userMsgSelector).html('<span style="color: #45ff70">This username is available</span>');
          // enable button if username is available
          enableButton(btnId);
        }
      });
    }

    // need to call separately
    function disableButton(btnId) {
      var btn = document.getElementById(btnId);
      if (btn) {
        btn.disabled = true;
      }
    }

    function enableButton(btnId) {
      var btn = document.getElementById(btnId);
      if (btn) {
        btn.disabled = false;
      }
    }
  </script>
</body>

</html>