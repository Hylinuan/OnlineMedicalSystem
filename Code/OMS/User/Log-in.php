<?php

/**
 * Checks if the user is logged in. If not, it attempts to authenticate the user using the provided login information.
 * If authentication is successful, it sets the necessary cookies and redirects to the index page.
 * If the user is already logged in, it redirects to the index page.
 */
if (!isset($_COOKIE['username']) || !isset($_COOKIE['password'])) {
    if (isset($_POST["submit"])) {
        ConnectDB_Login($_POST['username'], $_POST['password']);
        header("Location: ../index.php");
    }
} else {
    header("Location: ../index.php");
}

/**
 * Attempts to connect to the database and authenticate the user using the provided login information.
 *
 * @param string $userName The user's username.
 * @param string $passwd The user's password.
 */
function ConnectDB_Login($userName, $passwd)
{
    $validLogin = False;
    try {
        mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
        // Create connection
        $mysqli = new mysqli("localhost", "root", "", "oms", 3306);

        // Check connection
        if ($mysqli->connect_errno) {
            echo "Failed to connect to MySQL: " . $mysqli->connect_error;
            exit();
        };

        $sql = "
  SELECT `firstName`, `lastName` FROM `Paccount`
  WHERE `username` = '{$userName}' AND `password`= '{$passwd}';";

        $mysqli->multi_query($sql);

        do {
            if ($result = $mysqli->store_result()) {
                $arr = $result->fetch_all(MYSQLI_ASSOC);
                $result->free();
            }

            foreach ($arr as $key => $val) {
                if ($val['firstName'] != null) {
                    $fn = $val['firstName'];
                }
            }
        } while ($mysqli->next_result());
        echo "<script>alert('Welcome back! {$fn}')</script>";
        if ($fn != null) {
            if ($_POST["remember_me"] == '1' || $_POST["remember_me"] == 'on') {
                $hour = time() + 3600 * 24 * 30;
                setcookie('username', $userName, $hour);
                setcookie('password', $passwd, $hour);
            } else {
                $hour = time() + 3600 * 1;
                setcookie('username', $userName, $hour);
                setcookie('password', $passwd, $hour);
            }
            $validLogin = True;
            return $validLogin;
        }
    } catch (Exception $e) {
        $mysqli->close();
        echo '<script>alert(Caught exception: ', $e->getMessage(), ")";
    }
    header("Location: ../index.php");
}
?>
<!DOCTYPE html>
<html style="font-size: 16px;" lang="en">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="utf-8">
    <meta name="keywords" content="Log in">
    <meta name="description" content="Log in online medical system through username and password">
    <title>Log in</title>
    <link rel="stylesheet" href="../css/nicepage.css" media="screen">
    <link rel="stylesheet" href="../css/Log-in.css" media="screen">
    <script class="u-script" type="text/javascript" src="../js/jquery.js" defer=""></script>
    <script class="u-script" type="text/javascript" src="../js/nicepage.js" defer=""></script>
    <link id="u-theme-google-font" rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:100,100i,300,300i,400,400i,500,500i,700,700i,900,900i|Open+Sans:300,300i,400,400i,500,500i,600,600i,700,700i,800,800i">
    <meta name="theme-color" content="#93bfcb">
    <meta property="og:title" content="Log in">
    <meta property="og:description" content="">
    <meta property="og:type" content="website">
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
                        <li class="u-nav-item"><a class="u-button-style u-nav-link u-text-active-palette-1-base u-text-grey-90 u-text-hover-palette-2-base" href="Log-in.php" style="padding: 10px;">Log in</a>
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
                                <li class="u-nav-item"><a class="u-button-style u-nav-link" href="Log-in.php" style="padding-top: 22px; padding-bottom: 22px;">Log in</a>
                                </li>
                                <li class="u-nav-item"><a class="u-button-style u-nav-link" href="./Register.php" style="padding-top: 22px; padding-bottom: 22px;">Register</a>
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
            </nav><span class="u-file-icon u-hidden-md u-hidden-sm u-hidden-xs u-hover-feature u-icon u-text-palette-1-dark-2 u-icon-1" data-href="./Register.php" title="Register an account"><img src="../images/signup.png" alt="sign up"></span>
        </div>
    </header>
    <section class="u-clearfix u-section-1" id="sec-980c">
        <div class="u-clearfix u-sheet u-valign-middle u-sheet-1">
            <div class="u-align-center u-container-style u-grey-10 u-group u-radius-50 u-shape-round u-group-1">
                <div class="u-container-layout u-container-layout-1"><span class="u-file-icon u-icon u-text-palette-1-base u-icon-1"><img src="../images/dark_user.png" alt="user icon"></span>
                    <h3 class="u-text u-text-default u-text-1">User Log In</h3>
                    <div class="u-expanded-width u-form u-login-control u-form-1">
                        <form action="./Log-in.php" method="post" class="u-clearfix u-form-custom-backend u-form-spacing-30 u-form-vertical u-inner-form" source="custom" style="padding: 10px;">
                            <div class="u-form-group u-form-name">
                                <label for="username-5b0a" class="u-form-control-hidden u-label u-label-1"></label>
                                <input type="text" placeholder="Enter your Username" id="username-5b0a" name="username" class="u-border-2 u-border-white u-input u-input-rectangle u-radius-43 u-input-1" required="">
                            </div>
                            <div class="u-form-group u-form-password">
                                <label for="password-5b0a" class="u-form-control-hidden u-label u-label-2"></label>
                                <input type="text" placeholder="Enter your Password" id="password-5b0a" name="password" class="u-border-2 u-border-white u-input u-input-rectangle u-radius-43 u-input-2" required="">
                            </div>
                            <div class="u-form-checkbox u-form-group">
                                <input type="checkbox" id="remember_me" name="remember_me" value="On" class="u-field-input">
                                <label for="checkbox-5b0a" class="u-field-label" style="font-size: 1.25rem;">Remember
                                    me</label>
                            </div>
                            <div class="u-align-center u-form-group u-form-submit">
                                <input type="submit" value="login" name="submit" class="u-btn u-btn-submit u-button-style u-btn-1">
                            </div>
                        </form>
                    </div>
                    <a href="./Findback.php" class="u-border-1 u-border-active-palette-2-base u-border-hover-palette-1-base u-border-no-left u-border-no-right u-border-no-top u-btn u-button-style u-login-control u-login-forgot-password u-none u-text-palette-1-dark-1 u-btn-2">Forgot
                        password?</a>
                </div>
            </div>
        </div>
    </section>

    <footer class="u-align-center u-clearfix u-footer u-grey-80 u-footer" id="sec-5b62">
        <div class="u-clearfix u-sheet u-valign-middle u-sheet-1">
            <p class="u-small-text u-text u-text-variant u-text-1">2023 @Yuan-Hsuan Lin </p>
        </div>
    </footer>

</body>

</html>