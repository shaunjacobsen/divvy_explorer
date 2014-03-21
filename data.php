<?php
    $username = "divvy"; 
    $password = "divvy";   
    $host = "localhost";
    $database="divvy";
    
    $server = mysql_connect($host, $username, $password);
    $connection = mysql_select_db($database, $server);

    $myquery = "
        select count(trips.trip_id) AS c, DATE_FORMAT(trips.start_date, '%c/%d/%X') AS start_date, trips.usertype AS u, trips.gender AS g, SUBSTRING(trips.start_time,1,2) AS st, weather.average_temp AS dt,
case
when trips.age_in_2014 between 16 and 24 then '16-24'
when trips.age_in_2014 between 25 and 34 then '25-34'
when trips.age_in_2014 between 35 and 49 then '35-49'
when trips.age_in_2014 between 50 and 64 then '50-64'
when trips.age_in_2014 > 64 then '65+' else '0'
end as age,
case
when FLOOR(trips.tripduration/60) between 0 and 5 then '0-5'
when FLOOR(trips.tripduration/60) between 6 and 10 then '6-10'
when FLOOR(trips.tripduration/60) between 11 and 15 then '11-15'
when FLOOR(trips.tripduration/60) between 16 and 20 then '16-20'
when FLOOR(trips.tripduration/60) between 21 and 25 then '21-25'
when FLOOR(trips.tripduration/60) between 26 and 30 then '26-30'
when FLOOR(trips.tripduration/60) between 31 and 35 then '31-35'
when FLOOR(trips.tripduration/60) between 36 and 40 then '36-40'
when FLOOR(trips.tripduration/60) between 41 and 45 then '41-45'
when FLOOR(trips.tripduration/60) between 46 and 50 then '46-50'
when FLOOR(trips.tripduration/60) between 51 and 55 then '51-55'
when FLOOR(trips.tripduration/60) between 56 and 60 then '56-60'
when FLOOR(trips.tripduration/60) > 60 then '60+' else '0'
end as du
FROM trips, weather WHERE weather.date = trips.startdate group by start_date, u, g, age, du, st
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

