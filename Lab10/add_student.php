<?php
    require('config.php');
    session_start();

    // SQL path : /64102010078.sql
    
    $sql = "SELECT * FROM students";
    $result = $conn->query($sql);
    $id = $result->num_rows + 1;

    $stmt = $conn->prepare("INSERT INTO `students` (`id`, `name`, `lastname`, `major`, `dob`, `email`, `phone`) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("issssss",$id,$name,$lastname,$major,$dob,$email,$phone);
    $name = $_POST['name'];
    $lastname = $_POST['lastname'];
    $major = $_POST['major'];
    $dob = date('Y-m-d',strtotime(str_replace('/', '-', $_POST['dob'])));  // Convert date format from dd/mm/yyyy to yyyy-mm-dd for MySQL
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $stmt->execute();
    header("Location:admin.php");
    $stmt->close();
    $conn->close();
    
?>
