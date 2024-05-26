<div class="modal fade" id="addModal">
  <form id="form" method="post" enctype="multipart/form-data">
    <div class="modal-dialog modal-md">
      <div class="modal-content">
        <div class="modal-header align-items-center">
          <h4 class="modal-title">Add Officer</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true"><i class="fas fa-times-circle"></i></span>
          </button>
        </div>
        <div class="modal-body">
          <div class="row">
            <div class="container-fluid">
              <div class="row">
                <div class="col-12">
                  <div class="form-group">
                    <label class="control-label">Position</label>
                    <select name="txt_add_officer_position" class="form-control select2"
                      data-minimum-results-for-search="Infinity" autofocus>
                      <option selected disabled>Please select your position</option>
                      <option value="IPMR">IPMR</option>
                      <option value="Barangay kagawad">Barangay kagawad</option>
                    </select>
                  </div>
                  <div class="form-group">
                    <label class="control-label">First name</label>
                    <input type="text" name="txt_add_officer_fname" class="form-control"
                      placeholder="Please enter your government office">
                  </div>
                  <div class="form-group">
                    <label class="control-label">Middle name</label>
                    <input type="text" name="txt_add_officer_mname" class="form-control"
                      placeholder="Please enter your government office">
                  </div>
                  <div class="form-group">
                    <label class="control-label">Last name</label>
                    <input type="text" name="txt_add_officer_lname" class="form-control"
                      placeholder="Please enter your government office">
                  </div>
                </div>
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
        txt_add_officer_position: {
          required: true
        },
        txt_add_officer_fname: {
          required: true
        },
        txt_add_officer_mname: {
          required: true
        },
        txt_add_officer_lname: {
          required: true
        },
      },

      messages: {
        // define error messages for each field
        txt_add_officer_position: {
          required: "Please select your position"
        },
        txt_add_officer_fname: {
          required: "Please enter your first name"
        },
        txt_add_officer_mname: {
          required: "Please enter your middle name"
        },
        txt_add_officer_lname: {
          required: "Please enter your last name"
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