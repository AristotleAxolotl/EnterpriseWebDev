<?php
require 'dbconnection/dbconn_main.php';
session_start();
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
      $_SESSION['login_user'] = $username;
      header('Location: user.php');
    }else{
      $error = "Username or password is not vaild";
    }
    $conn -> close();
  }
}
?>
