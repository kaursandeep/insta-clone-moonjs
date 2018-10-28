<?php

include('config.php');
session_start();
if($_SESSION["user"]) {

    $postID=$_GET['id']; 
    $userID=$_SESSION["user"];
    
    header("Content-type:application/json");
        
    if(
        isset($_SERVER['HTTP_X_REQUESTED_WITH']) &&
        strcasecmp($_SERVER['HTTP_X_REQUESTED_WITH'], 'xmlhttprequest') == 0
    ){
    
    //post image upload
    $currentDate=date('m-d-Y-h-i-a'); 
    $comment=$_POST['comment'];
    //echo $photoname='hii'.$_FILES['userPhoto']['name'];
    
    
    $target_dir = "images/posts/";
    $target_file = $target_dir . basename($_FILES["userPhoto"]["name"]);
    
    $uploadOk = 1;
    $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
    // Check if image file is a actual image or fake image
    if(isset($_POST["submit"])) {
        $check = getimagesize($_FILES["userPhoto"]["tmp_name"]);
        if($check !== false) {
            echo "File is an image - " . $check["mime"] . ".";
            $uploadOk = 1;
        } else {
            echo "File is not an image.";
            $uploadOk = 0;
        }
    }
    
    // Check file size
    if ($_FILES["userPhoto"]["size"] > 5000000) {
        echo "Sorry, your file is too large.";
        $uploadOk = 0;
    }
    // Allow certain file formats
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
    && $imageFileType != "gif" ) {
        echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $uploadOk = 0;
    }
    
    $info = pathinfo($_FILES["userPhoto"]["name"]);
    $file_name =  addslashes (basename($_FILES["userPhoto"]["name"],'.'.$info['extension']).$currentDate.'.'.$imageFileType);  
    $target_file = $target_dir . basename($_FILES["userPhoto"]["name"],'.'.$info['extension']).$currentDate.'.'.$imageFileType; 
    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
    // if everything is ok, try to upload file
    } else {
        if (move_uploaded_file($_FILES["userPhoto"]["tmp_name"], $target_file )) {
            echo "The file ". basename( $_FILES["userPhoto"]["name"]). " has been uploaded.";
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }
    
    
    
    try {
        //echo 'hello</br>';
        /*$db->exec('CREATE TABLE IF NOT EXISTS Posts ( ' .
                  'ID INT AUTO_INCREMENT PRIMARY KEY, ' .
                  'userID INT, ' .
                  'image TEXT, ' .
                  'comment TEXT, ' .
                  'likeCount INT DEFAULT 0, ' .
                  'feedbackCount INT DEFAULT 0 '.
                  ')');*/
                  
        $db->exec(
                 'INSERT INTO Posts (' .
                  'userID, image, comment, likeCount, feedbackCount ) VALUES (' .
                  '\''.$userID.'\', \''.$file_name.'\',  \''.$comment.'\', 0, 0' .
                  ')'
                  );
                  
    
    }
    catch (Exception $e) {
        echo 'Caught exception: ',  $e->getMessage(), "\n";
    }
    
    }

}
?>