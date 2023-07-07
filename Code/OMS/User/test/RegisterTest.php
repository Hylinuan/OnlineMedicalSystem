<?php

use PHPUnit\Framework\TestCase;

class RegisterTest extends TestCase
{
    function ConnectDB_Signup($firstName, $middleName, $lastName, $birth, $phone, $email, $userName, $passwd, $confpasswd)
    {
        try {
            $validSignup = False;
            mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
            // Create connection
            $mysqli = new mysqli("127.0.0.1", "root", "", "oms", 3306);

            // Check connection
            if ($mysqli->connect_errno) {
                echo "Failed to connect to MySQL: " . $mysqli->connect_error;
                return $validSignup;
            }

            if (!is_String($firstName) || !is_String($middleName) || !is_String($lastName) || !is_String($birth) || !is_String($phone) || !is_String($email) || !is_String($userName) || !is_String($passwd) || !is_String($confpasswd)) {
                return $validSignup;
            }


            if (!preg_match('/^\+\d{11}$/', $phone)) {
                // echo "Invalid phone number!";
                return $validSignup;
            }
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                return $validSignup;
            }

            $today = date('Y-m-d'); // get today's date in the same format as $birthdate
            if ($birth > $today) {
                return $validSignup;
            }

            //check if phone number exists
            $existcheck = $mysqli->query("SELECT `phone` FROM (SELECT DISTINCT `phone` FROM Paccount UNION SELECT DISTINCT `phone` FROM Daccount) AS users WHERE `phone` = '{$phone}';");

            // checking if account exists
            if ($existcheck->num_rows < 1) {

                //checking if username is taken
                $usercheck = $mysqli->query("SELECT `userName` FROM (SELECT DISTINCT `userName` FROM Paccount UNION SELECT DISTINCT `userName` FROM Daccount) AS users WHERE `userName` = '{$userName}';");

                if ($usercheck->num_rows < 1) {
                    // checking if passwords match
                    if (strcmp($passwd, $confpasswd) == 0) {

                        $sql = "INSERT INTO `Paccount`(`username`, `password`, `firstName`, `middleName`, `lastName`, `birthD`, `phone`, `email`) VALUES ('{$userName}','{$passwd}','{$firstName}','{$middleName}','{$lastName}','{$birth}','{$phone}','{$email}');";
                        // $result = $mysqli->query($sql);

                        // if (!$result) {
                        //     echo "Error: " . $mysqli->error;
                        //     return $validSignup;
                        // }

                        // if ($mysqli->affected_rows > 0) {
                        //     $validSignup = True;
                        // }

                        $validSignup = True;
                    }
                }
            }

            return $validSignup;
        } catch (Exception $e) {
            // $mysqli->close();
            echo 'Caught exception: ' . $e->getMessage();
            return $validSignup;
        }
    }

    function testSuccess(): void // valid parameters
    {
        self::assertEquals(True, self::ConnectDB_Signup("this is", "a", "tester", "2000-01-01", "+13334445555", "tester@gmail.com", "tester001", "tester0000", "tester0000"));
    }

    function testFailure_1(): void // invalid name
    {
        self::assertEquals(False, self::ConnectDB_Signup("this is", 1, "tester", "2000-01-01", "+13334445555", "tester@gmail.com", "tester001", "tester0000", "tester0000"));
    }
    function testFailure_2(): void // invalid phone
    {
        self::assertEquals(False, self::ConnectDB_Signup("this is", "a", "tester", "2000-01-01", "+1333445555", "tester@gmail.com", "tester001", "tester0000", "tester0000"));
    }
    function testFailure_3(): void // invalid email
    {
        self::assertEquals(False, self::ConnectDB_Signup("this is", "a", "tester", "2000-01-01", "+13334445555", "tester", "tester001", "tester0000", "tester0000"));
    }
    function testFailure_4(): void // invalid birthdate
    {
        self::assertEquals(False, self::ConnectDB_Signup("this is", "a", "tester", "2030-01-01", "+13334445555", "tester@gmail.com", "tester001", "tester0000", "tester0000"));
    }
    function testFailure_5(): void // invalid username
    {
        self::assertEquals(False, self::ConnectDB_Signup("this is", "a", "tester", "2000-01-01", "+13334445555", "tester@gmail.com", -1, "tester0000", "tester0000"));
    }
    function testFailure_6(): void // confirm password not same as password
    {
        self::assertEquals(False, self::ConnectDB_Signup("this is", "a", "tester", "2000-01-01", "+13334445555", "tester@gmail.com", "tester001", "tester0000", "tester"));
    }
}
