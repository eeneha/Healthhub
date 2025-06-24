<?php 
session_start();
require ('db_connectivity.php'); 
$username = ""; 
$name = "";
$email = "";

if (isset($_SESSION['user_id'])) {
    $userId = $_SESSION['user_id'];
    
    $conn = new mysqli("localhost", "root", "", "healthhub");
    
    if (!$conn->connect_error) {
        $stmt = $conn->prepare("SELECT `name`, `username`,`email` FROM `users` WHERE `user_id` = ?");
        $stmt->bind_param("i", $userId);
        $stmt->execute();

        $result = $stmt->get_result();
        if ($result->num_rows === 1) {
            $user = $result->fetch_assoc();
            $name = $user['name'];
            $email = $user['email'];
            $username = $user['username'];
        }

        $stmt->close();
        $conn->close();
    }
}
?>

    