<?php
/**
*@author Olivier Peurichard & Etienne Marois
*/

/**
* Return in a JSON format all the containers from the current user.
*/

include('connectionDB.php');


    //To use the sessions values
    session_start();
    
    $sql = "
SELECT `id`,`content_type`,`name`,`max_value`,`alert_value` FROM `Containers` WHERE `id` IN ( SELECT `id_container` FROM `BelongsTo` WHERE `id_owner` ='".$_SESSION['id_user']."')
";
    $query = $bdd->query($sql);
    
    $data = array();

    $data = $query->fetchAll();

    echo json_encode($data);     
?>