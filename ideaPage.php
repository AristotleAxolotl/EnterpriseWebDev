<?php
ob_start();
//Assuming we will have a session with userID
$userID = 1;
$id = 1;

//$conn = new mysqli("mysql", "tp8149d", "tp8149d", "mdb_tp8149d");
//Query that gets the idea info with how many like and dislike it has
    
if($_GET['id']) {
  $id = (int)$_GET['id'];  
}

include 'DBConnection.php';
DBConnect();
$checkLikes = getVotesTotal($id);
$likes = $checkLikes[0];
$dislikes = $checkLikes[1];

//Storing all the values returned from the query above
    $ideas[] = getIdea($id);

//What happens when a user presses like
if(isset($_GET['type'], $_GET['id'])) {
    $id = (int)$_GET['id'];
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
                header("Refresh:0; url=ideaPage.php?id=$id");
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
DBClose();
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
                <h2><?php echo $idea[0]; ?></h2> <!-- title-->
                <p><?php echo $idea[1]; ?></p> <!-- author-->
                <p><?php echo $idea[2]; ?></p> <!-- date of idea-->
                <p><?php echo $idea[3]; ?></p> <!-- idea text-->
            <p><a href="ideaPage.php?type=like&id=<?php echo $idea[4]; ?>">Like </a>
            <a href="ideaPage.php?type=dislike&id=<?php echo $idea[4]; ?>">Dislike </a></p>
            
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