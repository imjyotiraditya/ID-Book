<?php
// this is the home page
$title = "Home Page"; // set page title
include("includes/header.php"); // include the header file
?>
<section class="text-gray-400 bg-gray-900 body-font">
    <div class="container mx-auto flex px-5 py-24 md:flex-row flex-col items-center">
        <div
            class="lg:flex-grow md:w-1/2 lg:pr-24 md:pr-16 flex flex-col md:items-start md:text-left mb-16 md:mb-0 items-center text-center">
            <h1 class="title-font sm:text-4xl text-3xl mb-4 font-medium text-white">Store all your
                <br class="hidden lg:inline-block">documents / ID's here
            </h1>
            </h1>
            <p class="mb-8 leading-relaxed">Maintain your documents and ID's in one place and access them anytime
                anywhere.
            </p>
            <div class="flex justify-center">
                <?php
if (!checkLogin()) {
?>
                <button onclick="window.location.href='login.php'"
                    class="inline-flex text-white bg-red-500 border-0 py-2 px-6 focus:outline-none hover:bg-red-600 rounded text-lg">Login</button>
                <button onclick="window.location.href='register.php'"
                    class="ml-4 inline-flex text-white bg-red-500 border-0 py-2 px-6 focus:outline-none hover:bg-red-600 rounded text-lg">Register</button>
                <?php
} else {
?>
                <button onclick="window.location.href='profile.php'"
                    class="inline-flex text-white bg-red-500 border-0 py-2 px-6 focus:outline-none hover:bg-red-600 rounded text-lg">Profile</button>
                <?php
}
?>
            </div>
        </div>
        <div class="lg:max-w-lg lg:w-full md:w-1/2 w-5/6">
            <img class="object-cover object-center rounded" alt="hero" src="assets/img/hero.png" height="600"
                width="720">
        </div>
    </div>
</section>
<section class="text-gray-400 bg-gray-900 body-font">
    <div class="container px-5 py-24 mx-auto">
        <div class="flex flex-col text-center w-full mb-20">
            <h1 class="sm:text-3xl text-2xl font-medium title-font mb-4 text-white">Why choose us?</h1>
            <p class="lg:w-2/3 mx-auto leading-relaxed text-base">ID-Book is a web application that allows you to
                store all your documents and ID's in one place and access them anytime anywhere.
            </p>
        </div>
        <div class="flex flex-wrap -m-2 text-center">
            <div class="p-4 md:w-1/2 sm:w-1/2 w-full">
                <div class="border-2 border-gray-800 px-4 py-6 rounded-lg">
                    <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                        stroke-width="2" class="text-red-400 w-12 h-12 mb-3 inline-block" viewBox="0 0 24 24">
                        <path d="M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2"></path>
                        <circle cx="9" cy="7" r="4"></circle>
                        <path d="M23 21v-2a4 4 0 00-3-3.87m-4-12a4 4 0 010 7.75"></path>
                    </svg>
                    <h2 class="title-font font-medium text-3xl text-white"><?php
$sql    = 'SELECT * FROM profiles';
$result = $conn->query($sql);
echo $result->num_rows;
?></h2>
                    <p class="leading-relaxed">Users</p>
                </div>
            </div>
            <div class="p-4 md:w-1/2 sm:w-1/2 w-full">
                <div class="border-2 border-gray-800 px-4 py-6 rounded-lg">
                    <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                        stroke-width="2" class="text-red-400 w-12 h-12 mb-3 inline-block" viewBox="0 0 24 24">
                        <path d="M3 18v-6a9 9 0 0118 0v6"></path>
                        <path
                            d="M21 19a2 2 0 01-2 2h-1a2 2 0 01-2-2v-3a2 2 0 012-2h3zM3 19a2 2 0 002 2h1a2 2 0 002-2v-3a2 2 0 00-2-2H3z">
                        </path>
                    </svg>

                    <h2 class="title-font font-medium text-3xl text-white">
                        <?php
$sql    = 'SELECT * FROM ids';
$result = $conn->query($sql);
echo $result->num_rows;
?></h2>
                    <p class="leading-relaxed">Files</p>
                </div>
            </div>
        </div>
    </div>
</section>
<?php
include("includes/footer.php"); // include the footer part
?>