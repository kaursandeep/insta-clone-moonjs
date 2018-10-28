<?php
//connect to database
$servername = getenv('IP');
$username = getenv('C9_USER');
$db = new PDO("mysql:dbname=c9;host=$servername", $username, "" );
$db->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );//Error Handling
?>