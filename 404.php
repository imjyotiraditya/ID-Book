<?php
// this is the home page
$title = "404 Not Found"; // set page title
include("includes/header.php"); // include the header file
?>
<section class="text-gray-400 bg-gray-900 body-font">
    <div class="container mx-auto flex px-5 py-24 items-center justify-center flex-col">
        <img class="lg:w-2/6 md:w-3/6 w-5/6 mb-10 object-cover object-center rounded" alt="hero">
        <div class="text-center lg:w-2/3 w-full">
            <h1 class="title-font sm:text-4xl text-3xl mb-4 font-medium text-white">Oops!</h1>
            <p class="leading-relaxed mb-8">The page you are looking for does not exist.</p>
        </div>
    </div>
</section>
<?php
include("includes/footer.php"); // include the footer part
?>
