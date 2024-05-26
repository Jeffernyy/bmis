<div class="modal fade" id="editReqModal<?php echo $row['pid'] ?>">
  <form method="post" enctype="multipart/form-data">
    <div class="modal-dialog modal-md">
      <div class="modal-content">
        <div class="modal-header align-items-center">
          <h4 class="modal-title">Edit Request Indigent</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true"><i class="fas fa-times-circle"></i></span>
          </button>
        </div>
        <div class="modal-body">
          <div class="row">
            <div class="col-12">
              <input type="hidden" value="<?php echo $row['pid'] ?>" name="hidden_id" id="hidden_id">
              <div class="form-group">
                <label class="control-label">Purpose</label>
                <select name="txt_edit_indigent_purpose" class="form-control select2">
                  <option selected value="<?php echo htmlspecialchars($row['indigent_purpose']) ?>">
                    <?php echo htmlspecialchars($row['indigent_purpose']) ?>
                  </option>
                  <?php
                  $purpose_query = mysqli_query($con, "SELECT purpose FROM tblpurpose ORDER BY purpose ASC");
                  while ($row_purpose = mysqli_fetch_array($purpose_query)) { ?>
                    <option value="<?php echo htmlspecialchars($row_purpose['purpose']) ?>">
                      <?php echo htmlspecialchars($row_purpose['purpose']) ?>
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
          <button type="submit" class="btn btn-primary" name="btn_req_edit">Save changes</button>
        </div>
      </div>
    </div>
  </form>
</div>