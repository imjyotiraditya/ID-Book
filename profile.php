<?php
$title = "Profile";
include("inc/header.php");
?>
<h1>Profile</h1>
<?php
if (!checkLogin()) {
  echo '<p class="info">You are not logged in, please visit to <a href="profile.php">login</a> page.</p>';
} else {
  $sql = 'SELECT * FROM profiles WHERE username="' . $_SESSION['username'] . '"';
  $result = $conn->query($sql);

  if ($result->num_rows > 0) {
    // output data of each row
    while ($row = $result->fetch_assoc()) {
      $data[] = $row;
    }
  }

  // get list of ids
  $sql2 = 'SELECT * FROM ids WHERE user_id="' . $data[0]['id'] . '"';
  $result2 = $conn->query($sql2);

  if ($result2->num_rows > 0) {
    // output data of each row
    while ($row2 = $result2->fetch_assoc()) {
      $ids[] = $row2;
    }
  }

  $img = '';
  $doc_id = $_GET['doc_id'];
  if (!empty($ids) && !empty($doc_id)) foreach ($ids as $id) {
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
        <td class="td2"><?php if (!empty($img)) {
                        echo $img;
                      } else {
                        if (!empty($ids)) {
                          foreach ($ids as $id) { ?><div class="block"><?= $id['name']; ?><div class="photo">
                    <?php if (!empty($id['front'])) echo '<img src="' . $id['front'] . '" height="auto" width="180">'; ?>
                    <div class="photo-btn"><a href="profile.php?doc_id=<?= $id['id']; ?>">View</a></div>
                </div>
            </div>
            <?php }
                        }
                        echo '<div class="block">Add Document<div class="photo"><a href="add.php"><img src="photos/add.png" height="100px" width="180"></a></div></div>';
                      } ?><br /><br /><span class="title">QR Code:</span><br /><img
                src="qr_codes/qr_<?= $data[0]['id']; ?>.png" class="qr"><br /><a
                href="qr_codes/qr_<?= $data[0]['id']; ?>.png">Download QR Code</a></td>
    </tr>
</table>
<?php
}
include("inc/footer.php");
?>