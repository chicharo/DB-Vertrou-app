<?php
    $username = "user"; 
    $password = "darzak";   
    $host = "192.168.1.73";
    $database="sensoringDB";
    
    $server = mysql_connect($host, $username, $password);
    $connection = mysql_select_db($database, $server);

    $myquery = "
SELECT `content_type`,`name` FROM `Containers` WHERE `id` IN ( SELECT `id_container` FROM `BelongsTo` WHERE `id_owner` = 1)
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