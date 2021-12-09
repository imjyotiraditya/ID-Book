<?php
// this page shows user detail fetched from the database, identified by the user id which is recieved from $_GET['id']
$title = "User Profile"; // set page title
include("includes/header.php"); // include the header file
$id     = $_GET['id']; // get the user id from url
$check  = ''; // a empty variable which will be used to check if the user id is valid or not
$sql    = 'SELECT * FROM profiles WHERE id=' . $id . ''; // sql code to check if th user exists
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    $check = 1;
    // output data of each row
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
}
?>
<h1>User Profile</h1>
<?php
if (empty($check)) {
    echo '<p class="error">User not found, please visit to <a href="index.php">home</a> page.</p>';
} else {
    // user details found, continue
    $sql2    = 'SELECT * FROM ids WHERE user_id="' . $data[0]['id'] . '"'; // get list of ids
    $result2 = $conn->query($sql2);
    
    if ($result2->num_rows > 0) {
        // output data of each row
        while ($row2 = $result2->fetch_assoc()) {
            $ids[] = $row2;
        }
    }
    
    $img    = '';
    $doc_id = $_GET['doc_id'];
    if (!empty($ids) && !empty($doc_id))
        foreach ($ids as $id) {
            $key = array_search($doc_id, $id);
            if ($key !== false) {
                $img = '<span class="title">' . $id['name'] . ':</span><br/><img src="' . $id['front'] . '" width="100%" height="auto"><br/><div class="center"><a href="' . $id['front'] . '">Download</a></div>
  <br/><img src="' . $id['back'] . '" width="100%" height="auto"><br/><div class="center"><a href="' . $id['back'] . '">Download</a></div><br/><br/><div class="center"><a href="profile.php">Back</a>';
            }
        }
?>
<table>
    <tr class="tr">
        <td class="td1"><img src="<?= $data[0]['photo']; ?>" class="circle"><br />
            <div class="name"><?= $data[0]['name']; ?></div>
            <div class="name">@<?= $data[0]['username']; ?></div><br />
        </td>
        <td class="td2"><?php
    if (!empty($img)) {
        echo $img;
    } else {
        if (!empty($ids)) {
            foreach ($ids as $id) {
?><div class="block"><?= $id['name']; ?><div class="photo">
                    <?php
                if (!empty($id['front']))
                    echo '<img src="' . $id['front'] . '" height="auto" width="180">';
?>
                    <div class="photo-btn"><a href="profile.php?doc_id=<?= $id['id']; ?>">View</a></div>
                </div>
            </div>
            <?php
            }
        }
    }
?><br /><br /><span class="title">QR Code:</span><br /><img src="qr_codes/qr_<?= $data[0]['id']; ?>.png"
                class="qr"><br /><a href="qr_codes/qr_<?= $data[0]['id']; ?>.png">Download QR Code</a></td>
    </tr>
</table>
<?php
}
include("includes/footer.php"); // include the footer part
?>