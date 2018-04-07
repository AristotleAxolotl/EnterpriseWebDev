<?php
//$dbhost = "localhost";
//$dbuser = "root";
//$dbpass = "";
//$db = "webdatadatabase";

$dbhost = "mysql.cms.gre.ac.uk";
$dbuser = "cl7533q";
$dbpass = "1tv5LLTJ";
$db = "mdb_cl7533q";


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
		unset($connection);
}

//Finds the user ID of the given username.
function getUserID($givenUsername){
    $sql = "SELECT UserID FROM users WHERE Username = " . "'" . $givenUsername . "'";
    global $connection;
    $result = $connection->query($sql);
    if ($row = $result->fetch_assoc() ) {
			return $row['UserID'];
		} else {
			return false;
		}
}

//Returns the username of the given userID.
function getUsername($givenUserID){
    $sql = "SELECT Username From users WHERE UserID =" . $givenUserID;
    global $connection;
    $result = $connection->query($sql);
    if ($row = $result->fetch_assoc() ) {
			return $row['Username'];
		} else {
			return false;
		}
}

//Returns the account type of the given username.
function getUserType($givenUsername){
    $sql = "SELECT Account_Type FROM users WHERE Username = " . "'" . $givenUsername . "'";
    global $connection;
    $result = $connection->query($sql);
    if ($row = $result->fetch_assoc() ) {
			return $row['Account_Type'];
		} else {
			return false;
		}
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
		$sql = "SELECT UserPassword FROM users WHERE Username = " . "'" . $givenUsername . "'";
		global $connection;
		$result = $connection->query($sql);
		if ($row = $result->fetch_assoc() ) {
			if ($row['UserPassword'] == $givenPassword) { return true; } else { return false; }
		} else {
			echo "That username does not exist, please try again";
		}
}

//Performs a search to retrieve 
function emailSearch($givenUsername){
	$sql = "SELECT Email FROM users WHERE Username = '". $givenUsername."'";
    global $connection;
    $result = $connection->query($sql);
    $output = array();
    while ($row = $result->fetch_assoc() ) {
		$output[] = $row['Email'];
	}
	return $output[0];
}

//Sends an email to the user
function sendMail($userToContact, $subject, $content){ 
    $sender = "ideaSupport@greenwich.com";
    $headers = "From: $sender \r\n" .
           "Reply-To: $sender \r\n" .
           "X-Mailer: PHP/" . phpversion();
    $reciepentInfo=emailSearch($userToContact);
    $notifSubject=$subject;
    $notifContent=$content;
    mail($reciepentInfo, $notifSubject, $notifContent, $headers); 
}

//Inserts a new user into the users table
function insertUser($givenUsername, $givenPassword, $givenEmail, $givenDepartment, $givenAccount){
	$sql = "SELECT UserID FROM users ORDER BY UserID DESC";
	global $connection;
	$result = $connection->query($sql);
	if ($row = $result->fetch_assoc() ) {
		$userID = $row['UserID'];
		$userID++;
		$sql = "INSERT INTO users (userID, Username, UserPassword, Email, Department, Account_Type) VALUES($userID, " . "'" .$givenUsername . "'" . "," . "'" .$givenPassword . "', '" . $givenEmail . "', '" . $givenDepartment . "', " . $givenAccount . ")";
		if ($connection->query($sql)) { return true; }
	} else {
		echo "There was a error while communicating with the database";
	}
}

//Gets the last login date of the user
function getLastLogin($givenUsername){
	$sql = "SELECT Last_Login FROM users WHERE Username = '" . $givenUsername . "'";
	global $connection;
	$result = $connection->query($sql);
	$output = array();
	while ($row = $result->fetch_assoc() ) {
		$output[0] = $row['Last_Login'];
	}
	return $output;
}

//Sets the last login date of the given user
function setLastLogin($givenUsername){
	$Date = date("y/m/d h:i:sa");
	$sql = "UPDATE users SET Last_Login = '" . $Date . "' WHERE Username = '" . $givenUsername . "'";
	global $connection;
	if ($connection->query($sql)){ return true; } else {echo "There was an error, last login could not be updated"; }
}

