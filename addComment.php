<?php
    session_start();
    include 'DBConnection.php';

    if(isset($_POST['submit'])) {
        $comment = $_POST['ideaComment'];
        $userID = $_SESSION['userID'];
        $ideaID = $_GET['ideaID'];
        

        #insertComment($comment, $userID, $ideaID) 
        if(insertComment($comment, $userID, $ideaID) == true) {
            header('Location: ideaPage.php?id=' . $ideaID);
        }
        else {
            echo "Comment not added";
        }
        
}
?>