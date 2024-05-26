$(document).ready(function () {
  var timeOut = null; // this used for hold few seconds to made ajax request
  var loading_html =
    '<img src="../../assets/loader/loader.gif" style="width: 25px; height: 25px;"/>'; // just an loading image or we can put any texts here
  // when button is clicked
  $("#username").keyup(function (e) {
    // when press the following key we need not to make any ajax request, you can customize it with your own way
    switch (e.keyCode) {
      case 8: // backspace
      case 9: // tab
      case 13: // enter
      case 16: // shift
      case 17: // ctrl
      case 18: // alt
      case 19: // pause/break
      case 20: // caps lock
      case 27: // escape
      case 33: // page up
      case 34: // page down
      case 35: // end
      case 36: // home
      case 37: // left arrow
      case 38: // up arrow
      case 39: // right arrow
      case 40: // down arrow
      case 45: // insert
      case 46: // delete
        return;
    }

    if (timeOut != null) clearTimeout(timeOut);
    timeOut = setTimeout(is_available, 2000); // delay delay ajax request for 2000 milliseconds
    $("#user_msg").html(loading_html); // adding the loading text or image
  });
});

function is_available() {
  // get the username
  var username = $("#username").val();
  // make the ajax request to check is username available or not
  $.post("check_username.php", { username: username }, function (result) {
    console.log(result);
    if (result != 0) {
      $("#user_msg").html(
        '<span style="color: #ff8080">This username is already taken.</span>'
      );
      document.getElementById("btn_add").disabled = true;
    } else if (username === "") {
      $("#user_msg").html(
        /* im sleepy */
        '<span class="text-warning">This username is dili pwede empty.</span>'
      );
      document.getElementById("btn_add").disabled = true;
    } else {
      $("#user_msg").html(
        '<span style="color: #45ff70">This username is available</span>'
      );
      document.getElementById("btn_add").disabled = false;
    }
  });
}
