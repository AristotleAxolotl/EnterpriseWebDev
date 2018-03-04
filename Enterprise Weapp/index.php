<?php
include('login.php');
if(isset($_SESSION['login_user'])){
  header("Location: user.php");
}
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Nav Bar Examples</title>
        <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="entweb.css">
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600" rel="stylesheet">
    </head>
    <body class="home-bg">
        <div class="site-wrapper">
          <div>
            <ul class="nav nav-pills nav-fill">
                <!-- <li class="nav-item">
                    <a class="navbar-brand" href="#"><img src="Images/logo4.png"</a>
                </li> -->
                <li class="nav-item">
                    <a class="nav-link active" href="#">HOME</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="ideapage.html">IDEAS</a>
                </li>
                <li class="nav-item pull-right">
                    <a class="nav-link" href="#">LOGIN</a>
                </li>
            </ul>
          </div>
          <div class="inner cover">
            <h1 class="cover-heading">Welcome</h1>
            <p class="lead subhead">Something about Greenwich idea thing.</p>
            <form method = 'POST'>
                <div class="form-group" id="login-form">
                    <input type="text" class="form-control input-text center-text center-element" name="username" placeholder="Username">
                    <input type="password" class="form-control input-text center-text center-element" name="password" placeholder="Password">
                    <button type="submit" name="submit" class="btn btn-lg btn-secondary">Login</button><br><br>
                    <span style="color:white"><?php echo $error; ?></span>
                </div>

            </form>
          </div>
        </div>
            <script src="http://code.jquery.com/jquery-3.2.1.js"></script>
            <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    </body>
</html>
