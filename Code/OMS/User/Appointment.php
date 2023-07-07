<?php

/**
 * Handles the logout functionality by removing the user cookies and redirecting to the login page.
 */
if (isset($_GET['logout'])) {
  setcookie('username', null, null);
  setcookie('password', null, null);
  unset($_COOKIE['username']);
  unset($_COOKIE['password']);
  header("Location: ./Log-in.php");
}
/**
 * Checks if the user is logged in. If not, displays an alert and redirects to the login page.
 */
if (!isset($_COOKIE['username']) || !isset($_COOKIE['password'])) {
  echo "<script>alert('Please log in to make appointment!')</script>";
  header("Location: ./Log-in.php");
}
//get all docsors' name from DB
$DocName = DocNameDropdownBar();
$DocTime = "";
$DocID = 0;

/**
 * Handles the form submission for making an appointment.
 */
if (isset($_POST['submit'])) {
  //get POST form details
  $time = $_POST['time'];
  $doctor = $_POST['doctor'];
  $passwd = $_POST['password'];
  $valid = ConnectDB_Appointment($time, $doctor, $passwd);
}


/**
 * Retrieves all doctors' names from the database.
 *
 * @return string The HTML code for the dropdown menu with doctors' names.
 */
function DocTimeDropdownBar($Doc)
{
  try {
    // Create connection
    $mysqli = new mysqli("localhost", "root", "", "oms", 3306);

    // Check connection
    if ($mysqli->connect_errno) { //there is error when connecting
      echo "Failed to connect to MySQL: " . $mysqli->connect_error;
      exit();
    }

    //get selected doctor's available time in the selected date
    $sql = "SELECT DISTINCT `date`, `startT` FROM `ScheduleTime` WHERE `DID` = (SELECT `DID` FROM `Daccount` WHERE `lastName` = '{$Doc}') AND `PID` IS NULL;";

    //unpack result
    $DrTime = '';
    $result = $mysqli->query($sql);
    while ($row = $result->fetch_assoc()) {
      $timeString = date('Y-m-d H:i:s', strtotime($row["date"] . ' ' . $row["startT"])); // format date and start time as a string
      $DrTime .= $timeString . '|'; // concatenate each time slot separated by '|'
    }

    // Remove the last '|' character
    $DrTime = rtrim($DrTime, '|');
  } catch (Exception $e) {
    echo "Error: " . $e->getMessage();
  }

  // Return the list of available time slots as a plain string
  return $DrTime;
}

// Check if the doctor parameter was passed in the URL
if (isset($_GET['doctor'])) {
  $selectedDoctor = $_GET['doctor'];
  $availableTimeSlots = DocTimeDropdownBar($selectedDoctor);
  echo $availableTimeSlots;
  exit(); // terminate the script to prevent the HTML code from being executed
}

/**
 * Retrieves the available time slots for the selected doctor from the database.
 *
 * @param string $Doc The selected doctor's name.
 * @return string The list of available time slots as a plain string.
 */
function DocNameDropdownBar()
{
  mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
  // Create connection
  $mysqli = new mysqli("localhost", "root", "", "oms", 3306);

  // Check connection
  if ($mysqli->connect_errno) { //there is error when connecting
    echo "Failed to connect to MySQL: " . $mysqli->connect_error;
    exit();
  }
  //get all doctors' lastname
  $sql = "SELECT `lastName` FROM `Daccount`;";

  //unpack result
  $DrName = "";
  $result = $mysqli->query($sql);
  while ($Name = $result->fetch_column(0)) {
    $DrName = $DrName . "<option value=" . $Name . ">" . $Name . "</option>";
  }
  return $DrName;
}
/**
 * Connects to the database and inserts the appointment details.
 *
 * @param string $dateAndTime The date and time of the appointment.
 * @param string $doctor The doctor's last name.
 * @param string $passwd The patient's password.
 * @return bool Returns True if the appointment is valid, False otherwise.
 */
