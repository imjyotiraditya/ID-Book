<?php
$title = "Register";
include("inc/header.php");
include('inc/phpqrcode/qrlib.php');
?>
<h1>Register</h1>
<?php
if (checkLogin()) {
    echo '<p class="info">You are already logged in, please visit to <a href="profile.php">profile</a> page.</p>';
} else {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // get form data from $_POST method
        $name = $_POST['name'];
        $username = $_POST['username'];
        $password = $_POST['password'];
        $target_dir = "photos/";
        $file_name = date("U") . '_' . basename($_FILES["fileToUpload"]["name"]);
        $target_file = $target_dir . $file_name;
        move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file);
        $sql = "INSERT INTO profiles (name, username, password, photo) VALUES ('$name', '$username', '$password', '$target_file')";
        if ($conn->query($sql) === TRUE) {
            $id = $conn->insert_id;
            echo '<p class="success">Registered successfuly! You can <a href="login.php">Login</a> now.</p>';
            QRcode::png('https://' . $_SERVER['HTTP_HOST'] . '/details.php?id=' . $id, 'qr_codes/qr_' . $id . '.png');
        } else {
            echo '<p class="error">Failed to Register! Please <a href="register.php">Register</a> again. ' . $conn->error . '</p>';
        }
    } else {
?>
<form method="post" action="register.php" enctype="multipart/form-data">
    <label for="name">Name</label><br /><input type="text" name="name"><br />
    <label for="username">Username</label><br /><input type="text" name="username"><br />
    <label for="password">Password</label><br /><input type="password" name="password"><br />
    <label for="fileToUpload">Photo</label><input type="file" name="fileToUpload" id="fileToUpload"><br />
    <button type="submit">Register</button>
</form>
<?php
    }
}
include("inc/footer.php");
?>