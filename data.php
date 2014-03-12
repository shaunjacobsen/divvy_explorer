<?php
    $username = "divvy"; 
    $password = "divvy";   
    $host = "localhost";
    $database="divvy";
    
    $server = mysql_connect($host, $username, $password);
    $connection = mysql_select_db($database, $server);

    $myquery = "
        SELECT DATE_FORMAT(start_date,'%c/%d/%X') AS start_date,start_time AS start_time,usertype AS u,gender AS g,tripduration AS dur,meters AS m,age_in_2014 AS age
        FROM trips
        WHERE meters MOD 36 = 1
        LIMIT 0,1000
    ";
    $query = mysql_query($myquery);
    
    if ( ! $query ) {
        echo mysql_error();
        die;
    }
    
    $data = array();
    
    for ($x = 0; $x < mysql_num_rows($query); $x++) {
        $data[] = mysql_fetch_assoc($query);
    }
    
    $jsondata = json_encode($data, JSON_NUMERIC_CHECK);

    echo stripslashes($jsondata);

    mysql_close($server);
?>

