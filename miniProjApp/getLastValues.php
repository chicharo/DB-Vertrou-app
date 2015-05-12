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


$data = array(); 

$myquery = "
SELECT `id_container`,`content_type_container`,`value`,`date`
  FROM `Datas` WHERE `date` IN (SELECT MAX( `date` )
                                FROM `Datas` WHERE `id_container` 
                                IN (Select `id_container`FROM `BelongsTo`
                                     where `id_owner` = '1')
                                GROUP BY `id_container`,`content_type_container`
  )
  ORDER BY `id_container` ASC , `date` DESC
";
$query = mysql_query($myquery);



if ( ! $query ) {
        echo mysql_error();
        die;
    }
    else{
    
    
    for ($x = 0; $x < mysql_num_rows($query); $x++) {
        $data[] = mysql_fetch_assoc($query);
    }
    
    echo json_encode($data);     
     
    mysql_close($server);
 } 


?>