<?php
$dbhost = "localhost";
$dbuser = "root";
$dbpass = "";
$db = "webdata";


$connection = new mysqli($dbhost, $dbuser, $dbpass, $db);

//Sets the database connection when called
function DBConnect(){
		global $connection;
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
		if ($row = $result->fetch_assoc() ) {
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
		if ($row = $result->fetch_assoc() ) {
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
	if ($row = $result->fetch_assoc() ) {
		$userID = $row['UserID'];
		$userID++;
		$sql = "INSERT INTO Users (userID, Username, UserPassword, Email, Department, Account_Type) VALUES($userID, " . "'" .$givenUsername . "'" . "," . "'" .$givenPassword . "'" . $givenEmail . "'" . $givenDepartment . "'" . $givenAccount . ")";
		if ($connection->query($sql)) { return true; }
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
	while ($row = $result->fetch_assoc() ) {
		$output[] = $row['Content'];
	}
	return $output;
}

//Returns a idea based on a given idea ID.
function getIdea($givenIdeaID){
    $sql = "SELECT Title, User_ID, Date, Content, Idea_ID FROM Ideas WHERE Idea_ID = " . $givenIdeaID;
	global $connection;
	$result = $connection->query($sql);
	$output = array();
	while ($row = $result->fetch_assoc() ) {
		$output[0] = $row['Title'];
        $output[1] = $row['User_ID'];
        $output[2] = $row['Date'];
        $output[3] = $row['Content'];
        $output[4] = $row['Idea_ID'];
	}
	return $output;
}


//Inserts a new idea into the ideas table
function insertIdea($givenIdea, $givenTitle, $givenUserID, $givenCategoryID){
	$sql = "SELECT Idea_ID FROM Idea ORDER BY Idea_ID DESC";
	global $connection;
	$result = $connection->query($sql);
	if ($row = $result->fetch_assoc() ) {
		$ideaID = $row['Idea_ID'];
		$ideaID++;
		$Date = date("d/m/y");
		$sql = "INSERT INTO Ideas (Idea_ID, Content, Title, Date, User_ID, Category_ID) VALUES ($ideaID, " . "'" .$givenIdea . "'" . ", '" . $givenTitle . "', ". "'" . $Date . "'" . "," . $givenUserID . ", " . $givenCategoryID . ")";
		if ($connection->query($sql)) { return true; }
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
	while ($row = $result->fetch_assoc() ) {
		$output[] = $row['Content'];
	}
	return $output;
}

//Inserts a new comment into the comments table
function insertComment($givenComment, $givenUserID, $givenIdeaID){
	$sql = "SELECT Comment_ID FROM Comments ORDER BY Comment_ID DESC";
	global $connection;
	$result = $connection->query($sql);
	if ($row = $result->fetch_assoc() ) {
		$CommentID = $row['Comment_ID'];
		$CommentID++;
		$Date = date("d/m/y");
		$sql = "INSERT INTO Comments (Comment_ID, Content, Date, User_ID, Idea_ID) VALUES ($CommentID, " . "'" .$givenComment . "'" . "," . "'" . $Date . "'" . "," . $givenUserID . ", " . $givenIdeaID . ")";
		if ($connection->query($sql)) { return true; }
	} else {
		echo "There was a error while communicating with the database";
	}
}

//Inserts a new reply comment into the comments table
function insertCommentReply($givenComment, $givenUserID, $givenIdeaID, $givenReplyID){
	$sql = "SELECT Comment_ID FROM Comments ORDER BY Comment_ID DESC";
	global $connection;
	$result = $connection->query($sql);
	if ($row = $result->fetch_assoc() ) {
		$CommentID = $row['Comment_ID'];
		$CommentID++;
		$Date = date("d/m/y");
		$sql = "INSERT INTO Comments (Comment_ID, Content, Date, User_ID, Idea_ID, Reply_ID) VALUES ($CommentID, " . "'" .$givenComment . "'" . "," . "'" . $Date . "'" . "," . $givenUserID . ", " . $givenIdeaID . ", " . $givenReplyID . ")";
		if ($connection->query($sql)) { return true; }
	} else {
		echo "There was a error while communicating with the database";
	}
}

//Returns the number of votes for a given Idea.
function getVotesTotal($givenIdeaID){
    $sql = "SELECT Vote FROM Votes JOIN Ideas ON Votes.Idea_ID = Ideas.Idea_ID WHERE Ideas.Idea_ID = " . $givenIdeaID;
    global $connection;
    $output = array(0,0);
    $result = $connection->query($sql);
    while ($row = $result->fetch_assoc() ) {
        $vote = (int)$row['Vote'];
        if ($vote == 1){
            $output[0] = $output[0] + 1; //Adds to the number of likes.
        } else {
            $output[1] = $output[1] + 1; //Adds to the number of dislikes.
        }
	}
    return $output;
}

//Updates a users vote.
function updateVote($givenVote, $givenUserID, $givenIdeaID){
    $sql = "UPDATE Votes SET Vote = " . $givenVote . " WHERE User_ID = " . $givenUserID . " AND Idea_ID = " . $givenIdeaID;
    global $connection;
    if ($connection->query($sql)) { return true; } else { return false; }
}

//Returns the number of posative votes for a given Idea.
function getPositiveVotes($givenIdeaID){
	$sql = "SELECT COUNT(Vote) FROM Votes WHERE Idea_ID = " . $givenIdeaID . " AND Vote = " . true;
	global $connection;
	$result = $connection->query($sql);
	if ($row = $result->fetch_assoc() ) {
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
	if ($row = $result->fetch_assoc() ) {
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
	if ($row = $result->fetch_assoc() ) {
		$voteID = $row['Vote_ID'];
		$voteID++;
		$sql = "INSERT INTO Votes (Vote_ID, Vote, User_ID, Idea_ID) VALUES (" . $voteID. ", " . $givenVote . ", " . $givenUserID . ", " . $giveIdeaID . ")";
		if ($connection->query($sql)) { return true; } else { return "There was a error while communicating with the database"; }
	}
}

//Checks if a user has submitted a vote for a give Idea, and returns the type of vote.
function checkVote($givenIdeaID, $givenUserID){
	$sql = "SELECT Vote FROM Votes WHERE Idea_ID = " . $givenIdeaID . " AND User_ID = " . $givenUserID;
    $output;
	global $connection;
	$result = $connection->query($sql);
	if ($row = $result->fetch_assoc() ) {
		$output = $row['Vote'];
	}
    return $output;
}

//Returns a list of all of the categories currently in the database(ID)
function getCategoriesID(){
	$sql = "SELECT * FROM Category";
	global $connection;
	$output = array();
	$result = $connection->query($sql);
		while ($row = $result->fetch_assoc() ) {
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
		while ($row = $result->fetch_assoc() ) {
			$output[] = $row['Type'];
		}
	return $output;
}

//Inserts a new category into the categories table
function insertCategory($givenCategory){
	$sql = "SELECT Category_ID FROM Category ORDER BY Category_ID DESC";
	global $connection;
	$result = $connection->query($sql);
	if ($row = $result->fetch_assoc() ) {
		$categoryID = $row['Category_ID'];
		$categoryID++;
		$sql = "INSERT INTO Category (Category_ID, Type) VALUES ($categoryID, '" . $givenCategory . "')";
		if ($connection->query($sql)) { return true; }
	}
}

//Deletes a category from the categories table
function deleteCategory($categoryID){
	$sql = "DELETE FROM Category WHERE Category_ID = " . $categoryID;
	global $connection;
	if ($connection->query($sql)) { return true; }
}

//Updates a category in the categories table
function updateCategory($categoryID, $categoryName){
		$sql = "UPDATE Category SET Type = '" . $categoryName . "' WHERE Category_ID = " . $categoryID;
		global $connection;
		if ($connection->query($sql)) { return true; }
}
?>
