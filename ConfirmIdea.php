<?php
/**
 * Created by PhpStorm.
 * User: AristotleTheAxolotl
 * Date: 13/02/2018
 * Time: 4:02 PM
 */
include 'DBConnection.php';
extract ($_POST);

define (URLCREATE, "http://localhost/phpstormprojects/webenterprise/CreateIdea.php");
define (URLCONFIRM, "http://localhost/phpstormprojects/webenterprise/ConfirmIdea.php");
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

<?php

if ( isset($_POST['yesButton']) ) {
    DBConnect();
    if ( insertIdea($extraInfo) == true) { echo "New Idea Inserted!"; } else { echo "There was a error!"; }
    DBClose();
}

?>


<h1>Confirm Your Idea!</h1>
<p>

Is this correct? <br />
    <?php
    echo '<form action="' . URLCREATE . '" method="post"><p>' . "\n" .
        '<input type="hidden" name="department" value="' . $department . '" />' . "\n" .
        '<input type="hidden" name="ideaTitle" value="' . $ideaTitle . '" />' . "\n" .
        '<input type="hidden" name="extraInfo" value="' . $extraInfo . '" />' . "\n";

    // report input data back to the user
    echo "\n Department: $department<br />" .
        "\n Title: $ideaTitle<br />" .
         "\n Information: $extraInfo".
        "<br /><br />";
    ?>
    <input type="submit" name="noButton" value="No"/>
    <input type="submit" name="yesButton" value="Yes" onclick="this.form.action='<?php echo URLCONFIRM ?>'"/>

</p>
<hr />
</body></html>