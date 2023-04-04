<?php
if (!isset($_COOKIE['username']) && !isset($_COOKIE['password'])) {
  $html = new DOMDocument();
  $html->loadHTMLFile('index.php');
  $html->getElementById('headSpan')->nodeValue = "<img src='./images/login.png' alt='Log in'>";
  $html->saveHTMLFile("index.php");
}
?>
<!DOCTYPE html>
<html style="font-size: 16px;" lang="en">

<head>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta charset="utf-8">
  <meta name="keywords" content="When it absolutely, positively has to be readability in your designs, Meet our Doctors​">
  <meta name="description" content="">
  <title>Home</title>
  <link rel="stylesheet" href="./css/nicepage.css" media="screen">
  <link rel="stylesheet" href="./Home.css" media="screen">
  <script class="u-script" type="text/javascript" src="./js/jquery.js" defer=""></script>
  <script class="u-script" type="text/javascript" src="./js/nicepage.js" defer=""></script>
  <meta name="generator" content="Nicepage 5.6.16, nicepage.com">
  <link id="u-theme-google-font" rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:100,100i,300,300i,400,400i,500,500i,700,700i,900,900i|Open+Sans:300,300i,400,400i,500,500i,600,600i,700,700i,800,800i">

  <script type="application/ld+json">
    {
      "@context": "http://schema.org",
      "@type": "Organization",
      "name": "OMS_v1",
      "logo": "images/Screenshot2023-03-19at12.17.37PM.png"
    }
  </script>
  <meta name="theme-color" content="#93bfcb">
  <meta property="og:title" content="Home">
  <meta property="og:description" content="">
  <meta property="og:type" content="website">
  <meta data-intl-tel-input-cdn-path="intlTelInput/">
  <script>
    function getCookie(name) {
      var dc = document.cookie;
      var prefix = name + "=";
      var begin = dc.indexOf("; " + prefix);
      if (begin == -1) {
        begin = dc.indexOf(prefix);
        if (begin != 0) return null;
      } else {
        begin += 2;
        var end = document.cookie.indexOf(";", begin);
        if (end == -1) {
          end = dc.length;
        }
      }
      // because unescape has been deprecated, replaced with decodeURI
      //return unescape(dc.substring(begin + prefix.length, end));
      return decodeURI(dc.substring(begin + prefix.length, end));
    }

    function doSomething() {
      var userName = getCookie("username");
      var password = getCookie("password");

      if (userName == null || password == null) {
        // cookie doesn't exist
        document.getElementById('headImg').src = './images/dark_user.png';
        document.getElementById('headImg').alt = 'View user information';
      } else {
        // cookie exists
      }
    }
  </script>
</head>

