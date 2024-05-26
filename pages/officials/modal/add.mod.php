<div class="modal fade" id="addModal">
  <form id="form" method="post" enctype="multipart/form-data">
    <div class="modal-dialog modal-md">
      <div class="modal-content">
        <div class="modal-header align-items-center">
          <h4 class="modal-title">Add Barangay Official</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true"><i class="fas fa-times-circle"></i></span>
          </button>
        </div>
        <div class="modal-body">
          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label class="control-label">Position</label>
                <select name="txt_add_official_position" class="form-control select2"
                  data-minimum-results-for-search="Infinity" autofocus>
                  <option selected disabled>Please select your position</option>
                  <option value="punong barangay">Punong Barangay</option>
                  <option value="barangay kagawad (ordinance)">Barangay kagawad (ordinance)</option>
                  <option value="barangay kagawad (public safety)">Barangay kagawad (public safety)</option>
                  <option value="barangay kagawad (tourism)">Barangay kagawad (tourism)</option>
                  <option value="barangay kagawad (budget & finance)">Barangay kagawad (budget & finance)</option>
                  <option value="barangay kagawad (agriculture)">Barangay kagawad (agriculture)</option>
                  <option value="barangay kagawad (education)">Barangay kagawad (education)</option>
                  <option value="barangay kagawad (infrastracture)">Barangay kagawad (infrastracture)</option>
                  <option value="sk chairman">Sk chairman</option>
                  <option value="secretary">Barangay secretary</option>
                  <option value="treasurer">Barangay treasurer</option>
                </select>
              </div>
              <div class="form-group">
                <label class="control-label">Name</label>
                <select name="txt_add_official_res_id" class="form-control select2">
                  <option selected disabled>Please select your name</option>
                  <?php
                  $squery = mysqli_query($con, "SELECT *, CONCAT(resident_fname, IF(resident_mname = 'n/a', '', CONCAT(' ', resident_mname)), ' ', resident_lname	) as official_name FROM tblresident");
                  while ($row = mysqli_fetch_array($squery)) {
                    echo ' <option value="' . $row['id'] . '">' . $row['official_name'] . '</option> ';
                  } ?>
                </select>
              </div>
              <div class="form-group">
                <label class="control-label">Contact #</label>
                <input name="txt_add_official_contact_num" class="form-control" type="number"
                  placeholder="Please enter your contact number">
              </div>
              <div class="form-group">
                <label class="control-label">Address</label>
                <input name="txt_add_official_address" class="form-control" type="text"
                  placeholder="Please enter your address">
              </div>
              <div class="form-group">
                <label class="control-label" for="txt_sterm">Start Term</label>
                <input name="txt_add_official_sterm" id="txt_sterm" class="form-control" type="text"
                  data-inputmask-alias="datetime" data-inputmask-inputformat="mm/dd/yyyy" placeholder="mm/dd/yyyy"
                  data-mask>
              </div>
              <div class="form-group">
                <label class="control-label" for="txt_eterm">End Term</label>
                <input name="txt_add_official_eterm" id="txt_eterm" class="form-control" type="text"
                  data-inputmask-alias="datetime" data-inputmask-inputformat="mm/dd/yyyy" placeholder="mm/dd/yyyy"
                  data-mask>
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
<script type="text/javascript">
  $(document).ready(function () {
    $('input[name="txt_sterm"]').change(function () {
      var startterm = document.getElementById("txt_sterm").value;
      console.log(startterm);
      document.getElementsByName("txt_eterm")[0].setAttribute('min', startterm);
    });
  });

  $(function () {
    // set default validator options
    $.validator.setDefaults({
      submitHandler: function () {
        const form = document.getElementById('form');
        form.submit();
      }
    });

    // initialize validation for the form
    $('#form').validate({
      rules: {
        // define validation rules for each field
        txt_add_official_position: {
          required: true
        },
        txt_add_official_res_id: {
          required: true
        },
        txt_add_official_contact_num: {
          required: true
        },
        txt_add_official_address: {
          required: true
        },
        txt_add_official_sterm: {
          required: true
        },
        txt_add_official_eterm: {
          required: true
        },
      },

      messages: {
        // define error messages for each field
        txt_add_official_position: {
          required: "Please select a position"
        },
        txt_add_official_res_id: {
          required: "Please select a name"
        },
        txt_add_official_contact_num: {
          required: "Please enter a contact number"
        },
        txt_add_official_address: {
          required: "Please enter a complete address"
        },
        txt_add_official_sterm: {
          required: "Please enter a date for start term"
        },
        txt_add_official_eterm: {
          required: "Please enter a date for end term"
        },
      },

      errorElement: 'label',
      errorPlacement: function (error, element) {
        if ($(element).hasClass('select2')) {
          error.addClass('invalid-feedback').css('color', '#ff6272').insertAfter(element.next('.select2-container'));
        } else {
          error.addClass('invalid-feedback').css('color', '#ff6272').insertAfter(element);
        }
      },

      highlight: function (element, errorClass, validClass) {
        if ($(element).hasClass('select2')) {
          $(element).closest('.form-group').removeClass('has-success').addClass('has-danger');
          $(element).next('.select2-container').find('.select2-selection').addClass('is-invalid');
        } else {
          $(element).addClass('is-invalid').removeClass('is-valid');
          $(element).closest('.form-group').removeClass('has-success').addClass('has-danger');
        }
        $(element).siblings('.valid-feedback').css('color', '#ff6272');
      },

      unhighlight: function (element, errorClass, validClass) {
        if ($(element).hasClass('select2')) {
          $(element).closest('.form-group').removeClass('has-danger').addClass('has-success');
          $(element).next('.select2-container').find('.select2-selection').removeClass('is-invalid').addClass('is-valid');
        } else {
          $(element).removeClass('is-invalid');
          $(element).closest('.form-group').removeClass('has-danger').addClass('has-success');
        }
        $(element).siblings('.valid-feedback').css('color', '#3eee67');
      },

      success: function (label, element) {
        label.removeClass('invalid-feedback').addClass('valid-feedback').text('Looks good');
        $(element).addClass('is-valid').removeClass('is-invalid');
        $(element).closest('.form-group').removeClass('has-danger').addClass('has-success');
        label.css('color', '#3eee67');
      },
    });

    // listen for changes in the select2 input and trigger validation
    $('#addModal').find('.select2').on('change', function () {
      $(this).valid(); // trigger validation for the select2 input
    });
  });
</script>