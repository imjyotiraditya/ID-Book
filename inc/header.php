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
    <link rel="stylesheet" href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css">
    <link rel="stylesheet" href="css/styles.css" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title><?php echo $title; ?></title>
</head>

<body>
    <header class="text-gray-400 bg-gray-900 body-font">
        <div class="container mx-auto flex flex-wrap p-5 flex-col md:flex-row items-center">
            <a class="flex title-font font-medium items-center text-white mb-4 md:mb-0">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor" stroke-linecap="round"
                    stroke-linejoin="round" stroke-width="2" class="w-10 h-10 text-white p-2 bg-indigo-500 rounded-full"
                    viewBox="0 0 24 24">
                    <path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5"></path>
                </svg>
                <span class="ml-3 text-xl">ID Book</span>
            </a>
            <nav
                class="md:mr-auto md:ml-4 md:py-1 md:pl-4 md:border-l md:border-gray-700 flex flex-wrap items-center text-base justify-center">
                <a href="/" class="mr-5 hover:text-white">Home</a>
                <?php if(!checkLogin()) { ?>
                <a href="login.php" class="mr-5 hover:text-white">Login</a>
                <a href="register.php" class="mr-5 hover:text-white">Register</a>
                <?php } else {?>
                <a href="profile.php" class="mr-5 hover:text-white">Profile</a>
                <a href="logout.php" class="mr-5 hover:text-white">Logout</a>
                <?php } ?>
            </nav>
        </div>
    </header>
    <main>