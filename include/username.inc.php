<?php
// define constants for role names and maximum username length
define('ROLE_ADMINISTRATOR', 'administrator');
define('ROLE_CAPTAIN', 'captain');
define('ROLE_STAFF', 'staff');
define('ROLE_RESIDENT', 'resident');
define('MAX_USERNAME_LENGTH', 21);

if (isset($_SESSION['role'])) {
  $role = strtolower($_SESSION['role']);
  $fullName = ucwords(strtolower($_SESSION['fname'])) . ($_SESSION['mname'] === 'n/a' ? '' : " " . ucwords(strtolower($_SESSION['mname']))) . " " . ucwords(strtolower($_SESSION['lname']));

  // function to sanitize input
  function sanitize_uname($value)
  {
    return htmlspecialchars($value);
  }

  // function to generate username
  function generateUsername($fullName)
  {
    // limit the name into MAX_USERNAME_LENGTH characters
    return (strlen($fullName) > MAX_USERNAME_LENGTH) ? substr($fullName, 0, MAX_USERNAME_LENGTH) . '...' : $fullName;
  }

  // function to construct username paragraph
  function constructUsername($fullName)
  {
    return '<p title="' . sanitize_uname($fullName) . '">' . generateUsername($fullName) . '</p>';
  }

  // generate username based on role
  switch ($role) {
    case ROLE_ADMINISTRATOR:
    case ROLE_CAPTAIN:
    case ROLE_STAFF:
    case ROLE_RESIDENT:

      $username = constructUsername($fullName);
      break;

    default:
      // handle unauthorized role
      // you might redirect the user to an error page or handle it as appropriate
      break;
  }
}