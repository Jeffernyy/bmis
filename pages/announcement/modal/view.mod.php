<div id="viewModal<?php echo $row['id'] ?>" class="modal fade">
  <form method="post" enctype="multipart/form-data">
    <div class="modal-dialog modal-xl">
      <div class="modal-content">
        <div class="modal-header align-items-center">
          <h4 class="modal-title">View image(s) for announcement |
            <?php echo ucfirst(strtolower(htmlspecialchars($row['announcement']))) ?>
          </h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true"><i class="fas fa-times-circle"></i></span>
          </button>
        </div>
        <div class="modal-body">
          <input type="hidden" name="hidden_id" value="<?php echo $row['id'] ?>">
          <?php
          // check user role to determine which elements to include
          if ($_SESSION['role'] === 'administrator' || $_SESSION['role'] === 'staff') {
            $mainCheckBox = 'cbxMainphoto';
            // check if there are images to show
            $query = mysqli_query($con, "SELECT a.*, b.id AS bid FROM tblannouncementphoto a LEFT JOIN tblannouncement b ON a.announcement_id = b.id WHERE b.id = '" . $row['id'] . "'");
            $imageCount = mysqli_num_rows($query);

            if ($imageCount > 0) { ?>
              <div class="custom-control custom-checkbox my-3">
                <input class="<?php echo $mainCheckBox ?> custom-control-input" type="checkbox"
                  id="<?php echo $mainCheckBox ?> <?php echo $row['id'] ?>">
                <label for="<?php echo $mainCheckBox ?> <?php echo $row['id'] ?>" class="custom-control-label">Select
                  All</label>
              </div>
            <?php }
          } ?>

          <div class="row">
            <?php
            $query = mysqli_query($con, "SELECT a.*, b.id AS bid FROM tblannouncementphoto a LEFT JOIN tblannouncement b ON a.announcement_id = b.id WHERE b.id = '" . $row['id'] . "'");
            $imageCount = mysqli_num_rows($query);

            if ($imageCount > 0) {
              while ($row_query = mysqli_fetch_array($query)) {
                $checkboxId = 'chk_deletephoto';
                // limit the length to 175 characters
                $shortened = (strlen($row_query['announcement_filename']) > 20) ?
                  substr($row_query['announcement_filename'], 0, 20) . '...' : $row_query['announcement_filename'];
                ?>
                <div class="col-md-6 mb-2">
                  <?php
                  // only include the checkbox if the user is an administrator or staff
                  if ($_SESSION['role'] === 'administrator' || $_SESSION['role'] === 'staff') { ?>
                    <div class="custom-control custom-checkbox">
                      <input name="chk_deletephoto[]" class="<?php echo $checkboxId ?> custom-control-input" type="checkbox"
                        id="<?php echo $checkboxId ?> <?php echo $row_query['id'] ?>" value="<?php echo $row_query['id'] ?>">
                      <label for="<?php echo $checkboxId ?> . <?php echo $row_query['id'] ?>"
                        class="custom-control-label"></label>
                    </div>
                    <?php
                  } ?>
                  <a href="images/<?php echo basename($row_query['announcement_filename']) ?>" data-toggle="lightbox"
                    data-title="<?php echo ucfirst(strtolower($shortened)) ?>"
                    data-gallery="gallery<?php echo $row['id'] ?>">
                    <image src="images/<?php echo basename($row_query['announcement_filename']) ?>" class="img-fluid pt-2">
                  </a>
                </div>
              <?php }

            } else {
              // display a message if no images are found
              ?>
              <div class="col-md-12">No images are available to show. Bleeeeeeee...</div>
              <?php
            } ?>
          </div>
        </div>
        <div class="modal-footer">
          <?php
          // only include the file input and buttons if the user is an administrator or staff
          if ($_SESSION['role'] === 'administrator' || $_SESSION['role'] === 'staff') { ?>
            <div class="form-group">
              <div class="input-group">
                <div class="custom-file">
                  <input name="images[]" type="file" class="custom-file-input" id="image_file" multiple>
                  <label class="custom-file-label" for="image_file">Please browse your image</label>
                </div>
              </div>
            </div>
            <input type="submit" class="btn btn-primary" name="btn_add_announcement_image" value="Add Image">
            <input type="submit" class="btn btn-danger" name="btn_del_announcement_image" value="Remove Image">
            <?php
          } ?>
          <input type="button" class="btn btn-default" data-dismiss="modal" value="Close">
        </div>
      </div>
    </div>
  </form>
</div>
</div>