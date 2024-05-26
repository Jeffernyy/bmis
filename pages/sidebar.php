<?php
include "../../include/profile.inc.php";
include "../../include/username.inc.php";

echo '
<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-3">
  <!-- Logo -->
  <a href="../../index.php" class="d-flex align-items-center justify-content-center py-3" style="border-bottom: 1px solid #4f5962">
      <img src="../../assets/img/brgy-logo.png" class="img-fluid" alt="Logo">
  </a>

  <style>
  .os-theme-dark>.os-scrollbar-horizontal,
  .os-theme-light>.os-scrollbar-horizontal {
    display: none }

  .layout-navbar-fixed.layout-fixed .wrapper .sidebar {
    margin-top: calc(0rem + 1px) }

  .layout-navbar-fixed.layout-fixed .wrapper .sidebar {
    margin-top: calc(0rem + 1px) }

  .sidebar-mini.sidebar-collapse .main-sidebar:not(.sidebar-no-expand):hover .sidebar .user-panel {
    justify-content: flex-start !important }

  .sidebar-mini.sidebar-collapse .sidebar .user-panel {
    justify-content: center !important }

  .sidebar-mini.sidebar-collapse .sidebar .user-panel .info {
    display: none }

  @supports not (-webkit-touch-callout:none) {
    .layout-fixed .wrapper .sidebar {
      height: calc(100vh - (11.375rem + 1px)) }
  }
</style>
  
  <!-- Sidebar -->
  <div class="sidebar">
    <!-- Sidebar user (optional) -->
    <div class="user-panel my-3 pb-3 d-flex align-items-center justify-content-start">
      <div class="widget-user-image img-circle d-flex align-items-center" style="background: rgb(132,208,247)">
        <img class="img-circle" ' . $profile . '  alt="User Avatar" style="width: 40px; height: 40px;">
      </div>
      <div class="info">
      <style> a p { margin: 0 } </style>
        <a href="../../index.php" class="d-block">' . $username . '</a>
      </div>
    </div>

    <!-- SidebarSearch Form -->
    <div class="form-inline">
      <div class="input-group" data-widget="sidebar-search">
        <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
        <div class="input-group-append">
          <button class="btn btn-sidebar">
            <i class="fas fa-search fa-fw"></i>
          </button>
        </div>
      </div>
    </div>
    <!-- Sidebar Menu -->
    <nav class="my-3">';

$page = substr($_SERVER['SCRIPT_NAME'], strrpos($_SERVER['SCRIPT_NAME'], "/") + 1);

