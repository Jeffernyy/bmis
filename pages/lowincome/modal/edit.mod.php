<div class="modal fade" id="editModal<?php echo $row['id'] ?>">
  <form method="post" enctype="multipart/form-data">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header align-items-center">
          <h4 class="modal-title">Edit Indigent</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true"><i class="fas fa-times-circle"></i></span>
          </button>
        </div>
        <div class="modal-body">
          <div class="row">
            <div class="col-12">
              <input type="hidden" value="<?php echo $row['id'] ?>" name="hidden_id" id="hidden_id">
              <!-- LOW INCOME NUMBER -->
              <div class="form-group">
                <label class="control-label">Low income #</label>
                <input name="txt_edit_lowincome_num" class="form-control" type="number"
                  placeholder="Please enter your lowincome number"
                  value="<?php echo htmlspecialchars($row['lowincome_num']) ?>" autofocus>
              </div>
              <!-- RESIDENT -->
              <div class="form-group">
                <label class="control-label">Resident</label>
                <input type="text" class="form-control"
                  value="<?php echo htmlspecialchars($row['lowincome_resident_name']) ?>" readonly>
              </div>
              <!-- REQUESTER -->
              <div class="form-group">
                <div class="row">
                  <div class="col-6">
                    <label class="control-label">Person who's requesting</label>
                    <select name="txt_edit_lowincome_requester_res_id" class="form-control select2 select_requester">
                      <option selected>
                        <?php echo htmlspecialchars($row['lowincome_requester_res_name']) ?>
                      </option>
                      <?php
                      $check_requester = mysqli_query($con, "SELECT *,CONCAT(resident_fname, IF(resident_mname = 'n/a', '', CONCAT(' ', resident_mname)), ' ', resident_lname) AS lowincome_res_name FROM tblresident r WHERE ((r.id NOT IN (SELECT blotter_respondent FROM tblblotter)) OR (r.id IN (SELECT blotter_respondent FROM tblblotter WHERE blotter_status = 'solved')) ) AND resident_length_of_stay >= 6");
                      while ($requester = mysqli_fetch_array($check_requester)) { ?>
                        <option value="<?php echo htmlspecialchars($requester['id']) ?>">
                          <?php echo htmlspecialchars($requester['lowincome_res_name']) ?>
                        </option>
                        <?php
                      } ?>
                      <option value="others">others, please specify</option>
                    </select>
                  </div>
                  <div class="col-6">
                    <label class="control-label">Specify who's requesting</label>
                    <input type="text" name="txt_edit_lowincome_requester_res_id"
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
                    <select name="txt_edit_lowincome_children_res_id" class="form-control select2 select_children">
                      <option selected value="<?php echo htmlspecialchars($row['lowincome_children_res_id']) ?>">
                        <?php echo htmlspecialchars($row['lowincome_children_res_name']) ?>
                      </option>
                      <?php
                      $check_children = mysqli_query($con, "SELECT *,CONCAT(resident_fname, IF(resident_mname = 'n/a', '', CONCAT(' ', resident_mname)), ' ', resident_lname) AS lowincome_res_name FROM tblresident");
                      while ($children = mysqli_fetch_array($check_children)) { ?>
                        <option value="<?php echo htmlspecialchars($children['id']) ?>">
                          <?php echo htmlspecialchars($children['lowincome_res_name']) ?>
                        </option>
                        <?php
                      } ?>
                      <option value="others">others, please specify</option>
                    </select>
                  </div>
                  <div class="col-6">
                    <label class="control-label">Specify your children</label>
                    <input type="text" name="txt_edit_lowincome_children_res_id"
                      class="form-control cstm_crsr specify_children" placeholder="Please specify your occupation"
                      disabled>
                  </div>
                </div>
              </div>
              <!-- CHILDREN AGE -->
              <div class="form-group">
                <label class="control-label">How old is he/shess?</label>
                <input type="text" name="txt_edit_lowincome_children_age"
                  class="form-control cstm_crsr specify_children" placeholder="Please specify your children" disabled>
              </div>
              <div class="form-group">
                <div class="row">
                  <div class="col-6">
                    <!-- NUMBER OF CHILDREN -->
                    <label class="control-label">How many children?</label>
                    <input name="txt_edit_lowincome_num_of_children" class="form-control" type="text"
                      placeholder="Please enter how many children"
                      value="<?php echo htmlspecialchars($row['lowincome_num_of_children']) ?>">
                  </div>
                  <!-- ANNUAL INCOME -->
                  <div class="col-6">
                    <label class="control-label">Annual income</label>
                    <div class="input-group">
                      <div class="input-group-prepend">
                        <span class="input-group-text">Php</span>
                      </div>
                      <input name="txt_edit_lowincome_annual_income" class="form-control" type="text"
                        value="<?php echo preg_replace('/[^0-9.]/', '', htmlspecialchars($row['lowincome_annual_income'])) ?>">
                    </div>
                  </div>
                </div>
              </div>
              <!-- GOVERNMENT OFFICE -->
              <div class="form-group">
                <label class="control-label">Government office</label>
                <select name="txt_edit_lowincome_gov_office" class="form-control select2">
                  <option selected>
                    <?php echo htmlspecialchars($row['lowincome_gov_office']) ?>
                  </option>
                  <?php
                  $get_gov_office = mysqli_query($con, "SELECT gov_office FROM tblgovoffice");
                  while ($gov_office = mysqli_fetch_array($get_gov_office)) { ?>
                    <option value="<?php echo htmlspecialchars($gov_office['gov_office']) ?>">
                      <?php echo strtolower(htmlspecialchars($gov_office['gov_office'])) ?>
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
                    <select name="txt_edit_lowincome_officer_of_dday" class="form-control select2"
                      data-minimum-results-for-search="infinity">
                      <option selected><?php echo htmlspecialchars($row['lowincome_officer_res_name']) ?></option>
                      <?php
                      $get_officer = mysqli_query($con, "SELECT *, CONCAT(officer_fname, 
                      IF(officer_mname = 'n/a', '', CONCAT(' ', SUBSTRING(officer_mname, 1, 1), '.')), 
                      ' ', officer_lname) AS lowincome_officer FROM tblofficer");
                      while ($officer = mysqli_fetch_array($get_officer)) { ?>
                        <option value="<?php echo htmlspecialchars($officer['id']) ?>">
                          <?php echo htmlspecialchars($officer['lowincome_officer']) ?>
                        </option>
                        <?php
                      } ?>
                    </select>
                  </div>
                  <div class="col-6">
                    <label class="control-label">Officer of the day position</label>
                    <select name="txt_edit_lowincome_officer_of_dday_pos" class="form-control select2"
                      data-minimum-results-for-search="infinity">
                      <option selected><?php echo htmlspecialchars($row['lowincome_officer_position_id']) ?></option>
                      <?php
                      $get_officer_pos = mysqli_query($con, "SELECT * FROM tblofficer");
                      while ($officer_pos = mysqli_fetch_array($get_officer_pos)) { ?>
                        <option value="<?php echo htmlspecialchars($officer_pos['id']) ?>">
                          <?php echo strtolower(htmlspecialchars($officer_pos['officer_position'])) ?>
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
                    <input name="txt_edit_lowincome_or_num" class="form-control" type="number"
                      placeholder="Please enter your or number"
                      value="<?php echo htmlspecialchars($row['lowincome_or_num']) ?>">
                  </div>
                  <!-- PAYMENT -->
                  <div class="col-6">
                    <label class="control-label">Payment</label>
                    <div class="input-group">
                      <div class="input-group-prepend">
                        <span class="input-group-text">₱</span>
                      </div>
                      <input name="txt_edit_lowincome_payment" class="form-control" type="number"
                        placeholder="Please enter your payment"
                        value="<?php echo preg_replace('/[^0-9.]/', '', htmlspecialchars($row['lowincome_payment'])) ?>">
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary" name="btn_edit">Save changes</button>
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