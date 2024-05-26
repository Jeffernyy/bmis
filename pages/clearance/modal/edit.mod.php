<div class="modal fade" id="editModal<?php echo $row['pid'] ?>">
  <form method="post" enctype="multipart/form-data">
    <div class="modal-dialog modal-md">
      <div class="modal-content">
        <div class="modal-header align-items-center">
          <h4 class="modal-title">Edit Clearance</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true"><i class="fas fa-times-circle"></i></span>
          </button>
        </div>
        <div class="modal-body">
          <div class="row">
            <div class="col-12">
              <input type="hidden" value="<?php echo $row['pid'] ?>" name="hidden_id" id="hidden_id">
              <div class="form-group">
                <label class="control-label">Clearance #</label>
                <input name="txt_edit_clearance_num" class="form-control" type="number"
                  value="<?php echo $row['clearance_num'] ?>" autofocus>
              </div>
              <div class="form-group">
                <label class="control-label">Name</label>
                <input class="form-control" type="text" value="<?php echo $row['clearance_res_name'] ?>" readonly>
              </div>
              <div class="form-group">
                <label class="control-label">Purpose</label>
                <select name="txt_edit_clearance_purpose" class="form-control select2">
                  <option selected value="<?php echo htmlspecialchars($row['clearance_purpose']) ?>">
                    <?php echo htmlspecialchars($row['clearance_purpose']) ?>
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
              <div class="form-group">
                <label class="control-label">Findings</label>
                <input name="txt_edit_clearance_findings" class="form-control" type="text"
                  value="<?php echo $row['clearance_findings'] ?>">
              </div>
              <div class="form-group">
                <label class="control-label">OR Number</label>
                <input name="txt_edit_clearance_or_num" class="form-control" type="number"
                  value="<?php echo $row['clearance_or_num'] ?>">
              </div>
              <div class="form-group">
                <label class="control-label">Amount</label>
                <div class="input-group">
                  <div class="input-group-prepend">
                    <span class="input-group-text">₱</span>
                  </div>
                  <input name="txt_edit_clearance_amount" class="form-control" type="number"
                    value="<?php echo preg_replace('/[^0-9.]/', '', $row['clearance_amount']) ?>">
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