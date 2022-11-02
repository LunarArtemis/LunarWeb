<?php

$name = $email = $website = $comment = $gender = ""; //initializing variables
$nameErr = $emailErr = $websiteErr = $genderErr = ""; //Error variables

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if (empty($_POST["name"])) {
        $nameErr = "Name is required";
    } else {
        $name = inputtest($_POST["name"]);
        if (!preg_match("/^[a-zA-Z ]*$/", $name)) {
            $nameErr = "Only letters and white space allowed";
        }
    }

    if (empty($_POST["email"])) {
        $emailErr = "Email is required";
    } else {
        $email = Inputtest($_POST["email"]);
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $emailErr = "The email address is incorrect";
        }
    }

    if (empty($_POST["comment"])) {
        $comment = "";
    } else {
        $comment = Inputtest($_POST["comment"]);
    }

    if (empty($_POST["website"])) {
        $websiteErr = "Website is required";
    } else {
        $website = Inputtest($_POST["website"]);
        if (!preg_match("/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i", $website)) {
            $websiteErr = "Invalid URL";
        }
    }

    if (empty($_POST["gender"])) {
        $genderErr = "Please select a gender";
    } else {
        $gender = Inputtest($_POST["gender"]);
    }
}

function Inputtest($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

?>
<html>

<head>
    <title>Form</title>
    <link rel="icon" type="image/x-icon" href="/res/webICO.ico" />
    <!-- tailwindcss -->
    <link href="https://unpkg.com/tailwindcss/dist/tailwind.min.css" rel="stylesheet">
    <!-- flowbite -->
    <link href="https://fonts.googleapis.com/css?family=Kanit&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/flowbite@1.5.3/dist/flowbite.min.css" />
    <script src="https://unpkg.com/flowbite@1.5.3/dist/flowbite.js"></script>
</head>

<body>
    <div class="container mx-auto">
        <div class="flex justify-center px-6 my-12">
            <!-- Row -->
            <div class="w-full xl:w-3/4 lg:w-11/12 flex">
                <!-- Col -->
                <div class="w-full h-auto bg-gray-400 hidden lg:block lg:w-1/2 bg-cover border rounded-l-lg" style="background-image: url('https://ionicframework.com/img/meta/ionic-framework-og.png')"></div>
                <!-- Col -->
                <div class="w-full lg:w-1/2 bg-white p-5 rounded-lg lg:rounded-l-none">
                    <h3 class="pt-4 text-2xl text-center font-extrabold">Form Validation</h3>
                    <form class="px-8 pt-6 pb-8 mb-4 bg-white rounded" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                        <!--require enter fullname letter and space only-->
                        <div class="mb-4">
                            <label class="block mb-2 text-sm font-bold text-gray-700" for="fullname">
                                Full Name
                            </label>
                            <input class="w-full px-3 py-2 mb-3 text-sm leading-tight text-gray-700 border border-red-500 rounded shadow appearance-none focus:outline-none focus:shadow-outline" id="name" type="text" name="name" placeholder="Full Name" required pattern="[a-zA-Z\s]+" title="Please enter only letters and space" />
                            <p class="text-xs italic text-red-500">Please choose a name.</p>
                        </div>
                        <!-- enter email -->
                        <div class="mb-4">
                            <label class="block mb-2 text-sm font-bold text-gray-700" for="email">
                                Email
                            </label>
                            <input class="w-full px-3 py-2 mb-3 text-sm leading-tight text-gray-700 border border-red-500 rounded shadow appearance-none focus:outline-none focus:shadow-outline" id="email" type="email" placeholder="example@email.com" name="email" required />
                            <p class="text-xs italic text-red-500">Please choose a email.</p>
                        </div>
                        <!-- website input optional-->
                        <div class="mb-4">
                            <label class="block mb-2 text-sm font-bold text-gray-700" for="website">
                                Website
                            </label>
                            <input class="w-full px-3 py-2 text-sm leading-tight text-gray-700 border rounded shadow appearance-none focus:outline-none focus:shadow-outline" id="website" type="url" placeholder="Website" name="website" />
                        </div>
                        <!-- gender select -->
                        <div class="mb-4">
                            <label class="block mb-2 text-sm font-bold text-gray-700" for="gender">
                                Gender
                            </label>
                            <div class="mb-1">
                                <input id="gender" type="radio" value="male" name="gender" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                <label for="gender" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">Male</label>
                            </div>
                            <div>
                                <input checked="" id="gender" type="radio" value="female" name="gender" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                <label for="gender" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">Female</label>
                            </div>
                        </div>
                        <!-- comment -->
                        <div class="mb-4">
                            <label class="block mb-2 text-sm font-bold text-gray-700" for="comment">
                                Comment
                            </label>
                            <textarea class="w-full px-3 py-2 mb-3 text-sm leading-tight text-gray-700 border rounded shadow appearance-none focus:outline-none focus:shadow-outline" id="comment" type="text" placeholder="Text here!" name="comment"></textarea>
                        </div>
                        <div class="mb-6 text-center">
                            <button class="w-full px-4 py-2 font-bold text-white bg-blue-500 rounded-full hover:bg-blue-700 focus:outline-none focus:shadow-outline" type="submit" value="Submit">
                                Submit
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <?php
    echo "<h1>Your Input</h1>";
    echo "Your Name: $name <br>";
    echo "Your Email: $email <br>";
    echo "Your Website: $website <br>";
    echo "Your Comment: $comment <br>";
    echo "Your Gender: $gender <br>";
    ?>
</body>
</html>