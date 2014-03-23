<?php
    $username = "divvy"; 
    $password = "divvy";   
    $host = "localhost";
    $database = "divvy";
    
    $server = new PDO('mysql:host=localhost;dbname=divvy', $username, $password);

    $myquery = "
    SELECT c, st_date AS start_date, u, g, st, du, age, dt FROM preprocessed_trips
    WHERE st_date > '2013-10-31'
    ";
    $result = $server->query($myquery);
    
    if ( ! $result ) {
        echo 'error';
        die;
    }
    
    $data = array();


    while($row = $result->fetch(PDO::FETCH_ASSOC)) {
        $data[] = $result->fetch(PDO::FETCH_ASSOC);
    }

    $popData = array_pop($data);
    
    $jsondata = json_encode($data, JSON_NUMERIC_CHECK);

    echo stripslashes($jsondata);

    $result->closeCursor();
    $server = null;

?>

