<?php
// function to sanitize input data
function sanitize_notif($data)
{
  return htmlspecialchars($data, ENT_QUOTES, 'UTF-8');
}

// check for different types of messages and display them using sweet alert
if (isset($_SESSION['success'])) {

  $message = sanitize_notif($_SESSION['success']);
  unset($_SESSION['success']);
  $type = 'success';
  $action = 'Success';

} elseif (isset($_SESSION['info'])) {

  $message = sanitize_notif($_SESSION['info']);
  unset($_SESSION['info']);
  $type = 'info';
  $action = 'Info';

} elseif (isset($_SESSION['warning'])) {

  $message = sanitize_notif($_SESSION['warning']);
  unset($_SESSION['warning']);
  $type = 'warning';
  $action = 'Warning';

} elseif (isset($_SESSION['error'])) {

  $message = sanitize_notif($_SESSION['error']);
  unset($_SESSION['error']);
  $type = 'error';
  $action = 'Error';

}

// output sweet alert based on the message type
if (isset($type)) {
  // generate notification token
  $NOTIFSESSID = bin2hex(random_bytes(32));
  $_SESSION['NOTIFSESSID'] = $NOTIFSESSID;

  // output the sweet alert script
  echo '
    <script>
      $(document).ready(function () {
        let timerInterval;
        Swal.fire({
          icon: "' . $type . '",
          html: "' . $action . '<br><br>' . $message . '<br><br>Will close in <b></b> milliseconds.",
          timer: 7000,
          timerProgressBar: true,
          didOpen: () => {
            Swal.showLoading();
            const timer = Swal.getPopup().querySelector("b");
            timerInterval = setInterval(() => {
              timer.textContent = `${Swal.getTimerLeft()}`;
            }, 100);
          },
          willClose: () => {
            clearInterval(timerInterval);
          }
        }).then((result) => {
          if (result.dismiss === Swal.DismissReason.timer) {
            console.log("I was closed by the timer");
          }
        });
      });
    </script>';

  // set notification token in a secure http only cookie
  setcookie('NOTIFSESSID', $NOTIFSESSID, 0, '/', '', true, true);
}