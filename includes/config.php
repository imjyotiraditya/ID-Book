<?php
// Turn off all error reporting
error_reporting(0);

// make a mysql database connection and save it to a variable named $conn
$db_host  = getenv('DB_HOST'); // database hostname
$db_user  = getenv('DB_USER'); // database username
$db_pass  = getenv('DB_PASS'); // database password
$db_name  = getenv('DB_NAME'); // database name

// make the connection
$conn = new mysqli($db_host, $db_user, $db_pass, $db_name);
if ($conn->connect_error) {
    // print out the error if failed to connect to database
    die("Connection failed: " . $conn->connect_error);
}

// start session for managing login session
session_start();

// this function checks if the user logged in or not by verifying session var named logge_in which is set on successful login
function checkLogin()
{
    if ($_SESSION['logged_in'] === true) {
        return true;
    } else {
        return false;
    }
}
