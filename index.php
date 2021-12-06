<?php
// this is the home page
$title = "Home Page"; // set page title
include("inc/header.php"); // include the header file
?>
<h1>Welcome</h1>
<p>Welcome dear guset, please <a href="login.php">login</a> to view or update your profile. If you don't have an account
    please <a href="register.php">register</a> here. If you want view someone else's profile, please scan the QR Code of
    the user.</p>
<?php
include("inc/footer.php"); // include the footer part
?>