function ConnectDB_Appointment($dateAndTime, $doctor, $passwd)
{
  try {
    $validAppointment = False; //return Value

    mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
    // Create connection
    $mysqli = new mysqli("localhost", "root", "", "oms", 3306);

    // Check connection
    if ($mysqli->connect_errno) { //there is error when connecting
      echo "Failed to connect to MySQL: " . $mysqli->connect_error;
      return $validAppointment; //return False
    }


    //checking if account exist
    $existcheck = $mysqli->query("SELECT * FROM (SELECT DISTINCT `password` FROM Paccount) AS users WHERE `password` = '{$passwd}';");

    // checking if account exists
    if ($existcheck->num_rows >= 1) {
      $DID = 0;
      $PID = 0;
      // Get the DID of the selected doctor
      $dresult = $mysqli->query("SELECT `DID` FROM `Daccount` WHERE `lastName` = '{$doctor}';");
      if ($dresult->num_rows == 1) {
        $drow = $dresult->fetch_assoc();
        $DID = $drow['DID'];
      }
      // Get the PID of the patient with the provided password
      $presult = $mysqli->query("SELECT `PID` FROM `Paccount` WHERE `password` = '{$passwd}';");
      if ($presult->num_rows == 1) {
        $prow = $presult->fetch_assoc();
        $PID = $prow['PID'];
      }



      // Split date and time
      $dateTime = explode(' ', $dateAndTime);
      $date = $dateTime[0]; // Date
      $time = $dateTime[1]; // Time

      // Update the doctor's available time
      $sql = "UPDATE `ScheduleTime` SET `PID` = '{$PID}' WHERE `DID` = '{$DID}' AND `date` = '{$date}' AND `startT` = '{$time}';";
      $result = $mysqli->query($sql);

      //insert the apppointment
      $sql = "INSERT INTO `Appointment`(`DID`, `PID`, `date`, `time`, `prescription`) VALUES ('{$DID}','{$PID}','{$date}','{$time}','NULL');";
      $result = $mysqli->query($sql);
    }

    header("Location: ./Schedule.php");
  } catch (mysqli_sql_exception $e) {
    echo "<script>alert(Error: " . $e->getMessage() . ")</script>";
  }

  $mysqli->close();
  $validAppointment = True;
  return $validAppointment;
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
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
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
    <script type="text/javascript">
      document.addEventListener('DOMContentLoaded', () => {
        // Get the select elements
        const DocSelect = document.querySelector('#doctorSelector');
        const TimeSelect = document.querySelector('#timeSelector');

        // Listen for change events on DocSelect
        DocSelect.addEventListener('change', () => {
          // Get the selected value of DocSelect
          const selectedValue = DocSelect.value;

          // Send a GET request to PHP function using AJAX
          fetch('./Appointment.php?doctor=' + selectedValue)
            .then(response => response.text()) // Change response type from JSON to text
            .then(data => {
              console.log('Data received:', data);
              TimeSelect.innerHTML = '';
              const timeSlots = data.split('|'); // Split the plain string into an array of time slots
              timeSlots.forEach(optionValue => {
                const option = document.createElement('option');
                option.value = optionValue;
                option.text = optionValue;
                TimeSelect.appendChild(option);
              });
            })
            .catch(error => {
              console.error('Error fetching data:', error);
            });
        });
      });
    </script>
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
      </nav><span class="u-file-icon u-hidden-md u-hidden-sm u-hidden-xs u-hover-feature u-icon u-icon-1" data-href="./Appointment.php?logout=True" title="Log out"><img src="../images/logout.png" alt="Log out"></span>
    </div>
  </header>
  <!-- end of Header(logo, menu) -->
  <section class="u-clearfix u-palette-1-light-2 u-section-1" id="sec-4761">
    <div class="u-clearfix u-sheet u-sheet-1">
      <div class="u-expanded-width-xs u-form u-form-1">
        <form action="Appointment.php" method="POST" class="u-clearfix u-form-spacing-10 u-form-vertical u-inner-form" style="padding: 10px;">
          <div class="u-form-group u-form-partition-factor-2 u-form-phone u-form-group-5">
            <label for="phone-60b5" class="u-label u-label-5">Select one Doctor</label>
            <select name="doctor" id="doctorSelector" class="u-input u-input-rectangle" required="required">
              <option disabled selected value> -- select a doctor -- </option>
              <?PHP
              echo $DocName;
              ?>
            </select>
          </div>
          <div class="u-form-date u-form-group u-form-partition-factor-2 u-form-group-4">
            <label for="date-0d5d" class="u-label u-label-4">Appointment Time</label>
            <select type="time" name="time" id="timeSelector" class="u-input u-input-rectangle" required="required">
              <option disabled selected value> -- select doctor first -- </option>
            </select>
          </div>

          <div class="u-form-group u-form-group-8">
            <label for="text-55a9" class="u-label u-label-8">Password</label>
            <input type="password" placeholder="Enter you password" id="text-55a9" name="password" class="u-input u-input-rectangle" required="required">
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
      <p class="u-small-text u-text u-text-variant u-text-1">2023 @Yuan-Hsuan Lin </p>
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