<div class="modal fade" id="editModal<?php echo $row['id'] ?>">
  <form method="post" enctype="multipart/form-data">
    <div class="modal-dialog modal-md">
      <div class="modal-content">
        <div class="modal-header align-items-center">
          <h4 class="modal-title">Edit Announcement</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true"><i class="fas fa-times-circle"></i></span>
          </button>
        </div>
        <div class="modal-body">
          <div class="row">
            <div class="col-12">
              <input type="hidden" value="<?php echo $row['id'] ?>" name="hidden_id" id="hidden_id">
              <div class="form-group">
                <label class="control-label">Date & Time</label>
                <input id="txt_edit_announcement_date" name="txt_edit_announcement_date" type="text"
                  class="form-control" value="<?php echo $row['announcement_date'] ?>" placeholder="mm/dd/yyyy hh:mm aa"
                  autofocus>
              </div>
              <div class="form-group">
                <label class="form-label">Announcement</label>
                <input name="txt_edit_announcement" class="form-control" type="text"
                  value="<?php echo $row['announcement'] ?>">
              </div>
              <div class="form-group">
                <label class="form-label">Description</label>
                <textarea name="txt_edit_announcement_desc" class="form-control" cols="3"
                  rows="3"><?php echo $row['announcement_description'] ?></textarea>
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

<script>
  $(document).ready(function () {
    $('#txt_edit_announcement_date').inputmask('99/99/9999 99:99 AA', {
      'placeholder': 'mm/dd/yyyy hh:mm aa',
      'alias': 'datetime',
      'mask': '99/99/9999 99:99 AA'
    });
  });
</script>