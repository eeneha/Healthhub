<?php 
session_start(); 
require ('db_connectivity.php'); 
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
        $dob = trim($_POST['dob']);
        $email = trim($_POST['email']);

        $query = "SELECT * FROM `users` WHERE `email` = ? AND `dob` = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("ss", $email, $dob);
        $stmt->execute();
        $result = $stmt->get_result();
        $rowcnt = mysqli_num_rows($result); 

        if($rowcnt==1){
            $row = mysqli_fetch_assoc($result); 
            $_SESSION['reset_email'] = $email; 
            header("Location: reset_password.html");
            exit();
        } else {
            echo "
            <script>
                alert('Invalid Email or Date Of Birth!');
                window.location.href = 'forget_password.html';
            </script>
            ";
            exit();
        }
    }
    ?>
    

 