if (isset($_SESSION['role']) && $_SESSION['role'] === 'administrator') {
  echo '
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
                with font-awesome or any other icon font library -->

          <li class="nav-item">
            <a href="../dashboard/dashboard.php" class="nav-link ' . ($page == "dashboard.php" ? 'active' : '') . '">
              <i class="nav-icon fas fa-th-large"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="../officials/officials.php" class="nav-link ' . ($page == "officials.php" ? 'active' : '') . '">
              <i class="nav-icon fas fa-user-friends"></i>
              <p>
                Officials
              </p>
            </a>
          </li>

          <li class="nav-item ' . (($page == "household.php" || $page == "resident.php") ? 'menu-open' : '') . '">
            <a href="#" class="nav-link ' . (($page == "household.php" || $page == "resident.php") ? 'active' : '') . '">
              <i class="nav-icon fas fa-scroll"></i>
              <p>
                Profiling
                <i class="fas fa-angle-right right"></i>
                <span class="badge badge-success right">2</span>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="../household/household.php" class="nav-link ' . ($page == "household.php" ? 'active' : '') . '">
                  <i class="fas fa-angle-right nav-icon"></i>
                  <p>Household</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="../resident/resident.php" class="nav-link ' . ($page == "resident.php" ? 'active' : '') . '">
                  <i class="fas fa-angle-right nav-icon"></i>
                  <p>Resident</p>
                </a>
              </li>
            </ul>
          </li>

          <li class="nav-header text-uppercase"><small>offenses</small></li>

          <li class="nav-item">
            <a href="../blotter/blotter.php" class="nav-link ' . ($page == "blotter.php" ? 'active' : '') . '">
              <i class="nav-icon fas fa-file-signature"></i>
              <p>
                Blotter
              </p>
            </a>
          </li>

          <li class="nav-header text-uppercase"><small>barangay issuance</small></li>

          <li class="nav-item ' . (($page == "clearance.php" || $page == "indigent.php" || $page == "lowincome.php") ? 'menu-open' : '') . '">
            <a href="#" class="nav-link ' . (($page == "clearance.php" || $page == "indigent.php" || $page == "lowincome.php") ? 'active' : '') . '">
              <i class="nav-icon fas fa-scroll"></i>
              <p>
                Issuance
                <i class="fas fa-angle-right right"></i>
                <span class="badge badge-primary right">3</span>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="../clearance/clearance.php" class="nav-link ' . ($page == "clearance.php" ? 'active' : '') . '">
                  <i class="fas fa-angle-right nav-icon"></i>
                  <p>Brgy Clearance</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="../indigent/indigent.php" class="nav-link ' . ($page == "indigent.php" ? 'active' : '') . '">
                  <i class="fas fa-angle-right nav-icon"></i>
                  <p>Cert of Indigent</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="../lowincome/lowincome.php" class="nav-link ' . ($page == "lowincome.php" ? 'active' : '') . '">
                  <i class="fas fa-angle-right nav-icon"></i>
                  <p>Cert of Low Income</p>
                </a>
              </li>
            </ul>
          </li>

          <li class="nav-header text-uppercase"><small>issuance credentials</small></li>

          <li class="nav-item ' . (($page == "govoffice.php" || $page == "purpose.php" || $page == "officer.php") ? 'menu-open' : '') . '">
            <a href="#" class="nav-link ' . (($page == "govoffice.php" || $page == "purpose.php" || $page == "officer.php") ? 'active' : '') . '">
              <i class="nav-icon fas fa-scroll"></i>
              <p>
                Credentials
                <i class="fas fa-angle-right right"></i>
                <span class="badge badge-info right">3</span>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="../officer/officer.php" class="nav-link ' . ($page == "officer.php" ? 'active' : '') . '">
                  <i class="fas fa-angle-right nav-icon"></i>
                  <p>Officer of the Day</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="../govoffice/govoffice.php" class="nav-link ' . ($page == "govoffice.php" ? 'active' : '') . '">
                  <i class="fas fa-angle-right nav-icon"></i>
                  <p>Government Offices</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="../purpose/purpose.php" class="nav-link ' . ($page == "purpose.php" ? 'active' : '') . '">
                  <i class="fas fa-angle-right nav-icon"></i>
                  <p>Issuance Purposes</p>
                </a>
              </li>
            </ul>
          </li>

          <li class="nav-header text-uppercase"><small>communication</small></li>

          <li class="nav-item">
            <a href="../announcement/announcement.php" class="nav-link ' . ($page == "announcement.php" ? 'active' : '') . '">
              <i class="nav-icon fas fa-bullhorn"></i>
              <p>
                Announcement
              </p>
            </a>
          </li>

          <li class="nav-header text-uppercase"><small>accounts</small></li>

          <li class="nav-item ' . (($page == "captain.php" || $page == "staff.php" || $page == "resuser.php") ? 'menu-open' : '') . '">
            <a href="#" class="nav-link ' . (($page == "captain.php" || $page == "staff.php" || $page == "resuser.php") ? 'active' : '') . '">
              <i class="nav-icon fas fa-users"></i>
              <p>
                Users
                <i class="fas fa-angle-right right"></i>
                <span class="badge badge-danger right">2</span>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="../captain/captain.php" class="nav-link ' . ($page == "captain.php" ? 'active' : '') . '">
                  <i class="fas fa-angle-right nav-icon"></i>
                  <p>Barangay Captain</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="../staff/staff.php" class="nav-link ' . ($page == "staff.php" ? 'active' : '') . '">
                  <i class="fas fa-angle-right nav-icon"></i>
                  <p>Barangay Staff</p>
                </a>
              </li>
            </ul>
          </li>

          <li class="nav-header text-uppercase"><small>reporting</small></li>

          <li class="nav-item">
            <a href="../report/report.php" class="nav-link ' . ($page == "report.php" ? 'active' : '') . '">
              <i class="nav-icon fas fa-file-signature"></i>
              <p>
                Report
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="../logs/logs.php" class="nav-link ' . ($page == "logs.php" ? 'active' : '') . '">
              <i class="nav-icon fas fa-history"></i>
              <p>
                Logs
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="../backup/backup.php" class="nav-link ' . ($page == "backup.php" ? 'active' : '') . '">
              <i class="nav-icon fas fa-database"></i>
              <p>
                Backup
              </p>
            </a>
          </li>
        </ul> ';
} elseif (isset($_SESSION['role']) && $_SESSION['role'] === 'captain') {
  echo '
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
                with font-awesome or any other icon font library -->

          <li class="nav-header text-uppercase"><small>communication</small></li>

          <li class="nav-item">
            <a href="../announcement/announcement.php" class="nav-link ' . ($page == "announcement.php" ? 'active' : '') . '">
              <i class="nav-icon fas fa-bullhorn"></i>
              <p>
                Announcement
              </p>
            </a>
          </li>

          <li class="nav-header text-uppercase"><small>reporting</small></li>

          <li class="nav-item">
            <a href="../report/report.php" class="nav-link ' . ($page == "report.php" ? 'active' : '') . '">
              <i class="nav-icon fas fa-file-signature"></i>
              <p>
                Report
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="../logs/logs.php" class="nav-link ' . ($page == "logs.php" ? 'active' : '') . '">
              <i class="nav-icon fas fa-history"></i>
              <p>
                Logs
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="../backup/backup.php" class="nav-link ' . ($page == "backup.php" ? 'active' : '') . '">
              <i class="nav-icon fas fa-database"></i>
              <p>
                Backup
              </p>
            </a>
          </li>
        </ul> ';
} elseif (isset($_SESSION['role']) && $_SESSION['role'] === 'staff') {
  echo '
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
                with font-awesome or any other icon font library -->

          <li class="nav-item">
            <a href="../officials/officials.php" class="nav-link ' . ($page == "officials.php" ? 'active' : '') . '">
              <i class="nav-icon fas fa-user-friends"></i>
              <p>
                Officials
              </p>
            </a>
          </li>

          <li class="nav-item ' . (($page == "household.php" || $page == "resident.php") ? 'menu-open' : '') . '">
            <a href="#" class="nav-link ' . (($page == "household.php" || $page == "resident.php") ? 'active' : '') . '">
              <i class="nav-icon fas fa-scroll"></i>
              <p>
                Profiling
                <i class="fas fa-angle-right right"></i>
                <span class="badge badge-success right">2</span>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="../household/household.php" class="nav-link ' . ($page == "household.php" ? 'active' : '') . '">
                  <i class="fas fa-angle-right nav-icon"></i>
                  <p>Household</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="../resident/resident.php" class="nav-link ' . ($page == "resident.php" ? 'active' : '') . '">
                  <i class="fas fa-angle-right nav-icon"></i>
                  <p>Resident</p>
                </a>
              </li>
            </ul>
          </li>

          <li class="nav-header text-uppercase"><small>offenses</small></li>

          <li class="nav-item">
            <a href="../blotter/blotter.php" class="nav-link ' . ($page == "blotter.php" ? 'active' : '') . '">
              <i class="nav-icon fas fa-file-signature"></i>
              <p>
                Blotter
              </p>
            </a>
          </li>

          <li class="nav-header text-uppercase"><small>barangay issuance</small></li>

          <li class="nav-item ' . (($page == "clearance.php" || $page == "indigent.php" || $page == "lowincome.php") ? 'menu-open' : '') . '">
            <a href="#" class="nav-link ' . (($page == "clearance.php" || $page == "indigent.php" || $page == "lowincome.php") ? 'active' : '') . '">
              <i class="nav-icon fas fa-scroll"></i>
              <p>
                Issuance
                <i class="fas fa-angle-right right"></i>
                <span class="badge badge-primary right">3</span>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="../clearance/clearance.php" class="nav-link ' . ($page == "clearance.php" ? 'active' : '') . '">
                  <i class="fas fa-angle-right nav-icon"></i>
                  <p>Brgy Clearance</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="../indigent/indigent.php" class="nav-link ' . ($page == "indigent.php" ? 'active' : '') . '">
                  <i class="fas fa-angle-right nav-icon"></i>
                  <p>Cert of Indigent</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="../lowincome/lowincome.php" class="nav-link ' . ($page == "lowincome.php" ? 'active' : '') . '">
                  <i class="fas fa-angle-right nav-icon"></i>
                  <p>Cert of Low Income</p>
                </a>
              </li>
            </ul>
          </li>

          <li class="nav-header text-uppercase"><small>issuance credentials</small></li>

          <li class="nav-item ' . (($page == "govoffice.php" || $page == "purpose.php" || $page == "officer.php") ? 'menu-open' : '') . '">
            <a href="#" class="nav-link ' . (($page == "govoffice.php" || $page == "purpose.php" || $page == "officer.php") ? 'active' : '') . '">
              <i class="nav-icon fas fa-scroll"></i>
              <p>
                Credentials
                <i class="fas fa-angle-right right"></i>
                <span class="badge badge-info right">3</span>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="../officer/officer.php" class="nav-link ' . ($page == "officer.php" ? 'active' : '') . '">
                  <i class="fas fa-angle-right nav-icon"></i>
                  <p>Officer of the Day</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="../govoffice/govoffice.php" class="nav-link ' . ($page == "govoffice.php" ? 'active' : '') . '">
                  <i class="fas fa-angle-right nav-icon"></i>
                  <p>Government Offices</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="../purpose/purpose.php" class="nav-link ' . ($page == "purpose.php" ? 'active' : '') . '">
                  <i class="fas fa-angle-right nav-icon"></i>
                  <p>Issuance Purposes</p>
                </a>
              </li>
            </ul>
          </li>

          <li class="nav-header text-uppercase"><small>communication</small></li>

          <li class="nav-item">
            <a href="../announcement/announcement.php" class="nav-link ' . ($page == "announcement.php" ? 'active' : '') . '">
              <i class="nav-icon fas fa-bullhorn"></i>
              <p>
                Announcement
              </p>
            </a>
          </li>
        </ul> ';
} elseif (isset($_SESSION['resident']) && $_SESSION['resident'] === 1) {
  echo '
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
                with font-awesome or any other icon font library -->

          <li class="nav-header text-uppercase"><small>barangay issuance</small></li>

          <li class="nav-item ' . (($page == "clearance.php" || $page == "indigent.php" || $page == "lowincome.php") ? 'menu-open' : '') . '">
            <a href="#" class="nav-link ' . (($page == "clearance.php" || $page == "indigent.php" || $page == "lowincome.php") ? 'active' : '') . '">
              <i class="nav-icon fas fa-scroll"></i>
              <p>
                Issuance
                <i class="fas fa-angle-right right"></i>
                <span class="badge badge-primary right">3</span>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="../clearance/clearance.php" class="nav-link ' . ($page == "clearance.php" ? 'active' : '') . '">
                  <i class="fas fa-angle-right nav-icon"></i>
                  <p>Brgy Clearance</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="../indigent/indigent.php" class="nav-link ' . ($page == "indigent.php" ? 'active' : '') . '">
                  <i class="fas fa-angle-right nav-icon"></i>
                  <p>Cert of Indigent</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="../lowincome/lowincome.php" class="nav-link ' . ($page == "lowincome.php" ? 'active' : '') . '">
                  <i class="fas fa-angle-right nav-icon"></i>
                  <p>Cert of Low Income</p>
                </a>
              </li>
            </ul>
          </li>

          <li class="nav-header text-uppercase"><small>communication</small></li>

          <li class="nav-item">
            <a href="../announcement/announcement.php" class="nav-link ' . ($page == "announcement.php" ? 'active' : '') . '">
              <i class="nav-icon fas fa-bullhorn"></i>
              <p>
                Announcement
              </p>
            </a>
          </li>
        </ul> ';
}
echo '
    </nav>
    <!-- /.sidebar-menu -->
  </div>
  <!-- /.sidebar -->
</aside>
'
  ?>