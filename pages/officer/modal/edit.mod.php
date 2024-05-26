<div class="modal fade" id="editModal<?php echo $row['id'] ?>">
  <form method="post" enctype="multipart/form-data">
    <div class="modal-dialog modal-md">
      <div class="modal-content">
        <div class="modal-header align-items-center">
          <h4 class="modal-title">Edit Officer</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true"><i class="fas fa-times-circle"></i></span>
          </button>
        </div>
        <div class="modal-body">
          <div class="row">
            <div class="container-fluid">
              <div class="row">
                <div class="col-12">
                  <input type="hidden" value="<?php echo $row['id'] ?>" name="hidden_id" id="hidden_id">
                  <div class="form-group">
                    <label class="control-label">Position</label>
                    <select name="txt_edit_officer_position" class="form-control select2"
                      data-minimum-results-for-search="Infinity" autofocus>
                      <option selected>
                        <?php echo htmlspecialchars($row['officer_position']) ?>
                      </option>
                      <option value="ipmr">IPMR</option>
                      <option value="barangay kagawad">Barangay kagawad</option>
                    </select>
                  </div>
                  <div class="form-group">
                    <label class="control-label">First name</label>
                    <input type="text" name="txt_edit_officer_fname" class="form-control"
                      placeholder="Please enter your government office"
                      value="<?php echo htmlspecialchars($row['officer_fname']) ?>">
                  </div>
                  <div class="form-group">
                    <label class="control-label">Middle name</label>
                    <input type="text" name="txt_edit_officer_mname" class="form-control"
                      placeholder="Please enter your government office"
                      value="<?php echo htmlspecialchars($row['officer_mname']) ?>">
                  </div>
                  <div class="form-group">
                    <label class="control-label">Last name</label>
                    <input type="text" name="txt_edit_officer_lname" class="form-control"
                      placeholder="Please enter your government office"
                      value="<?php echo htmlspecialchars($row['officer_lname']) ?>">
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