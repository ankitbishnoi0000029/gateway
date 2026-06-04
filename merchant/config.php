<?php
error_reporting(E_ALL);
ini_set("display_errors", true);

date_default_timezone_set("Asia/Kolkata");

$dbhost1 = "localhost";
$dbuser1 = "u908417695_A1ejankari";
$dbpass1 = 'superUser';
// $dbpass1 = '41rdO$2^Dy';

$dbname1 = "u908417695_A1ejankari";

$dbhost = $dbhost1;
$dbuser = $dbuser1;
$dbpass = $dbpass1;
$dbname = $dbname1;

if (!defined('DB_HOST')) {
    define('DB_HOST', $dbhost1);
    define('DB_USERNAME', $dbuser1);
    define('DB_PASSWORD', $dbpass1);
    define('DB_NAME', $dbname1);
}

if (!function_exists("connect_database")) {
    function connect_database() {
        global $dbhost1, $dbuser1, $dbpass1, $dbname1;

        static $conn = null;

    // Agar connection already active hai to same return karo
    if ($conn instanceof mysqli) {
        try {
            if ($conn->ping()) {
                return $conn;
            }
        } catch (Throwable $e) {
            // closed or invalid connection - create a new one
        }
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
