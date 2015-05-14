<?php
/**
*@author Olivier Peurichard & Etienne Marois
*/

/**
* return in JSON format the geolocalisation of the current container.
*/

include('connectionDB.php');

session_start();
//recuperation of containers
    $statement = $bdd->prepare("SELECT DISTINCT `geolat`, `geolong` FROM `Containers` WHERE id = '".$_SESSION['idContainer']."'");
    $statement->execute();
    $results=$statement->fetchAll(PDO::FETCH_ASSOC);
    $json=json_encode($results);

    echo $json;

?>