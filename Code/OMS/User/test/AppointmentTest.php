<?php

use PHPUnit\Framework\TestCase;

class AppointmentTest extends TestCase
{
    function ConnectDB_Appointment($dateAndTime, $doctor, $passwd): bool
    {
        try {
            $validAppointment = False; //return Value

            mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
            // Create connection
            $mysqli = new mysqli("127.0.0.1", "root", "", "oms", 3306);

            // Check connection
            if ($mysqli->connect_errno) { //there is error when connecting
                echo "\nFailed to connect to MySQL: " . $mysqli->connect_error;
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
                $dateTime = explode('T', $dateAndTime);
                if (count($dateTime) >= 2) {
                    $date = $dateTime[0]; // Date
                    $time = $dateTime[1]; // Time
                } else {
                    return $validAppointment;
                }

                $validAppointment = True;

                // Update the doctor's available time
                $sql = "UPDATE `ScheduleTime` SET `PID` = '{$PID}' WHERE `DID` = '{$DID}' AND `date` = '{$date}' AND `startT` = '{$time}';";

                //insert the apppointment
                $sql = "INSERT INTO `Appointment`(`DID`, `PID`, `date`, `time`, `prescription`) VALUES ('{$DID}','{$PID}','{$date}','{$time}','');";
                return $validAppointment;
            }
        } catch (exception $e) {
            echo "Error: " . $e->getMessage();
        }
        return $validAppointment;
    }
    public function testSuccess(): void // test correct parameters
    {
        ob_start(); // start output buffering
        $result = self::ConnectDB_Appointment("2023-04-20T08:30", "Rodriguez", "yuan0000");
        $output = ob_get_clean(); // capture output and stop buffering

        self::assertTrue($result);
        self::assertStringNotContainsString('Wrong data type', $output); // check that output does not contain the error message
    }

    public function testSuccess_2(): void // test correct parameters
    {
        $dateAndTime = "2023-04-20T08:30:00";
        $doctor = "Rodriguez";
        $passwd = "yuan0000";

        self::assertIsString($dateAndTime);
        self::assertIsString($doctor);
        self::assertIsString($passwd);
    }

    public function testFailure_1(): void // invalid date type
    {
        self::assertEquals(False, self::ConnectDB_Appointment(2023 - 04 - 03, "Johnson", "yuan0000"));
    }
    public function testFailure_2(): void // invalid date type
    {
        self::assertEquals(False, self::ConnectDB_Appointment('2023/04/03', "Johnson", "yuan0000"));
    }
}
