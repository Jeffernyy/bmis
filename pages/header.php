<?php include "../../include/profile.inc.php" ?>
<nav class="main-header navbar navbar-expand navbar-dark elevation-2" style="border: none !important">
  <ul class="navbar-nav">
    <li class="nav-item">
      <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
    </li>
    <li class="nav-item d-none d-sm-inline-block">
      <a href="../../index.php" class="nav-link">Home</a>
    </li>
  </ul>

  <ul class="navbar-nav ml-auto">
    <!-- messages dropdown menu -->
    <li class="nav-item dropdown">
      <a class="nav-link" data-toggle="dropdown" role="button">
        <i class="far fa-comments mr-1"></i>
        <span class="badge badge-danger navbar-badge">3</span>
      </a>
      <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right"
        style="margin: 10px 10px 0 0;   box-shadow: 0 40px 55px rgba(0,0,0,0.30), 0 0px 12px rgba(0,0,0,0.22);">
        <a class="dropdown-item" role="button">
          <div class="media">
            <img src="../../assets/icons/icons01.png" alt="User Avatar" class="img-size-50 mr-3 img-circle">
            <div class="media-body">
              <h3 class="dropdown-item-title">
                Hello
                <span class="float-right text-sm text-danger"><i class="fas fa-star"></i></span>
              </h3>
              <p class="text-sm">Lorem ipsum dolor sit amet.</p>
              <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
            </div>
          </div>
        </a>
        <div class="dropdown-divider"></div>
        <a class="dropdown-item" role="button">
          <div class="media">
            <img src="../../assets/icons/icons02.png" alt="User Avatar" class="img-size-50 img-circle mr-3">
            <div class="media-body">
              <h3 class="dropdown-item-title">
                World
                <span class="float-right text-sm text-muted"><i class="fas fa-star"></i></span>
              </h3>
              <p class="text-sm">Lorem ipsum dolor sit amet.</p>
              <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
            </div>
          </div>
        </a>
        <div class="dropdown-divider"></div>
        <a class="dropdown-item" role="button">
          <div class="media">
            <img src="../../assets/icons/icons03.png" alt="User Avatar" class="img-size-50 img-circle mr-3">
            <div class="media-body">
              <h3 class="dropdown-item-title">
                Heheh
                <span class="float-right text-sm text-warning"><i class="fas fa-star"></i></span>
              </h3>
              <p class="text-sm">Lorem ipsum dolor sit amet.</p>
              <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
            </div>
          </div>
        </a>
        <div class="dropdown-divider"></div>
        <a class="dropdown-item dropdown-footer" role="button">See All Messages</a>
      </div>
    </li>

    <!-- notifications dropdown menu -->
    <li class="nav-item dropdown">
      <a class="nav-link" data-toggle="dropdown" role="button">
        <i class="far fa-bell mr-2"></i>
        <span class="badge badge-danger navbar-badge">15</span>
      </a>
      <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right"
        style="margin: 10px 10px 0 0;   box-shadow: 0 40px 55px rgba(0,0,0,0.30), 0 0px 12px rgba(0,0,0,0.22);">
        <span class="d-block text-center text-light py-3">Notifications</span>
        <div class="dropdown-divider"></div>
        <a class="dropdown-item" role="button">
          <i class="fas fa-bullhorn" style="margin: 0 10px 0 0;"></i> 4 announcements
          <span class="float-right text-muted text-sm">3 mins ago</span>
        </a>
        <div class="dropdown-divider"></div>
        <a class="dropdown-item" role="button">
          <i class="fas fa-scroll mr-2"></i> 8 certificate requests
          <span class="float-right text-muted text-sm">1 hour ago</span>
        </a>
        <div class="dropdown-divider"></div>
        <a class="dropdown-item" role="button">
          <i class="fas fa-file-signature" style="margin: 0 10px 0 0;"></i> 3 blotter messages
          <span class="float-right text-muted text-sm">2 days ago</span>
        </a>
        <div class="dropdown-divider"></div>
        <a class="dropdown-item dropdown-footer" role="button">See All Notifications</a>
      </div>
    </li>

    <!-- full screen -->
    <li class="nav-item">
      <a class="nav-link" data-widget="fullscreen" role="button">
        <i class="fas fa-expand-arrows-alt"></i>
      </a>
    </li>

    <!-- user dropdown menu -->
    <li class="nav-item dropdown">
      <a class="nav-link" data-toggle="dropdown" role="button">
        <i class="fas fa-user-cog"></i>
      </a>
      <div class="dropdown-menu dropdown-menu-xl dropdown-menu-right"
        style="margin: 10px 10px 0 0; box-shadow: 0 40px 55px rgba(0,0,0,0.30), 0 0px 12px rgba(0,0,0,0.22);">
        <div class="col-md-12 pt-2 px-2">
          <div class="card card-widget widget-user shadow-lg m-0">
            <div class="widget-user-header text-white"
              style="background: url(../../assets/avatar/background.jpeg) center center/cover">
            </div>
            <div class="widget-user-image img-circle" style="background: #000000">
              <img class="img-circle" <?php echo $profile ?> alt="Profile" style="width: 100px; height: 100px;">
            </div>
            <div class="card-footer p-0">
              <div class="row">
                <div class="col-sm-12">
                  <div class="description-block text-left m-0">
                    <span class="d-block text-center" style="margin: 55px 0 20px 0">You’ve logged in as <br>
                      <?php echo ucwords(strtolower(htmlspecialchars($_SESSION['fname']))) . " " . ($_SESSION['mname'] === 'n/a' ? '' : ucwords(strtolower(htmlspecialchars($_SESSION['mname'])))) . " " . ucwords(strtolower(htmlspecialchars($_SESSION['lname']))) ?>
                    </span>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item py-3" data-toggle="modal" data-target="#changePwModal" role="button">
                      <i class="fas fa-unlock-alt" style="margin: 0 9px 0 0;"></i> Change Password
                    </a>
                    <div class="dropdown-divider"></div>
                    <a href="../../logout.php" class="dropdown-item py-3">
                      <i class="fas fa-sign-out-alt" style="margin: 0 7.5px 0 0;"></i> Logout
                    </a>
                    <div class="dropdown-divider"></div>
                    <a target="_blank" href="https://www.facebook.com/jeffern.malinao.90" class="dropdown-item py-3">
                      <i class="fas fa-hand-holding-heart" style="margin: 0 6.275px 0 0;"></i> Follow me on social media
                    </a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </li>
  </ul>
