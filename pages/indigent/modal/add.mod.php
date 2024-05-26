<div class="modal fade" id="addModal">
  <form method="post" enctype="multipart/form-data">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header align-items-center">
          <h4 class="modal-title">Add Certificate of Indigency</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true"><i class="fas fa-times-circle"></i></span>
          </button>
        </div>
        <div class="modal-body">
          <div class="row">
            <div class="col-12">
              <!-- LOW INCOME NUMBER -->
              <div class="form-group">
                <label class="control-label">Indigent #</label>
                <input name="txt_add_indigent_num" class="form-control" type="number"
                  placeholder="Please enter your indigent number" autofocus>
              </div>
              <!-- RESIDENT -->
              <div class="form-group">
                <label class="control-label">Resident</label>
                <select name="txt_add_indigent_res_id" class="form-control select2">
                  <option selected disabled>Please select your name</option>
                  <?php
                  $squery = mysqli_query($con, "SELECT *,CONCAT(resident_fname, IF(resident_mname = 'n/a', '', CONCAT(' ', resident_mname)), ' ', resident_lname) AS indigent_res_name FROM tblresident r WHERE ((r.id NOT IN (SELECT blotter_respondent FROM tblblotter)) OR (r.id IN (SELECT blotter_respondent FROM tblblotter WHERE blotter_status = 'solved')) ) AND resident_length_of_stay >= 6");
                  while ($row = mysqli_fetch_array($squery)) { ?>
                    <option value="<?php echo htmlspecialchars($row['id']) ?>">
                      <?php echo htmlspecialchars($row['indigent_res_name']) ?>
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
                    <select name="txt_add_indigent_requester_res_id" class="form-control select2 select_requester">
                      <option selected disabled>Please select your occupation</option>
                      <?php
                      $squery = mysqli_query($con, "SELECT *,CONCAT(resident_fname, IF(resident_mname = 'n/a', '', CONCAT(' ', resident_mname)), ' ', resident_lname) AS indigent_res_name FROM tblresident r WHERE ((r.id NOT IN (SELECT blotter_respondent FROM tblblotter)) OR (r.id IN (SELECT blotter_respondent FROM tblblotter WHERE blotter_status = 'solved')) ) AND resident_length_of_stay >= 6");
                      while ($row = mysqli_fetch_array($squery)) { ?>
                        <option value="<?php echo htmlspecialchars($row['id']) ?>">
                          <?php echo htmlspecialchars($row['indigent_res_name']) ?>
                        </option>
                        <?php
                      } ?>
                      <option value="others">others, please specify</option>
                    </select>
                  </div>
                  <div class="col-6">
                    <label class="control-label">Specify who's requesting</label>
                    <input type="text" name="txt_add_indigent_requester_res_id"
                      class="form-control cstm_crsr specify_requester" placeholder="Please specify your occupation"
                      disabled>
                  </div>
                </div>
              </div>
              <!-- PURPOSE -->
              <div class="form-group">
                <label class="control-label">Purpose</label>
                <select name="txt_add_indigent_purpose" class="form-control select2">
                  <option selected disabled>Please select your purpose</option>
                  <?php
                  $query = mysqli_query($con, "SELECT purpose FROM tblpurpose");
                  while ($row = mysqli_fetch_array($query)) { ?>
                    <option value="<?php echo htmlspecialchars($row['purpose']) ?>">
                      <?php echo htmlspecialchars($row['purpose']) ?>
                    </option>
                    <?php
                  } ?>
                </select>
              </div>
              <!-- GOVERNMENT OFFICE -->
              <div class="form-group">
                <label class="control-label">Government office</label>
                <select name="txt_add_indigent_gov_office" class="form-control select2">
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
                    <select name="txt_add_indigent_officer_res_id" class="form-control select2"
                      data-minimum-results-for-search="infinity">
                      <option selected disabled>Please select officer of the day</option>
                      <?php
                      $get_officer = mysqli_query($con, "SELECT *,CONCAT(officer_fname, IF(officer_mname = 'n/a', '', CONCAT(' ', officer_mname)), ' ', officer_lname) AS indigent_officer FROM tblofficer");
                      while ($officer_row = mysqli_fetch_array($get_officer)) { ?>
                        <option value="<?php echo htmlspecialchars($officer_row['id']) ?>">
                          <?php echo htmlspecialchars($officer_row['indigent_officer']) ?>
                        </option>
                        <?php
                      } ?>
                    </select>
                  </div>
                  <div class="col-6">
                    <label class="control-label">Officer of the day position</label>
                    <select name="txt_add_indigent_officer_position_id" class="form-control select2"
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
                    <input name="txt_add_indigent_or_num" class="form-control" type="number"
                      placeholder="Please enter your or number">
                  </div>
                  <!-- PAYMENT -->
                  <div class="col-6">
                    <label class="control-label">Payment</label>
                    <div class="input-group">
                      <div class="input-group-prepend">
                        <span class="input-group-text">₱</span>
                      </div>
                      <input name="txt_add_indigent_payment" class="form-control" type="number"
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