<body data-home-page="index.php" data-home-page-title="Home" class="u-body u-xl-mode" data-lang="en">
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
            <li class="u-nav-item"><a class="u-button-style u-nav-link u-text-active-palette-1-base u-text-grey-90 u-text-hover-palette-2-base" href="index.php" style="padding: 10px;">Home</a>
            </li>
            <li class="u-nav-item"><a class="u-button-style u-nav-link u-text-active-palette-1-base u-text-grey-90 u-text-hover-palette-2-base" href="./User/Appointment.php" style="padding: 10px;">Appointment</a>
            </li>
            <li class="u-nav-item"><a class="u-button-style u-nav-link u-text-active-palette-1-base u-text-grey-90 u-text-hover-palette-2-base" href="./User/Schedule.php" style="padding: 10px;">Schedule</a>
            </li>
            <li class="u-nav-item"><a class="u-button-style u-nav-link u-text-active-palette-1-base u-text-grey-90 u-text-hover-palette-2-base" href="./User/Log-in.php" style="padding: 10px;">Log in</a>
            </li>
            <li class="u-nav-item"><a class="u-button-style u-nav-link u-text-active-palette-1-base u-text-grey-90 u-text-hover-palette-2-base" href="./User/Register.php" style="padding: 10px;">Register</a>
            </li>
          </ul>
        </div>
        <div class="u-custom-menu u-nav-container-collapse">
          <div class="u-black u-container-style u-inner-container-layout u-opacity u-opacity-95 u-sidenav">
            <div class="u-inner-container-layout u-sidenav-overflow">
              <div class="u-menu-close"></div>
              <ul class="u-align-center u-nav u-popupmenu-items u-spacing-23 u-unstyled u-nav-2">
                <li class="u-nav-item"><a class="u-button-style u-nav-link" href="./index.php" style="padding-top: 22px; padding-bottom: 22px;">Home</a>
                </li>
                <li class="u-nav-item"><a class="u-button-style u-nav-link" href="./User/Appointment.php" style="padding-top: 22px; padding-bottom: 22px;">Appointment</a>
                </li>
                <li class="u-nav-item"><a class="u-button-style u-nav-link" href="./User/Schedule.php" style="padding-top: 22px; padding-bottom: 22px;">Schedule</a>
                </li>
                <li class="u-nav-item"><a class="u-button-style u-nav-link" href="./User/Log-in.php" style="padding-top: 22px; padding-bottom: 22px;">Log in</a>
                </li>
                <li class="u-nav-item"><a class="u-button-style u-nav-link" href="./User/Register.php" style="padding-top: 22px; padding-bottom: 22px;">Register</a>
                </li>
              </ul>
            </div>
          </div>
          <div class="u-black u-menu-overlay u-opacity u-opacity-70"></div>
        </div>
      </nav>
      <a href="https://nicepage.com/c/testimonials-html-templates" class="u-image u-logo u-image-1" data-image-width="618" data-image-height="58">
        <img src="./images/logo.png" class="u-logo-image u-logo-image-1" alt="online medical system logo">
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
            <li class="u-nav-item"><a class="u-border-no-bottom u-border-no-left u-border-no-right u-border-no-top u-button-style u-nav-link u-text-active-palette-1-base u-text-grey-90 u-text-hover-palette-2-base" href="index.php" style="padding: 26px 34px;">Home</a>
            </li>
            <li class="u-nav-item"><a class="u-border-no-bottom u-border-no-left u-border-no-right u-border-no-top u-button-style u-nav-link u-text-active-palette-1-base u-text-grey-90 u-text-hover-palette-2-base" href="./User/Appointment.php" style="padding: 26px 34px;">Appointment</a>
            </li>
            <li class="u-nav-item"><a class="u-border-no-bottom u-border-no-left u-border-no-right u-border-no-top u-button-style u-nav-link u-text-active-palette-1-base u-text-grey-90 u-text-hover-palette-2-base" href="./User/Schedule.php" style="padding: 26px 34px;">Schedule</a>
            </li>
          </ul>
        </div>
        <div class="u-nav-container-collapse">
          <div class="u-black u-container-style u-inner-container-layout u-opacity u-opacity-95 u-sidenav">
            <div class="u-inner-container-layout u-sidenav-overflow">
              <div class="u-menu-close"></div>
              <ul class="u-align-center u-nav u-popupmenu-items u-unstyled u-nav-4">
                <li class="u-nav-item"><a class="u-button-style u-nav-link" href="./index.php">Home</a>
                </li>
                <li class="u-nav-item"><a class="u-button-style u-nav-link" href="./User/Appointment.php">Appointment</a>
                </li>
                <li class="u-nav-item"><a class="u-button-style u-nav-link" href="./User/Schedule.php">Schedule</a>
                </li>
              </ul>
            </div>
          </div>
          <div class="u-black u-menu-overlay u-opacity u-opacity-70"></div>
        </div>
      </nav><span id="headSpan" class="u-file-icon u-hidden-md u-hidden-sm u-hidden-xs u-hover-feature u-icon u-text-palette-1-dark-2 u-icon-1" data-href="./User/Userinfo.php" title="User information"><img id="headImg" src="./images/dark_user.png" alt="View user information"></span>
    </div>
  </header>
  <section class="u-align-center u-clearfix u-palette-1-light-2 u-section-1" id="sec-ac8d">
    <div class="u-clearfix u-sheet u-sheet-1">
      <div class="u-clearfix u-expanded-width u-gutter-10 u-layout-wrap u-layout-wrap-1">
        <div class="u-layout">
          <div class="u-layout-row">
            <div class="u-size-30">
              <div class="u-layout-col">
                <div class="u-align-left u-container-style u-effect-hover-slide u-hover-feature u-layout-cell u-left-cell u-size-30 u-layout-cell-1" src="" data-animation-name="" data-animation-duration="0" data-animation-delay="0" data-animation-direction="" data-image-width="1280" data-image-height="905">
                  <div class="u-container-layout u-container-layout-1" src="">
                    <img class="u-expanded-width u-hover-feature u-image u-image-1" src="./images/schedule.jpg" data-image-width="1500" data-image-height="1000" data-href="./User/Schedule.php" title="Schedule">
                  </div>
                </div>
                <div class="u-align-left u-container-style u-effect-hover-slide u-hover-feature u-layout-cell u-left-cell u-size-30 u-layout-cell-2" src="" data-image-width="1280" data-image-height="905" data-animation-name="" data-animation-duration="0" data-animation-delay="0" data-animation-direction="">
                  <div class="u-container-layout u-valign-top u-container-layout-2" src="">
                    <img class="u-expanded u-hover-feature u-image u-image-default u-image-2" src="./images/prescription.jpg" data-image-width="1600" data-image-height="1067">
                  </div>
                </div>
              </div>
            </div>
            <div class="u-size-30">
              <div class="u-layout-row">
                <div class="u-align-left u-container-style u-effect-hover-slide u-hover-feature u-layout-cell u-right-cell u-size-60 u-layout-cell-3" src="" data-image-width="1280" data-image-height="905" data-animation-name="" data-animation-duration="0" data-animation-delay="0" data-animation-direction="">
                  <div class="u-container-layout u-container-layout-3" src="">
                    <img class="u-expand-resize u-expanded-width u-hover-feature u-image u-image-3" data-image-width="1200" data-image-height="800" src="./images/appointment.jpg" data-href="./User/Appointment.php" title="Appointment">
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="u-align-center u-container-style u-group u-opacity u-opacity-90 u-white u-group-1">
        <div class="u-container-layout u-valign-middle u-container-layout-4">
          <h2 class="u-text u-text-default u-text-1">Online Medical System</h2>
          <p class="u-text u-text-2">Stay healthy and connected.</p>
          <a href="./User/Register.php" class="u-btn u-button-style u-hover-feature u-none u-text-hover-palette-2-base u-btn-1">Register now</a>
        </div>
      </div>
    </div>

  </section>
  <section class="u-align-center u-clearfix u-white u-section-2" id="sec-7349">
    <div class="u-clearfix u-sheet u-sheet-1">
      <h2 class="u-subtitle u-text u-text-1">Meet our Doctors<span style="font-size: 3rem;"></span>
      </h2>
      <div id="carousel-5989" data-interval="5000" data-u-ride="carousel" class="u-carousel u-expanded-width u-slider u-slider-1">
        <ol class="u-absolute-hcenter u-carousel-indicators u-carousel-indicators-1">
          <li data-u-target="#carousel-5989" class="u-active u-grey-30 u-shape-circle" data-u-slide-to="0" style="width: 10px; height: 10px;"></li>
          <li data-u-target="#carousel-5989" class="u-grey-30 u-shape-circle" data-u-slide-to="1" style="width: 10px; height: 10px;"></li>
        </ol>
        <div class="u-carousel-inner" role="listbox">
          <div class="u-active u-align-center u-carousel-item u-container-style u-slide">
            <div class="u-container-layout u-valign-top u-container-layout-1">
              <div alt="" class="u-image u-image-circle u-image-1" data-image-width="1280" data-image-height="716">
              </div>
              <p class="u-large-text u-text u-text-variant u-text-2">"Lorem ipsum dolor sit amet, consectetur adipiscing
                elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis
                nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in
                reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur."</p>
              <h4 class="u-text u-text-default u-text-3">Connor Quinn<br>
              </h4>
              <h6 class="u-text u-text-default u-text-4">President, CEO</h6>
            </div>
          </div>
          <div class="u-align-center u-carousel-item u-container-style u-slide">
            <div class="u-container-layout u-valign-top u-container-layout-2">
              <div alt="" class="u-image u-image-circle u-image-2" data-image-width="1280" data-image-height="716">
              </div>
              <p class="u-large-text u-text u-text-variant u-text-5">"Lorem ipsum dolor sit amet, consectetur adipiscing
                elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis
                nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in
                reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur."</p>
              <h4 class="u-text u-text-default u-text-6"> Jack Alvarez<br>
              </h4>
              <h6 class="u-text u-text-default u-text-7">Sales Manager</h6>
            </div>
          </div>
        </div>
        <a class="u-absolute-vcenter u-carousel-control u-carousel-control-prev u-grey-70 u-hidden-xs u-icon-circle u-spacing-10 u-carousel-control-1" href="#carousel-5989" role="button" data-u-slide="prev">
          <span aria-hidden="true">
            <svg viewBox="0 0 451.847 451.847">
              <path d="M97.141,225.92c0-8.095,3.091-16.192,9.259-22.366L300.689,9.27c12.359-12.359,32.397-12.359,44.751,0
