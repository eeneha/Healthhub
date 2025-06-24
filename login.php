<?php 
session_start(); 
require('db_connectivity.php'); 

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (!empty($_POST['email']) && !empty($_POST['password'])) {
        $email = $_POST['email'];
        $password = $_POST['password'];

        // Prevention From SQL Injection
        $query = "SELECT * FROM `users` WHERE `email` = ?";
        $stmt = $conn->prepare($query); 
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result && $result->num_rows === 1) {
            $row = $result->fetch_assoc();

            if ($row && password_verify($password, $row['password'])) {
                // Set session variables to mark user as logged in
                $_SESSION['user_id'] = $row['user_id'];  // Adjust 'user_id' if your DB uses a different column name
                $_SESSION['user_name'] = $row['name'];   // Optional: store username for display
                
                header("Location: hospital_search.php"); 
                exit(); 
            } else {
          echo "<script>
        alert('Login failed: Incorrect password.');
        window.location.href = 'login_registration.html';
        </script>";
            exit;
            }
        } else {
            echo "<script>alert('Login failed: Email not found.')
            window.location.href = 'login_registration.html'; </script>";
        }
    } else { 
        echo "<script>alert('Please provide both email and password.')
        window.location.href = 'login_registration.html'; </script>";
    }
}
?>
