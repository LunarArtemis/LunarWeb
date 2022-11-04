<?php

use LDAP\Result;

require('config.php');
session_start();
// Check if user not logged in
if (!isset($_SESSION["login"])) {
    header("location: login.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>User</title>

        <link rel="icon" type="image/x-icon" href="/res/webICO.ico" />
        <!-- tailwindcss -->
        <link href="https://unpkg.com/tailwindcss/dist/tailwind.min.css" rel="stylesheet">
        <!-- flowbite -->
        <link rel="stylesheet" href="https://unpkg.com/flowbite@1.5.3/dist/flowbite.min.css" />
        <script src="https://unpkg.com/flowbite@1.5.3/dist/flowbite.js"></script>
        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
        <script src="https://unpkg.com/flowbite@1.5.3/dist/datepicker.js"></script>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />
    </head>

<body class="bg-gray-50 dark:bg-gray-900"">
    <!-- Nav bar -->
    <nav class=" bg-white px-2 sm:px-4 py-2.5 dark:bg-gray-900 fixed w-full z-20 top-0 left-0 border-b border-gray-200 dark:border-gray-600">
    <div class="container flex flex-wrap justify-between items-center mx-auto">
        <a href="https://lunarartemis.onuniverse.com/" class="flex items-center" target="_blank">
            <img src="/res/webLogo.png" class="mr-3 h-6 sm:h-9 invert dark:invert-0" alt="Flowbite Logo" />
            <span class="text-gray-700 self-center text-xl font-semibold whitespace-nowrap dark:text-white">Lunar Artemis</span>
        </a>
        <button data-collapse-toggle="navbar-sticky" type="button" class="bg-gray-50 inline-flex items-center p-2 ml-3 text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600" aria-controls="navbar-default" aria-expanded="false">
            <span class="sr-only">Open main menu</span>
            <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z" clip-rule="evenodd"></path>
            </svg>
        </button>
        <div class="hidden w-full bg-gray-50 md:block md:w-auto" id="navbar-sticky">
            <ul class="flex flex-col p-4 mt-4 bg-gray-50 rounded-lg border border-gray-100 md:flex-row md:space-x-8 md:mt-0 md:text-sm md:font-medium md:border-0 md:bg-white dark:bg-gray-800 md:dark:bg-gray-800 dark:border-gray-700">
                <li class="flex items-center space-x-2">
                    <p class="text-md text-gray-700 space-x-4">Welcome
                        <?php echo "<span class='text-xl font-medium text-blue-500 space-x-4'>" . $_SESSION['username'] . "</span>" . " Your permission is" . "<span class='text-purple-600 text-xl font-medium'>" . $_SESSION['role'] . "</span>" ?></p>
                </li>
                <li>
                    <?php if (isset($_SESSION['role'])) { ?>
                        <button type="button" class="text-white inline-flex items-center mt-3 bg-gradient-to-r from-red-400 via-red-500 to-red-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 shadow-lg shadow-red-500/50 dark:shadow-lg dark:shadow-red-800/80 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15m3 0l3-3m0 0l-3-3m3 3H9" />
                            </svg><a href="logout.php">Sign out</a></button>
                    <?php } ?>
                </li>
            </ul>
        </div>
    </div>
    </nav>

    <section class="py-12 pt-52">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="lg:text-center">
                <h2 class="text-base text-blue-600 font-semibold tracking-wide uppercase">Students</h2>
                <p class="mt-2 text-3xl leading-8 font-extrabold tracking-tight text-gray-900 sm:text-4xl">
                    All Students
                </p>
                <p class="mt-4 max-w-2xl text-xl text-gray-500 lg:mx-auto">
                    All students in the database
                </p>
            </div>
        </div>
    </section>

    <section class=" bg-gray-50 dark:bg-gray-900">
        <div class=" max-w-7xl mx-auto px-4 relative shadow-md sm:px-6 lg:px-8 sm:rounded-lg">
            <?php
            $sql = "SELECT * FROM students";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                echo '<table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">';
                echo '<thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">';
                echo '<tr><th class="py-3 px-6">ID</th><th class="py-3 px-6">Name</th><th class="py-3 px-6">Last Name</th><th class="py-3 px-6">Major</th><th class="py-3 px-6">DOB</th><th class="py-3 px-6">Email</th><th class="py-3 px-6">Phone</th></tr>';
                while ($row = $result->fetch_assoc()) {
                    if ($row["id"] % 2 == 0) {
                        echo '<tr class="bg-gray-50 border-b dark:bg-gray-800 dark:border-gray-700"><td class="py-3 px-6">' . $row["id"] . '</td><td class="py-3 px-6">' . $row["name"] . '</td><td class="py-3 px-6">' . $row["lastname"] . '</td><td class="py-3 px-6">' . $row["major"] . '</td><td class="py-3 px-6">' . $row["dob"] . '</td><td class="py-3 px-6">' . $row["email"] . '</td><td class="py-3 px-6">' . $row["phone"] . '</td></tr>';
                    } else if ($row["id"] % 2 == 1) {
                        echo '<tr class="bg-white border-b dark:bg-gray-900 dark:border-gray-700"><td class="py-3 px-6">' . $row["id"] . '</td><td class="py-3 px-6">' . $row["name"] . '</td><td class="py-3 px-6">' . $row["lastname"] . '</td><td class="py-3 px-6">' . $row["major"] . '</td><td class="py-3 px-6">' . $row["dob"] . '</td><td class="py-3 px-6">' . $row["email"] . '</td><td class="py-3 px-6">' . $row["phone"] . '</td></tr>';
                    }
                }
                echo "</table>";
            } else {
                echo "0 results";
            }
            $conn->close();
            ?>
        </div>
    </section>
</body>

</html>