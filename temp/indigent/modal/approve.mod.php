<div class="modal fade" id="approveModal<?php echo $row['pid'] ?>">
  <form method="post" enctype="multipart/form-data">
    <div class="modal-dialog modal-md">
      <div class="modal-content">
        <div class="modal-header align-items-center">
          <h4 class="modal-title">Approve Indigent</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true"><i class="fas fa-times-circle"></i></span>
          </button>
        </div>
        <div class="modal-body">
          <?php echo '<input type="hidden" value="' . $row['pid'] . '" name="hidden_id" id="hidden_id">' ?>
          <p>Do you wish to approve this barangay indigent requested by
            <?php echo $row['indigent_requested_by'] ?>
            for his/her
            <?php echo $row['indigent_purpose'] ?> purpose? If yes, please provide the necessary details.
          </p>
          <hr class="bg-light" style="padding: 0.5px 0">
          <div class="row">
            <div class="col-12">
              <div class="form-group">
                <label class="control-label">Indigent #</label>
                <input name="txt_app_indigent_num" class="form-control" type="number"
                  placeholder="Please enter your indigent number" autofocus>
              </div>
              <div class="form-group">
                <label class="control-label">Findings</label>
                <input name="txt_app_indigent_findings" class="form-control" type="text"
                  placeholder="Please enter your findings">
              </div>
              <div class="form-group">
                <label class="control-label">OR Number</label>
                <input name="txt_app_indigent_or_num" class="form-control" type="number"
                  placeholder="Please enter your or number">
              </div>
              <div class="form-group">
                <label class="control-label">Amount</label>
                <div class="input-group">
                  <div class="input-group-prepend">
                    <span class="input-group-text">₱</span>
                  </div>
                  <input name="txt_app_indigent_amount" class="form-control" type="number"
                    placeholder="Please enter your amount">
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