<div class="modal fade" id="approveModal<?php echo htmlspecialchars($row['id']) ?>">
  <form method="post" enctype="multipart/form-data">
    <div class="modal-dialog modal-md">
      <div class="modal-content">
        <div class="modal-header align-items-center">
          <h4 class="modal-title">Approve Certificate of Indigency</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true"><i class="fas fa-times-circle"></i></span>
          </button>
        </div>
        <div class="modal-body">
          <input type="hidden" value="<?php echo htmlspecialchars($row['id']) ?>" name="hidden_id" id="hidden_id">
          <p>Do you wish to approve this barangay indigent requested by
            <?php echo $row['indigent_requested_by'] ?>
            for his/her
            <?php echo $row['indigent_purpose'] ?> purpose? If yes, please provide the necessary details.
          </p>
          <hr class="bg-light" style="padding: 0.5px 0">
          <div class="row">
            <div class="col-12">
              <!-- INDIGENT NUMBER -->
              <div class="form-group">
                <label class="control-label">Indigent #</label>
                <input name="txt_app_indigent_num" class="form-control" type="number"
                  placeholder="Please enter your indigent number" autofocus>
              </div>
              <!-- OR NUMBER -->
              <div class="form-group">
                <label class="control-label">Order receipt number</label>
                <input name="txt_app_indigent_or_num" class="form-control" type="number"
                  placeholder="Please enter your or number">
              </div>
              <!-- PAYMENT -->
              <div class="form-group">
                <label class="control-label">Payment</label>
                <div class="input-group">
                  <div class="input-group-prepend">
                    <span class="input-group-text">₱</span>
                  </div>
                  <input name="txt_app_indigent_payment" class="form-control" type="number"
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