<?php
session_start();
require('db_connectivity.php'); 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['Name'];
    $dob = $_POST['dob'];
    $gender = $_POST['gender'];
    $phone_number = $_POST['phone'];
    $email = $_POST['email'];
    $username = $_POST['username'];
    $password = $_POST['password'];

    //Password Hashing. 
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
  
    $check_email = "SELECT `email` FROM `users` WHERE `email` = '$email'";
    $result = mysqli_query($conn, $check_email);
    $count = mysqli_num_rows($result);
    if ($count > 0) {
        echo "Email Already Exists!";
    } 
    else {
        // Parameterised Queries
        $query = "INSERT INTO `users` (`name`, `dob`, `gender`, `email`, `phone`, `username`, `password`) 
              VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("sssssss", $name, $dob, $gender, $email, $phone_number, $username, $hashed_password);
        $stmt->execute();

        if ($stmt) {
            header("Location: login_registration.html");
            exit(); 
    
        } else {
            echo  "<script>
            alert('Sorry! Registration Failed. Please try again later!')
            </script>";
        }
    }
} 
    $conn->close();
    ?>
    
