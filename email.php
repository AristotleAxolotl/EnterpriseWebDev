<?php include ($_SERVER['DOCUMENT_ROOT']."/database/DBConnection.php");

function sendMail($userToContact){ 
    $sender = "grievous@test.com";
    $headers = "From: $sender \r\n" .
           "Reply-To: $sender \r\n" .
           "X-Mailer: PHP/" . phpversion();
    DBConnect();
    $reciepentInfo=emailSearch($userToContact);
    $notifSubject="New comment on your post!";
    $notifContent="A new comment has been posted on your post, check it out at [linktocomment].";
    mail($reciepentInfo[0], $notifSubject, $notifContent, $headers); 
    DBClose();
}
?>