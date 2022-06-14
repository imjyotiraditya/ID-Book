<?php
$title = "Login";
include("includes/header.php");
if (checkLogin()) {
    header("Location: profile.php");
} else {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // get form data from $_POST method
        $username = $_POST['username'];
        $password = base64_encode($_POST['password']);
        $sql      = 'SELECT * FROM profiles WHERE username="' . $username . '" AND password="' . $password . '"';
        $result   = $conn->query($sql);
        if ($result->num_rows > 0) {
            $_SESSION['logged_in'] = true;
            $_SESSION['username']  = $username;
            header('Location: profile.php');
        } else {
?>
<p class="error">Username or Password is invalid! Please <a href="login.php">Login</a> again.</p>
<?php
        }
    } else {
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
            <form method="post" action="login.php">
                <h2 class="text-white text-lg font-medium title-font mb-5">Login</h2>
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
                <button type="submit"
                    class="text-white bg-red-500 border-0 py-2 px-6 focus:outline-none hover:bg-red-600 rounded text-lg">Login</button>
            </form>
        </div>
    </div>
</section>
<?php
    }
}
include("includes/footer.php");
?>
