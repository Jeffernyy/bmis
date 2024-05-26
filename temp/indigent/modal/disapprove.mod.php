<div class="modal fade" id="disapproveModal<?php echo $row['pid'] ?>">
  <form method="post" enctype="multipart/form-data">
    <div class="modal-dialog modal-md">
      <div class="modal-content">
        <div class="modal-header align-items-center">
          <h4 class="modal-title">Disapprove Indigent</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true"><i class="fas fa-times-circle"></i></span>
          </button>
        </div>
        <div class="modal-body">
          <input type="hidden" value="<?php echo htmlspecialchars($row['pid']) ?>" name="hidden_id" id="hidden_id">
          <p>Are you sure you want to disapprove this barangay indigent requested by
            <?php echo htmlspecialchars($row['indigent_requested_by']) ?> for his/her
            <?php echo htmlspecialchars($row['indigent_purpose']) ?> purpose? If yes, put the findings.
          </p>
          <hr class="bg-light" style="padding: 0.5px 0">
          <div class="row">
            <div class="col-12">
              <div class="form-group">
                <label class="control-label">Findings</label>
                <input name="txt_dis_indigent_findings" class="form-control" type="text"
                  placeholder="Please enter your findings" autofocus>
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary" name="btn_disapprove">Disapprove</button>
        </div>
      </div>
    </div>
  </form>
</div>