<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=7">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="format-detection" content="telephone=no">
  <meta name="theme-color" content="#75dab4">

  <title>Login | Barangay Management Information System</title>

  <meta name="author" content="Rakkzxc">
  <meta name="description" content="barangay new pandan management information system">
  <meta name="keywords" content="barangay new pandan management information system">

  <!-- social media meta -->
  <meta property="og:description" content="Brgy New Pandan | Barangay Management Information System">
  <meta property="og:image" content="http://www.brgynewpandan.com/newpandan/preview.png">
  <meta property="og:site_name" content="newpandan">
  <meta property="og:title" content="newpandan">
  <meta property="og:type" content="website">
  <meta property="og:url" content="http://www.brgynewpandan.com/newpandan">

  <!-- twitter meta -->
  <meta name="twitter:card" content="summary">
  <meta name="twitter:site" content="@newpandan">
  <meta name="twitter:creator" content="@newpandan">
  <meta name="twitter:title" content="newpandan">
  <meta name="twitter:description" content="Brgy New Pandan | Barangay Management Information System">
  <meta name="twitter:image" content="http://www.brgynewpandan.com/newpandan/preview.png">

  <!-- favicon files -->
  <link href="assets/ico/apple-touch-icon-144-precomposed.png" rel="apple-touch-icon" sizes="144x144">
  <link href="assets/ico/apple-touch-icon-114-precomposed.png" rel="apple-touch-icon" sizes="114x114">
  <link href="assets/ico/apple-touch-icon-72-precomposed.png" rel="apple-touch-icon" sizes="72x72">
  <link href="assets/ico/apple-touch-icon-57-precomposed.png" rel="apple-touch-icon">
  <link href="assets/ico/favicon.png" rel="shortcut icon">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- Select2 -->
  <link rel="stylesheet" href="plugins/select2/css/select2.min.css">
  <link rel="stylesheet" href="plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
  <!-- SweetAlert2 -->
  <link rel="stylesheet" href="plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <!-- jQuery -->
  <script src="plugins/jquery/jquery.min.js"></script>
  <!-- Google Recaptcha -->
  <script src="https://www.google.com/recaptcha/api.js" async defer></script>
</head>

<style>
  label.invalid-feedback,
  label.valid-feedback,
  label.success,
  label.error {
    margin-bottom: 0 !important;
  }

  label:not(.form-check-label):not(.custom-file-label) {
    font-weight: normal;
  }

  .form-control.is-valid {
    border-color: #3eee67 !important;
  }

  .form-control.is-invalid {
    border-color: #ff6272 !important;
  }

  /* Success styling for select2 */
  .select2-container .select2-selection.is-valid {
    border-color: #3eee67 !important;
  }

  /* Error styling for select2 */
  .select2-container .select2-selection.is-invalid {
    border-color: #ff6272 !important;
  }

  .custom-file-input.is-valid~.custom-file-label,
  .was-validated .custom-file-input:valid~.custom-file-label {
    border-color: #3eee67 !important;
  }

  .custom-file-input.is-invalid~.custom-file-label,
  .was-validated .custom-file-input:invalid~.custom-file-label {
    border-color: #ff6272 !important;
  }

  .login-box {
    position: fixed;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
  }

  .g-recaptcha {
    transform: scale(1.058);
    transform-origin: 0 0;
  }
</style>

<?php include "include/login.inc.php" ?>

<body class="hold-transition login-page dark-mode">
  <div class="login-box shadow-lg">
    <div class="card card-outline card-primary">
      <a class="text-light" href="index.php" style="position: absolute; top: 5px; left: 7px; z-index: 9;"><i
          class="fas fa-reply"></i></a>
      <div class="card-header text-center">
        <style>
          .card-header {
            border-bottom: 2px double rgba(255, 255, 255, 0.075) !important
          }
        </style>
        <img src="assets/img/brgy-logo.png" style="height:125px">
      </div>
      <div class="card-body">
        <p class="login-box-msg" style="color: rgba(255, 255, 255, 0.85)">Blee<span>😋</span></p>
        <form id="logForm" method="post">
          <div class="input-group mb-3">
            <input type="text" class="form-control" name="txt_log_uname"
              value="<?php echo isset($_POST['txt_log_uname']) ? htmlspecialchars($_POST['txt_log_uname']) : '' ?>"
              placeholder="Enter your username" autofocus>
            <div class="input-group-append">
              <div class="input-group-text">
                <i class="fas fa-user"></i>
              </div>
            </div>
          </div>
          <div class="input-group mb-3">
            <input type="password" class="form-control" name="txt_log_pword" placeholder="Enter your password">
            <div class="input-group-append">
              <div class="input-group-text">
                <i class="fas fa-lock"></i>
              </div>
            </div>
          </div>
          <div class="form-group mb-3">
            <div class="g-recaptcha" data-sitekey="<?php echo getenv('GOOGLE_SITE_CAPTCHA_KEY') ?>"></div>
          </div>
          <div class="form-group mb-3">
            <select name="txt_log_user_role" class="form-control select2" data-minimum-results-for-search="Infinity"
              required>
              <option selected disabled>Please sign in as</option>
              <option value="administrator">Administrator</option>
              <option value="captain">Captain</option>
              <option value="staff">Staff</option>
              <option value="resident">Resident</option>
            </select>
          </div>
          <div class="row">
            <div class="col-12">
              <button type="submit" class="btn btn-primary btn-block" name="btn_login">Sign In</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>

  <script>
    $(function () {
      // set default validator options
      $.validator.setDefaults({
        submitHandler: function () {
          const form = document.getElementById('logForm');
          logForm.submit();
        }
      });

      // initialize validation for the form
      $('#logForm').validate({
        rules: {
          // define validation rules for each field
          txt_log_uname: {
            required: true
          },
          txt_log_pword: {
            required: true
          },
          txt_log_user_role: {
            required: true
          },
        },

        messages: {
          // define error messages for each field
          txt_log_uname: {
            required: "Please enter your username"
          },
          txt_log_pword: {
            required: "Please enter you password"
          },
          txt_log_user_role: {
            required: "Please select a user role"
          },
        },

        errorElement: 'label',
        errorPlacement: function (error, element) {
          if ($(element).hasClass('select2')) {
            error.addClass('invalid-feedback').css('color', '#ff6272').insertAfter(element.next('.select2-container'));
          } else {
            error.addClass('invalid-feedback').css('color', '#ff6272').insertAfter(element.next('.input-group-append'));
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
      $('#logForm').find('.select2').on('change', function () {
        $(this).valid(); // trigger validation for the select2 input
      });
    });
  </script>

  <!-- Bootstrap -->
  <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- Select2 -->
  <script src="plugins/select2/js/select2.full.min.js"></script>
  <!-- jquery-validation -->
  <script src="plugins/jquery-validation/jquery.validate.min.js"></script>
  <script src="plugins/jquery-validation/additional-methods.min.js"></script>
  <!-- SweetAlert2 -->
  <script src="plugins/sweetalert2/sweetalert2.min.js"></script>
  <!-- AdminLTE App -->
  <script src="dist/js/adminlte.min.js"></script>
  <!-- Initialize Plugins -->
  <script> $(".select2").select2() </script>
</body>

</html>