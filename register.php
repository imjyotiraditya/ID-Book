<?php
$title = "Register";
include("inc/header.php");
include('inc/phpqrcode/qrlib.php');
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
            header("Location: login.php");
            QRcode::png('https://' . $_SERVER['HTTP_HOST'] . '/details.php?id=' . $id, 'qr_codes/qr_' . $id . '.png');
        } else {
            echo '<p class="error">Failed to Register! Please <a href="register.php">Register</a> again. ' . $conn->error . '</p>';
        }
    } else {
?>
<section class="text-gray-400 bg-gray-900 body-font">
    <div class="container px-5 py-24 mx-auto flex flex-wrap items-center">
        <div class="lg:w-3/5 md:w-1/2 md:pr-16 lg:pr-0 pr-0">
            <h1 class="title-font font-medium text-3xl text-white">Register Now</h1>
            <p class="leading-relaxed mt-4">Create your account and start using our services.</p>
        </div>
        <div
            class="lg:w-2/6 md:w-1/2 bg-gray-800 bg-opacity-50 rounded-lg p-8 flex flex-col md:ml-auto w-full mt-10 md:mt-0">
            <form method="post" action="register.php" enctype="multipart/form-data">
                <h2 class="text-white text-lg font-medium title-font mb-5">Sign Up</h2>
                <div class="relative mb-4">
                    <label for="name" class="leading-7 text-sm text-gray-400">Full Name</label>
                    <input type="text" id="name" name="name"
                        class="w-full bg-gray-600 bg-opacity-20 focus:bg-transparent focus:ring-2 focus:ring-red-900 rounded border border-gray-600 focus:border-red-500 text-base outline-none text-gray-100 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out"
                        required>
                </div>
                <div class="relative mb-4">
                    <label for="username" class="leading-7 text-sm text-gray-400">Username</label>
                    <input type="text" id="username" name="username"
                        class="w-full bg-gray-600 bg-opacity-20 focus:bg-transparent focus:ring-2 focus:ring-red-900 rounded border border-gray-600 focus:border-red-500 text-base outline-none text-gray-100 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out"
                        required>
                </div>
                <div class="relative mb-4">
                    <label for="password" class="leading-7 text-sm text-gray-400">Password</label>
                    <input type="password" id="password" name="password"
                        class="w-full bg-gray-600 bg-opacity-20 focus:bg-transparent focus:ring-2 focus:ring-red-900 rounded border border-gray-600 focus:border-red-500 text-base outline-none text-gray-100 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out"
                        required>
                </div>
                <div class="relative mb-4">
                    <label for="fileToUpload" class="leading-7 text-sm text-gray-400">Profile Picture</label>
                    <input type="file" id="fileToUpload" name="fileToUpload"
                        class="w-full bg-gray-600 bg-opacity-20 focus:bg-transparent focus:ring-2 focus:ring-red-900 rounded border border-gray-600 focus:border-red-500 text-base outline-none text-gray-100 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out"
                        required>
                </div>
                <button type="submit"
                    class="text-white bg-red-500 border-0 py-2 px-6 focus:outline-none hover:bg-red-600 rounded text-lg">Register</button>
            </form>
        </div>
    </div>
</section>
<?php
    }
}
include("inc/footer.php");
?>