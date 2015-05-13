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

//To use the sessions values 
session_start();

$data = array(); 

$myquery = " 
        SELECT value, D.date, content_type_container, name
        FROM Datas D, BelongsTo B, Containers C
        WHERE D.id_container = '".$_SESSION['idContainer']."'
        AND D.id_container = B.id_container
        AND D.id_container = C.id
        AND D.content_type_container = C.content_type
        AND id_owner = '".$_SESSION['id_user']."'
        ORDER BY D.date
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