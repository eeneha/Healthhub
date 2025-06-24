<?php
session_start();
include ('db_connectivity.php');

if (!isset($_SESSION['reset_email'])) {
    header("Location: login.html");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    if (empty($password) || empty($confirm_password) ) {
        echo "<script>alert('Passwords can't be empty! Please fill all the fields!'); 
        window.location.href='reset_password.html';</script>";
        exit();
    }
    
    
    if ($password !== $confirm_password) {
        echo "<script>alert('Passwords do not match!'); 
        window.location.href='reset_password.html';</script>";
        exit();
    }
    
    if(strlen($password)<8 || strlen($password)>20 ) { 
        echo "<script>alert('Password must be at least 8 and 20 characters!'); 
        window.location.href='reset_password.html';</script>";
        exit();
    }

        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $email = $_SESSION['reset_email'];

        $query = "UPDATE `users` SET `password` = ? WHERE `email` = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("ss", $hashed_password, $email);
        $stmt->execute(); 


        
            session_destroy();
            echo "<script>alert('Password updated successfully!'); 
            window.location.href='login_registration.html';</script>";
        } else {
            echo "<script>alert('Error updating password');
            window.location.href='reset_password.php';</script>";;
        }
    

?>

