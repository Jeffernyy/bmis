<div class="modal fade" id="addModal">
  <form method="post" enctype="multipart/form-data">
    <div class="modal-dialog modal-md">
      <div class="modal-content">
        <div class="modal-header align-items-center">
          <h4 class="modal-title">Add Clearance</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true"><i class="fas fa-times-circle"></i></span>
          </button>
        </div>
        <div class="modal-body">
          <div class="row">
            <div class="col-12">
              <div class="form-group">
                <label class="control-label">Clearance #</label>
                <input name="txt_add_clearance_num" class="form-control" type="number"
                  placeholder="Please enter your clearance number" autofocus>
              </div>
              <div class="form-group">
                <label class="control-label">Name</label>
                <select name="txt_add_clearance_res_id" class="form-control select2">
                  <option selected disabled>Please select your name</option>
                  <?php
                  $squery = mysqli_query($con, "SELECT *,CONCAT(resident_fname, IF(resident_mname = 'n/a', '', CONCAT(' ', resident_mname)), ' ', resident_lname) AS clearance_res_name FROM tblresident r WHERE ((r.id NOT IN (SELECT blotter_respondent FROM tblblotter)) OR (r.id IN (SELECT blotter_respondent FROM tblblotter WHERE blotter_status = 'solved')) ) AND resident_length_of_stay >= 6");
                  while ($row = mysqli_fetch_array($squery)) { ?>
                    <option value="<?php echo htmlspecialchars($row['id']) ?>">
                      <?php echo htmlspecialchars($row['clearance_res_name']) ?>
                    </option>
                    <?php
                  } ?>
                </select>
              </div>
              <div class="form-group">
                <label class="control-label">Purpose</label>
                <select name="txt_add_clearance_purpose" class="form-control select2">
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
              <div class="form-group">
                <label class="control-label">Findings</label>
                <input name="txt_add_clearance_findings" class="form-control" type="text"
                  placeholder="Please enter your findings">
              </div>
              <div class="form-group">
                <label class="control-label">OR Number</label>
                <input name="txt_add_clearance_or_num" class="form-control" type="number"
                  placeholder="Please enter your or number">
              </div>
              <div class="form-group">
                <label class="control-label">Amount</label>
                <div class="input-group">
                  <div class="input-group-prepend">
                    <span class="input-group-text">₱</span>
                  </div>
                  <input name="txt_add_clearance_amount" class="form-control" type="number"
                    placeholder="Please enter your amount">
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