<?php 

    $servername = getenv('IP');
    $username = getenv('C9_USER');
    $password = "";
    $database = "whiteboard";
    $dbport = 3306;
    
    //Create Connection
    $db = new mysqli($servername, $username, $password, $database, $dbport);
    
    //Check Connection
    if ($db->connect_error) {
        die("Connection failed: " . $db->connect_error);
    }
    
    //echo "Connected Successfully (".$db->host_info.")";