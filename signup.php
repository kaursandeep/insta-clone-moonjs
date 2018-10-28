<?php

include('config.php');

$servername = getenv('IP');
$username = getenv('C9_USER');
session_start();
echo $firstname=$_GET['firstname'];
echo $lastname=$_GET['lastname'];
echo $emailid=$_GET['emailid'];
echo $password=$_GET['password'];
echo $Rpassword=$_GET['Rpassword'];



$sth = $db->prepare("SELECT * FROM signup");
//$sth->execute();

/* Fetch all of the remaining rows in the result set */
$response = $sth->fetchAll();

echo json_encode($response);
header("Content-type:application/json");
?>