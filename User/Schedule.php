<?php
if (!isset($_COOKIE['username']) && !isset($_COOKIE['password'])) {
  echo "<script>alert('Please log in to make appointment!')</script>";
  header("Location: ./Log-in.php");
} else {
}
?>
<!DOCTYPE html>
<html style="font-size: 16px;" lang="en">

<head>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta charset="utf-8">
  <meta name="keywords" content="">
  <meta name="description" content="">
  <title>Schedule</title>
  <link rel="stylesheet" href="../css/nicepage.css" media="screen">
  <link rel="stylesheet" href="../css/Schedule.css" media="screen">
  <script class="u-script" type="text/javascript" src="../js/jquery.js" defer=""></script>
  <script class="u-script" type="text/javascript" src="../js/nicepage.js" defer=""></script>

  <link id="u-theme-google-font" rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:100,100i,300,300i,400,400i,500,500i,700,700i,900,900i|Open+Sans:300,300i,400,400i,500,500i,600,600i,700,700i,800,800i">

  <script type="application/ld+json">
    {
      "@context": "http://schema.org",
      "@type": "Organization",
      "name": "OMS",
      "logo": "../images/logo.png"
    }
  </script>
  <meta name="theme-color" content="#93bfcb">
  <meta property="og:title" content="Schedule">
  <meta property="og:description" content="">
  <meta property="og:type" content="website">
  <meta data-intl-tel-input-cdn-path="intlTelInput/">
</head>