function getNumberOfIdeas(){
    $sql = "SELECT COUNT(Idea_ID) as n FROM ideas";
    global $connection;
    $result = $connection->query($sql);
    $number = $result->fetch_assoc();
    #echo $number['n'];
    return $number['n'];
}
//Performs a search for all of the avaliable Ideas(Title)
function ideaSearchTitle($number){
	$sql = "SELECT Title FROM ideas limit $number, 5";
	global $connection;
	$result = $connection->query($sql);
	$output = array();
	while ($row = $result->fetch_assoc() ) {
		$output[] = $row['Title'];
	}
	return $output;
}

//Performs a search for all of the avaliable Ideas(Content)
function ideaSearchContent($number){
	$sql = "SELECT Content FROM ideas limit $number, 5";
	global $connection;
	$result = $connection->query($sql);
	$output = array();
	while ($row = $result->fetch_assoc() ) {
		$output[] = $row['Content'];
	}
	return $output;
}

//Performs a search for all of the avaliable Ideas(ID)
function ideaSearchID($number){
	$sql = "SELECT Idea_ID FROM ideas ORDER BY Idea_ID limit $number, 5";
	global $connection;
	$result = $connection->query($sql);
	$output = array();
	while ($row = $result->fetch_assoc() ) {
		$output[] = $row['Idea_ID'];
	}
	return $output;
}

