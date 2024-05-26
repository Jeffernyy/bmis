<div class="modal fade" id="editModal<?php echo $row['pid'] ?>">
  <form method="post" enctype="multipart/form-data">
    <div class="modal-dialog modal-md">
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
              <input type="hidden" value="<?php echo $row['pid'] ?>" name="hidden_id" id="hidden_id">
              <div class="form-group">
                <label class="control-label">Indigent #</label>
                <input name="txt_edit_indigent_num" class="form-control" type="number"
                  value="<?php echo $row['indigent_num'] ?>" autofocus>
              </div>
              <div class="form-group">
                <label class="control-label">Name</label>
                <input class="form-control" type="text" value="<?php echo $row['indigent_res_name'] ?>" readonly>
              </div>
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
              <div class="form-group">
                <label class="control-label">Government Office</label>
                <select name="txt_edit_indigent_gov_office" class="form-control select2">
                  <option selected value="<?php echo htmlspecialchars($row['indigent_gov_office']) ?>">
                    <?php echo htmlspecialchars($row['indigent_gov_office']) ?>
                  </option>
                  <?php
                  $query = mysqli_query($con, "SELECT gov_office FROM tblgovoffice");
                  while ($row = mysqli_fetch_array($query)) {
                    echo '<option value="' . htmlentities($row['gov_office']) . '">' . $row['gov_office'] . '</option>';
                  } ?>
                </select>
              </div>
              <div class="form-group">
                <label class="control-label">Findings</label>
                <input name="txt_edit_indigent_findings" class="form-control" type="text"
                  value="<?php echo $row['indigent_findings'] ?>">
              </div>
              <div class="form-group">
                <label class="control-label">OR Number</label>
                <input name="txt_edit_indigent_or_num" class="form-control" type="number"
                  value="<?php echo $row['indigent_or_num'] ?>">
              </div>
              <div class="form-group">
                <label class="control-label">Amount</label>
                <div class="input-group">
                  <div class="input-group-prepend">
                    <span class="input-group-text">₱</span>
                  </div>
                  <input name="txt_edit_indigent_amount" class="form-control" type="number"
                    value="<?php echo preg_replace('/[^0-9.]/', '', $row['indigent_amount']) ?>">
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