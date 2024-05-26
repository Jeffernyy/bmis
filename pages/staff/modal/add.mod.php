<div class="modal fade" id="addModal">
  <form id="form" method="post" enctype="multipart/form-data">
    <div class="modal-dialog modal-md">
      <div class="modal-content">
        <div class="modal-header align-items-center">
          <h4 class="modal-title">Add Barangay Staff</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true"><i class="fas fa-times-circle"></i></span>
          </button>
        </div>
        <div class="modal-body">
          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label class="form-label" for="firstName">First name</label>
                <input name="txt_add_staff_fname" class="form-control" type="text" id="firstName"
                  placeholder="Please enter your first name" autofocus>
              </div>
              <div class="form-group">
                <label class="form-label">Middle name</label>
                <input name="txt_add_staff_mname" class="form-control" type="text"
                  placeholder="Please enter your middle name">
              </div>
              <div class="form-group">
                <label class="form-label">Last name</label>
                <input name="txt_add_staff_lname" class="form-control" type="text"
                  placeholder="Please enter your last name">
              </div>
              <div class="form-group my-0">
                <label class="control-label">Username</label>
                <input name="txt_add_staff_uname" id="add_username" class="form-control" type="text"
                  placeholder="Please enter your username">
                <label id="add_user_msg"></label>
              </div>
              <div class="form-group">
                <label class="control-label">Password</label>
                <input name="txt_add_staff_upass" class="form-control" type="password"
                  placeholder="Please enter your password">
              </div>
              <div class="form-group">
                <label for="image_file">Image</label>
                <div class="input-group">
                  <div class="custom-file">
                    <input name="txt_add_staff_image" type="file" class="custom-file-input" id="image_file">
                    <label class="custom-file-label" for="image_file">Please browse your image</label>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary" name="btn_add" id="btn_add">Save changes</button>
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
        txt_add_staff_fname: {
          required: true
        },
        txt_add_staff_mname: {
          required: true
        },
        txt_add_staff_lname: {
          required: true
        },
        txt_add_staff_uname: {
          required: true
        },
        txt_add_staff_upass: {
          required: true
        },
        txt_add_staff_image: {
          required: true
        },
      },

      messages: {
        // define error messages for each field
        txt_add_staff_fname: {
          required: "Please enter a first name"
        },
        txt_add_staff_mname: {
          required: "Please enter a middle name"
        },
        txt_add_staff_lname: {
          required: "Please enter a last name"
        },
        txt_add_staff_uname: {
          required: "Please enter a username"
        },
        txt_add_staff_upass: {
          required: "Please enter a password"
        },
        txt_add_staff_image: {
          required: "Please select an image"
        },
      },

      errorElement: 'label',
      errorPlacement: function (error, element) {
        if ($(element).attr("type") === "file") {
          error.addClass('invalid-feedback').css('color', '#ff6272').insertAfter(element.closest('.custom-file'));
        } else {
          error.addClass('invalid-feedback').css('color', '#ff6272').insertAfter(element);
        }
      },

      highlight: function (element, errorClass, validClass) {
        if ($(element).attr("type") === "file") {
          $(element).addClass('is-invalid').removeClass('is-valid');
        } else {
          $(element).addClass('is-invalid').removeClass('is-valid');
          $(element).closest('.form-group').removeClass('has-success').addClass('has-danger');
        }
        $(element).siblings('.valid-feedback').css('color', '#ff6272');
      },

      unhighlight: function (element, errorClass, validClass) {
        if ($(element).attr("type") === "file") {
          $(element).removeClass('is-invalid');
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
  });
</script>