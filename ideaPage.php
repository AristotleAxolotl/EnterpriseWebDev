<?php
ob_start();
//Assuming we will have a session with userID
$userID = 5;

$conn = new mysqli("mysql", "tp8149d", "tp8149d", "mdb_tp8149d");
//Query that gets the idea info with how many like and dislike it has
    
if($_GET['id']) {
  $id = (int)$_GET['id'];  
}

$checkLikes=$conn->query("SELECT 
COUNT(distinct(idea_likesID)) as likes, 
COUNT(distinct(idea_dislikeID)) as dislikes 
FROM ideas
LEFT JOIN idea_likes ON ideas.ideasID = idea_likes.ideasID 
LEFT JOIN idea_dislike ON ideas.ideasID = idea_dislike.ideasID
WHERE ideas.ideasID=$id");

while($row2=$checkLikes->fetch_assoc()) {
    if($row2['likes']==0) {
        $likes=0;
        $dislikes=(int)$row2['dislikes'];
        //echo "1";
    }
    elseif($row2['dislikes']==0){
         $likes = (int)$row2['likes'];
       $dislikes=0;
       // echo "2";
    }
    else {
    $likes = (int)$row2['likes'];
       $dislikes=(int)$row2['dislikes'];
        //echo "3";
    }
}

$getIdea = $conn->query("SELECT ideas.ideasID, ideas.idea, ideas.ideaCol, ideas.dateOfIdea,
User.username as username
FROM ideas 
INNER JOIN User ON ideas.userId = User.idUser
WHERE ideas.ideasID=$id
GROUP BY ideas.ideasID");

//Checking if connection is successfull
 if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

//Storing all the values returned from the query above
while($row = $getIdea->fetch_object()) {
    $ideas[] = $row;
}

//What happens when a user presses like
if(isset($_GET['type'], $_GET['id'])) {
    $id = (int)$_GET['id'];
    $type = (string)$_GET['type'];
    $like = "like";
    $dislike = "dislike";
        
if($type==$like) 
{
//Check to see if the user has already like the idea
    $check = $conn->query("SELECT * FROM idea_likes WHERE userID='$userID' AND ideasID='$id'");
//If they have liked the idea then tell them that they cant like it again
    if($check->num_rows>0) 
        {
            alert("Already liked this post");
            header("Refresh:0; url=ideaPage.php?id=$id");
        }
    //If theydont lready like the idea
        else
        {
    //Check if they have previously disliked it
         $check2 = $conn->query("SELECT * FROM idea_dislike WHERE userID='$userID' AND ideasID='$id'");
        //If they have disliked it then remove the dislike and add the like
            if($check2->num_rows>0) 
            {
                $deleteDislike = $conn->query("DELETE FROM idea_dislike where userID='$userID' and ideasID='$id'");
                $addlike = $conn->query("INSERT INTO idea_likes(userID, ideasID) VALUES('$userID','$id')");
                alert("Added like and removed dislike");
            }
        //If they havent disliked it then just add the like   
            else 
            {
                $addlike = $conn->query("INSERT INTO idea_likes(userID, ideasID) VALUES('$userID','$id')");
                alert("Added like");
            }
            
            
        } 
    //Refresh the page to see the updated likes
   header("Refresh:0; url=ideaPage.php?id=$id");
}
//If the user presses the dislike button
elseif($type==$dislike) 
{
//Check if they have previously disliked the idea    
    $check = $conn->query("select * from idea_dislike where userID='$userID' and ideasID='$id'");
//If they have disliked it before then tell them they cant again
    if($check->num_rows>0) 
        {
            alert("Already disliked this post");
            header("Refresh:0; url=ideaPage.php?id=$id");
        }
    //If they havent disliked it before
    else
        {
        //Check if they have already liked it
            $check2 = $conn->query("SELECT * FROM idea_likes WHERE userID='$userID' AND ideasID='$id'");
        //If they have liked it then remove the like and add the dislike
            if($check2->num_rows>0)
            {
                $deleteDislike = $conn->query("DELETE FROM idea_likes where userID='$userID' and ideasID='$id'");
                $addDislike = $conn->query("INSERT INTO idea_dislike(userID, ideasID) VALUES('$userID','$id')");
                alert("Added dislike and removed like");
            }
        //If they havent liked is before then just add the dislike
            else
            {
                $addlike = $conn->query("INSERT INTO idea_dislike(userID, ideasID) VALUES('$userID','$id')");
                alert("Added dislike");
            }
             
        } 
    //Refresh the page to see the updated likes
  header("Refresh:0; url=ideaPage.php?id=$id");
    }
    

}

function alert($msg) 
{
	echo "<script type='text/javascript'>alert('$msg');</script>";
} 
?>
<!DOCTYPE html>
<html>
    <head>
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
                    <a class="nav-link active" href="#">HOME</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">IDEAS</a>
                </li>
                <li class="nav-item pull-right">
                    <a class="nav-link" href="#">LOGIN</a>
                </li>     
            </ul>
         </div>
        <div class="container">
    <?php
        foreach($ideas as $idea): ?>
            <div class="container-background">
            <div class="idea">
                <h2><?php echo $idea->idea; ?></h2> <!-- title-->
                <p><?php echo $idea->username; ?></p> <!-- author-->
                <p><?php echo $idea->dateOfIdea; ?></p> <!-- date of idea-->
                <p><?php echo $idea->ideaCol; ?></p> <!-- idea text-->
            <p><a href="ideaPage.php?type=like&id=<?php echo $idea->ideasID; ?>">Like </a>
            <a href="ideaPage.php?type=dislike&id=<?php echo $idea->ideasID; ?>">Dislike </a></p>
            
            <p>
            <?php echo $likes; ?> Like
            <?php echo $dislikes; ?> Dislike</p>
            </div>
        <?php endforeach; ?>

            <button class="btn btn-primary">Comment</button>  
        </div>
      </div>    
    </body>
</html>