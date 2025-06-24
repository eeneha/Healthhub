<?php 
session_start(); 
session_unset(); 
session_destroy(); 
echo "session has been logout successfully!"; 
header("Location: login.html"); 
?>