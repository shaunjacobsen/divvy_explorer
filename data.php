<?php
    $username = "divvy"; 
    $password = "divvy";   
    $host = "localhost";
    $database = "divvy";
    
    $server = new PDO('mysql:host=localhost;dbname=divvy', $username, $password);

    $con1 = "'$_GET[d1]'";
    $con2 = "'$_GET[d2]'";

    $ipaddress = $_SERVER['REMOTE_ADDR'];
    $date = TIME();

    $myquery = "
    SELECT c, st_date AS start_date, u, g, st, du, age, dt FROM preprocessed_trips
    WHERE st_date BETWEEN ".$con1." AND ".$con2."
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

    $sqlInsert = "INSERT INTO queries (d1, d2, ip) VALUES (:d1, :d2, :ip)";

    $q = $server->prepare($sqlInsert);
    $q->execute(array(':d1'=>$con1,
                      ':d2'=>$con2,
                      ':ip'=>$ipaddress));

    $result->closeCursor();

    $server = null;

?>

