<div class="modal fade" id="addModal">
  <form action="" method="post" enctype="multipart/form-data">
    <div class="modal-dialog modal-md">
      <div class="modal-content">
        <div class="modal-header align-items-center">
          <h4 class="modal-title">Add Household</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true"><i class="fas fa-times-circle"></i></span>
          </button>
        </div>
        <div class="modal-body">
          <div class="row">
            <div class="col-12">
              <div class="form-group">
                <label class="control-label">Household #</label>
                <input onkeyup="show_head()" id="txt_add_household_num" name="txt_add_household_num"
                  class="form-control" type="number" placeholder="Please enter your household number" autofocus
                  required>
              </div>
              <div class="form-group">
                <label class="control-label">Purok</label>
                <input id="txt_add_purok" name="txt_add_household_purok" class="form-control" type="text"
                  placeholder="This purok is auto generated" readonly required>
              </div>
              <div class="form-group">
                <label class="control-label">Total Number of Household Members</label>
                <input id="txt_add_total_household_mem" name="txt_add_household_total_household_mem"
                  class="form-control" type="text" placeholder="This total household member is auto generated" readonly
                  required>
              </div>
              <div class="form-group">
                <label class="control-label">Head of the Family</label>
                <span class="badge badge-warning ml-2">Please enter household number first</span>
                <select id="txt_add_head_of_family" name="txt_add_household_head_of_family" class="form-control select2"
                  data-minimum-results-for-search="Infinity" required onchange="show_all()">
                  <option selected disabled>Please select the head of family</option>
                </select>
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary" name="btn_add">Save changes</button>
        </div>
      </div>
    </div>
  </form>
</div>

<script>
  function show_head() {
    var householdNumID = $('#txt_add_household_num').val();
    console.log(householdNumID);
    if (householdNumID) {
      $.ajax({
        type: 'POST',
        url: '../../ajax/household.ajax.php',
        data: 'household_id=' + householdNumID,
        success: function (html) {
          $('#txt_add_head_of_family').html(html);
        }
      });
    }
  }

  function show_purok() {
    var purokID = $('#txt_add_head_of_family').val();
    console.log(purokID);
    if (purokID) {
      $.ajax({
        type: 'POST',
        url: '../../ajax/household.ajax.php',
        data: 'purok_id=' + purokID,
        success: function (html) {
          $('#txt_add_purok').html(html);
        }
      });
    }
  }

  function show_total() {
    var totalHouseholdMemID = $('#txt_add_head_of_family').val();
    console.log(totalHouseholdMemID);
    if (totalHouseholdMemID) {
      $.ajax({
        type: 'POST',
        url: '../../ajax/household.ajax.php',
        data: 'total_household_mem_id=' + totalHouseholdMemID,
        success: function (html) {
          $('#txt_add_total_household_mem').html(html);
        }
      });
    }
  }

  function show_all() {
    show_purok();
    show_total();
  }
</script>