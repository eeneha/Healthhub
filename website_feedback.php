<?php
require('db_connectivity.php'); 

if ($_SERVER["REQUEST_METHOD"] == "POST") { 
    $name = isset($_SESSION['name']);
    $liked_most = $_POST['liked_most'];
    $improvements = $_POST['improvements'];
    $recommend = $_POST['recommend'];
    $additional_comments = $_POST['additional_comments'];

    $query = "INSERT INTO website_feedback (name, liked_most, improvements, recommend, additional_comments) 
              VALUES (?, ?, ?, ?, ?)";
    
    $stmt = $conn->prepare($query);
    $stmt->bind_param("sssss", $name, $liked_most, $improvements, $recommend, $additional_comments);
    
    if ($stmt->execute()) {
        echo "Feedback Successfully Submitted!";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>
