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
                $img = '
            <div class="xl:w-1/4 md:w-1/2 p-4">
                <div class="bg-gray-800 bg-opacity-40 p-6 rounded-lg">
                    <img class="h-40 rounded w-full object-cover object-center mb-6" src="' . $id['front'] . '"
                        alt="content">
                    <h3 class="tracking-widest text-red-400 text-xs font-medium title-font">' . $id['name'] . '</h3>
                    <h2 class="text-lg text-white font-medium title-font mb-4">Front Side</h2>
                    <p class="leading-relaxed text-base">
                        <a href="' . $id['front'] . '" class="text-red-500 inline-flex items-center md:mb-2 lg:mb-0">View
                            <svg class="w-4 h-4 ml-2" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"
                                fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M5 12h14"></path>
                                <path d="M12 5l7 7-7 7"></path>
                            </svg>
                        </a>
                    </p>
                </div>
            </div>
            <div class="xl:w-1/4 md:w-1/2 p-4">
                <div class="bg-gray-800 bg-opacity-40 p-6 rounded-lg">
                    <img class="h-40 rounded w-full object-cover object-center mb-6" src="' . $id['back'] . '"
                        alt="content">
                    <h3 class="tracking-widest text-red-400 text-xs font-medium title-font">' . $id['name'] . '</h3>
                    <h2 class="text-lg text-white font-medium title-font mb-4">Back Side</h2>
                    <p class="leading-relaxed text-base">
                        <a href="' . $id['back'] . '" class="text-red-500 inline-flex items-center md:mb-2 lg:mb-0">View
                            <svg class="w-4 h-4 ml-2" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"
                                fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M5 12h14"></path>
                                <path d="M12 5l7 7-7 7"></path>
                            </svg>
                        </a>
                    </p>
                </div>
            </div>';
            }
        }
?>
<section class="text-gray-400 bg-gray-900 body-font">
    <div class="container mx-auto flex px-5 py-24 items-center justify-center flex-col">
        <img class="lg:w-1/6 md:w-3/6 w-4/6 mb-10 object-cover object-center rounded" alt="hero"
            src="<?= $data[0]['photo']; ?>">
        <div class="text-center lg:w-2/3 w-full">
            <h1 class="title-font sm:text-4xl text-3xl mb-4 font-medium text-white"><?= $data[0]['name']; ?></h1>
            <p class="leading-relaxed mb-8">@<?= $data[0]['username']; ?></p>
        </div>
    </div>
    <div class="container mx-auto flex px-5 py-24 items-center justify-center flex-col">
        <img class="lg:w-1/6 md:w-3/6 w-4/6 mb-10 object-cover object-center rounded" alt="hero"
            src="qr_codes/qr_<?= $data[0]['id']; ?>.png">
        <div class="text-center lg:w-2/3 w-full">
            <h1 class="title-font sm:text-4xl text-3xl mb-4 font-medium text-white">QR Code</h1>
            <p class="leading-relaxed mb-8">Scan to visit the profile</p>
        </div>
    </div>
</section>
<section class="text-gray-400 bg-gray-900 body-font">
    <div class="container px-5 py-24 mx-auto">
        <div class="flex flex-col text-center w-full mb-20">
            <h1 class="sm:text-3xl text-2xl font-medium title-font mb-4 text-white">Documents</h1>
            <p class="lg:w-2/3 mx-auto leading-relaxed text-base">Access your documents here. If there are no documents,
                you can upload them by clicking the button below.</p>
            <button onclick="window.location.href='add.php'"
                class="flex mx-auto mt-16 text-white bg-red-500 border-0 py-2 px-8 focus:outline-none hover:bg-red-600 rounded text-lg">Add
                Document</button>
        </div>
        <div class="flex flex-wrap -m-4">
            <?php
    if (!empty($img)) {
        echo $img;
    } else {
        if (!empty($ids)) {
            foreach ($ids as $id) {
?>
            <div class="xl:w-1/4 md:w-1/2 p-4">
                <div class="bg-gray-800 bg-opacity-40 p-6 rounded-lg">
                    <?php
                if (!empty($id['front'])) {
?>
                    <img class="h-40 rounded w-full object-cover object-center mb-6" src="<?= $id['front']; ?>"
                        alt="content">
                    <?php
                }
?>
                    <h3 class="tracking-widest text-red-400 text-xs font-medium title-font">Document</h3>
                    <h2 class="text-lg text-white font-medium title-font mb-4"><?= $id['name']; ?></h2>
                    <p class="leading-relaxed text-base">
                        <a href="profile.php?doc_id=<?= $id['id']; ?>"
                            class="text-red-500 inline-flex items-center md:mb-2 lg:mb-0">Expand
                            <svg class="w-4 h-4 ml-2" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"
                                fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M5 12h14"></path>
                                <path d="M12 5l7 7-7 7"></path>
                            </svg>
                        </a>
                    </p>
                </div>
            </div>
            <?php
            }
        }
    }
?>
        </div>
    </div>
</section>
<?php
}
include("includes/footer.php"); // include the footer part
?>