<?php
include 'DBConnection.php';
ob_start();
session_start();
if(!isset($_SESSION['login_user'])){
    header("Location: index.php");
}
error_reporting(E_ERROR | E_PARSE);
//Assuming we will have a session with userID
$userID = getUserID($_SESSION['login_user']);
#$id = 1;
    
if($_GET['id']) {
  $id = (int)$_GET['id'];  
}


DBConnect();
$comments = commentSearch($id);

//echo count($comments);
#$string = implode("<br>",$comments);
#echo $string;

$checkLikes = getVotesTotal($id);
$likes = $checkLikes[0];
$dislikes = $checkLikes[1];

//Storing all the values returned from the query above
    $ideas[] = getIdea($id);

//What happens when a user presses like
if(isset($_GET['type'], $_GET['id'])) {
    $id = $_GET['id'];
    $type = (string)$_GET['type'];
    $like = "like";
    $dislike = "dislike";
        
if($type==$like) 
{
//Check to see if the user has already like the idea
    $check = checkVote($id, $userID);
    if ($check == 1 || $check == 2 && $check != null) {
//If they have liked the idea then tell them that they cant like it again
    if($check == 1) 
        {
            alert("Already liked this post");
            header("Refresh:0; url=ideaPage.php?id=$id");
        }
		else
        {
            updateVote(1, $userID, $id);
            
        }
	} else {
		insertVote($id, 1, $userID);				
	}
	header("Refresh:0; url=ideaPage.php?id=$id");
}


//If the user presses the dislike button
elseif($type==$dislike) 
{
	$check = checkVote($id, $userID);
    if ($check == 2 || $check == 1 && $check != null) {

        if($check == 2) 
            {
                alert("Already disliked this post");
             //   header("Refresh:0; url=ideaPage.php?id=$id");
            }
        else
            {
                updateVote(2, $userID, $id);
            } 
        
            
        } else { 
            insertVote($id, 2, $userID);
        }
    header("Refresh:0; url=ideaPage.php?id=$id");
}
}
function alert($msg) 
{
	echo "<script type='text/javascript'>alert('$msg');</script>";
} 
if(isset($_POST['flag'])) {
    $id = $_GET['id'];
    $return = reportIdea($id);
    if($return==true) {
        //header("Location: ideaPage.php?id=$id&reported=y");
        alert("Reported");
    }
}
if(isset($_POST['flagReview'])) {
    $id = $_GET['id'];
    $return = reviewIdea($id);
    if($return==true) {
        //header("Location: ideaPage.php?id=$id&reported=y");
        alert("Reviewed");
    }
}

?>
<!DOCTYPE html>
<html>
    <head>
        <style>
            div.ideaComments {
                height: 300px;
                overflow: scroll;
               
            }
        </style>
        <title>Nav Bar Examples</title>
        <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">   
        <link rel="stylesheet" type="text/css" href="entweb.css">
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600" rel="stylesheet">
    </head>
    <body class="other-bg">
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
                <li class="nav-item pull-right">
                  <form action ="logout.php" method="POST">
                    <button class="nav-link btn" type="submit" href="#">LOG OUT</button>
                  </form>
                </li>    
            </ul>
         </div>
        <div class="container">
    <?php
        foreach($ideas as $idea): ?>
            <div class="container-background">
            <div class="idea">
                <h2><?php echo $idea[0]; ?></h2> <!-- title-->
                <p><?php echo $idea[1]; ?></p> <!-- author-->
                <p><?php echo $idea[2]; ?></p> <!-- date of idea-->
                <p><?php echo $idea[3]; ?></p> <!-- idea text-->
            <p><a href="ideaPage.php?type=like&id=<?php echo $idea[4]; ?>" class="btn btn-primary">Like </a>
            <a href="ideaPage.php?type=dislike&id=<?php echo $idea[4]; ?>" class="btn btn-primary">Dislike </a></p>
            
            <p>
            <?php echo $likes; ?> Like
            <?php echo $dislikes; ?> Dislike</p>
            </div>
			<h3>Comments:</h3>
        <?php endforeach; ?>
        <div class="ideaComments">
		 <?php for($i=0;$i<count($comments);$i++){
                    echo $comments[$i] . "<br> <br>";
            }        
?>

        </div>
        <form action="addComment.php?ideaID=<?php echo $id; ?>" method="post">    
            <div class="comment">
                <textarea rows="5" cols="50" name="ideaComment" placeholder="Type comment here..."></textarea>
                <input class="btn btn-primary" name="submit" type="submit" value="Comment" />
            </div>  
        </form>
        
      <div>
        <form action="ideaPage.php?id=<?php echo $id; ?>" method="post">
        <input class="btn btn-primary" name="flag" type="submit" value="Report this Post" />
        </form>
          <?php 
          $userName = $_SESSION['login_user'];
          if (getUserType($userName) == "1") { ?>
        <form action="ideaPage.php?id=<?php echo $id; ?>" method="post">
        <input class="btn btn-primary" name="flagReview" type="submit" value="Mark as Reviewed" />
        </form>
          <?php } 
          DBClose();
          ?>
      </div>
             
        </div>
      </div>    
    </body>
</html>