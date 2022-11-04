<?php
require('config.php');
session_start();
$stmt = $conn->prepare("UPDATE `students` SET `name` = ?, `lastname` = ?, `major` = ?, `dob` = ?, `email` = ?, `phone` = ? WHERE `students`.`id` = ?");
$stmt->bind_param("ssssssi", $name, $lastname, $major, $dob, $email, $phone, $id);
$id = $_POST['id'];
$name = $_POST['name'];
$lastname = $_POST['lastname'];
$major = $_POST['major'];
$dob = $_POST['dob'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$stmt->execute();
header("Location:admin.php");
$stmt->close();
$conn->close();
?>