<body class="u-body u-xl-mode" data-lang="en">
  <header class="u-header" id="sec-b883" data-animation-name="" data-animation-duration="0" data-animation-delay="0" data-animation-direction="">
    <div class="u-clearfix u-sheet u-valign-middle-md u-valign-middle-sm u-valign-middle-xs u-sheet-1">
      <nav class="u-hidden-lg u-hidden-xl u-menu u-menu-one-level u-offcanvas u-menu-1">
        <div class="menu-collapse" style="font-size: 1.875rem; font-weight: 700; letter-spacing: 0px;">
          <a class="u-button-style u-custom-border u-custom-border-color u-custom-borders u-custom-left-right-menu-spacing u-custom-padding-bottom u-custom-text-active-color u-custom-text-color u-custom-text-hover-color u-custom-top-bottom-menu-spacing u-nav-link" href="#" style="font-size: calc(1em + 18px); padding: 9px 8px;">
            <svg class="u-svg-link" viewBox="0 0 24 24">
              <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#svg-2bcb"></use>
            </svg>
            <svg class="u-svg-content" version="1.1" id="svg-2bcb" viewBox="0 0 16 16" x="0px" y="0px" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns="http://www.w3.org/2000/svg">
              <g>
                <rect y="1" width="16" height="2"></rect>
                <rect y="7" width="16" height="2"></rect>
                <rect y="13" width="16" height="2"></rect>
              </g>
            </svg>
          </a>
        </div>
        <div class="u-custom-menu u-nav-container">
          <ul class="u-nav u-spacing-20 u-unstyled u-nav-1">
            <li class="u-nav-item"><a class="u-button-style u-nav-link u-text-active-palette-1-base u-text-grey-90 u-text-hover-palette-2-base" href="../index.php" style="padding: 10px;">Home</a>
            </li>
            <li class="u-nav-item"><a class="u-button-style u-nav-link u-text-active-palette-1-base u-text-grey-90 u-text-hover-palette-2-base" href="./Appointment.php" style="padding: 10px;">Appointment</a>
            </li>
            <li class="u-nav-item"><a class="u-button-style u-nav-link u-text-active-palette-1-base u-text-grey-90 u-text-hover-palette-2-base" href="../Schedule.php" style="padding: 10px;">Schedule</a>
            </li>
            <li class="u-nav-item"><a class="u-button-style u-nav-link u-text-active-palette-1-base u-text-grey-90 u-text-hover-palette-2-base" href="./Log-in.php" style="padding: 10px;">Log in</a>
            </li>
            <li class="u-nav-item"><a class="u-button-style u-nav-link u-text-active-palette-1-base u-text-grey-90 u-text-hover-palette-2-base" href="./Register.php" style="padding: 10px;">Register</a>
            </li>
          </ul>
        </div>
        <div class="u-custom-menu u-nav-container-collapse">
          <div class="u-black u-container-style u-inner-container-layout u-opacity u-opacity-95 u-sidenav">
            <div class="u-inner-container-layout u-sidenav-overflow">
              <div class="u-menu-close"></div>
              <ul class="u-align-center u-nav u-popupmenu-items u-spacing-23 u-unstyled u-nav-2">
                <li class="u-nav-item"><a class="u-button-style u-nav-link" href="../index.php" style="padding-top: 22px; padding-bottom: 22px;">Home</a>
                </li>
                <li class="u-nav-item"><a class="u-button-style u-nav-link" href="./Appointment.php" style="padding-top: 22px; padding-bottom: 22px;">Appointment</a>
                </li>
                <li class="u-nav-item"><a class="u-button-style u-nav-link" href="./Schedule.php" style="padding-top: 22px; padding-bottom: 22px;">Schedule</a>
                </li>
                <li class="u-nav-item"><a class="u-button-style u-nav-link" href="./Log-in.php" style="padding-top: 22px; padding-bottom: 22px;">Log in</a>
                </li>
                <li class="u-nav-item"><a class="u-button-style u-nav-link" href="./Register.php" style="padding-top: 22px; padding-bottom: 22px;">Register</a>
                </li>
              </ul>
            </div>
          </div>
          <div class="u-black u-menu-overlay u-opacity u-opacity-70"></div>
        </div>
      </nav>
      <a href="https://nicepage.com/c/testimonials-html-templates" class="u-image u-logo u-image-1" data-image-width="618" data-image-height="58">
        <img src="../images/logo.png" class="u-logo-image u-logo-image-1" alt="online medical system logo">
      </a>
      <nav class="u-hidden-md u-hidden-sm u-hidden-xs u-menu u-menu-one-level u-offcanvas u-menu-2">
        <div class="menu-collapse" style="font-size: 2.25rem; letter-spacing: 0px; font-weight: 700;">
          <a class="u-button-style u-custom-border u-custom-border-color u-custom-borders u-custom-left-right-menu-spacing u-custom-text-active-color u-custom-text-color u-custom-text-hover-color u-custom-top-bottom-menu-spacing u-nav-link" href="#">
            <svg class="u-svg-link" viewBox="0 0 24 24">
              <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#svg-1bf5"></use>
            </svg>
            <svg class="u-svg-content" version="1.1" id="svg-1bf5" viewBox="0 0 16 16" x="0px" y="0px" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns="http://www.w3.org/2000/svg">
              <g>
                <rect y="1" width="16" height="2"></rect>
                <rect y="7" width="16" height="2"></rect>
                <rect y="13" width="16" height="2"></rect>
              </g>
            </svg>
          </a>
        </div>
        <div class="u-nav-container">
          <ul class="u-nav u-spacing-10 u-unstyled u-nav-3">
            <li class="u-nav-item"><a class="u-border-no-bottom u-border-no-left u-border-no-right u-border-no-top u-button-style u-nav-link u-text-active-palette-1-base u-text-grey-90 u-text-hover-palette-2-base" href="../index.php" style="padding: 26px 34px;">Home</a>
            </li>
            <li class="u-nav-item"><a class="u-border-no-bottom u-border-no-left u-border-no-right u-border-no-top u-button-style u-nav-link u-text-active-palette-1-base u-text-grey-90 u-text-hover-palette-2-base" href="./Appointment.php" style="padding: 26px 34px;">Appointment</a>
            </li>
            <li class="u-nav-item"><a class="u-border-no-bottom u-border-no-left u-border-no-right u-border-no-top u-button-style u-nav-link u-text-active-palette-1-base u-text-grey-90 u-text-hover-palette-2-base" href="./Schedule.php" style="padding: 26px 34px;">Schedule</a>
            </li>
          </ul>
        </div>
        <div class="u-nav-container-collapse">
          <div class="u-black u-container-style u-inner-container-layout u-opacity u-opacity-95 u-sidenav">
            <div class="u-inner-container-layout u-sidenav-overflow">
              <div class="u-menu-close"></div>
              <ul class="u-align-center u-nav u-popupmenu-items u-unstyled u-nav-4">
                <li class="u-nav-item"><a class="u-button-style u-nav-link" href="../index.php" style="padding: 26px 34px;">Home</a>
                </li>
                <li class="u-nav-item"><a class="u-button-style u-nav-link" href="./Appointment.php" style="padding: 26px 34px;">Appointment</a>
                </li>
                <li class="u-nav-item"><a class="u-button-style u-nav-link" href="./Schedule.php" style="padding: 26px 34px;">Schedule</a>
                </li>
                <li class="u-nav-item"><a class="u-button-style u-nav-link" href="./Log-in.php" style="padding: 26px 34px;">Log in</a>
                </li>
                <li class="u-nav-item"><a class="u-button-style u-nav-link" href="./Register.php" style="padding: 26px 34px;">Register</a>
                </li>
              </ul>
            </div>
          </div>
          <div class="u-black u-menu-overlay u-opacity u-opacity-70"></div>
        </div>
      </nav><span class="u-file-icon u-hidden-md u-hidden-sm u-hidden-xs u-hover-feature u-icon u-text-palette-1-dark-2 u-icon-1" data-href="./Userinfo.php" title="UserInfo"><img src="../images/dark_user.png" alt="view user information"></span>
    </div>
  </header>
  <section class="u-clearfix u-section-1" id="sec-edf4">
    <div class="u-clearfix u-sheet u-valign-top-sm u-sheet-1">
      <p id="scheduleDT" class="u-align-center u-text u-text-1">Mar 26 - Apr 1, 2023</p><span class="u-file-icon u-icon u-icon-1"><img src="../images/left.png" alt="previous week icon"></span><span class="u-file-icon u-icon u-icon-2"><img src="../images/right.png" alt="next week icon"></span>
      <div class="u-expanded-width-xs u-widget u-widget-1">[np_widget]{"type":"calendar","title":""}[/np_widget]</div>
    </div>
  </section>

  <footer class="u-align-center u-clearfix u-footer u-grey-80 u-footer" id="sec-5b62">
    <div class="u-clearfix u-sheet u-valign-middle u-sheet-1">
      <p class="u-small-text u-text u-text-variant u-text-1">2023 @Yuan-Hsuan Lin </p>
    </div>
  </footer>
  <!-- <section class="u-backlink u-clearfix u-grey-80">
    <a class="u-link" href="https://nicepage.com/website-templates" target="_blank">
      <span>Website Templates</span>
    </a>
    <p class="u-text">
      <span>created with</span>
    </p>
    <a class="u-link" href="" target="_blank">
      <span>Website Builder Software</span>
    </a>.
  </section> -->

</body>

</html>