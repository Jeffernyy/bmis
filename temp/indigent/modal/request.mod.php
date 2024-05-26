<div class="modal fade" id="reqModal">
  <form method="post" enctype="multipart/form-data">
    <div class="modal-dialog modal-md">
      <div class="modal-content">
        <div class="modal-header align-items-center">
          <h4 class="modal-title">Request Indigent</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true"><i class="fas fa-times-circle"></i></span>
          </button>
        </div>
        <div class="modal-body">
          <div class="row">
            <div class="col-12">
              <div class="form-group">
                <label class="control-label">Purpose</label>
                <select name="txt_req_indigent_purpose" class="form-control select2" autofocus>
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
                <label class="control-label">Government Office</label>
                <select name="txt_req_indigent_gov_office" class="form-control select2">
                  <option selected disabled>Please select your government office</option>
                  <?php
                  $query = mysqli_query($con, "SELECT gov_office FROM tblgovoffice");
                  while ($row = mysqli_fetch_array($query)) {
                    echo '<option value="' . htmlspecialchars($row['gov_office']) . '">' . strtolower(htmlspecialchars($row['gov_office'])) . '</option>';
                  } ?>
                </select>
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary" name="btn_request">Request Indigent</button>
        </div>
      </div>
    </div>
  </form>
</div>