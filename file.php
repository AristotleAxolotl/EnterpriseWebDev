<?php include 'DBConnection.php'; 
//https://stackoverflow.com/questions/737045/send-a-file-to-client
$count = $_POST['pageCount'];
$ideaTitle = ideaSearchTitle($count);
$ideaContent = ideaSearchContent($count);
$ideaID = ideaSearchID($count);
$filename="files/report".date("dmY").".csv";//takes current date for filename
//if checkbox are not empty info sent
if(isset($_POST['postDownload'])){
    $downloadList = $_POST['postDownload'];
    header('Content-Type: text/plain');
    header('Content-Disposition: attachment;filename='.$filename);
}else{//redirect to ideas page
    header('Location: ideaSample.php');
}
$N = count($downloadList);
$content = "Date: ".date("d/m/Y")."\n
            Posts downloaded: $N  \n";
for($i=0; $i < $N; $i++)
{// 0 = 'Title'; 1 = 'User_ID'; 2 = 'Date'; 3 = 'Content'; 4 = 'Idea_ID';
    $currentList=$downloadList[$i];
    $currentListCut=substr($currentList, 4);
    $currentIdea=getIdea($currentListCut);
    $content .= "Post ID: $currentIdea[4] \n
        Posted by: ".getUsername($currentIdea[1])." \n
        Title: $currentIdea[0]\n
        Description: $currentIdea[3] \n
        Date posted: $currentIdea[2] \n\n";    
}
//write contents into the file
$handle = fopen($filename, 'w');

fwrite($handle, $content);
// close the file pointer
fclose($handle);
readfile($filename);
?>