<div class="modal fade" id="editModal<?php echo $row['id'] ?>">
  <form method="post" enctype="multipart/form-data">
    <div class="modal-dialog modal-md">
      <div class="modal-content">
        <div class="modal-header align-items-center">
          <h4 class="modal-title">Edit Barangay Captain</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true"><i class="fas fa-times-circle"></i></span>
          </button>
        </div>
        <div class="modal-body">
          <div class="row">
            <div class="col-md-12">
              <input type="hidden" value="<?php echo $row['id'] ?>" name="hidden_id" id="hidden_id">
              <div class="form-group">
                <label class="form-label" for="firstName">First name</label>
                <input name="txt_edit_captain_fname" class="form-control" type="text"
                  value="<?php echo $row['captain_fname'] ?>" autofocus>
              </div>
              <div class="form-group">
                <label class="form-label" for="middleName">Middle name</label>
                <input name="txt_edit_captain_mname" class="form-control" type="text"
                  value="<?php echo $row['captain_mname'] ?>">
              </div>
              <div class="form-group">
                <label class="form-label" for="lastName">Last name</label>
                <input name="txt_edit_captain_lname" class="form-control" type="text"
                  value="<?php echo $row['captain_lname'] ?>">
              </div>
              <div class="form-group my-0">
                <label class="control-label">Username</label>
                <input name="txt_edit_captain_uname" class="form-control" type="text"
                  value="<?php echo $row['captain_uname'] ?>" placeholder="Please enter your new username if needed">
                <label></label>
              </div>
              <div class="form-group">
                <label class="control-label">Password</label>
                <input name="txt_edit_captain_upass" class="form-control" type="password"
                  placeholder="Please enter your new password if needed">
              </div>
              <div class="form-group">
                <label for="image_file">Image</label>
                <div class="input-group">
                  <div class="custom-file">
                    <input name="txt_edit_captain_image" type="file" class="custom-file-input" id="image_file">
                    <label class="custom-file-label" for="image_file">Please browse your new image if needed</label>
                  </div>
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