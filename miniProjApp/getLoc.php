<?php

try
{
	// Connection to database
	//$bdd = new PDO('mysql:host=localhost;dbname=mesTests;charset=utf8', 'root', '');
    $bdd = new PDO('mysql:host=192.168.1.65;dbname=sensoringDB;charset=utf8', 'user', 'darzak');
}
catch(Exception $e)
{
	// If there is an error, we stop all
        die('Erreur : '.$e->getMessage());
}

session_start();
//recuperation of containers
    $statement = $bdd->prepare("SELECT DISTINCT `geolat`, `geolong` FROM `Containers` WHERE id = '".$_SESSION['idContainer']."'");
    $statement->execute();
    $results=$statement->fetchAll(PDO::FETCH_ASSOC);
    $json=json_encode($results);

    echo $json;

?>