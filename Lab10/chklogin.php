<?php
require('config.php');
session_start();
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
if($_SERVER["REQUEST_METHOD"] == "POST"){
    $username = $_POST['username'];
    $password = md5($_POST['password']);
}
$sql = "SELECT * FROM users WHERE username = '$username' and password = '$password'";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    // check if the user is an admin go to admin.php
    while($row = $result->fetch_assoc()) {
        $role = $row['role'];
    }
    if ($role == "admin") {
        $_SESSION["username"] = $username;
        $_SESSION["role"] = $role;
        $_SESSION["password"] = $password;
        $_SESSION["login"] = true;
        header("Location:admin.php");
    } else if ($role == "user") {
        $_SESSION["username"] = $username;
        $_SESSION["role"] = $role;
        $_SESSION["password"] = $password;
        $_SESSION["login"] = true;
        header("Location:user.php");
    }

} else {
    $_SESSION['error_msg']="Wrong Username or Password";
    header('location:login.php');
    exit;
}

//$conn->close();
