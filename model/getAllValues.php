<?php
/**
*@author Olivier Peurichard & Etienne Marois
*/

/**
* Return in a JSON format all the values from the current container of the current user.
*/

//connection to database
include('connectionDB.php');

//To use the sessions values 
session_start();

$data = array(); 

$sql = " 
        SELECT value, D.date, content_type_container, name
        FROM Datas D, BelongsTo B, Containers C
        WHERE D.id_container = '".$_SESSION['idContainer']."'
        AND D.id_container = B.id_container
        AND D.id_container = C.id
        AND D.content_type_container = C.content_type
        AND id_owner = '".$_SESSION['id_user']."'
        ORDER BY D.date
";

$query = $bdd->query($sql);

$data = $query->fetchAll();

    echo json_encode($data);

?>