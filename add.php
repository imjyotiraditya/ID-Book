<?php
// This page adds new documents
$title = "Add Document";
include("inc/header.php");
?>
<h1>Add Document</h1>
<?php
if (!checkLogin()) {
    echo '<p class="info">You are not logged in, please visit to <a href="profile.php">login</a> page.</p>';
} else {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // get user data
        $sql = 'SELECT * FROM profiles WHERE username="' . $_SESSION['username'] . '"';
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            // output data of each row
            while ($row = $result->fetch_assoc()) {
                $data[] = $row;
            }
        }

        // get form data from $_POST method
        $target_dir = "photos/";
        $front = date("U") . '_' . basename($_FILES["front"]["name"]);
        $back = date("U") . '_' . basename($_FILES["back"]["name"]);

        move_uploaded_file($_FILES["front"]["tmp_name"], $target_dir . $front);
        move_uploaded_file($_FILES["back"]["tmp_name"], $target_dir . $back);

        $sql = 'INSERT INTO ids (name, user_id, front, back) VALUES ("' . $_POST['name'] . '", "' . $data[0]['id'] . '", "' . $target_dir . $front . '", "' . $target_dir . $back . '")';
        if ($conn->query($sql) === TRUE) {
            echo '<p class="success">Document uploaded successfuly! You can visit <a href="profile.php">profile</a> now.</p>';
        } else {
            echo '<p class="error">Failed to upload! Please <a href="add.php">try</a> again. ' . $conn->error . '</p>';
        }
    } else {
        // show the upload form if nothing was submitted
?>
<form method="post" action="add.php" enctype="multipart/form-data">
    <label for="name">Document Name/Type</label><input type="text" name="name" id="name">
    <label for="front">Front Side</label><input type="file" name="front" id="front"><br />
    <label for="back">Back Side</label><input type="file" name="back" id="back">
    <button type="submit">Upload</button>
</form>
<?php
    }
}
include("inc/footer.php");
?>