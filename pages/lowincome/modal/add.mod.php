<div class="modal fade" id="addModal">
  <form method="post" enctype="multipart/form-data">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header align-items-center">
          <h4 class="modal-title">Add Low Income</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true"><i class="fas fa-times-circle"></i></span>
          </button>
        </div>
        <div class="modal-body">
          <div class="row">
            <div class="col-12">
              <!-- LOW INCOME NUMBER -->
              <div class="form-group">
                <label class="control-label">Low income #</label>
                <input name="txt_add_lowincome_num" class="form-control" type="number"
                  placeholder="Please enter your lowincome number" autofocus>
              </div>
              <!-- RESIDENT -->
              <div class="form-group">
                <label class="control-label">Resident</label>
                <select name="txt_add_lowincome_res_id" class="form-control select2">
                  <option selected disabled>Please select your name</option>
                  <?php
                  $squery = mysqli_query($con, "SELECT *,CONCAT(resident_fname, IF(resident_mname = 'n/a', '', CONCAT(' ', resident_mname)), ' ', resident_lname) AS lowincome_res_name FROM tblresident r WHERE ((r.id NOT IN (SELECT blotter_respondent FROM tblblotter)) OR (r.id IN (SELECT blotter_respondent FROM tblblotter WHERE blotter_status = 'solved')) ) AND resident_length_of_stay >= 6");
                  while ($row = mysqli_fetch_array($squery)) { ?>
                    <option value="<?php echo htmlspecialchars($row['id']) ?>">
                      <?php echo htmlspecialchars($row['lowincome_res_name']) ?>
                    </option>
                    <?php
                  } ?>
                </select>
              </div>
              <!-- REQUESTER -->
              <div class="form-group">
                <div class="row">
                  <div class="col-6">
                    <label class="control-label">Person who's requesting</label>
                    <select name="txt_add_lowincome_requester_res_id" class="form-control select2 select_requester">
                      <option selected disabled>Please select your occupation</option>
                      <?php
                      $squery = mysqli_query($con, "SELECT *,CONCAT(resident_fname, IF(resident_mname = 'n/a', '', CONCAT(' ', resident_mname)), ' ', resident_lname) AS lowincome_res_name FROM tblresident r WHERE ((r.id NOT IN (SELECT blotter_respondent FROM tblblotter)) OR (r.id IN (SELECT blotter_respondent FROM tblblotter WHERE blotter_status = 'solved')) ) AND resident_length_of_stay >= 6");
                      while ($row = mysqli_fetch_array($squery)) { ?>
                        <option value="<?php echo htmlspecialchars($row['id']) ?>">
                          <?php echo htmlspecialchars($row['lowincome_res_name']) ?>
                        </option>
                        <?php
                      } ?>
                      <option value="others">others, please specify</option>
                    </select>
                  </div>
                  <div class="col-6">
                    <label class="control-label">Specify who's requesting</label>
                    <input type="text" name="txt_add_lowincome_requester_res_id"
                      class="form-control cstm_crsr specify_requester" placeholder="Please specify your occupation"
                      disabled>
                  </div>
                </div>
              </div>
              <!-- CHILDREN -->
              <div class="form-group">
                <div class="row">
                  <div class="col-6">
                    <label class="control-label">Who's your children</label>
                    <select name="txt_add_lowincome_children_res_id" class="form-control select2 select_children">
                      <option selected disabled>Please select your children</option>
                      <?php
                      $squery = mysqli_query($con, "SELECT *,CONCAT(resident_fname, IF(resident_mname = 'n/a', '', CONCAT(' ', resident_mname)), ' ', resident_lname) AS lowincome_res_name FROM tblresident");
                      while ($row = mysqli_fetch_array($squery)) { ?>
                        <option value="<?php echo htmlspecialchars($row['id']) ?>">
                          <?php echo htmlspecialchars($row['lowincome_res_name']) ?>
                        </option>
                        <?php
                      } ?>
                      <option value="others">others, please specify</option>
                    </select>
                  </div>
                  <div class="col-6">
                    <label class="control-label">Specify your children</label>
                    <input type="text" name="txt_add_lowincome_children_res_id"
                      class="form-control cstm_crsr specify_children" placeholder="Please specify your children"
                      disabled>
                  </div>
                </div>
              </div>
              <!-- CHILDREN AGE -->
              <div class="form-group">
                <label class="control-label">How old is he/shess?</label>
                <input type="text" name="txt_add_lowincome_children_age" class="form-control cstm_crsr specify_children"
                  placeholder="Please specify your children" disabled>
              </div>
              <div class="form-group">
                <div class="row">
                  <div class="col-6">
                    <!-- NUMBER OF CHILDREN -->
                    <label class="control-label">How many children?</label>
                    <input name="txt_add_lowincome_num_of_children" class="form-control" type="text"
                      placeholder="Please enter how many children">
                  </div>
                  <!-- ANNUAL INCOME -->
                  <div class="col-6">
                    <label class="control-label">Annual income</label>
                    <div class="input-group">
                      <div class="input-group-prepend">
                        <span class="input-group-text">Php</span>
                      </div>
                      <input name="txt_add_lowincome_annual_income" class="form-control" type="number"
                        placeholder="Please enter your annual income">
                    </div>
                  </div>
                </div>
              </div>
              <!-- GOVERNMENT OFFICE -->
              <div class="form-group">
                <label class="control-label">Government office</label>
                <select name="txt_add_lowincome_gov_office" class="form-control select2">
                  <option selected disabled>Please select government office</option>
                  <?php
                  $query = mysqli_query($con, "SELECT gov_office FROM tblgovoffice");
                  while ($row = mysqli_fetch_array($query)) { ?>
                    <option value="<?php echo htmlspecialchars($row['gov_office']) ?>">
                      <?php echo strtolower(htmlspecialchars($row['gov_office'])) ?>
                    </option>
                    <?php
                  } ?>
                </select>
              </div>
              <!-- OFFICER OF THE DAY -->
              <div class="form-group">
                <div class="row">
                  <div class="col-6">
                    <label class="control-label">Officer of the day</label>
                    <select name="txt_add_lowincome_officer_of_dday" class="form-control select2"
                      data-minimum-results-for-search="infinity">
                      <option selected disabled>Please select officer of the day</option>
                      <?php
                      $get_officer = mysqli_query($con, "SELECT *,CONCAT(officer_fname, IF(officer_mname = 'n/a', '', CONCAT(' ', officer_mname)), ' ', officer_lname) AS lowincome_officer FROM tblofficer");
                      while ($officer_row = mysqli_fetch_array($get_officer)) { ?>
                        <option value="<?php echo htmlspecialchars($officer_row['id']) ?>">
                          <?php echo htmlspecialchars($officer_row['lowincome_officer']) ?>
                        </option>
                        <?php
                      } ?>
                    </select>
                  </div>
                  <div class="col-6">
                    <label class="control-label">Officer of the day position</label>
                    <select name="txt_add_lowincome_officer_of_dday_pos" class="form-control select2"
                      data-minimum-results-for-search="infinity">
                      <option selected disabled>Please select your position</option>
                      <?php
                      $get_officer_position = mysqli_query($con, "SELECT * FROM tblofficer");
                      while ($officer_position_row = mysqli_fetch_array($get_officer_position)) { ?>
                        <option value="<?php echo htmlspecialchars($officer_position_row['id']) ?>">
                          <?php echo strtolower(htmlspecialchars($officer_position_row['officer_position'])) ?>
                        </option>
                        <?php
                      } ?>
                    </select>
                  </div>
                </div>
              </div>
              <div class="form-group">
                <div class="row">
                  <!-- OR NUMBER -->
                  <div class="col-6">
                    <label class="control-label">Order receipt number</label>
                    <input name="txt_add_lowincome_or_num" class="form-control" type="number"
                      placeholder="Please enter your or number">
                  </div>
                  <!-- PAYMENT -->
                  <div class="col-6">
                    <label class="control-label">Payment</label>
                    <div class="input-group">
                      <div class="input-group-prepend">
                        <span class="input-group-text">₱</span>
                      </div>
                      <input name="txt_add_lowincome_payment" class="form-control" type="number"
                        placeholder="Please enter your payment">
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary" name="btn_add">Save changes</button>
        </div>
      </div>
    </div>
  </form>
</div>

<script>
  $(document).ready(function () {
    function addHandleSpecifiedInput(addDropdownId, addSpecifiedId) {
      // add an event listener to the select element
      $(addDropdownId).change(function () {
        // get the selected value
        var addSelectedValue = $(this).val();
        // get the corresponding input field for specifying
        var addSpecifiedInput = $(addSpecifiedId);

        // if the selected value is others, please specify
        // enable the input
        // otherwise disable it
        addSpecifiedInput.prop(
          "disabled",
          addSelectedValue.toLowerCase() !== "others"
        );

        // add or remove a class based on the disabled status
        if (addSpecifiedInput.prop("disabled")) {
          addSpecifiedInput.addClass("cstm_crsr");
        } else {
          addSpecifiedInput.removeClass("cstm_crsr");
        }

        // clear the value of the input field
        addSpecifiedInput.val("");
      });
    }

    // handle specified inputs for each set of dropdown and specified input
    addHandleSpecifiedInput(".select_requester", ".specify_requester");
    addHandleSpecifiedInput(".select_children", ".specify_children");
  });
</script>