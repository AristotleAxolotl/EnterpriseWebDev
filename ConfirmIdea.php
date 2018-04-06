<?php
/**
 * Created by PhpStorm.
 * User: AristotleTheAxolotl
 * Date: 13/02/2018
 * Time: 4:02 PM
 */
include 'DBConnection.php';
error_reporting(E_ERROR | E_PARSE);
session_start();
if(!isset($_SESSION['login_user'])){
    header("Location: index.php");
}
extract ($_POST);

define ('URLCREATE', "CreateIdea.php");
define ('URLCONFIRM', "ConfirmIdea.php");
?>

<?xml version="1.0" encoding="UTF-8"?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd" >
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-gb">
<head>
<title>New Idea</title>
<meta name="Author" content="tb2683m@greenwich.ac.uk"/>
<title>Confirm Idea Page</title>
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
                <li class="nav-item pull-right">
                  <form action ="logout.php" method="POST">
                    <button class="nav-link btn" type="submit" href="#">LOG OUT</button>
                  </form>
                <?php } else { ?>
                    <a class="nav-link" href="index.php">LOGIN</a>
                <?php } ?>   
            </ul>
         </div>
<?php

if ( isset($_POST['yesButton']) ) {
    DBConnect();
    $departmentID = getCategoryID($department);
    $userName = $_SESSION['login_user'];
    $userID = getUserID($userName);

    if ( insertIdea($extraInfo, $ideaTitle, $userID, $departmentID, $anon) == true) { echo "New Idea Inserted!"; sendMail('Chris', 'New Idea Posted', 'A new Idea has been posted to the idea submissions site'); } else { echo "There was a error!"; }
    DBClose();
}

?>


<h4>Confirm Your Idea!</h4>
<p>

Is this correct? <br />
    <?php
    echo '<form action="' . URLCREATE . '" method="post"><p>' . "\n" .
        '<input type="hidden" name="department" value="' . $department . '" />' . "\n" .
        '<input type="hidden" name="ideaTitle" value="' . $ideaTitle . '" />' . "\n" .
        '<input type="hidden" name="extraInfo" value="' . $extraInfo . '" />' . "\n" .
        '<input type="hidden" name="anon" value="' . $anon . '" />' . "\n";

    // report input data back to the user
    echo "\n Department: $department<br />" .
        "\n Title: $ideaTitle<br />" .
         "\n Information: $extraInfo<br/>".
         "\n Anonymous: ";  if($anon == 1){echo "Yes";}elseif($anon == 0){echo "No";}
    echo "<br /><br />";
    ?>
    <input type="submit" name="noButton" value="No" class="btn btn-primary"/>
    <input type="submit" name="yesButton" value="Yes" onclick="this.form.action='<?php echo URLCONFIRM ?>'" class="btn btn-primary"/>

</p>
<hr />
</body></html>
