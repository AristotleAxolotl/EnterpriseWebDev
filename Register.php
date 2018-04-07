<?php
include 'DBConnection.php';
session_start();
error_reporting(E_ERROR | E_PARSE);
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
	<title>Registration</title>
        <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">   
        <link rel="stylesheet" type="text/css" href="entweb.css">
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600" rel="stylesheet">
</head>
<body>

    <div>
            <ul class="nav nav-pills nav-fill">
                <!-- <li class="nav-item">
                    <a class="navbar-brand" href="#"><img src="Images/logo4.png"</a>
                </li> -->
                <li class="nav-item">
                    <a class="nav-link active" href="Register.php">HOME</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="ideaSample.php">IDEAS</a>
                </li>
                <li class="nav-item pull-right">
                    <a class="nav-link" href="index.php">LOGIN</a>
                </li>
            </ul>
          </div>
    
    
    
<?php

require 'dbconn_main.php';
$usernameError = $emailError = $passrep_error = $captcha_error = "";
$username_test = $email_test = $password_test = $captcha_test = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    if (empty($_POST["usrname"])) {
        $usernameError = "Name is required!";
    } else {
        $username_test = test_input($_POST['usrname']);
        if (!preg_match("/^[a-zA-Z ]*$/", $username_test)) {
            $usernameError = "Only letters required!";
        }
    }
    if (isset($_POST['usrname'])) {
        $sql    = "SELECT * From users where username = '" . $_POST['usrname'] . "'";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            $usernameError = "User already exists!";
        } else {
            echo "fine";
        }
    }
    if (empty($_POST["psw-repeat"])) {
        $passrep_error = "Repeat password!";
    } else {
        $password_test = test_input($_POST['psw-repeat']);
        if (!($_POST["usrpassword"] == $_POST["psw-repeat"])) {
            $passrep_error = "Passwords do not match";
        }
    }
    if (empty($_POST["usremail"])) {
        $eamilError = "Email is required";
    } else {
        $email_test = test_input($_POST["usremail"]);
        if (!filter_var($email_test, FILTER_VALIDATE_EMAIL)) {
            $emailError = "Invalid format!";
        }
    }
    if (isset($_POST["usrcaptcha"]) && $_POST["usrcaptcha"] != "" && $_SESSION["code"] == $_POST["usrcaptcha"]) {
        echo "fine";
    } else {
        $captcha_error = "Captcha is not correct!";
    }
    //if (!($usernameError) && !($emailError) && !($passrep_error) && !($captcha_error))
    if (!($usernameError) && !($emailError) && !($passrep_error)) {
        $confirm_code=md5(uniqid(rand()));
        $itemOne = 'Test Department';
        $itemTwo = '1';
        insertUser($_POST['usrname'], md5($_POST['usrpassword']), $_POST['usremail'], $itemOne, $itemTwo);
        //$sql = "INSERT INTO users(confirm_code, username, password, email, capcha_string) 
 //VALUES('".$confirm_code."','" . $_POST['usrname'] . "','" . md5($_POST['usrpassword']) . "','" . $_POST['usremail'] . "','" . //$_POST['usrcaptcha'] . "')";
        
       if ($conn->query($sql) == TRUE) {
           $to=$_POST['usremail'];
           $subject =  "Royal Borogh of Greenwich - confirmation";
           $header = "from: Royal Borough of Greenwich\r\n";
           $message = "Your confirmation link here";
           $message .= "Click to activate an account\r\n";
           $message .= "http://localhost/webbapp/register_confirm.php?passkey=$confirm_code";
           $sentmail = mail($to, $subject, $header, $message);
        } else {
            echo "Email address is not found in database!";
        }
        if($sentmail){
            echo "Email has been sent!";
        }else{
            echo "Can't send email to your address!";
        }
        $conn->close();
    }
}

function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
	
?>
	<ul class="active">
		<li><a href="index.php">Home</a></li>
	</ul>
	
 <h2>Register</h2>

<form method='POST' action="Register.php" style="border:1px solid #ccc">
  <div class="container">
    <label><b>Username</b></label>
    <input type="text" name="usrname" placeholder="Enter username" required>
	<span class="error">* <?php echo $usernameError; ?></span> 
	<br>
	
    <label><b>Password</b></label>
    <input type="password" name="usrpassword" placeholder="Enter Password" required>
	<span class="error" >* <?php echo $passrep_error; ?> </span>
	<br>
	
    <label><b>Repeat Password</b></label>
    <input type="password" name="psw-repeat" placeholder="Repeat Password"  required>
	<span class="error" >* <?php echo $passrep_error; ?> </span>
	<br>
    
    <label><b>Captcha</b></label>
    <input type="text" name="usrcaptcha" placeholder="Enter Captcha" required>
    <img src="captcha.php"/>
    <span class="error" >* <?php echo $captcha_error; ?></span>
    <br>
    
    <label><b>Email</b></label>
    <input type="text" name="usremail" placeholder="Enter Email" required>
    <span class="error">* <?php echo $emailError;?></span>
	<br>
	
    <input type="checkbox" checked="checked"> Remember me
    <p>By creating an account you agree to our <a href="#">Terms & Privacy</a>.</p>

    <div class="clearfix">
      <button type="button" name="Cancel" class="cancelbtn">Cancel</button>
      <button type="submit" name="Submit" class="signupbtn">Sign Up</button>
    </div>
  </div>
</form>

</body>
</html>


