<?php 
session_start();
include 'DBConnection.php';
?>

<!DOCTYPE HTML>
<html>
<head> 
<title>Manager Download Page</title>
        <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">   
        <link rel="stylesheet" type="text/css" href="entweb.css">
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600" rel="stylesheet">
</head>
<body>
<div> 
            <ul class="nav nav-pills nav-fill nav-div">
                <!-- <li class="nav-item">
                    <a class="navbar-brand" href="#">Greenwich</a> 
                </li> -->
                <li class="nav-item">
                    <a class="nav-link active" href="index.php">HOME</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="ideaSample.php">IDEAS</a>
                </li>
                <?php 
                      if ($_SESSION['login_user'] != null){
                ?>
                <form action ="logout.php" method="POST">
                    <button class="nav-link pull-right" type="submit" href="#">LOG OUT</button>
                  </form>
                <?php } else { ?>
                    <a class="nav-link pull-right" href="index.php">LOGIN</a>
                <?php } ?>    
            </ul>
         </div>

		 
		 
		 
		 
		 
		 
		 

</body>
</html>