</nav>

<?php include '../../include/changepw.inc.php' ?>

<div class="modal fade" id="changePwModal">
  <form method="post" enctype="multipart/form-data">
    <div class="modal-dialog modal-md">
      <div class="modal-content">
        <div class="modal-header align-items-center">
          <h4 class="modal-title">Change Password</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true"><i class="fas fa-times-circle"></i></span>
          </button>
        </div>
        <div class="modal-body">
          <?php
          if ($_SESSION['role'] === "administrator") { ?>
            <div class="form-group">
              <label class="control-label">Username</label>
              <input type="text" name="txt_change_uname" class="form-control"
                placeholder="Please enter your current username" autofocus>
            </div>
            <div class="form-group">
              <label class="control-label">New Password</label>
              <input type="password" name="txt_change_pword" class="form-control"
                placeholder="Please enter your new password if needed">
            </div>
            <div class="form-group">
              <label class="control-label">Confirm Password</label>
              <input type="password" name="txt_confirm_pword" class="form-control"
                placeholder="Please confirm your password">
            </div>
            <?php
          } elseif ($_SESSION['role'] === "captain") { ?>
            <div class="form-group">
              <label class="control-label">Username</label>
              <input type="text" name="txt_change_uname" class="form-control"
                placeholder="Please enter your current username" autofocus>
            </div>
            <div class="form-group">
              <label class="control-label">New Password</label>
              <input type="password" name="txt_change_pword" class="form-control"
                placeholder="Please enter your new password if needed">
            </div>
            <div class="form-group">
              <label class="control-label">Confirm Password</label>
              <input type="password" name="txt_confirm_pword" class="form-control"
                placeholder="Please confirm your password">
            </div>
            <?php
          } elseif ($_SESSION['role'] === "staff") { ?>
            <div class="form-group">
              <label class="control-label">Username</label>
              <input type="text" name="txt_change_uname" class="form-control"
                placeholder="Please enter your current username" autofocus>
            </div>
            <div class="form-group">
              <label class="control-label">New Password</label>
              <input type="password" name="txt_change_pword" class="form-control"
                placeholder="Please enter your new password if needed">
            </div>
            <div class="form-group">
              <label class="control-label">Confirm Password</label>
              <input type="password" name="txt_confirm_pword" class="form-control"
                placeholder="Please confirm your password">
            </div>
            <?php
          } elseif ($_SESSION['role'] === "resident") { ?>
            <div class="form-group">
              <label class="control-label">Secret Key</label>
              <input type="text" name="txt_change_pword_skey" class="form-control"
                placeholder="Please enter your valid secret key" autofocus>
            </div>
            <div class="form-group">
              <label class="control-label">New Password</label>
              <input type="password" name="txt_change_pword" class="form-control"
                placeholder="Please enter your new password if needed">
            </div>
            <div class="form-group">
              <label class="control-label">Confirm Password</label>
              <input type="password" name="txt_confirm_pword" class="form-control"
                placeholder="Please confirm your password">
            </div>
            <?php
          } ?>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary" name="btn_change_users_pass">
            Save changes</button>
        </div>
      </div>
    </div>
  </form>
</div>