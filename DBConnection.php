<?php

class MyDB extends SQLite3 {
      function __construct() {
         $this->open('WebData.db');
      }
}

$connection;

//Sets the database connection when called
function DBConnect(){
		global $connection;
		$connection = new MyDB;
		if (!$connection) { echo $connection->lastErrorMsg(); } 
}

//Closes the connection to the database
function DBClose(){
		global $connection;
		$connection->close();
}

//Performs a search to see if a given username exists
function usernameSearch($givenUsername){
		$sql = "SELECT * FROM Users WHERE Username = " . "'" . $givenUsername . "'";
		global $connection;
		$result = $connection->query($sql);
		if ($row = $result->fetchArray(SQLITE3_ASSOC) ) {
			return true;
		} else {
			return false;
		}
}

//Performs a search to see if a given password matches a username
function passwordSearch($givenUsername, $givenPassword){
		$sql = "SELECT UserPassword FROM Users WHERE Username = " . "'" . $givenUsername . "'";
		global $connection;
		$result = $connection->query($sql);
		if ($row = $result->fetchArray(SQLITE3_ASSOC) ) {
			if ($row['UserPassword'] == $givenPassword) { return true; } else { return false; }
		} else {
			echo "That username does not exist, please try again";
		}
}

//Inserts a new user into the users table
function insertUser($givenUsername, $givenPassword, $givenEmail, $givenDepartment, $givenAccount){
	$sql = "SELECT UserID FROM Users ORDER BY UserID DESC";
	global $connection;
	$result = $connection->query($sql);
	if ($row = $result->fetchArray(SQLITE3_ASSOC) ) {
		$userID = $row['UserID'];
		$userID++;
		$sql = "INSERT INTO Users (userID, Username, UserPassword, Email, Department, Account_Type) VALUES($userID, " . "'" .$givenUsername . "'" . "," . "'" .$givenPassword . "'" . $givenEmail . "'" . $givenDepartment . "'" . $givenAccount . ")";
		if ($connection->exec($sql)) { return true; }
	} else {
		echo "There was a error while communicating with the database";
	}
}

//Performs a search for all of the avaliable Ideas
function ideaSearch(){
	$sql = "SELECT * FROM Ideas";
	global $connection;
	$result = $connection->query($sql);
	$output = array();
	while ($row = $result->fetchArray(SQLITE3_ASSOC) ) {
		$output[] = $row['Content'];
	}
	return $output;
}

//Inserts a new idea into the ideas table
function insertIdea($givenIdea, $givenTitle, $givenUserID, $givenCategoryID){
	$sql = "SELECT Idea_ID FROM Idea ORDER BY Idea_ID DESC";
	global $connection;
	$result = $connection->query($sql);
	if ($row = $result->fetchArray(SQLITE3_ASSOC) ) {
		$ideaID = $row['Idea_ID'];
		$ideaID++;
		$Date = date("d/m/y");
		$sql = "INSERT INTO Ideas (Idea_ID, Content, Title, Date, User_ID, Category_ID) VALUES ($ideaID, " . "'" .$givenIdea . "'" . ", '" . $givenTitle . "', ". "'" . $Date . "'" . "," . $givenUserID . ", " . $givenCategoryID . ")";
		if ($connection->exec($sql)) { return true; }
	} else {
		echo "There was a error while communicating with the database";
	}
}

//Performs a search for all of the avaliable Comments of a specific Idea
function commentSearch($givenIdeaID){
	$sql = "SELECT * FROM Comments WHERE Idea_ID = " . $givenIdeaID;
	global $connection;
	$result = $connection->query($sql);
	$output = array();
	while ($row = $result->fetchArray(SQLITE3_ASSOC) ) {
		$output[] = $row['Content'];
	}
	return $output;
}

//Inserts a new comment into the comments table
function insertComment($givenComment, $givenUserID, $givenIdeaID){		
	$sql = "SELECT Comment_ID FROM Comments ORDER BY Comment_ID DESC";
	global $connection;
	$result = $connection->query($sql);
	if ($row = $result->fetchArray(SQLITE3_ASSOC) ) {
		$CommentID = $row['Comment_ID'];
		$CommentID++;
		$Date = date("d/m/y");
		$sql = "INSERT INTO Comments (Comment_ID, Content, Date, User_ID, Idea_ID) VALUES ($CommentID, " . "'" .$givenComment . "'" . "," . "'" . $Date . "'" . "," . $givenUserID . ", " . $givenIdeaID . ")";
		if ($connection->exec($sql)) { return true; }
	} else {
		echo "There was a error while communicating with the database";
	}
}

