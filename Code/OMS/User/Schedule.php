<?php

/**
 * Checks if the user has requested to logout.
 * If so, it clears the username and password cookies, unsets the cookie variables,
 * and redirects to the login page.
 * If the user is not logged in, it displays an alert message and redirects to the login page.
 */
if (isset($_GET['logout'])) {
  setcookie('username', null, null);
  setcookie('password', null, null);
  unset($_COOKIE['username']);
  unset($_COOKIE['password']);
  header("Location: ./Log-in.php");
}
if (!isset($_COOKIE['username']) && !isset($_COOKIE['password'])) {
  echo "<script>alert('Please log in to make appointment!')</script>";
  header("Location: ./Log-in.php");
}

/**
 * Retrieves the appointments for the logged-in patient and displays them in a table.
 *
 * @param string $username The username of the logged-in patient.
 * @return string The HTML table containing the appointments for the patient.
 */
function GetAppointmentsTable($username)
{
  // Create connection
  $mysqli = new mysqli("localhost", "root", "", "oms", 3306);

  // Check connection
  if ($mysqli->connect_errno) {
    echo "Failed to connect to MySQL: " . $mysqli->connect_error;
    exit();
  }

  // Prepare the query to get appointments for the logged-in patient
  $sql = "SELECT `AID`, `date`, `time`, `firstName`, `lastName` 
          FROM `Appointment` 
          INNER JOIN `Daccount` ON `Appointment`.`DID` = `Daccount`.`DID`
          WHERE `Appointment`.`PID` = (SELECT `PID` FROM `Paccount` WHERE `username` = '{$username}')
          ORDER BY `Appointment` .`date` ASC";

  // Execute the query
  $result = $mysqli->query($sql);

  // Check if there are any appointments
  if ($result->num_rows == 0) {
    return "No appointments found for you.";
  }

  // Create the table header
  $table = "<table>
  <thead>
  <tr class='table100-head'>
  <th class='column1'>Appointment ID</th>
  <th class='column2'>Date</th>
  <th class='column3'>Time</th>
  <th class='column4'>Doctor</th>
  <th class='column5'>Cancel</th>
  </tr>
  </thead>
  <tbody>";

  // Loop through the appointments and add them to the table
  while ($row = $result->fetch_assoc()) {
    // Format the date and time
    $date = date("F j, Y", strtotime($row['date']));
    $time = date("g:i A", strtotime($row['time']));

    // Add the appointment to the table
    $table .= "<tr>
              <td class='column1'>{$row['AID']}</td>
              <td class='column2'>{$date}</td>
              <td class='column3'>{$time}</td>
              <td class='column4'>{$row['lastName']}</td>
              <td class='column5'><button style='background-color: #af4c4c;
              color: white;' onclick='cancel({$row['AID']})'>Cancel</button></td>
            </tr>";
  }

  // Close the table
  $table .= "</tbody></table>";

  // Add a script to handle the cancelAppointment function
  $table .= "<script>
            function cancel(AID) {
              $.ajax({
                url: './Schedule.php',
                type: 'POST',
                data: { AID: AID },
                success: function(result) {
                  if (result) {
                    alert('Appointment cancelled successfully.');
                    location.reload();
                  } else {
                    alert('Error cancelling appointment.');
                  }
                },
                error: function() {
                  alert('Error cancelling appointment.');
                }
              });
            }
          </script>";

  // Return the table
  return $table;
}


if (isset($_POST['AID'])) {
  cancelAppointment();
}
/**
 * Cancels the appointment with the provided Appointment ID.
 *
 * @return bool Returns True if the appointment cancellation is successful, False otherwise.
 */
function cancelAppointment()
{
  try {
    $validCancel = False;
    $AID = $_POST['AID'];
    echo "<script>alert('{$AID}')'</script>";
    // Create connection
    $mysqli = new mysqli("localhost", "root", "", "oms", 3306);

    // Check connection
    if ($mysqli->connect_errno) {
      echo "Failed to connect to MySQL: " . $mysqli->connect_error;
      exit();
    }

    // Prepare the SQL query to remove the appointment
    $sql = "DELETE FROM `Appointment` WHERE `AID` = '{$AID}'";

    // Execute the query
    if ($mysqli->query($sql) === TRUE) {
      echo "<script>alert('Appointment cancelled successfully.')</script>";
    } else {
      echo "<script>alert('Error cancelling appointment: '" . $mysqli->error . ")</script>";
    }

    // Close the connection
    $mysqli->close();

    $validCancel = True;
    return $validCancel;
  } catch (Exception $e) {
    $mysqli->close();
    echo '<script>alert(Caught exception: ', $e->getMessage(), ")";
    return $validCancel;
  }
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
  <link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="../css/font-awesome.min.css">
  <link rel="stylesheet" type="text/css" href="../css/animate.css">
  <link rel="stylesheet" type="text/css" href="../css/select2.min.css">
  <link rel="stylesheet" type="text/css" href="../css/perfect-scrollbar.css">
  <link rel="stylesheet" type="text/css" href="../css/util.css">
  <link rel="stylesheet" type="text/css" href="../css/main.css">
  <link rel="stylesheet" type="text/css" href="../css/nicepage.css" media="screen">
  <link rel="stylesheet" type="text/css" href="../css/Schedule.css" media="screen">
  <script class="u-script" type="text/javascript" src="../js/jquery.js" defer=""></script>
  <script class="u-script" type="text/javascript" src="../js/nicepage.js" defer=""></script>

  <link id="u-theme-google-font" rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:100,100i,300,300i,400,400i,500,500i,700,700i,900,900i|Open+Sans:300,300i,400,400i,500,500i,600,600i,700,700i,800,800i">

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
      <a href="../index.php" class="u-image u-logo u-image-1" data-image-width="618" data-image-height="58">
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
      </nav><span class="u-file-icon u-hidden-md u-hidden-sm u-hidden-xs u-hover-feature u-icon u-icon-1" data-href="./Schedule.php?logout=True" title="Log out"><img src="../images/logout.png" alt="Log out"></span>
    </div>
  </header>
  <section class="u-clearfix u-section-1" id="sec-edf4">
    <div class="u-clearfix u-sheet u-valign-top-sm u-sheet-1">
      <p id="scheduleDT" class="u-align-center u-text u-text-1">Your Schedule</p><span class="u-file-icon u-icon u-icon-1"></span><span class="u-file-icon u-icon u-icon-2"></span>
      <div class="u-expanded-width-lg u-expanded-width-md u-expanded-width-sm u-expanded-width-xs u-widget u-widget-1">
        <div style="height:100%; width: 100%; overflow:auto;">
          <?php
          $schedule = GetAppointmentsTable($_COOKIE['username']);
          echo $schedule; ?>
        </div>
      </div>
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