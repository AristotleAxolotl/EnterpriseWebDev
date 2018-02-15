<?php
$conn = new mysqli("mysql", "tp8149d", "tp8149d", "mdb_tp8149d");
//$getLikes = $conn->query("select count(idea_likesID) as amount from idea_likes");
$getIdea = $conn->query("SELECT ideas.ideasID, ideas.idea, ideas.ideaCol FROM ideas");

//Checking if connection is successfull
 if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

while($row = $getIdea->fetch_object()) {
    $ideas[] = $row;
    
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
                <!--<li class="nav-item">
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

        <div>
            <h2>Latest Ideas</h2>
        </div>
        <div class="container">
        <div class="row">
        <?php
        foreach($ideas as $idea): ?>
        <div class="col-sm-4">
          <div class="card card-div">
            <div class="card-block">
            <div class="idea">
             <h3 class="card-title"><?php echo $idea->idea; ?></h3>
                <p class="card-text"><?php echo $idea->ideaCol; ?></p>
                <a href="ideaPage.php?id=<?php echo $idea->ideasID; ?>" class="btn btn-primary">More</a>
             </div>
            </div>
          </div>
        </div>
        <?php endforeach; ?>
      </div>
      </div>
    </body>
</html>