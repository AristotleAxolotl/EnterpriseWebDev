<?php
include 'DBConnection.php';
require 'dbconn_main.php';
session_start();
//secure log in
if ($_SERVER['HTTPS'] != 'on') {
    echo '<script type="text/javascript">window.location = "https://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'] . '";</script>';
  }
$error = $username_error = "";
$username_test = "";

if(isset ($_POST['submit'])){
  if(empty($_POST['username']) || empty($_POST['password'])){
    $error = "Please insert username and password";
  }else{
    $username = $_POST['username'];
    $password = $_POST['password'];
    $username = stripslashes($username);
    $password = stripslashes($password);

    $sql = "select * from users where (Username='$username' or Email ='$username') and UserPassword='$password'";
    $result = $conn->query($sql);
      
    if($result->num_rows==1){
        $row=$result->fetch_assoc();
        $userID = $row['UserID'];
        
      $_SESSION['login_user'] = $username;
      $_SESSION['UserID'] = $userID;
        
      header('Location: user.php');
    }else{
      $error = "Username or password is not vaild";
    }
    $conn -> close();
  }
}
?>
