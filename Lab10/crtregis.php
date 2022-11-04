<?php
    require('config.php');
    session_start();

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // if username duplicate in database
    $sql = "SELECT * FROM users WHERE username = '" . $_POST['username'] . "'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $_SESSION['error_regis'] = "Username already exists";
        header("Location: login.php#regisSection");
        exit();
    } else {
        // create new user defualt role is user
    $stmt = $conn->prepare("INSERT INTO `users` (`username`, `password`, `role`) VALUES (?, ?, ?)");
    $stmt->bind_param("sss",$username,$password,$role);
    $username = $_POST['username'];
    $password = md5($_POST['password']);
    $role = "user";
    $stmt->execute();
    $_SESSION['success_msg']="User Created";
    header("Location:login.php#regisSection");
    $stmt->close();
    $conn->close();
    }