//Inserts a new reply comment into the comments table
function insertCommentReply($givenComment, $givenUserID, $givenIdeaID, $givenReplyID){		
	$sql = "SELECT Comment_ID FROM Comments ORDER BY Comment_ID DESC";
	global $connection;
	$result = $connection->query($sql);
	if ($row = $result->fetchArray(SQLITE3_ASSOC) ) {
		$CommentID = $row['Comment_ID'];
		$CommentID++;
		$Date = date("d/m/y");
		$sql = "INSERT INTO Comments (Comment_ID, Content, Date, User_ID, Idea_ID, Reply_ID) VALUES ($CommentID, " . "'" .$givenComment . "'" . "," . "'" . $Date . "'" . "," . $givenUserID . ", " . $givenIdeaID . ", " . $givenReplyID . ")";
		if ($connection->exec($sql)) { return true; }
	} else {
		echo "There was a error while communicating with the database";
	}
}

//Returns the number of posative votes for a given Idea.
function getPositiveVotes($givenIdeaID){
	$sql = "SELECT COUNT(Vote) FROM Votes WHERE Idea_ID = " . $givenIdeaID . " AND Vote = " . true;
	global $connection;
	$result = $connection->query($sql);
	if ($row = $result->fetchArray(SQLITE3_ASSOC) ) {
		$output = $row['COUNT(Vote)'];
	} else {
		echo "There was a error while communicating with the database";
	}
}

//Returns the number of negative votes for a given Idea.
function getNegativeVotes($givenIdeaID){
	$sql = "SELECT COUNT(Vote) FROM Votes WHERE Idea_ID = " . $givenIdeaID . " AND Vote = " . false;
	global $connection;
	$result = $connection->query($sql);
	if ($row = $result->fetchArray(SQLITE3_ASSOC) ) {
		$output = $row['COUNT(Vote)'];
	} else {
		echo "There was a error while communicating with the database";
	}
}

//Inserts a new vote into the votes table.
function insertVote($giveIdeaID, $givenVote, $givenUserID){
	$sql = "SELECT Vote_ID FROM Votes ORDER BY Vote_ID DESC";
	global $connection;
	$result = $connection->query($sql);
	if ($row = $result->fetchArray(SQLITE3_ASSOC) ) {
		$voteID = $row['Vote_ID'];
		$voteID++;
		$sql = "INSERT INTO Votes (Vote_ID, Vote, User_ID, Idea_ID) VALUES ($voteID , " . $vote . ", " . $givenUserID . ", " . $giveIdeaID . ")";
		if ($connection->exec($sql)) { return true; } else { return "There was a error while communicating with the database"; }
	}
}

//Checks if a user has submitted a vote for a give Idea.
function checkVote($givenIdeaID, $givenUserID){
	$sql = "SELECT * FROM Votes WHERE Idea_ID = " . $givenIdeaID . " AND User_ID = " . $givenUserID;
	global $connection;
	$result = $connection->query($sql);
	if ($row = $result->fetchArray(SQLITE3_ASSOC) ) {
		return true;
	} else {
		return false;
	}
}

//Returns a list of all of the categories currently in the database(ID)
function getCategoriesID(){
	$sql = "SELECT * FROM Category";
	global $connection;
	$output = array();
	$result = $connection->query($sql);
	while ($row = $result->fetchArray(SQLITE3_ASSOC) ) {
		$output[] = $row['Category_ID'];
	}
	return $output;
}


//Returns a list of all of the categories currently in the database(Type)
function getCategoriesType(){
	$sql = "SELECT * FROM Category";
	global $connection;
	$output = array();
	$result = $connection->query($sql);
	while ($row = $result->fetchArray(SQLITE3_ASSOC) ) {
		$output[] = $row['Type'];
	}
	return $output;
}

//Inserts a new category into the categories table
function insertCategory($givenCategory){
	$sql = "SELECT Category_ID FROM Category ORDER BY Category_ID DESC";
	global $connection;
	$result = $connection->query($sql);
	if ($row = $result->fetchArray(SQLITE3_ASSOC) ) {
		$categoryID = $row['Category_ID'];
		$categoryID++;
		$sql = "INSERT INTO Category (Category_ID, Type) VALUES ($categoryID, '" . $givenCategory . "')";
		if ($connection->exec($sql)) { return true; }
	}	
}

//Deletes a category from the categories table
function deleteCategory($categoryID){
	$sql = "DELETE FROM Category WHERE Category_ID = " . $categoryID;
	global $connection;
	if ($connection->exec($sql)) { return true; }
}

//Updates a category in the categories table
function updateCategory($categoryID, $categoryName){
		$sql = "UPDATE Category SET Type = '" . $categoryName . "' WHERE Category_ID = " . $categoryID;
		global $connection;
		if ($connection->exec($sql)) { return true; }
}
?>
