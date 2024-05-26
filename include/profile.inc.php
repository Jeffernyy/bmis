<?php
// Define constants only if they are not already defined
if (!defined('ADMIN_PATH')) {
  define('ADMIN_PATH', '../../assets/avatar/');
}

if (!defined('STAFF_PATH')) {
  define('STAFF_PATH', '../../pages/staff/images/');
}

if (!defined('CAPTAIN_PATH')) {
  define('CAPTAIN_PATH', '../../pages/captain/images/');
}

if (!defined('RESIDENT_PATH')) {
  define('RESIDENT_PATH', '../../pages/resident/images/');
}

// Validate and sanitize input
$profile = isset($_SESSION['profile']) ? htmlspecialchars($_SESSION['profile']) : '';
$role = isset($_SESSION['role']) ? htmlspecialchars($_SESSION['role']) : '';

if (!empty($role)) {

  switch ($role) {

    case 'administrator':
      $profilePath = ADMIN_PATH;
      break;

    case 'staff':
      $profilePath = STAFF_PATH;
      break;

    case 'captain':
      $profilePath = CAPTAIN_PATH;
      break;

    case 'resident':
      $profilePath = RESIDENT_PATH;
      break;

    default:
      // Handle unauthorized role
      // You might redirect the user to an error page or handle it as appropriate
      break;
  }

  // Construct the profile URL
  if (isset($profilePath)) {
    $profile = 'src="' . $profilePath . $profile . '"';
  }
}