<?php
error_reporting(0);
include("config.php");
?>
<!DOCTYPE html>
<html lang="en-US">

<head>
    <meta charset="utf-8" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.1/css/all.min.css">
    <link rel="stylesheet" href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css">
    <link rel="stylesheet" href="assets/css/styles.css" />
    <link rel="shortcut icon" type="image/jpg" href="assets/img/favicon.ico" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title><?php
echo $title;
?></title>
</head>

<body class="bg-gray-900">
    <header class="text-gray-400 bg-gray-900 body-font">
        <div class="container mx-auto flex flex-wrap p-5 flex-col md:flex-row items-center">
            <a class="flex title-font font-medium items-center text-white mb-4 md:mb-0">
                <img src="assets/img/favicon.ico" alt="logo" class="w-10 h-10">
                <span class="ml-3 text-xl">ID Book</span>
            </a>
            <nav
                class="md:mr-auto md:ml-4 md:py-1 md:pl-4 md:border-l md:border-gray-700 flex flex-wrap items-center text-base justify-center">
                <a href="/" class="mr-5 hover:text-white">Home</a>
                <?php
if (!checkLogin()) {
?>
                <a href="login.php" class="mr-5 hover:text-white">Login</a>
                <a href="register.php" class="mr-5 hover:text-white">Register</a>
                <?php
} else {
?>
                <a href="profile.php" class="mr-5 hover:text-white">Profile</a>
                <a href="logout.php" class="mr-5 hover:text-white">Logout</a>
                <?php
}
?>
            </nav>
        </div>
    </header>
    <main>