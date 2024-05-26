<div class="modal fade" id="editModal<?php echo $row['pid'] ?>">
  <form action="" method="post" enctype="multipart/form-data">
    <div class="modal-dialog modal-md">
      <div class="modal-content">
        <div class="modal-header align-items-center">
          <h4 class="modal-title">Edit Barangay Official</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true"><i class="fas fa-times-circle"></i></span>
          </button>
        </div>
        <div class="modal-body">
          <div class="row">
            <div class="col-12">
              <input type="hidden" value="<?php echo $row['pid'] ?>" name="hidden_id" id="hidden_id">
              <div class="form-group">
                <label class="control-label">Position</label>
                <input class="form-control" type="text" value="<?php echo $row['official_position'] ?>" readonly>
              </div>
              <div class="form-group">
                <label class="control-label">Name</label>
                <input name="name" class="form-control" type="text" value="<?php echo $row['official_name'] ?>"
                  readonly>
              </div>
              <div class="form-group">
                <label class="control-label">Contact #</label>
                <input name="txt_edit_official_contact_num" class="form-control" type="text"
                  value="<?php echo $row['official_contact_num'] ?>" autofocus>
              </div>
              <div class="form-group">
                <label class="control-label">Address</label>
                <input name="txt_edit_official_address" class="form-control" type="text"
                  value="<?php echo $row['official_address'] ?>">
              </div>
              <div class="form-group">
                <label class="control-label" for="txt_sterm">Start Term</label>
                <input name="txt_edit_official_sterm" class="form-control" type="text" data-inputmask-alias="datetime"
                  data-inputmask-inputformat="mm/dd/yyyy" placeholder="mm/dd/yyyy"
                  value="<?php echo $row['official_term_start'] ?>" data-mask data-user-id="<?php echo $row['pid'] ?>">
              </div>
              <div class="form-group">
                <label class="control-label" for="txt_eterm">End Term</label>
                <input name="txt_edit_official_eterm" class="form-control" type="text" data-inputmask-alias="datetime"
                  data-inputmask-inputformat="mm/dd/yyyy" placeholder="mm/dd/yyyy"
                  value="<?php echo $row['official_term_end'] ?>" data-mask data-user-id="<?php echo $row['pid'] ?>">
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
          <input type="submit" class="btn btn-primary" name="btn_edit" value="Save changes">
        </div>
      </div>
    </div>
  </form>
</div>