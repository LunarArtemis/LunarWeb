<?php

use LDAP\Result;

require('config.php');
session_start();

// Check user permission
if ($_SESSION["role"] !== "admin" && $_SESSION["login"] == true) {
    header("location: user.php");
    exit;
}
// Check if user not logged in
if (!isset($_SESSION["login"])) {
    header("location: login.php");
    exit;
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>

    <link rel="icon" type="image/x-icon" href="/res/webICO.ico" />
    <!-- tailwindcss -->
    <link href="https://unpkg.com/tailwindcss/dist/tailwind.min.css" rel="stylesheet">
    <!-- flowbite -->
    <link rel="stylesheet" href="https://unpkg.com/flowbite@1.5.3/dist/flowbite.min.css" />
    <script src="https://unpkg.com/flowbite@1.5.3/dist/flowbite.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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
                        <?php echo "<span class='text-xl font-medium text-blue-500 space-x-8'> " . $_SESSION['username'] . " </span>" . " Your permission is" . "<span class='text-purple-600 text-xl font-medium'>" . $_SESSION['role'] . "</span>" ?></p>
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
    <!-- End Nav bar -->

    <section class=" bg-gray-50 pt-52 dark:bg-gray-900">
        <div class="flex items-center justify-center px-6 py-8  mx-auto  w-8/12 lg:py-0">
            <div class=" bg-white rounded-lg shadow dark:border md:mt-0 sm:max-w-md xl:p-0 dark:bg-gray-800 dark:border-gray-700">
                <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
                    <h1 class="text-2xl font-bold leading-tight tracking-tight text-blue-600 md:text-2xl dark:text-white">
                        Insert Data
                    </h1>
                    <form action="add_student.php" method="post">
                        <div class="grid md:grid-cols-2 md:gap-6">
                            <div class="relative z-0 mb-6 w-full group">
                                <input type="text" name="name" id="name" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required />
                                <label for="name" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Name</label>
                            </div>
                            <div class="relative z-0 mb-6 w-full group">
                                <input type="text" name="lastname" id="lastname" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required />
                                <label for="lastname" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Last name</label>
                            </div>
                        </div>

                        <div class="relative z-0 mb-6 w-full group">
                            <input type="text" name="email" id="email" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required />
                            <label for="email" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Email</label>
                        </div>

                        <div class="relative z-0 mb-6 w-full group">
                            <input type="text" name="phone" id="phone" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required />
                            <label for="phone" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Phone</label>
                        </div>

                        <div class="relative z-0 mb-6 w-full group">
                            <label for="dob" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Date of Birth</label>
                            <div class="relative">
                                <div class="flex absolute inset-y-0 left-0 items-center pl-3 pointer-events-none">
                                    <svg aria-hidden="true" class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"></path>
                                    </svg>
                                </div>
                                <input datepicker datepicker-autohide type="text" name="dob" id="dob" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Select date">
                            </div>
                        </div>

                        <!-- major selection -->
                        <div class="relative z-0 mb-6 w-full group">
                            <label for="major" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-400">Major</label>
                            <select name="major" id="major" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                <option value="" disabled selected>Choose a major</option>
                                <option value="CS">CS</option>
                                <option value="Stat">Stat</option>
                                <option value="Math">Math</option>
                            </select>
                        </div>

                        <!-- Insert and clear feild button -->
                        <div class="flex justify-center space-x-5">
                            <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                Insert
                            </button>
                            <button type="reset" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                                Clear
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <section class="py-12 pt-20">
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
            $editBTN = '<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-blue-500 edit" id="edit">
                <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" /></svg>';
            $delBTN = '<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-red-500 delete" id="delete">
                <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" /></svg>';
            if ($result->num_rows > 0) {
                echo '<table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">';
                echo '<thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">';
                echo '<tr><th class="py-3 px-6">ID</th><th class="py-3 px-6">Name</th><th class="py-3 px-6">Last Name</th><th class="py-3 px-6">Major</th><th class="py-3 px-6">DOB</th><th class="py-3 px-6">Email</th><th class="py-3 px-6">Phone</th><th class="py-3 px-6">Edit and Delete</th></tr>';
                while ($row = $result->fetch_assoc()) {
                    if ($row["id"] % 2 == 0) {
                        echo '<tr class="bg-gray-50 border-b dark:bg-gray-800 dark:border-gray-700"><td class="py-3 px-6">' . $row["id"] . '</td><td class="py-3 px-6">' . $row["name"] . '</td><td class="py-3 px-6">' . $row["lastname"] . '</td><td class="py-3 px-6">' . $row["major"] . '</td><td class="py-3 px-6">' . $row["dob"] . '</td><td class="py-3 px-6">' . $row["email"] . '</td><td class="py-3 px-6">' . $row["phone"] . '</td><td class="py-3 px-6"><div class="inline-flex space-x-4">' . $editBTN . $delBTN . '</div></td></tr>';
                    } else if ($row["id"] % 2 == 1) {
                        echo '<tr class="bg-white border-b dark:bg-gray-900 dark:border-gray-700"><td class="py-3 px-6">' . $row["id"] . '</td><td class="py-3 px-6">' . $row["name"] . '</td><td class="py-3 px-6">' . $row["lastname"] . '</td><td class="py-3 px-6">' . $row["major"] . '</td><td class="py-3 px-6">' . $row["dob"] . '</td><td class="py-3 px-6">' . $row["email"] . '</td><td class="py-3 px-6">' . $row["phone"] . '</td><td class="py-3 px-6"><div class="inline-flex space-x-4">' . $editBTN . $delBTN . '</div></td></tr>';
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

    <script>
        // contenteditable attribute when click on edit button
        const editBTN = document.querySelectorAll('.edit');
        editBTN.forEach((btn) => {
            btn.addEventListener('click', (e) => {
                const parent = e.target.parentElement.parentElement.parentElement;
                const id = parent.children[0].textContent;
                const name = parent.children[1];
                const lastname = parent.children[2];
                const major = parent.children[3];
                const dob = parent.children[4];
                const email = parent.children[5];
                const phone = parent.children[6];
                name.setAttribute('contenteditable', 'true');
                lastname.setAttribute('contenteditable', 'true');
                major.setAttribute('contenteditable', 'true');
                dob.setAttribute('contenteditable', 'true');
                email.setAttribute('contenteditable', 'true');
                phone.setAttribute('contenteditable', 'true');
                name.focus();


                // chane edit button to save button
                btn.innerHTML = '<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-green-500 save" id="save"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" /></svg>';
                btn.classList.remove('edit');
                btn.classList.add('save');
                // update data when click on save button
                const saveBTN = document.querySelectorAll('.save');
                saveBTN.forEach((btn) => {
                    btn.addEventListener('click', (e) => {
                        const parent = e.target.parentElement.parentElement.parentElement;
                        const id = parent.children[0].textContent;
                        const name = parent.children[1].textContent;
                        const lastname = parent.children[2].textContent;
                        const major = parent.children[3].textContent;
                        const dob = parent.children[4].textContent;
                        const email = parent.children[5].textContent;
                        const phone = parent.children[6].textContent;
                        const data = {
                            id: id,
                            name: name,
                            lastname: lastname,
                            major: major,
                            dob: dob,
                            email: email,
                            phone: phone
                        }

                        // change save button to edit button
                        btn.innerHTML = '<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-blue-500 edit" id="edit"><path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" /></svg>';
                        btn.classList.remove('save');
                        btn.classList.add('edit');
                        // send data to update.php using ajax
                        $.ajax({
                            url: 'update.php',
                            type: 'POST',
                            data: data,
                            success: function(data) {
                                location.reload();
                            }
                        });
                    })
                })
            });
        });

        // swal alert when click on delete button ask for confirmation
        // warning data deleted can't be recovered
        const delBTN = document.querySelectorAll('.delete');
        delBTN.forEach((btn) => {
            btn.addEventListener('click', (e) => {
                const parent = e.target.parentElement.parentElement.parentElement;
                const id = parent.children[0].textContent;
                const data = {
                    id: id
                }
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        Swal.fire(
                            'Deleted!',
                            'Your file has been deleted.',
                            'success'
                        )
                        $.ajax({
                            url: 'delete.php',
                            type: 'POST',
                            data: data,
                            success: function(data) {
                                location.reload();
                            }
                        });
                    }
                })
            });
        });

        // swal success when click insert button 
        const insertBTN = document.querySelector('#insert');
        insertBTN.addEventListener('click', (e) => {
            swal("Good job!", "Data Inserted Successfully!", "success");
        });
    </script>

</body>

</html>