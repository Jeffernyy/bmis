<?php echo '
<div class="modal fade" id="editModal' . $row['hid'] . '">
<form action="" method="post" enctype="multipart/form-data">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
      <div class="modal-header align-items-center">
        <h4 class="modal-title">Edit Household</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true"><i class="fas fa-times-circle"></i></span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-12">
            <input type="hidden" value="' . $row['hid'] . '" name="hidden_id" id="hidden_id">
            <input type="hidden" value="' . $row['household_num'] . '" name="hiddennum" id="hiddennum">
            <div class="form-group">
              <label class="control-label">Household #</label>
              <input class="form-control" type="text" value="' . $row['household_num'] . '" readonly>
            </div>
            <div class="form-group">
              <label class="control-label">Purok</label>
              <input name="txt_edit_household_purok" class="form-control" type="text" value="' . $row['hpurok'] . '"
              autofocus>
            </div>
            <div class="form-group">
              <label class="control-label">Total Number of Household Members</label>
              <input class="form-control" type="number" value="' . $row['household_total_mem'] . '" readonly>
            </div>
            <div class="form-group">
              <label class="control-label">Head of the Family</label>';
              $qry = mysqli_query($con, "SELECT *, COALESCE(CONCAT(r.resident_fname, IF(r.resident_mname = 'n/a', '', CONCAT(' ', r.resident_mname)), ' ', r.resident_lname), 'n/a') as household_head_of_family_res_name, p.id as pid FROM tblhousehold p LEFT JOIN tblresident r ON r.id = p.household_head_of_family WHERE p.id = '" . $row['household_head_of_family'] . "' ");
              while ($row = mysqli_fetch_array($qry)) {
                echo '<input class="form-control" type="text" value="' . $row['household_head_of_family_res_name'] . '" readonly>';
              }
              echo '
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
</div>'
  ?>