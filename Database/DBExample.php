<?php
include 'DBConnection.php';
DBConnect();

if ( usernameSearch("Chris") == true) { echo "Username found!"; } else { echo "Username not found!"; }

//if ( insertUser("Bill", "Password") == true) { echo "New User Inserted!"; } else { echo "There was a error!"; }

$result = array();
if ( ($result = ideaSearch()) != null) { echo $result[0]; echo $result[1]; } else { echo "Ideas not found!"; }

//if ( insertIdea("This is an inserted Idea") == true) { echo "New Idea Inserted!"; } else { echo "There was a error!"; }

$result = array();
if ( ($result = commentSearch(1)) != null) { echo $result[0]; echo $result[1]; } else { echo "Ideas not found!"; }

//if ( insertComment("This is an inserted Comment") == true) { echo "New comment Inserted!"; } else { echo "There was a error!"; }

DBClose();

?>