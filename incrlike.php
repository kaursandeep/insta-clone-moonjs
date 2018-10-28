<?php
session_start();
if($_SESSION["user"]) {
include('config.php');

$postID=$_GET['id']; 
$userID=$_SESSION["user"];

try {
    $db->exec('CREATE TABLE IF NOT EXISTS Likes ( ' .
              'id INT AUTO_INCREMENT PRIMARY KEY, ' .
              'userID INT, ' .
              'postID INT'.
              ')');
              
     $sth=$db->prepare('Select * from Likes where postID='.$postID.' and userID='.$userID.'');
     $sth->execute();
     
     
     if ($sth->rowCount() > 0) {
        
    } else {
        //update likecount in posts
        $sth=$db->prepare('Select likeCount from Posts where id='.$postID.'');
        $sth->execute();
        $response = $sth->fetchAll();
        $likeCount=$response[0]['likeCount']; 
        $likeCount=$likeCount+1; 
        
        //echo 'update Posts set likeCount='.$likeCount.' where id='.$postID.' and userID='.$userID;
        $updatesql=$db->prepare('update Posts set likeCount='.$likeCount.' where id='.$postID.'');
        $updatesql->execute();
        
        //add like in Likes table
        $db->exec(
             'INSERT INTO Likes (' .
              'userID, postID) VALUES (' .
              ''.$userID.', '.$postID.''.
              ')'
              );
             
					
		$jsonstring =  json_encode([
						'files' => [[
							'postid' => $postID,
							'likeCount' => $likeCount
						
						]]
					]);
        echo $jsonstring; 
             
        
    }
              

}
catch (Exception $e) {
    echo 'Caught exception: ',  $e->getMessage(), "\n";
}
}
?>