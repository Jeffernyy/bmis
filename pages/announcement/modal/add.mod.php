<div class="modal fade" id="addModal">
  <form id="form" method="post" enctype="multipart/form-data">
    <div class="modal-dialog modal-md">
      <div class="modal-content">
        <div class="modal-header align-items-center">
          <h4 class="modal-title">Add Announcement</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true"><i class="fas fa-times-circle"></i></span>
          </button>
        </div>
        <div class="modal-body">
          <div class="row">
            <div class="col-12">
              <div class="form-group">
                <label class="control-label">Date & Time</label>
                <input id="txt_add_announcement_date" name="txt_add_announcement_date" type="text" class="form-control"
                  placeholder="mm/dd/yyyy hh:mm aa" autofocus>
              </div>
              <div class="form-group">
                <label class="form-label" for="announcement">Announcement</label>
                <input name="txt_add_announcement" class="form-control" type="text" id="announcement"
                  placeholder="Please enter your announcement">
              </div>
              <div class="form-group">
                <label class="form-label" for="description">Description</label>
                <textarea name="txt_add_announcement_desc" class="form-control" cols="3" rows="3" id="description"
                  placeholder="Please enter your description"></textarea>
              </div>
              <div class="form-group">
                <label for="image_file">Image</label>
                <div class="input-group">
                  <div class="custom-file">
                    <input name="txt_add_announcement_image[]" type="file" class="custom-file-input" id="image_file"
                      multiple>
                    <label class="custom-file-label" for="image_file">Please browse your image</label>
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
  $(document).ready(function () {
    // Apply Inputmask to the datetime input field
    $('#txt_add_announcement_date').inputmask('99/99/9999 99:99 AA', {
      'placeholder': 'mm/dd/yyyy hh:mm aa',
      'alias': 'datetime',
      'mask': '99/99/9999 99:99 AA'
    });

    $.validator.addMethod("custom_month", function (value, element) {
      var month = parseInt(value.substr(0, 2));

      // validate month to be within 1-12
      if (month > 12 || month < 1) {
        return false;
      }

      return true;
    }, "Please enter a valid month");

    $.validator.addMethod("custom_date", function (value, element) {
      var month = parseInt(value.substr(0, 2));
      var day = parseInt(value.substr(3, 2));
      var year = parseInt(value.substr(6, 4));

      // validate day to be within 1-31 depending on the month in the calendar
      var daysInMonth = new Date(year, month, 0).getDate();
      if (day > daysInMonth || day < 1) {
        return false;
      }

      return true;
    }, "Please enter a valid date");

    $.validator.addMethod("custom_year", function (value, element) {
      var year = parseInt(value.substr(6, 4));

      // validate year to be within 1910 and 3020
      if (year < 1910 || year > 3020) {
        return false;
      }

      return true;
    }, "Please enter a valid year");

    $.validator.addMethod("custom_hour", function (value, element) {
      var hours = parseInt(value.substr(11, 2));

      // validate hours to be within 1-12 for 12-hour format
      if (hours > 12 || hours < 1) {
        return false;
      }

      return true;
    }, "Please enter a valid hour(s)");

    $.validator.addMethod("custom_minute", function (value, element) {
      var minutes = parseInt(value.substr(14, 2));

      // validate minutes to be within 0-59
      if (minutes > 59 || minutes < 0) {
        return false;
      }

      return true;
    }, "Please enter a valid minute(s)");

    $.validator.addMethod("custom_meridian", function (value, element) {
      var meridian = value.substr(17, 2);

      // validate am/pm to be either am or pm
      if (meridian !== 'AM' && meridian !== 'PM') {
        return false;
      }

      return true;
    }, "Please enter only am/pm as the meridian");

    // initialize validation for the form
    $('#form').validate({
      rules: {
        // define validation rules for each field
        txt_add_announcement_date: {
          required: true,
          custom_month: true,
          custom_date: true,
          custom_year: true,
          custom_hour: true,
          custom_minute: true,
          custom_meridian: true
        },
        txt_add_announcement: {
          required: true
        },
        txt_add_announcement_desc: {
          required: true
        },
        'txt_add_announcement_image[]': {
          required: true
        },
      },

      messages: {
        // define error messages for each field
        txt_add_announcement_date: {
          required: "Please enter a date for the announcement"
        },
        txt_add_announcement: {
          required: "Please select an announcement"
        },
        txt_add_announcement_desc: {
          required: "Please enter a description for the announcement"
        },
        'txt_add_announcement_image[]': {
          required: "Please enter an image for the announcement"
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