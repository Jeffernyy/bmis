<!DOCTYPE html>
<html lang="en">

<?php include '../include/session.inc.php' ?>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=7">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="format-detection" content="telephone=no">
  <meta name="theme-color" content="#75dab4">

  <title>Brgy New Pandan | Barangay Management Information System</title>

  <meta name="author" content="Rakkzxc">
  <meta name="description" content="barangay new pandan management information system">
  <meta name="keywords" content="barangay new pandan management information system">

  <!-- social media meta -->
  <meta property="og:description" content="Brgy New Pandan | Barangay Management Information System">
  <meta property="og:image" content="http://www.brgynewpandan.com/assets/img/brgy-logo.png">
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
  <meta name="twitter:image" content="http://www.brgynewpandan.com/assets/img/brgy-logo.png">

  <!-- favicon files -->
  <link href="../assets/ico/apple-touch-icon-144-precomposed.png" rel="apple-touch-icon" sizes="144x144">
  <link href="../assets/ico/apple-touch-icon-114-precomposed.png" rel="apple-touch-icon" sizes="114x114">
  <link href="../assets/ico/apple-touch-icon-72-precomposed.png" rel="apple-touch-icon" sizes="72x72">
  <link href="../assets/ico/apple-touch-icon-57-precomposed.png" rel="apple-touch-icon">
  <link href="../assets/ico/favicon.png" rel="shortcut icon">

  <!-- stylesheet files -->
  <link rel="stylesheet" href="../plugins/fontawesome/fontawesome.min.css">
  <link rel="stylesheet" href="../plugins/odometer/odometer.min.css">
  <link rel="stylesheet" href="../plugins/swiper/swiper.min.css">
  <link rel="stylesheet" href="../plugins/bootstrap-themezinho/bootstrap.min.css">
  <link rel="stylesheet" href="../app/css/hmbrgr.css">
  <link rel="stylesheet" href="../app/css/theme.css">

  <!-- script files -->
  <script src="../plugins/jquery-themezinho/jquery.min.js" defer></script>
  <script src="../plugins/bootstrap-themezinho/bootstrap.min.js" defer></script>
  <script src="../plugins/swiper/swiper.min.js" defer></script>
  <script src="../plugins/wow/wow.min.js" defer></script>
  <script src="../plugins/splitting/splitting.min.js" defer></script>
  <script src="../plugins/odometer/odometer.min.js" defer></script>
  <script src="../app/js/theme.js" defer></script>
</head>

