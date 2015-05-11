<?php
   $username = "user"; 
    $password = "darzak";   
    $host = "192.168.1.78";
    $database="sensoringDB";

try
{
    // On se connecte à MySQL
    //$bdd = new PDO('mysql:host=192.168.1.73;port=3306;dbname=sensoringDB;charset=utf8', 'root', 'Darzak97410')
    $server = mysql_connect($host, $username, $password);
    $connection = mysql_select_db($database, $server);
}
catch(Exception $e)
{
        echo "bug";
        die('Erreur : '.$e->getMessage());
}

$data = array();  
 $username = "userTest";
 

$myquery = "
SELECT `id_container`,`content_type_container`,`value`,`date`
  FROM `Datas` WHERE `date` IN (SELECT MAX( `date` )
                                FROM `Datas` WHERE `id_container` 
                                IN (Select `id_container`FROM `BelongsTo`
                                     where `id_owner` = (Select `id` FROM Users where username='userTest'))
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