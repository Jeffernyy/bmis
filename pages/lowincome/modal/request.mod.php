<div class="modal fade" id="reqModal">
  <form method="post" enctype="multipart/form-data">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header align-items-center">
          <h4 class="modal-title">Request Low Income</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true"><i class="fas fa-times-circle"></i></span>
          </button>
        </div>
        <div class="modal-body">
          <div class="row">
            <div class="col-12">
              <!-- CHILDREN -->
              <div class="form-group">
                <div class="row">
                  <div class="col-6">
                    <label class="control-label">Who's your children</label>
                    <select name="txt_req_lowincome_children_res_id" class="form-control select2 children_selected"
                      autofocus>
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
                    <input type="text" name="txt_req_lowincome_children_res_id"
                      class="form-control cstm_crsr children_specified" placeholder="Please specify your occupation"
                      disabled>
                  </div>
                </div>
              </div>
              <div class="form-group">
                <label class="control-label">How old is he/she?</label>
                <input type="text" name="txt_req_lowincome_children_age"
                  class="form-control cstm_crsr children_specified" placeholder="Please specify your occupation"
                  disabled>
              </div>
              <div class="form-group">
                <div class="row">
                  <div class="col-6">
                    <!-- NUMBER OF CHILDREN -->
                    <label class="control-label">How many children?</label>
                    <input name="txt_req_lowincome_num_of_children" class="form-control" type="text"
                      placeholder="Please enter how many children">
                  </div>
                  <!-- ANNUAL INCOME -->
                  <div class="col-6">
                    <label class="control-label">Annual income</label>
                    <div class="input-group">
                      <div class="input-group-prepend">
                        <span class="input-group-text">₱</span>
                      </div>
                      <input name="txt_req_lowincome_annual_income" class="form-control" type="number"
                        placeholder="Please enter your annual income">
                    </div>
                  </div>
                </div>
              </div>
              <!-- GOVERNMENT OFFICE -->
              <div class="form-group">
                <label class="control-label">Government office</label>
                <select name="txt_req_lowincome_gov_office" class="form-control select2">
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
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary" name="btn_request">Request Low Income</button>
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
    addHandleSpecifiedInput(".children_selected", ".children_specified");
  });
</script>