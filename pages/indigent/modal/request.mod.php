<div class="modal fade" id="reqModal">
  <form method="post" enctype="multipart/form-data">
    <div class="modal-dialog modal-md">
      <div class="modal-content">
        <div class="modal-header align-items-center">
          <h4 class="modal-title">Request Certificate of Indigency</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true"><i class="fas fa-times-circle"></i></span>
          </button>
        </div>
        <div class="modal-body">
          <div class="row">
            <div class="col-12">
              <!-- PURPOSE -->
              <div class="form-group">
                <label class="control-label">Purpose</label>
                <select name="txt_req_indigent_purpose" class="form-control select2" autofocus>
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
                <select name="txt_req_indigent_gov_office" class="form-control select2">
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
          <button type="submit" class="btn btn-primary" name="btn_request">Request Certificate of Indigency</button>
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