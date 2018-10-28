<?php
$email=$_GET['email']; 
$password=$_GET['password'];

include ('config.php');
  $sth = $db->prepare("SELECT * FROM signup where emailid='".$email."' and password='".$password."'");
    $sth->execute();
    $response = $sth->fetchAll();
   // print_r($response);
    $userID=$response[0]['userID']; 
    
      if ($sth->rowCount() > 0) {
          session_start();
          // header('https://insta-2-sandeepkaur452.c9users.io/home.php');
           $_SESSION["user"] = $userID;
           echo true;
      }
      else {
          echo "Incorrect username or password.";
      }
   
    
?>