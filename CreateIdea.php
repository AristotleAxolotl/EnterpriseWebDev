<?php
/**
 * Created by PhpStorm.
 * User: AristotleTheAxolotl
 * Date: 09/02/2018
 * Time: 3:58 PM
 */

ob_start();
session_start();
?>

<?xml version="1.0" encoding="UTF-8"?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd" >
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-gb">
<head>
<title>New Idea</title>
<meta name="Author" content="tb2683m@greenwich.ac.uk"/>
<link href="mailform.css" rel="stylesheet" type="text/css" />
</head>
<body>
<h1>Create Your Idea!</h1>
<form method="post" action="createdb.php" enctype="application/x-www-form-urlencoded">

<p>
    <!-- This is just an example, later it will be altered to get departments from the database,
    then loop until all departments are displayed-->
Please Select the Department for your idea:
    <select name="department">
        <option value = "">Select...</option>
        <option value = "example1">Example 1</option>
        <option value = "example2">Example 2</option>
    </select> <br /> <br />

Enter a Title/Overview of your idea! <br />
<input type="text" name="ideaTitle" rows="50" maxlength="50"></text><br /><br />

Enter the information about your idea</br>
<textarea name="extraInfo" rows="4" cols="50" maxlength="400"></textarea><br /><br />
    <?php
    $date = date("d/m/Y");
    echo $date;
    ?>

<input type="submit" name="Sub" value="Submit Idea!"/>
</p>
</form>
<hr />
</body></html>