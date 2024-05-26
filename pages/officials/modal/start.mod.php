<div class="modal fade" id="startModal<?php echo $row['pid']; ?>">
  <form method="post">
    <div class="modal-dialog modal-md">
      <div class="modal-content">
        <div class="modal-header align-items-center">
          <h4 class="modal-title">Start Term Barangay Official</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true"><i class="fas fa-times-circle"></i></span>
          </button>
        </div>
        <div class="modal-body">
          <div class="row">
            <div class="container-fluid">
              <div class="row">
                <div class="col-12 col-md-12 col-sm-12">
                  <div class="form-group">
                    <input type="hidden" value="<?php echo $row['pid']; ?>" name="hidden_id" id="hidden_id">
                    <p style="margin: 16px 0">Are you sure you want to start the term of
                      <?php echo ucwords(strtolower(htmlspecialchars($row['official_name']))) ?>?
                    </p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary" name="btn_start" id="btn_start">Save changes</button>
        </div>
      </div>
    </div>
  </form>
</div>