c12.354,12.354,12.354,32.388,0,44.748L173.525,225.92l171.903,171.909c12.354,12.354,12.354,32.391,0,44.744
c-12.354,12.365-32.386,12.365-44.745,0l-194.29-194.281C100.226,242.115,97.141,234.018,97.141,225.92z"></path>
            </svg>
          </span>
          <span class="sr-only">
            <svg viewBox="0 0 451.847 451.847">
              <path d="M97.141,225.92c0-8.095,3.091-16.192,9.259-22.366L300.689,9.27c12.359-12.359,32.397-12.359,44.751,0
c12.354,12.354,12.354,32.388,0,44.748L173.525,225.92l171.903,171.909c12.354,12.354,12.354,32.391,0,44.744
c-12.354,12.365-32.386,12.365-44.745,0l-194.29-194.281C100.226,242.115,97.141,234.018,97.141,225.92z"></path>
            </svg>
          </span>
        </a>
        <a class="u-absolute-vcenter u-carousel-control u-carousel-control-next u-grey-70 u-hidden-xs u-icon-circle u-spacing-10 u-carousel-control-2" href="#carousel-5989" role="button" data-u-slide="next">
          <span aria-hidden="true">
            <svg viewBox="0 0 451.846 451.847">
              <path d="M345.441,248.292L151.154,442.573c-12.359,12.365-32.397,12.365-44.75,0c-12.354-12.354-12.354-32.391,0-44.744
