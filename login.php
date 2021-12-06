<?php
$title = "Login";
include("inc/header.php");
?>
<h1>Login</h1>
<?php
if (checkLogin()) {
    echo '<p class="info">You are already logged in, please visit to <a href="profile.php">profile</a> page.</p>';
} else {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // get form data from $_POST method
        $username = $_POST['username'];
        $password = $_POST['password'];
        $sql = 'SELECT * FROM profiles WHERE username="' . $username . '" AND password="' . $password . '"';
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            $_SESSION['logged_in'] = true;
            $_SESSION['username'] = $username;
?>
<p class="success">Login successfull! You can view <a href="profile.php">profile</a> now.</p>
<?php
        } else {
        ?>
<p class="error">Username or Password is invalid! Please <a href="login.php">Login</a> again.</p>
<?php
        }
    } else {
        ?>
<form method="post" action="login.php">
    <label for="username">Username</label><br /><input type="text" name="username"><br />
    <label for="password">Password</label><br /><input type="password" name="password"><br />
    <button type="submit">Login</button>
</form>
<?php
    }
}
include("inc/footer.php");
?>