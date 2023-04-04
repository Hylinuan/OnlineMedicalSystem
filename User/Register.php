<?php
if (isset($_COOKIE['username']) || isset($_COOKIE['password'])) {
  header("Location: ../index.php");
} else {
  if (isset($_POST["submit"])) {

    mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
    // Create connection
    $mysqli = new mysqli("localhost", "root", "", "oms", 3306);

    // Check connection
    if ($mysqli->connect_errno) {
      echo "Failed to connect to MySQL: " . $mysqli->connect_error;
      exit();
    }

    $firstName = $_POST['firstName'];
    $middleName = $_POST['middleName'];
    $lastName = $_POST['lastName'];
    $birth = $_POST['birthdate'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $userName = $_POST['username'];
    $passwd = $_POST['password'];
    $confpasswd = $_POST['confirm-password'];

    //check if phone number exists
    $existcheck = $mysqli->query("SELECT `phone` FROM (SELECT DISTINCT `phone` FROM Paccount UNION SELECT DISTINCT `phone` FROM Daccount) AS users WHERE `phone` = '{$phone}';");

    // checking if account exists
    if ($existcheck->num_rows < 1) {

      //checking if username is taken
      $usercheck = $mysqli->query("SELECT `userName` FROM (SELECT DISTINCT `userName` FROM Paccount UNION SELECT DISTINCT `userName` FROM Daccount) AS users WHERE `userName` = '{$userName}';");

      if ($usercheck->num_rows < 1) {
        // checking if passwords match
        if (strcmp($passwd, $confpasswd) == 0) {

          $sql = "INSERT INTO Paccount (`PID`, `firstName`, `middleName`, `lastName`, `birthD`, `phone`, `email`)
                VALUES ('', '{$firstName}', '{$middleName}', '{$lastName}', '{$birth}',  '{$phone}', '{$email}');";
          $result = $mysqli->query($sql);
        }
      }
    }
    header("Location: ./User/Log-in.php");

    $conn->close();
  }
}
?>
<!DOCTYPE html>
<html style="font-size: 16px;" lang="en">

<head>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta charset="utf-8">
  <meta name="keywords" content="Register">
  <meta name="description" content="Register an account">
  <title>Register</title>
  <link rel="stylesheet" href="../css/nicepage.css" media="screen">
  <link rel="stylesheet" href="../css/Register.css" media="screen">
  <script class="u-script" type="text/javascript" src="../js/jquery.js" defer=""></script>
  <script class="u-script" type="text/javascript" src="../js/nicepage.js" defer=""></script>
  <link id="u-theme-google-font" rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:100,100i,300,300i,400,400i,500,500i,700,700i,900,900i|Open+Sans:300,300i,400,400i,500,500i,600,600i,700,700i,800,800i">
  <meta name="theme-color" content="#93bfcb">
  <meta property="og:title" content="Register">
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
            <li class="u-nav-item"><a class="u-button-style u-nav-link u-text-active-palette-1-base u-text-grey-90 u-text-hover-palette-2-base" href="./Schedule.php" style="padding: 10px;">Schedule</a>
            </li>
            <li class="u-nav-item"><a class="u-button-style u-nav-link u-text-active-palette-1-base u-text-grey-90 u-text-hover-palette-2-base" href="./Log-in.php" style="padding: 10px;">Log in</a>
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
              </ul>
            </div>
          </div>
          <div class="u-black u-menu-overlay u-opacity u-opacity-70"></div>
        </div>
      </nav>
      <a class="u-image u-logo u-image-1" data-image-width="618" data-image-height="58">
        <img src="../images/logo.png" class="u-logo-image u-logo-image-1">
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
                <li class="u-nav-item"><a class="u-button-style u-nav-link" href="../index.php">Home</a>
                </li>
                <li class="u-nav-item"><a class="u-button-style u-nav-link" href="./Appointment.php">Appointment</a>
                </li>
                <li class="u-nav-item"><a class="u-button-style u-nav-link" href="./Schedule.php">Schedule</a>
                </li>
              </ul>
            </div>
          </div>
          <div class="u-black u-menu-overlay u-opacity u-opacity-70"></div>
        </div>
      </nav><span class="u-file-icon u-hidden-md u-hidden-sm u-hidden-xs u-hover-feature u-icon u-icon-1" data-href="./Log-in.php" title="Log-in"><img id="headImg" src="../images/login.png" alt=""></span>
    </div>
  </header>
  <!-- end of Header(logo, menu) -->
  <section class="u-clearfix u-palette-1-light-2 u-section-1" id="sec-4761">
    <div class="u-clearfix u-sheet u-sheet-1">
      <div class="u-expanded-width-xs u-form u-form-1">
        <form action="Register.php" method="POST" class="u-clearfix u-form-spacing-10 u-form-vertical u-inner-form" style="padding: 10px;">
          <div class="u-form-group u-form-name u-form-partition-factor-3 u-form-group-1">
            <label for="name-5d55" class="u-label u-label-1">First Name</label>
            <input type="text" placeholder="Enter your First Name" id="name-5d55" name="firstName" class="u-input u-input-rectangle" required="required" maxlength="50">
          </div>
          <div class="u-form-group u-form-name u-form-partition-factor-3">
            <label for="name-c3f6" class="u-label u-label-2">Middle Name</label>
            <input type="text" placeholder="Enter your Middle Name" id="name-c3f6" name="middleName" class="u-input u-input-rectangle" maxlength="50">
          </div>
          <div class="u-form-group u-form-name u-form-partition-factor-3 u-form-group-3">
            <label for="name-5d55" class="u-label u-label-3">Last Name</label>
            <input type="text" placeholder="Enter your Last Name" id="name-5d55" name="lastName" class="u-input u-input-rectangle" required="required" maxlength="50">
          </div>
          <div class="u-form-date u-form-group u-form-partition-factor-2 u-form-group-4">
            <label for="date-0d5d" class="u-label u-label-4">Date</label>
            <input type="date" placeholder="MM-DD-YYYY" id="mobi-picker" name="birthdate" class="u-input u-input-rectangle" required="required" date-format="mm/dd/yyyy">
          </div>
          <div class="u-form-group u-form-partition-factor-2 u-form-phone u-form-group-5">
            <label for="phone-60b5" class="u-label u-label-5">Phone</label>
            <input type="tel" pattern="\+?\d{0,3}[\s\(\-]?([0-9]{2,3})[\s\)\-]?([\s\-]?)([0-9]{3})[\s\-]?([0-9]{2})[\s\-]?([0-9]{2})" placeholder="Enter your phone (e.g. +14155552675)" id="phone-60b5" name="phone" class="u-input u-input-rectangle" required="required" maxlength="13">
          </div>
          <div class="u-form-email u-form-group">
            <label for="email-c3f6" class="u-label u-label-6">Email</label>
            <input type="email" placeholder="Enter a valid email address" id="email-c3f6" name="email" class="u-input u-input-rectangle" required="required" maxlength="50">
          </div>
          <div class="u-form-group u-form-group-7">
            <label for="text-9a81" class="u-label u-label-7">Username</label>
            <input type="text" placeholder="Enter your username" id="text-9a81" name="username" class="u-input u-input-rectangle" required="required" autofocus="autofocus" maxlength="30">
          </div>
          <div class="u-form-group u-form-group-8">
            <label for="text-55a9" class="u-label u-label-8">Password</label>
            <input type="password" placeholder="Enter you password" id="text-55a9" name="password" class="u-input u-input-rectangle" required="required">
          </div>
          <div class="u-form-group u-form-group-9">
            <label for="text-92a4" class="u-label u-label-9">Confirm Password</label>
            <input type="password" placeholder="Re-enter your password" id="text-92a4" name="confirm-password" class="u-input u-input-rectangle" required="required">
          </div>
          <div class="u-align-center u-form-group u-form-submit">
            <input type="submit" name="submit" value="Submit" class="u-btn u-btn-submit u-button-style u-btn-1"></input>
            <!-- <button type="submit" value="submit" class="u-form-control-hidden"> -->
          </div>
        </form>
      </div>
    </div>
  </section>

  <footer class="u-align-center u-clearfix u-footer u-grey-80 u-footer" id="sec-5b62">
    <div class="u-clearfix u-sheet u-valign-middle-md u-valign-middle-sm u-valign-middle-xs u-sheet-1">
      <p class="u-small-text u-text u-text-variant u-text-1">Sample text. Click to select the Text Element.</p>
    </div>
  </footer>
  <section class="u-backlink u-clearfix u-grey-80">
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