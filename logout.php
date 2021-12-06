<?php
include("inc/header.php");
session_destroy();
header("Location: login.php");
?>