<body>
  <div class="preloader">
    <div class="layer"></div>
    <!-- end layer -->
    <div class="inner">
      <figure> <img src="../assets/img/preloader.gif" alt="Preloader"> </figure>
      <span>Brgy New Pandan Site Loading...</span>
    </div>
    <!-- end inner -->
  </div>
  <!-- end preloader -->
  <div class="page-transition">
    <div class="layer"></div>
    <!-- end layer -->
  </div>
  <!-- end page-transition -->
  <nav class="site-navigation">
    <div class="layer"></div>
    <!-- end layer -->
    <div class="inner">
      <ul data-splitting>
        <li><a href="index.php">HOME</a><small>Welcome page</small></li>
        <li><a href="issuance.php">ISSUANCE</a> <small>Our all issuance</small> </li>
        <li><a href="about.php">ABOUT</a> <small>All about us</small> </li>
        <li><a href="announcement.php">ACTIVITY</a> <small>Recent announcement</small> </li>
        <li><a href="contact.php">CONTACT</a> <small>Say hello to us</small> </li>
      </ul>
    </div>
    <!-- end inner -->
  </nav>
  <!-- end site-navigation -->
  <div class="social-media">
    <div class="layer"> </div>
    <!-- end layer -->
    <div class="inner">
      <h5>Follow us on social media</h5>
      <ul>
        <li><a href="#"><img src="../assets/icons/icons8-facebook.svg" alt="Facebook" width="75px" height="75px">
          </a></li>
        <li><a href="#"><img src="../assets/icons/icons8-twitter.svg" alt="Twitter" width="75px" height="75px">
          </a></li>
        <li><a href="#"><img src="../assets/icons/icons8-instagram.svg" alt="Instagram" width="75px" height="75px">
          </a></li>
      </ul>
    </div>
  </div>
  <!-- end social-media -->
  <main>
    <aside class="left-side">
      <div class="logo"> <a href="../index.php"><img src="../assets/img/brgy-logo.png" alt="Logo"></a> </div>
      <!-- end logo -->
      <div class="hamburger" id="hamburger">
        <div class="hamburger__line hamburger__line--01">
          <div class="hamburger__line-in hamburger__line-in--01"></div>
        </div>
        <div class="hamburger__line hamburger__line--02">
          <div class="hamburger__line-in hamburger__line-in--02"></div>
        </div>
        <div class="hamburger__line hamburger__line--03">
          <div class="hamburger__line-in hamburger__line-in--03"></div>
        </div>
        <div class="hamburger__line hamburger__line--cross01">
          <div class="hamburger__line-in hamburger__line-in--cross01"></div>
        </div>
        <div class="hamburger__line hamburger__line--cross02">
          <div class="hamburger__line-in hamburger__line-in--cross02"></div>
        </div>
      </div>
      <!-- end hamburger -->
      <div class="follow-us"> FOLLOW US </div>
      <!-- end follow-us -->
      <div class="equalizer"> <span></span> <span></span> <span></span> <span></span> </div>
      <!-- end equalizer -->
    </aside>
    <!-- end left-side -->
    <div class="all-cases-link">
      <?php if (isset($_SESSION['role'])) {
        if (isset($_SESSION['role']) && $_SESSION['role'] === 'administrator') { ?>

          <a href="../index.php" rel="noopener noreferrer" style="text-decoration: none"><span>HOME</span></a>
          <a href="../issuance.php" rel="noopener noreferrer" style="text-decoration: none"><span>ISSUANCE</span></a>
          <a href="../about.php" rel="noopener noreferrer" style="text-decoration: none"><span>ABOUT</span></a>
          <a href="../activity.php" rel="noopener noreferrer" style="text-decoration: none"><span>ACTIVITY</span></a>
          <a href="../pages/dashboard/dashboard.php" rel="noopener noreferrer"
            style="text-decoration: none"><span>DASHBOARD</span></a>

        <?php } elseif (isset($_SESSION['role']) && $_SESSION['role'] === 'staff') { ?>

          <a href="../index.php" rel="noopener noreferrer" style="text-decoration: none"><span>HOME</span></a>
          <a href="../issuance.php" rel="noopener noreferrer" style="text-decoration: none"><span>ISSUANCE</span></a>
          <a href="../about.php" rel="noopener noreferrer" style="text-decoration: none"><span>ABOUT</span></a>
          <a href="../activity.php" rel="noopener noreferrer" style="text-decoration: none"><span>ACTIVITY</span></a>
          <a href="../pages/officials/officials.php" rel="noopener noreferrer"
            style="text-decoration: none"><span>DASHBOARD</span></a>

        <?php } elseif (isset($_SESSION['resident']) && $_SESSION['resident'] === 1) { ?>

          <a href="../index.php" rel="noopener noreferrer" style="text-decoration: none"><span>HOME</span></a>
          <a href="../issuance.php" rel="noopener noreferrer" style="text-decoration: none"><span>ISSUANCE</span></a>
          <a href="../about.php" rel="noopener noreferrer" style="text-decoration: none"><span>ABOUT</span></a>
          <a href="../activity.php" rel="noopener noreferrer" style="text-decoration: none"><span>ACTIVITY</span></a>
          <a href="../pages/dashboard/dashboard.php" rel="noopener noreferrer"
            style="text-decoration: none"><span>DASHBOARD</span></a>

        <?php } elseif (isset($_SESSION['role']) && $_SESSION['role'] === 'captain') { ?>

          <a href="../index.php" rel="noopener noreferrer" style="text-decoration: none"><span>HOME</span></a>
          <a href="../issuance.php" rel="noopener noreferrer" style="text-decoration: none"><span>ISSUANCE</span></a>
          <a href="../about.php" rel="noopener noreferrer" style="text-decoration: none"><span>ABOUT</span></a>
          <a href="../activity.php" rel="noopener noreferrer" style="text-decoration: none"><span>ACTIVITY</span></a>
          <a href="../pages/announcement/announcement.php" rel="noopener noreferrer"
            style="text-decoration: none"><span>DASHBOARD</span></a>

        <?php }
      } else { ?>
        <a href="../index.php" rel="noopener noreferrer" style="text-decoration: none"><span>HOME</span></a>
        <a href="../issuance.php" rel="noopener noreferrer" style="text-decoration: none"><span>ISSUANCE</span></a>
        <a href="../about.php" rel="noopener noreferrer" style="text-decoration: none"><span>ABOUT</span></a>
        <a href="../activity.php" rel="noopener noreferrer" style="text-decoration: none"><span>ACTIVITY</span></a>
        <a href="../login.php" rel="noopener noreferrer" style="text-decoration: none"><span>LOGIN</span></a>
      <?php } ?>
    </div>
    <!-- end all-cases-link -->
    <header class="slider">
      <div class="swiper-container gallery-top">
        <div class="swiper-wrapper">
          <div class="swiper-slide" data-background="../assets/img/banner-slide01.jpg"></div>
          <div class="swiper-slide" data-background="../assets/img/banner-slide02.jpg"></div>
          <div class="swiper-slide" data-background="../assets/img/banner-slide03.jpg"></div>
          <div class="swiper-slide" data-background="../assets/img/banner-slide04.jpg"></div>
          <div class="swiper-slide" data-background="../assets/img/banner-slide05.jpg"></div>
        </div>
        <!-- end swiper-wrapper -->
        <div class="slide-progress"> <span>01</span>
          <div class="swiper-pagination"></div>
          <span>05</span>
        </div>
        <!-- end slide-progress -->
        <div class="swiper-button-prev">PREV</div>
        <!-- end button-prev -->
        <div class="swiper-button-next">NEXT</div>
        <!-- end buttin-next -->
      </div>
      <!-- end gallery-top -->
      <div class="swiper-container gallery-thumbs">
        <div class="swiper-wrapper">
          <div class="swiper-slide"><span>HOUSEHOLD</span> <a href="#">HOUSEHOLD PROFILING</a></div>
          <div class="swiper-slide"><span>RESIDENT</span> <a href="#">RESIDENT PROFILING</a></div>
          <div class="swiper-slide"><span>BLOTTER</span> <a href="#">BLOTTER CASE</a></div>
          <div class="swiper-slide"><span>ISSUANCE</span> <a href="#">ISSUANCE REQUESTS</a></div>
          <div class="swiper-slide"><span>ACTIVITY</span> <a href="#">ACTIVITY ANNOUNCEMENT</a></div>
        </div>
        <!-- end swiper-wrapper -->
      </div>
      <!-- end gallery-thumbs -->
    </header>
    <!-- end slider -->
    <section class="intro">
      <div class="container">
        <div class="row">
          <div class="col-lg-5 wow" data-splitting>
            <h3 class="section-title">Lorem ipsum dolor sit amet.</h3>
            <a href="#">newpandan@rakkzxc.com</a>
          </div>
          <!-- end col-5 -->
          <div class="col-lg-7 wow" data-splitting>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Quas dolore similique optio beatae perferendis
              veritatis iure ipsam qui ipsa. Quo dolorum alias modi iusto rem?</p>
            <h6>Barangay New Pandan</h6>
            <small>Northlink Technological College</small>
            <b>15</b>
            <h4>YEARS OF<br>
              BLE EXPERIENCE</h4>
          </div>
          <!-- end col-7 -->
        </div>
        <!-- end row -->
      </div>
      <!-- end container -->
    </section>
    <!-- end intro -->
    <section class="intro-image">
      <div class="container">
        <div class="row">
          <div class="col-12">
            <div class="office-slider">
              <div class="swiper-wrapper">
                <div class="swiper-slide">
                  <figure class="reveal-effect masker wow"> <img src="../assets/img/office01.jpg" alt="Office">
                    <figcaption>
                      <h6>BARANGAY HALL OFFICE</h6>
                    </figcaption>
                  </figure>
                </div>
                <!-- end swiper-slide -->
                <div class="swiper-slide">
                  <figure> <img src="../assets/img/office02.jpg" alt="Office">
                    <figcaption>
                      <h6>BARANGAY HALL OFFICE</h6>
                    </figcaption>
                  </figure>
                </div>
                <!-- end swiper-slide -->
                <div class="swiper-slide">
                  <figure> <img src="../assets/img/office03.jpg" alt="Office">
                    <figcaption>
                      <h6>BARANGAY HALL OFFICE</h6>
                    </figcaption>
                  </figure>
                </div>
                <!-- end swiper-slide -->
              </div>
              <!-- end swiper-wrapper -->
              <div class="swiper-pagination"></div>
              <!-- end swiper-pagination -->
            </div>
            <!-- end office-slider -->
          </div>
          <!-- end col-12 -->
        </div>
        <!-- end row -->
      </div>
      <!-- end container -->
    </section>
    <!-- end intro-image -->
    <section class="icon-content-block mb-5">
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-12 wow" data-splitting>
            <h3 class="section-title">THE SERVICES<br>
              WE ARE ABLE TO DO</h3>
          </div>
          <!-- end col-12 -->
          <div class="col-lg-3 col-md-4 wow" data-splitting>
            <div class="content-block">
              <figure> <img src="../assets/icons/icons01.png" alt="Icon"> </figure>
              <h6>PROFILING</h6>
              <ul>
                <li>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Harum autem saepe necessitatibus facilis
                  natus! Quo, magnam.</li>
              </ul>
            </div>
            <!-- end content-block -->
          </div>
          <!-- end col-3 -->
          <div class="col-lg-3 col-md-4 wow" data-splitting>
            <div class="content-block selected">
              <figure> <img src="../assets/icons/icons02.png" alt="Icon"> </figure>
              <h6>BLOTTER</h6>
              <ul>
                <li>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Molestias accusantium explicabo voluptate
                  iusto odio sint! Sed, dolorem atque.</li>
              </ul>
            </div>
            <!-- end content-block -->
          </div>
          <!-- end col-3 -->
          <div class="col-lg-3 col-md-4 wow" data-splitting>
            <div class="content-block mb-5">
              <figure> <img src="../assets/icons/icons03.png" alt="Icon"> </figure>
              <h6>ISSUANCE</h6>
              <ul>
                <li>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Qui, fugit dolorem dicta labore deleniti
                  soluta blanditiis repudiandae iure.</li>
              </ul>
            </div>
            <!-- end content-block -->
          </div>
          <!-- end col-3 -->
        </div>
        <!-- end row -->
      </div>
      <!-- end container -->
    </section>
    <!-- end icon-content-block -->
    <section class="clients mt-5">
      <div class="container">
        <div class="row">
          <div class="col-lg-5 wow" data-splitting>
            <h3 class="section-title text-uppercase">Lorem ipsum dolor sit amet consectetur.</h3>
          </div>
          <!-- end col-5 -->
          <div class="col-lg-7">
            <ul>
              <li class="reveal-effect masker wow"> <img src="../assets/img/envoy.png" alt="Envoy"> </li>
              <li class="reveal-effect masker wow"> <img src="../assets/img/envoy.png" alt="Envoy"> </li>
              <li class="reveal-effect masker wow"> <img src="../assets/img/envoy.png" alt="Envoy"> </li>
              <li class="reveal-effect masker wow"> <img src="../assets/img/envoy.png" alt="Envoy"> </li>
              <li class="reveal-effect masker wow"> <img src="../assets/img/envoy.png" alt="Envoy"> </li>
              <li class="reveal-effect masker wow"> <img src="../assets/img/envoy.png" alt="Envoy"> </li>
            </ul>
          </div>
          <!-- end col-7 -->
        </div>
        <!-- end row -->
      </div>
      <!-- end container -->
    </section>
    <!-- end clients -->
  </main>
  <!-- end main -->
  <footer class="footer">
    <div class="container">
      <div class="row">
        <div class="col-12">
          <h6>Lorem ipsum dolor sit amet consectetur adipisicing.</h6>
          <h2>Lorem ipsum dolor sit amet consectetur.</h2>
          <a href="#" class="link">Get in touch</a>
        </div>
        <!-- end col-12 -->
        <div class="col-12">
          <div class="footer-bar"> <span class="copyright">© 2024 Barangay New Pandan | All Rights Reserved</span> <span
              class="creation">Site created with love by <a href="#">Rakkzxc</a></span> </div>
          <!-- end footer-bar -->
        </div>
        <!-- end col-12 -->
      </div>
      <!-- end row -->
    </div>
    <!-- end container -->
  </footer>
  <!-- end footer -->
</body>

</html>