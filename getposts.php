<?php
    include ('config.php');
    $sth = $db->prepare("SELECT p.*,s.firstname,s.lastname FROM Posts p LEFT JOIN signup s ON p.userID=s.userID ORDER BY p.id DESC");
    $sth->execute();
    //Fetch all of the remaining rows in the result set 
    $response = $sth->fetchAll();
    $jsonstring = json_encode($response);
    echo $jsonstring;   
    
?>