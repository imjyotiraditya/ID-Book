<?php
// turn off php notices
error_reporting(E_ALL & ~E_NOTICE);

// make a mysql database connection and save it to a variable named $conn
$db_host = "localhost"; // database hostname
$db_user = "root"; // database username
$password = ""; // database password
$db_name = "project"; // database name

// make the connection
$conn = new mysqli($db_host, $db_user, $password, $db_name);
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
