<?php
// This page adds new documents
$title = "Add Document";
include("inc/header.php");
if (!checkLogin()) {
    header("Location: login.php");
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
            header("Location: profile.php");
        } else {
            header("Location: add.php");
        }
    } else {
        // show the upload form if nothing was submitted
?>
<section class="text-gray-400 bg-gray-900 body-font">
    <div class="container px-5 py-24 mx-auto flex flex-wrap items-center">
        <div class="lg:w-3/5 md:w-1/2 md:pr-16 lg:pr-0 pr-0">
            <h1 class="title-font font-medium text-3xl text-white">Login to your account</h1>
            <p class="leading-relaxed mt-4">To get access to your account, please login with your username and password.
            </p>
        </div>
        <div
            class="lg:w-2/6 md:w-1/2 bg-gray-800 bg-opacity-50 rounded-lg p-8 flex flex-col md:ml-auto w-full mt-10 md:mt-0">
            <form method="post" action="add.php" enctype="multipart/form-data">
                <h2 class="text-white text-lg font-medium title-font mb-5">Add Document</h2>
                <div class="relative mb-4">
                    <label for="name" class="leading-7 text-sm text-gray-400">Document Name/Type</label>
                    <input type="text" id="name" name="name"
                        class="w-full bg-gray-600 bg-opacity-20 focus:bg-transparent focus:ring-2 focus:ring-red-900 rounded border border-gray-600 focus:border-red-500 text-base outline-none text-gray-100 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out"
                        required>
                </div>
                <div class="relative mb-4">
                    <label for="front" class="leading-7 text-sm text-gray-400">Front Side</label>
                    <input type="file" id="front" name="front"
                        class="w-full bg-gray-600 bg-opacity-20 focus:bg-transparent focus:ring-2 focus:ring-red-900 rounded border border-gray-600 focus:border-red-500 text-base outline-none text-gray-100 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out"
                        required>
                </div>
                <div class="relative mb-4">
                    <label for="back" class="leading-7 text-sm text-gray-400">Back Side</label>
                    <input type="file" id="back" name="back"
                        class="w-full bg-gray-600 bg-opacity-20 focus:bg-transparent focus:ring-2 focus:ring-red-900 rounded border border-gray-600 focus:border-red-500 text-base outline-none text-gray-100 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out"
                        required>
                </div>
                <button type="submit"
                    class="text-white bg-red-500 border-0 py-2 px-6 focus:outline-none hover:bg-red-600 rounded text-lg">Upload</button>
            </form>
        </div>
    </div>
</section>
<?php
    }
}
include("inc/footer.php");
?>