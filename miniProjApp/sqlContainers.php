<?php

try
{
	// Connection to database
	//$bdd = new PDO('mysql:host=localhost;dbname=mesTests;charset=utf8', 'root', '');
    $bdd = new PDO('mysql:host=192.168.1.73;dbname=sensoringDB;charset=utf8', 'user', 'darzak');
}
catch(Exception $e)
{
	// If there is an error, we stop all
        die('Erreur : '.$e->getMessage());
}


//recuperation of containers
    $sql = "SELECT DISTINCT content_type FROM BelongsTo, Containers WHERE id_owner= '".$id_owner."' AND id_container = id";
    $req = $bdd->query($sql);
    for($i = 0; $data = $req->fetch(); $i++){
        $container_type[$i] = $data['content_type'];
    }

?>
