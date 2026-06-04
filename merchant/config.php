// <?php
// error_reporting(E_ALL);
// ini_set("display_errors", true);

// date_default_timezone_set("Asia/Kolkata");

// $dbhost = "localhost";
// $dbuser = "u908417695_A1ejankari";
// $dbpass = '41rdO$2^Dy';
// $dbname = "u908417695_A1ejankari";

// $conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
// // print_r($conn);
// if (!$conn) {
//     die(
//         "Database Connection failed<br>" .
//         "Error No: " . mysqli_connect_errno() . "<br>" .
//         "Error: " . mysqli_connect_error()
//     );
// }

// mysqli_set_charset($conn, "utf8mb4");

// $server = $_SERVER["SERVER_NAME"] ?? "";
// ?>
<?php
error_reporting(E_ALL);
ini_set("display_errors", true);

date_default_timezone_set("Asia/Kolkata");

// mysqli_report(MYSQLI_REPORT_OFF);

// Normal variables
$dbhost1 = "localhost";
$dbuser1 = "u908417695_A1ejankari";
$dbpass1 = '41rdO$2^Dy';
$dbname1 = "u908417695_A1ejankari";

if (!function_exists("connect_database")) {
    function connect_database() {
        global $dbhost1, $dbuser1, $dbpass1, $dbname1;

        static $conn = null;

        // Agar connection already active hai to same return karo
        if ($conn instanceof mysqli && @mysqli_ping($conn)) {
            return $conn;
        }

        $conn = mysqli_connect($dbhost1, $dbuser1, $dbpass1, $dbname1);

        if (!$conn) {
            die(
                "Database Connection failed<br>" .
                "Error No: " . mysqli_connect_errno() . "<br>" .
                "Error: " . mysqli_connect_error()
            );
        }

        mysqli_set_charset($conn, "utf8mb4");

        return $conn;
    }
}

// Old code ke liye global $conn
$conn = connect_database();

$server = $_SERVER["SERVER_NAME"] ?? "";
?>