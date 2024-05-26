<div class="modal fade" id="approveModal<?php echo htmlspecialchars($row['id']) ?>">
  <form method="post" enctype="multipart/form-data">
    <div class="modal-dialog modal-md">
      <div class="modal-content">
        <div class="modal-header align-items-center">
          <h4 class="modal-title">Approve Low Income</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true"><i class="fas fa-times-circle"></i></span>
          </button>
        </div>
        <div class="modal-body">
          <input type="hidden" value="<?php echo htmlspecialchars($row['id']) ?>" name="hidden_id" id="hidden_id">
          <p>Do you wish to approve this barangay low income requested by
            <?php echo htmlspecialchars($row['lowincome_requested_by']) ?>
            has annual income of
            <?php echo htmlspecialchars($row['lowincome_annual_income']) ?>? If yes, please provide the
            necessary details.
          </p>
          <hr class="bg-light" style="padding: 0.5px 0">
          <div class="row">
            <div class="col-12">
              <!-- LOW INCOME NUMBER -->
              <div class="form-group">
                <label class="control-label">Low income #</label>
                <input name="txt_app_lowincome_num" class="form-control" type="number"
                  placeholder="Please enter your lowincome number" autofocus>
              </div>
              <!-- OFFICER OF THE DAY -->
              <div class="form-group">
                <label class="control-label">Officer of the day</label>
                <select name="txt_app_lowincome_officer_of_dday" class="form-control select2"
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
              <div class="form-group">
                <label class="control-label">Officer of the day position</label>
                <select name="txt_app_lowincome_officer_of_dday_pos" class="form-control select2"
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
              <!-- OR NUMBER -->
              <div class="form-group">
                <label class="control-label">Order receipt number</label>
                <input name="txt_app_lowincome_or_num" class="form-control" type="number"
                  placeholder="Please enter your or number">
              </div>
              <!-- PAYMENT -->
              <div class="form-group">
                <label class="control-label">Payment</label>
                <div class="input-group">
                  <div class="input-group-prepend">
                    <span class="input-group-text">₱</span>
                  </div>
                  <input name="txt_app_lowincome_payment" class="form-control" type="number"
                    placeholder="Please enter your payment">
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary" name="btn_approve">Approve</button>
        </div>
      </div>
    </div>
  </form>
</div>