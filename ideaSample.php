<?php
session_start();
if(!isset($_SESSION['login_user'])){
    header("Location: index.php");
}
error_reporting(E_ERROR | E_PARSE);
include 'DBConnection.php'; 
//$conn = new mysqli("mysql", "tp8149d", "tp8149d", "mdb_tp8149d");
//$getLikes = $conn->query("select count(idea_likesID) as amount from idea_likes");
//$getIdea = $conn->query("SELECT ideas.ideasID, ideas.idea, ideas.ideaCol FROM ideas");

//Checking if connection is successfull
 if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$page = (isset($_GET['page']) ? $_GET['page'] : null);
if($page=="" || $page=="1"){
	$page1=0;
}
else {
	$page1=($page*5)-5;
}
$amount = getNumberOfIdeas();
#echo $amount;
$ideaTitle = ideaSearchTitle($page1);
$ideaContent = ideaSearchContent($page1);
$ideaID = ideaSearchID($page1);
$count = 0;
$number = ceil($amount/5);
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
                <!--<li class="nav-item">
                    <a class="navbar-brand" href="#">Greenwich</a> 
                </li> -->
                <li class="nav-item">
                    <a class="nav-link active" href="index.php">HOME</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="ideaSample.php">IDEAS</a>
                </li>
                <li class="nav-item pull-right">
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
                </li>
            </ul>
         </div>

        <div>
            <h2>Latest Ideas</h2>
        </div>
        <div class="container">
        <div class="row">
        <?php
        foreach($ideaTitle as $idea): ?>
        <form action="file.php" method="post">
        <div class="col-sm-4">
          <div class="card card-div">
              <input type="checkbox" name="postDownload[]" value="post<?php echo $ideaID[$count]; ?>" />
            <div class="card-block">
            <div class="idea">
             <h3 class="card-title"><?php echo $idea; ?></h3>
         
                <a href="ideaPage.php?id=<?php echo $ideaID[$count]; ?>" class="btn btn-primary">More</a>
             </div>
            </div>
          </div>
            </div>
        <?php 
            $count++;
            endforeach;?>
            <input type="hidden" value="<?php echo $page1; ?>" name="pageCount">
            <input type="submit" name="postDsubmit" value="Download selected posts" />
            </form>
      </div>
      </div>
                        <?php
    //Creating the links to the next page in the table 
	for($i=1;$i<=$number;$i++) {
		?><a href="ideaSample.php?page=<?php echo $i ?>" style="text-decoration:none" class ="btn btn-primary"><?php echo $i. " "; ?></a><?php
       
	}?>
            
    </body>
</html>