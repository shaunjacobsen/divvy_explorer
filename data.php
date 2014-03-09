<?php
    $username = "divvy"; 
    $password = "divvy";   
    $host = "localhost";
    $database="divvy";
    
    $server = mysql_connect($host, $username, $password);
    $connection = mysql_select_db($database, $server);

    $myquery = "
        SELECT trip_id,start_date,DATE_FORMAT(start_date,'%c/%d/%X') AS start_date,DATE_FORMAT(end_date,'%c/%d/%X') AS end_date,start_time,end_time,start_dayofweek,tripduration,usertype,gender,meters,age_in_2014,from_station_name,from_station_latitude,from_station_longitude,to_station_name
        FROM `trips`
        WHERE trip_id mod 75 = 0
        LIMIT 0,1000000
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

