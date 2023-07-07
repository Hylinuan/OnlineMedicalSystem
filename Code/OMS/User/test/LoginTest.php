<?php

use PHPUnit\Framework\TestCase;

class LoginTest extends TestCase
{
    function ConnectDB_Login($userName, $passwd)
    {
        $validLogin = False;
        try {
            mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
            // Create connection
            $mysqli = new mysqli("127.0.0.1", "root", "", "oms", 3306);

            // Check connection
            if ($mysqli->connect_errno) {
                echo "Failed to connect to MySQL: " . $mysqli->connect_error;
                return $validLogin;
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
                $fn = "";
                foreach ($arr as $key => $val) {
                    if ($val['firstName'] != null) {
                        $fn = $val['firstName'];
                    }
                }
            } while ($mysqli->next_result());
            echo "<script>alert('Welcome back! {$fn}')</script>";
            if ($fn != null) {
                // if ($_POST["remember_me"] == '1' || $_POST["remember_me"] == 'on') {
                //     $hour = time() + 3600 * 24 * 30;
                //     setcookie('username', $userName, $hour);
                //     setcookie('password', $passwd, $hour);
                // } else {
                //     $hour = time() + 3600 * 1;
                //     setcookie('username', $userName, $hour);
                //     setcookie('password', $passwd, $hour);
                // }
                $validLogin = True;
                return $validLogin;
            }
        } catch (Exception $e) {

            echo '<script>alert(Caught exception: ', $e->getMessage(), ")";
        }
        return $validLogin;
        // header("Location: ../index.php");
    }

    function testSuccess(): void // valid parameters
    {
        self::assertEquals(True, self::ConnectDB_Login("yuanhsuanlin", "yuan0000"));
    }
    function testFailure_1(): void //wrong pair of parameter
    {
        self::assertEquals(False, self::ConnectDB_Login("joshuaMaxeen", "yuan0000"));
    }
    function testFailure_2(): void //invalid parameter
    {
        self::assertEquals(False, self::ConnectDB_Login("yuanhsuanlin", 0));
    }
    function testFailure_3(): void //invalid parameter
    {
        self::assertEquals(False, self::ConnectDB_Login(10.344, "yuan0000"));
    }
}
