<?php
/**
 * Created by PhpStorm.
 * User: AristotleTheAxolotl
 * Date: 09/02/2018
 * Time: 3:58 PM
 */
include 'DBConnection.php';
error_reporting(E_ERROR | E_PARSE);
session_start();
if(!isset($_SESSION['login_user'])){
    header("Location: index.php");
}
?>

<?xml version="1.0" encoding="UTF-8"?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd" >
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-gb">
<head>
<title>New Idea</title>
<meta name="Author" content="tb2683m@greenwich.ac.uk"/>
<title>Creat Idea Page</title>
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
		 
<h4>Create Your Idea!</h4>
<form method="post" action="ConfirmIdea.php" enctype="application/x-www-form-urlencoded">

<p>
    <!-- This is just an example, later it will be altered to get departments from the database,
    then loop until all departments are displayed-->
Please Select the Department for your idea:
    <select name="department">
        <?php
        $categories = getCategoriesType();
        foreach($categories as $Key => $value){?>
        <option value="<?php echo $value ?>"><?php echo $value ?></option>
        <?php }?>
    </select> <br /> <br />

Enter a Title/Overview of your idea! <br />
<input type="text" name="ideaTitle" rows="50" maxlength="50" value="<?php if (isset($_POST['ideaTitle'])){echo $_POST['ideaTitle'];}?>"></text><br /><br />

Enter the information about your idea</br>
<textarea name="extraInfo" rows="4" cols="50" maxlength="400" ><?php if (isset($_POST['extraInfo'])){echo $_POST['extraInfo'];}?></textarea><br /><br />

Would you like to post this anonymously?
<input type="radio" name="anon" <?php if(isset($_POST['anon']) && $_POST['anon'] == 0){echo "checked";}elseif (!isset($_POST['anon'])){echo "checked";}?> value=0>No
<input type="radio" name="anon" <?php if(isset($_POST['anon']) && $_POST['anon'] == 1){echo "checked";}?> value=1>Yes<br />
<input type="submit" name="Sub" value="Submit Idea!" class="btn btn-primary"/>
</p>
</form>
<hr />
</body></html>
