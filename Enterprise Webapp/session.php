<?php
require 'dbconn/dbconn_main.php';
session_start();// Starting Session
// Storing Session
#$time = $_SERVER['REQUEST_TIME'];
#$timeout_in = 1800;
$user_check=$_SESSION['login_user'];
// SQL Query To Fetch Complete Information Of User
$sql= "select username from user_data where username='$user_check'";
$row = $conn->query($sql);
$login_session =$row->fetch_assoc();
if(!isset($login_session)){
$conn ->close(); // Closing Connection
header('Location: index.php'); // Redirecting To Home Page
}
?>