//Returns a idea based on a given idea ID.
function getIdea($givenIdeaID){
    $sql = "SELECT Title, User_ID, Date, Content, Idea_ID FROM ideas WHERE Idea_ID = " . $givenIdeaID;
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

function getIdeaCount(){
    //Collects a list of all of the avaliable categories.
    $sql = "SELECT Category_ID FROM category";
    global $connection;
    $result = $connection->query($sql);
    $types = array();
    $count = 0;
    while ($row = $result->fetch_assoc() ){
        $types[$count] = $row['Category_ID'];
		$count++;
    }
	$count = 0;
	$output = array();
	//Collects the number of ideas for each category.
	foreach ($types as $value){
	$sql = "SELECT COUNT(Title), category.Type FROM ideas JOIN category ON ideas.category_ID = category.category_ID WHERE ideas.Category_ID = " . $value;
	$result = $connection->query($sql);
	$row = $result->fetch_assoc();
	$output[$count] = $row['Type']; //sets the category name.
	$output[$count+1] = $row['COUNT(Title)']; //Sets the category amount.
	$count++;
	$count++;
	}
	return $output;
}

//Inserts a new idea into the ideas table
function insertIdea($givenIdea, $givenTitle, $givenUserID, $givenCategoryID, $anonymous){
	$sql = "SELECT Idea_ID FROM ideas ORDER BY Idea_ID DESC";
	global $connection;
	$result = $connection->query($sql);
	if ($row = $result->fetch_assoc() ) {
		$ideaID = $row['Idea_ID'];
		$ideaID++;
		$Date = date("y/m/d");
		$sql = "INSERT INTO ideas (Idea_ID, Content, Title, Date, User_ID, Category_ID, anonymous) VALUES " . "(" . $ideaID . ", '" .$givenIdea . "'" . ", '" . $givenTitle . "', ". "'" . $Date . "'" . "," . $givenUserID . ", " . $givenCategoryID . ", " . $anonymous . ")";
		if ($connection->query($sql)) { return true; }
	} else {
		echo "There was a error while communicating with the database";
	}
}

//Adds to the amount of times that a Idea has been reported
function reportIdea($givenIdeaID){
    $sql = "SELECT Reported FROM ideas WHERE Idea_ID = " . $givenIdeaID;
    global $connection;
    $result = $connection->query($sql);
    $output = array();
    if ($row = $result->fetch_assoc() ) {
        $output = $row['Reported'];
    }
    $output++;
    $sql = "UPDATE ideas SET Reported = " . $output . " WHERE Idea_ID = " . $givenIdeaID;
    if ($connection->query($sql)) { return true; } else { return false; }
}

//Sets the number of reports to be 0.
function reviewIdea($givenIdeaID){
    $sql = "UPDATE ideas SET Reported = 0 WHERE Idea_ID = " . $givenIdeaID;
    global $connection;
    if ($connection->query($sql)) { return true; } else { return false; }
}

//gets a list of all of the reported Ideas
function getReportedIdeas(){
	$sql = "SELECT Idea_ID, Title, Reported FROM ideas ORDER BY Reported DESC";
	global $connection;
	$result = $connection->query($sql);
	$output = array();
	$count = 0;
	while ($row = $result->fetch_assoc() ) {
		$output[$count] = $row['Idea_ID'];
		$output[$count+1] = $row['Title'];
		$output[$count+2] = $row['Reported'];
		$count++;
		$count++;
		$count++;
	}
	return $output;
}

//Performs a search for all of the avaliable Comments of a specific Idea
function commentSearch($givenIdeaID){
	$sql = "SELECT * FROM comments WHERE Idea_ID = " . $givenIdeaID;
	global $connection;
	$result = $connection->query($sql);
	$output = array();
	$count = 0;
	while ($row = $result->fetch_assoc() ) {
		$output[$count] = $row['Content'];
		$count++;
	}
	return $output;
}

//Inserts a new comment into the comments table
function insertComment($givenComment, $givenUserID, $givenIdeaID){		
	$sql = "SELECT Comment_ID FROM comments ORDER BY Comment_ID DESC";
	global $connection;
	$result = $connection->query($sql);
	if ($row = $result->fetch_assoc() ) {
		$CommentID = $row['Comment_ID'];
		$CommentID++;
		$Date = date("y/m/d");
		$sql = "INSERT INTO comments (Comment_ID, Content, Date, User_ID, Idea_ID) VALUES ($CommentID, " . "'" .$givenComment . "'" . "," . "'" . $Date . "'" . "," . $givenUserID . ", " . $givenIdeaID . ")";
		if ($connection->query($sql)) { return true; }
	} else {
		echo "There was a error while communicating with the database";
	}
}

//Inserts a new reply comment into the comments table
function insertCommentReply($givenComment, $givenUserID, $givenIdeaID, $givenReplyID){		
	if ($givenReplyID == null){
		$givenReplyID = 0;
	}
	$sql = "SELECT Comment_ID FROM Comments ORDER BY Comment_ID DESC";
	global $connection;
	$result = $connection->query($sql);
	if ($row = $result->fetch_assoc() ) {
		$CommentID = $row['Comment_ID'];
		$CommentID++;
		$Date = date("y/m/d");
		$sql = "INSERT INTO Comments (Comment_ID, Content, Date, User_ID, Idea_ID, Reply_ID) VALUES ($CommentID, " . "'" .$givenComment . "'" . "," . "'" . $Date . "'" . "," . $givenUserID . ", " . $givenIdeaID . ", " . $givenReplyID . ")";
		if ($connection->query($sql)) { return true; }
	} else {
		echo "There was a error while communicating with the database";
	}
}

//Returns the number of votes for a given Idea.
function getVotesTotal($givenIdeaID){
    $sql = "SELECT Vote FROM votes JOIN ideas ON votes.Idea_ID = ideas.Idea_ID WHERE ideas.Idea_ID = " . $givenIdeaID;
    global $connection;
    $output = array(0,0);
    $result = $connection->query($sql);
    while ($row = $result->fetch_assoc() ) {
        $vote = (int)$row['Vote'];
        if ($vote == 1){
            $output[0] = $output[0] + 1; //Adds to the number of likes.
        } else if ($vote == 2){
            $output[1] = $output[1] + 1; //Adds to the number of dislikes.
        }
	}
    return $output;
}

//Updates a users vote.
function updateVote($givenVote, $givenUserID, $givenIdeaID){
    $sql = "UPDATE votes SET Vote = " . $givenVote . " WHERE User_ID = " . $givenUserID . " AND Idea_ID = " . $givenIdeaID;
    global $connection;
    if ($connection->query($sql)) { return true; } else { return false; }
}

//Returns the number of posative votes for a given Idea.
function getPositiveVotes($givenIdeaID){
	$sql = "SELECT COUNT(Vote) FROM votes WHERE Idea_ID = " . $givenIdeaID . " AND Vote = " . true;
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
	$sql = "SELECT COUNT(Vote) FROM votes WHERE Idea_ID = " . $givenIdeaID . " AND Vote = " . false;
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
	$sql = "SELECT Vote_ID FROM votes ORDER BY Vote_ID DESC";
	global $connection;
	$result = $connection->query($sql);
	if ($row = $result->fetch_assoc() ) {
		$voteID = $row['Vote_ID'];
		$voteID++;
		$sql = "INSERT INTO votes (Vote_ID, Vote, User_ID, Idea_ID) VALUES (" . $voteID. ", " . $givenVote . ", " . $givenUserID . ", " . $giveIdeaID . ")";
		if ($connection->query($sql)) { return true; } else { return "There was a error while communicating with the database"; }
	}
}

//Checks if a user has submitted a vote for a give Idea, and returns the type of vote.
function checkVote($givenIdeaID, $givenUserID){
	$sql = "SELECT Vote FROM votes WHERE Idea_ID = " . $givenIdeaID . " AND User_ID = " . $givenUserID;
    $output;
	global $connection;
	if ($result = $connection->query($sql)){
	if ($row = $result->fetch_assoc() ) {
		$output = $row['Vote'];
	} else {
		$output = false;
	}
    } else {
        $output = false;
    }
    return $output;
}

//Returns a category ID based on the given category type
function getCategoryID($categoryType){
	$sql = "SELECT Category_ID FROM category WHERE Type = '" . $categoryType ."'";
	global $connection;
	$result = $connection->query($sql);
	$row = $result->fetch_assoc();
    $output = $row['Category_ID'];
	return $output;
}

//Returns a list of all of the categories currently in the database(ID)
function getCategoriesID(){
	$sql = "SELECT * FROM category";
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
	$sql = "SELECT * FROM category";
	global $connection;
	$output = array();
	$result = $connection->query($sql);
		while ($row = $result->fetch_assoc() ) {
			$output[] = $row['Type'];
		}
	return $output;
}

//Returns a list of all of the categories currently in the database(Date)
function getCategoriesDate(){
	$sql = "SELECT * FROM category";
	global $connection;
	$output = array();
	$result = $connection->query($sql);
		while ($row = $result->fetch_assoc() ) {
			$output[] = $row['End_Date'];
		}
	return $output;
}

//Inserts a new category into the categories table
function insertCategory($givenCategory, $givenCategoryDate){
	$sql = "SELECT Category_ID FROM category ORDER BY Category_ID DESC";
	global $connection;
	$result = $connection->query($sql);
	if ($row = $result->fetch_assoc() ) {
		$categoryID = $row['Category_ID'];
		$categoryID++;
		$sql = "INSERT INTO category (Category_ID, Type, End_Date) VALUES ($categoryID, '" . $givenCategory . "', '" . $givenCategoryDate . "')";
		if ($connection->query($sql)) { return true; }
	}
}

//Deletes a category from the categories table
function deleteCategory($categoryID){
	$sql = "DELETE FROM category WHERE Category_ID = " . $categoryID;
	global $connection;
	if ($connection->query($sql)) { return true; }
}

//Updates a category in the categories table
function updateCategory($categoryID, $categoryName, $categoryDate){
		if ($categoryName != null){
			$sql = "UPDATE category SET Type = '" . $categoryName . "' WHERE Category_ID = " . $categoryID;
		} else {
			$sql = "UPDATE category SET End_Date = '" . $categoryDate . "' WHERE Category_ID = " . $categoryID;
		}
		global $connection;
		if ($connection->query($sql)) { return true; }
}
?>