L278.318,225.92L106.409,54.017c-12.354-12.359-12.354-32.394,0-44.748c12.354-12.359,32.391-12.359,44.75,0l194.287,194.284
c6.177,6.18,9.262,14.271,9.262,22.366C354.708,234.018,351.617,242.115,345.441,248.292z"></path>
            </svg>
          </span>
          <span class="sr-only">
            <svg viewBox="0 0 451.846 451.847">
              <path d="M345.441,248.292L151.154,442.573c-12.359,12.365-32.397,12.365-44.75,0c-12.354-12.354-12.354-32.391,0-44.744
L278.318,225.92L106.409,54.017c-12.354-12.359-12.354-32.394,0-44.748c12.354-12.359,32.391-12.359,44.75,0l194.287,194.284
c6.177,6.18,9.262,14.271,9.262,22.366C354.708,234.018,351.617,242.115,345.441,248.292z"></path>
            </svg>
          </span>
        </a>
      </div>
    </div>
    <style data-mode="XXL">
      @media (max-width: 0px) {
        .u-section-2 {
          background-image: none;
        }

        .u-section-2 .u-sheet-1 {
          min-height: 579px;
        }

        .u-section-2 .u-slider-1 {
          min-height: 480px;
          width: 763px;
          margin-top: 50px;
          margin-bottom: 50px;
          margin-left: auto;
          margin-right: auto;
        }

        .u-section-2 .u-carousel-indicators-1 {
          position: absolute;
          bottom: 10px;
          width: auto;
          height: auto;
        }

        .u-section-2 .u-container-layout-1 {
          padding-top: 30px;
          padding-bottom: 30px;
          padding-left: 80px;
          padding-right: 80px;
        }

        .u-section-2 .u-image-1 {
          width: 83px;
          height: 83px;
          background-image: url("data:image/svg+xml;base64,PHN2ZyB2ZXJzaW9uPSIxLjEiIGlkPSJtYW4iIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyIgeD0iMHB4IiB5PSIwcHgiIHZpZXdCb3g9IjAgMCAyNTYgMjU2IiBzdHlsZT0id2lkdGg6IDI1NnB4OyBoZWlnaHQ6IDI1NnB4OyI+CjxyZWN0IGZpbGw9IiNDNkQ4RTEiIHdpZHRoPSIyNTYiIGhlaWdodD0iMjU2Ii8+CjxwYXRoIGZpbGw9IiM3Rjk2QTYiIGQ9Ik0xNzIuNiw5My40YzExLjYtNDQuNy0xMS4yLTQ4LjYtMTEuNy00OC4xYy0yMi40LTMxLjMtOTAuMy0xNi44LTc3LjQsNDguMWMtMTMuMy0yLjQtMS44LDMxLjYsMy43LDMyLjEKCWMwLDAsMCwwLDAsMGMwLjIsMCwwLjMsMCwwLjUtMC4xYzE0LjQsNDkuNyw2Mi43LDUwLjIsODAuNywwQzE3Mi4zLDEyNy4zLDE4Ni41LDkzLjMsMTcyLjYsOTMuNHoiLz4KPHBhdGggZmlsbD0iIzdGOTZBNiIgZD0iTTIwNS40LDE3Ny45Yy0yNC02LjEtNDMuNS0xOS44LTQzLjUtMTkuOGwtMjAuNiw2NC44bC04LTIyLjhjMTkuNy0yNy41LTMwLjMtMjcuNS0xMC42LDBsLTgsMjIuOEw5NCwxNTguMQoJYzAsMC0xOS41LDEzLjctNDMuNSwxOS44QzMyLjcsMTgyLjUsMzAsMjU2LDMwLDI1NmgxOTZDMjI2LDI1NiwyMjMuMywxODIuNSwyMDUuNCwxNzcuOXoiLz4KPC9zdmc+Cg==");
          background-position: 50% 50%;
          margin-top: 0;
          margin-bottom: 0;
          margin-left: auto;
          margin-right: auto;
        }

        .u-section-2 .u-text-2 {
          margin-top: 20px;
          margin-left: 0;
          margin-right: 0;
          margin-bottom: 0;
          font-size: 1.25rem;
        }

        .u-section-2 .u-text-3 {
          font-weight: 700;
          margin-top: 35px;
          margin-left: auto;
          margin-right: auto;
          margin-bottom: 0;
        }

        .u-section-2 .u-text-4 {
          font-size: 1rem;
          font-weight: 400;
          margin-top: 15px;
          margin-left: auto;
          margin-right: auto;
          margin-bottom: 0;
        }

        .u-section-2 .u-container-layout-2 {
          padding-top: 30px;
          padding-bottom: 30px;
          padding-left: 80px;
          padding-right: 80px;
        }

        .u-section-2 .u-image-2 {
          width: 83px;
          height: 83px;
          background-image: url("data:image/svg+xml;base64,PHN2ZyB2ZXJzaW9uPSIxLjEiIGlkPSJtYW4iIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyIgeD0iMHB4IiB5PSIwcHgiIHZpZXdCb3g9IjAgMCAyNTYgMjU2IiBzdHlsZT0id2lkdGg6IDI1NnB4OyBoZWlnaHQ6IDI1NnB4OyI+CjxyZWN0IGZpbGw9IiNDNkQ4RTEiIHdpZHRoPSIyNTYiIGhlaWdodD0iMjU2Ii8+CjxwYXRoIGZpbGw9IiM3Rjk2QTYiIGQ9Ik0xNzIuNiw5My40YzExLjYtNDQuNy0xMS4yLTQ4LjYtMTEuNy00OC4xYy0yMi40LTMxLjMtOTAuMy0xNi44LTc3LjQsNDguMWMtMTMuMy0yLjQtMS44LDMxLjYsMy43LDMyLjEKCWMwLDAsMCwwLDAsMGMwLjIsMCwwLjMsMCwwLjUtMC4xYzE0LjQsNDkuNyw2Mi43LDUwLjIsODAuNywwQzE3Mi4zLDEyNy4zLDE4Ni41LDkzLjMsMTcyLjYsOTMuNHoiLz4KPHBhdGggZmlsbD0iIzdGOTZBNiIgZD0iTTIwNS40LDE3Ny45Yy0yNC02LjEtNDMuNS0xOS44LTQzLjUtMTkuOGwtMjAuNiw2NC44bC04LTIyLjhjMTkuNy0yNy41LTMwLjMtMjcuNS0xMC42LDBsLTgsMjIuOEw5NCwxNTguMQoJYzAsMC0xOS41LDEzLjctNDMuNSwxOS44QzMyLjcsMTgyLjUsMzAsMjU2LDMwLDI1NmgxOTZDMjI2LDI1NiwyMjMuMywxODIuNSwyMDUuNCwxNzcuOXoiLz4KPC9zdmc+Cg==");
          background-position: 50% 50%;
          margin-top: 0;
          margin-bottom: 0;
          margin-left: auto;
          margin-right: auto;
        }

        .u-section-2 .u-text-5 {
          margin-top: 20px;
          margin-left: 0;
          margin-right: 0;
          margin-bottom: 0;
          font-size: 1.25rem;
        }

        .u-section-2 .u-text-6 {
          font-weight: 700;
          margin-top: 35px;
          margin-left: auto;
          margin-right: auto;
          margin-bottom: 0;
        }

        .u-section-2 .u-text-7 {
          font-size: 1rem;
          font-weight: 400;
          margin-top: 15px;
          margin-left: auto;
          margin-right: auto;
          margin-bottom: 0;
        }

        .u-section-2 .u-carousel-control-1 {
          width: 43px;
          height: 43px;
          background-image: none;
        }

        .u-section-2 .u-carousel-control-2 {
          width: 43px;
          height: 43px;
          background-image: none;
          left: auto;
          position: absolute;
          right: 0;
        }
      }
    </style>
  </section>

  <footer class="u-align-center u-clearfix u-footer u-grey-80 u-footer" id="sec-5b62">
    <div class="u-clearfix u-sheet u-valign-middle u-sheet-1">
      <p class="u-small-text u-text u-text-variant u-text-1">2023 @Yuan-Hsuan Lin </p>
    </div>
  </footer>
  <section class="u-backlink u-clearfix u-grey-80">
    <a class="u-link" href="https://nicepage.com/website-templates" target="_blank">
      <span>Website Templates</span>
    </a>
    <p class="u-text">
      <span>created with</span>
    </p>
    <a class="u-link" href="" target="_blank">
      <span>Website Builder Software</span>
    </a>.
  </section>

</body>

</html>