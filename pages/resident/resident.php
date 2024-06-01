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
                  <h1 class="m-0">Manage Resident</h1>
                </div>
                <div class="col-sm-6">
                  <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Manage Resident</li>
                  </ol>
                </div>
              </div>
            </div>
          </section>
          <?php
          if (!isset($_GET['resident'])) {
            ?>
            <!-- main content -->
            <section class="content">
              <div class="container-fluid">
                <div class="row">
                  <div class="col-12 col-sm-12">
                    <div class="card card-primary card-outline">
                      <div class="card-header">
                        <div class="row">
                          <div class="col-6 col-sm-6">
                            <button type="button" class="btn btn-primary mr-1" data-toggle="modal" data-target="#addModal"><i
                                class="fa fa-user-plus" aria-hidden="true"></i>
                              &nbsp; Add Resident</button>
                            <?php
                            if ((isset($_SESSION['role']) && $_SESSION['role'] === "administrator") || (isset($_SESSION['role']) && $_SESSION['role'] === "staff")) {
                              ?>
                              <button type="button" class="btn btn-danger ml-1" data-toggle="modal"
                                data-target="#deleteModal"><i class="fas fa-trash-alt" aria-hidden="true"></i>
                                &nbsp; Delete Resident</button>
                              <?php
                            } ?>
                          </div>
                          <div class="col-6 col-sm-6 d-flex justify-content-end" style="padding: 0 14px 0 0">
                            <form method="get">
                              <div class="row">
                                <?php
                                // function to generate sha-256 hash
                                function generateHash($value)
                                {
                                  return hash('sha256', $value);
                                }
                                // get the filter value from the URL
                                $filter = isset($_GET['filter']) ? $_GET['filter'] : '';
                                // hash the filter value
                                $hashedFilter = generateHash($filter);
                                ?>
                                <!-- display the hashed filter value in the url -->
                                <div class="form-group d-flex align-items-center my-0 py-0 pr-2">
                                  <label for="purok" class="control-label my-0 mr-3">Filter by purok</label>
                                  <select name="filter" id="purok" class="form-control select2"
                                    data-minimum-results-for-search="Infinity">
                                    <option selected disabled>Please select purok</option>
                                    <option value="alacta" <?= $filter === 'alacta' ? 'selected' : '' ?>>Alacta</option>
                                    <option value="alaska" <?= $filter === 'alaska' ? 'selected' : '' ?>>Alaska</option>
                                    <option value="alpine" <?= $filter === 'alpine' ? 'selected' : '' ?>>Alpine</option>
                                    <option value="bearbrand" <?= $filter === 'bearbrand' ? 'selected' : '' ?>>Bearbrand</option>
                                    <option value="carnation" <?= $filter === 'carnation' ? 'selected' : '' ?>>Carnation</option>
                                    <option value="liberty" <?= $filter === 'liberty' ? 'selected' : '' ?>>Liberty</option>
                                    <option value="nido" <?= $filter === 'nido' ? 'selected' : '' ?>>Nido</option>
                                    <option value="sustagen" <?= $filter === 'sustagen' ? 'selected' : '' ?>>Sustagen</option>
                                  </select>
                                  <?php
                                  // display the hashed filter value in the url
                                  ?> <input type="hidden" name="hashed_filter"
                                    value="<?php echo htmlspecialchars($hashedFilter) ?>"> <?php
                                       ?>
                                </div>
                                <div class="form-group my-0 py-0 pl-2">
                                  <button type="submit" class="btn btn-success mr-1"><i class="fas fa-filter"></i>&nbsp;
                                    Filter</button>
                                  <button type="button" class="btn btn-danger ml-1" onclick="resetSelect()"><i
                                      class="fas fa-undo-alt"></i>&nbsp; Reset</button>
                                </div>
                              </div>
                            </form>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="card card-primary card-outline">
                      <div class="card-body table-responsive">
                        <form method="post" enctype="multipart/form-data">
                          <table id="tblresident" class="table table-bordered table-striped table-hover">
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
                                <th class="align-middle user-select-none">Purok</th>
                                <th class="align-middle user-select-none">Name</th>
                                <th class="align-middle user-select-none">Email</th>
                                <th class="align-middle user-select-none">Gender</th>
                                <th class="align-middle user-select-none">Religion</th>
                                <th class="align-middle user-select-none" width="180px">Option</th>
                              </tr>
                            </thead>
                            <tbody>
                              <?php
                              if ((isset($_SESSION['role']) && $_SESSION['role'] === "administrator") || (isset($_SESSION['role']) && $_SESSION['role'] === "staff")) {
                                if (isset($_GET['filter']) && $_GET['filter'] != '') {
                                  $filter = $_GET['filter'];
                                  $squery = mysqli_query($con, "SELECT *,CONCAT(resident_fname, IF(resident_mname = 'n/a', '', CONCAT(' ', resident_mname)), ' ', resident_lname) AS res_name FROM tblresident WHERE resident_purok = '$filter' ORDER BY resident_purok");
                                } else {
                                  $squery = mysqli_query($con, "SELECT *,CONCAT(resident_fname, IF(resident_mname = 'n/a', '', CONCAT(' ', resident_mname)), ' ', resident_lname) AS res_name FROM tblresident ORDER BY resident_purok");
                                }
                                while ($row = mysqli_fetch_array($squery)) {
                                  $checkboxId = 'cstm-chckbx' . $row['id'];
                                  ?>
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
                                    <td class="align-middle user-select-none p-2 m-0" width="50px">
                                      <image src="images/<?php echo htmlspecialchars(basename($row['resident_image'])) ?>"
                                        width="70px" height="70px">
                                    </td>
                                    <td class="align-middle user-select-none">
                                      <?php echo htmlspecialchars($row['resident_purok']) ?>
                                    </td>
                                    <td class="align-middle user-select-none"><?php echo htmlspecialchars($row['res_name']) ?>
                                    </td>
                                    <td class="align-middle user-select-none">
                                      <?php echo htmlspecialchars($row['resident_email_add']) ?>
                                    </td>
                                    <td class="align-middle user-select-none">
                                      <?php echo htmlspecialchars($row['resident_gender']) ?>
                                    </td>
                                    <td class="align-middle user-select-none">
                                      <?php echo htmlspecialchars($row['resident_religion']) ?>
                                    </td>
                                    <td class="align-middle user-select-none">
                                      <button type="button" class="btn btn-primary mr-1"
                                        data-target="#edit<?php echo htmlspecialchars($row['id']) ?>" data-toggle="modal">
                                        <i class="fas fa-edit" aria-hidden="true"></i>&nbsp; Edit
                                      </button>
                                      <button type="button" class="btn btn-primary ml-1"
                                        data-target="#viewr<?php echo htmlspecialchars($row['id']) ?>" data-toggle="modal">
                                        <i class="fas fa-eye" aria-hidden="true"></i>&nbsp; View
                                      </button>
                                    </td>
                                  </tr>
                                  <?php
                                  include 'modal/edit.mod.php';
                                  include 'modal/viewr.mod.php';
                                }
                              } else {
                                $squery = mysqli_query($con, "SELECT *,CONCAT(resident_fname, IF(resident_mname = 'n/a', '', CONCAT(' ', resident_mname)), ' ', resident_lname) AS res_name FROM tblresident ORDER BY resident_purok");
                                while ($row = mysqli_fetch_array($squery)) {
                                  ?>
                                  <tr>
                                    <td class="align-middle user-select-none">
                                      <?php echo htmlspecialchars($row['resident_purok']) ?>
                                    </td>
                                    <td class="align-middle user-select-none p-2 m-0" width="50px">
                                      <image src="images/<?php echo htmlspecialchars(basename($row['resident_image'])) ?>"
                                        width="70px" height="70px">
                                    </td>
                                    <td class="align-middle user-select-none"><?php echo htmlspecialchars($row['res_name']) ?>
                                    </td>
                                    <td class="align-middle user-select-none"><?php echo htmlspecialchars($row['resident_age']) ?>
                                    </td>
                                    <td class="align-middle user-select-none">
                                      <?php echo htmlspecialchars($row['resident_gender']) ?>
                                    </td>
                                    <td class="align-middle user-select-none">
                                      <button type="button" class="btn btn-primary mr-1"
                                        data-target="#edit<?php echo htmlspecialchars($row['id']) ?>" data-toggle="modal">
                                        <i class="fas fa-edit" aria-hidden="true"></i>&nbsp; Edit
                                      </button>
                                      <button type="button" class="btn btn-primary ml-1"
                                        data-target="#viewr<?php echo htmlspecialchars($row['id']) ?>" data-toggle="modal">
                                        <i class="fas fa-eye" aria-hidden="true"></i>&nbsp; View
                                      </button>
                                    </td>
                                  </tr>
                                  <?php
                                  include 'modal/edit.mod.php';
                                  include 'modal/viewr.mod.php';
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
            <?php
          } else {
            ?>
            <!-- main content -->
            <section class="content">
              <div class="container-fluid">
                <div class="row">
                  <div class="col-12 col-sm-12">
                    <div class="card card-primary card-outline">
                      <div class="card-body table-responsive">
                        <form method="post" enctype="multipart/form-data">
                          <table id="tblresident1" class="table table-bordered table-striped table-hover">
                            <thead>
                              <tr>
                                <th class="align-middle user-select-none">Image</th>
                                <th class="align-middle user-select-none">Name</th>
                                <th class="align-middle user-select-none">Household #</th>
                                <th class="align-middle user-select-none">Total Household #</th>
                                <th class="align-middle user-select-none">Relationship</th>
                                <th class="align-middle user-select-none">Civil Status</th>
                                <th class="align-middle user-select-none" width="88px">Option</th>
                              </tr>
                            </thead>
                            <tbody>
                              <?php
                              $squery = mysqli_query($con, "SELECT *, CONCAT(resident_fname, IF(resident_mname = 'n/a', '', CONCAT(' ', resident_mname)), ' ', resident_lname) AS res_name FROM tblresident WHERE resident_household_num = '" . $_GET['resident'] . "'");
                              while ($row = mysqli_fetch_array($squery)) {
                                ?>
                                <tr>
                                  <td class="align-middle user-select-none p-2 m-0" width="50px">
                                    <image src="images/<?php echo htmlspecialchars(basename($row['resident_image'])) ?>"
                                      width="70px" height="70px">
                                  </td>
                                  <td class="align-middle user-select-none"><?php echo htmlspecialchars($row['res_name']) ?>
                                  </td>
                                  <td class="align-middle user-select-none">
                                    <?php echo htmlspecialchars($row['resident_household_num']) ?>
                                  </td>
                                  <td class="align-middle user-select-none">
                                    <?php echo htmlspecialchars($row['resident_total_household_mem']) ?>
                                  </td>
                                  <td class="align-middle user-select-none">
                                    <?php echo htmlspecialchars($row['resident_relationship_to_head']) ?>
                                  </td>
                                  <td class="align-middle user-select-none">
                                    <?php echo htmlspecialchars($row['resident_civil_status']) ?>
                                  </td>
                                  <td class="align-middle user-select-none">
                                    <button type="button" class="btn btn-primary"
                                      data-target="#viewh<?php echo htmlspecialchars($row['id']) ?>" data-toggle="modal">
                                      <i class="fas fa-eye" aria-hidden="true"></i>&nbsp; View
                                    </button>
                                  </td>
                                </tr>
                                <?php
                                include 'modal/viewh.mod.php';
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
            <?php
          } ?>
        </div>
      </div>
    <?php }
}
include '../../include/footer.inc.php' ?>
  <script>
    $(document).ready(function () {
      $('#txtAddResMobNum, #txtEditResMobNum').on('input', function () {
        var enteredNumber = $(this).val();

        // check if the entered number has reached the desired length
        if (enteredNumber.length === 11) {
          // check if the entered number starts with '0'
          if (enteredNumber.startsWith('0')) {
            // remove the '0' and add '63' at the beginning
            var formattedNumber = '+63' + enteredNumber.slice(1);
            // update the input field with the formatted number
            $(this).val(formattedNumber);
            // apply input mask manually
            $(this).inputmask('9999999999999', {
              placeholder: '',
              definitions: {
                '9': {
                  validator: "[0-9+]",
                  cardinality: 1
                }
              }
            });
          }
        } else if (enteredNumber.length < 11) {
          // check if the entered number starts with '63'
          if (enteredNumber.startsWith('+63')) {
            // remove the '63' and add '0' at the beginning
            var formattedNumber = '0' + enteredNumber.slice(3);
            // update the input field with the formatted number
            $(this).val(formattedNumber);
          }
        }
      });
    });

    // reset the filter query for purok if it is filtered
    function resetSelect() {
      // get the select element by its ID
      const select = document.getElementById("purok");

      // set the selected index to -1 to reset the selected option
      select.selectedIndex = -1;

      // clear the filter parameter in the URL
      const urlParams = new URLSearchParams(window.location.search);
      urlParams.delete('filter');

      // clear the hashed filter input value
      const hashedFilterInput = document.querySelector('input[name="hashed_filter"]');
      if (hashedFilterInput) {
        hashedFilterInput.value = '';
      }

      // update the url without the filter parameter
      // but need to trigger the reset after the filter
      const newUrl = window.location.pathname + '?' + urlParams.toString();
      window.history.replaceState({}, document.title, newUrl);

      // submit the form after resetting the select input
      // only if the reset is trigger
      select.form.submit();
    }

    $(document).ready(function () {
      var addTimeOut = { timeout: null };
      $("#add_username").keyup(function (e) {
        handleKeyUp("#add_username", "#add_user_msg", addTimeOut, e, "btn_add");
      });
    });

    // check the username availability and query the result
    function handleKeyUp(usernameSelector, userMsgSelector, timeOutRef, event, btnId) {
      var username = $(usernameSelector).val();
      var loading_html = '<img src="../../assets/loader/loader.gif" width="25px" height="25px">';
      if (username === "") {
        $(userMsgSelector).html('<span class="text-warning">Username cannot be empty.</span>');
        // disable button if username is empty
        disableButton(btnId);
        return;
      }

      if (event.key === "Backspace") {
        // handle backspace separately
        // the only problem here if the input is empty by holding alt + a then backspace
        // but it is working
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
      $.post("../../ajax/username.ajax.php", { resident_uname: username }, function (result) {
        console.log(result);
        if (result != 0) {
          $(userMsgSelector).html('<span style="color: #ff8080">This username is already taken.</span>');
          // disable button if username is taken
          disableButton(btnId);
        } else {
          $(userMsgSelector).html('<span style="color: #45ff70">This username is available.</span>');
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

    // need to call separately
    function enableButton(btnId) {
      var btn = document.getElementById(btnId);
      if (btn) {
        btn.disabled = false;
      }
    }
  </script>
</body>

</html>