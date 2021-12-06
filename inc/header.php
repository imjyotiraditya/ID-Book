<?php
// this file shows the header part of the page in all pages ,we just have to include this file in every page

// include the file where we need to connect to the database
include("db.php");
?>
<!DOCTYPE html>
<html lang="en-US">

<head>
    <meta charset="utf-8" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.1/css/all.min.css">
    <link rel="stylesheet" href="css/styles.css" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title><?php echo $title; ?></title>
</head>

<body>
    <header class="topnav" id="myTopnav">
        <a href="/"><i class="fas fa-home"></i> Home</a>
        <?php if(!checkLogin()) { ?><a href="login.php"><i class="fas fa-sign-in-alt"></i> Login</a>
        <a href="register.php"><i class="fas fa-user-plus"></i> Register</a><?php } else {?>
        <a href="profile.php"><i class="fas fa-user"></i> Profile</a>
        <a href="logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a><?php } ?>
        <a href="javascript:void(0);" class="icon" onclick="toggleNavigaton()">
            <i class="fa fa-bars"></i>
        </a>
    </header>
    <main>