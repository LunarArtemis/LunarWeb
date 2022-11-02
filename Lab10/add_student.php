<?php
    session_start();

    $sql = "SELECT * FROM students";
    $result = $conn->query($sql);
    $id = $result->num_rows + 1;
    $nameErr = $lastnameErr = $majorErr = $dobErr = $emailErr = "";
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        if (empty($_POST["name"])) {
            $nameErr = "Name is required";
            $_SESSION["nameErr"] = $nameErr;
        } else {
            $name = $_POST["name"];
            $_SESSION["nameErr"] = "";
        }
        if (empty($_POST["lastname"])) {
            $lastnameErr = "Last Name is required";
            $_SESSION["lastnameErr"] = $lastnameErr;
        } else {
            $lastname = $_POST["lastname"];
            $_SESSION["lastnameErr"] = "";
        }
        if (empty($_POST["major"])) {
            $majorErr = "Major is required";
            $_SESSION["majorErr"] = $majorErr;
        } else {
            $major = $_POST["major"];
            $_SESSION["majorErr"] = "";
        }
        if (empty($_POST["dob"])) {
            $dobErr = "Date of Birth is required";
            $_SESSION["dobErr"] = $dobErr;
        } else {
            $dob = $_POST["dob"];
            $_SESSION["dobErr"] = "";
        }
        if (empty($_POST["email"])) {
            $emailErr = "Email is required";
            $_SESSION["emailErr"] = $emailErr;
        } else {
            $email = $_POST["email"];
            $_SESSION["emailErr"] = "";
        }
        if($_POST['phone'] == ""){
            $phone = NULL;
        }else{$phone = $_POST['phone'];}
        echo $name . " " . $lastname . " " . $major . " " . $dob . " " . $email . " " . $phone;
    }
    if(!(empty($name) || empty($lastname) || empty($major) || empty($dob) || empty($email))){
    $stmt = $conn->prepare("INSERT INTO `students` (`id`, `name`, `lastname`, `major`, `dob`, `email`, `phone`) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("issssss",$id,$name,$lastname,$major,$dob,$email,$phone);
    $stmt->execute();
    $stmt->close();
    }
    header("Location:admin.php");
    $conn->close();
?>
