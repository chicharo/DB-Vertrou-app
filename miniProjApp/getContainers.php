<?php
    $usernameDB = "user"; 
    $passwordDB = "darzak";   
    $host = "192.168.1.65";
    $database="sensoringDB";

    /*$usernameDB = "root"; 
    $passwordDB = "";   
    $host = "localhost";
    $database="mesTest";*/

    // Connection to mySQL database
    $server = mysql_connect($host, $usernameDB, $passwordDB);
    $connection = mysql_select_db($database, $server);
    
    $myquery = "
SELECT `id`,`content_type`,`name`,`max_value`,`alert_value` FROM `Containers` WHERE `id` IN ( SELECT `id_container` FROM `BelongsTo` WHERE `id_owner` ='1')
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
    
    echo json_encode($data);     
     
    mysql_close($server);
?>