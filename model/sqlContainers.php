<?php
/**
*@author Olivier Peurichard & Etienne Marois
*/

/**
* Return a table which contain the containers' types the current user.
*/

include('connectionDB.php');

//recuperation of containers
    $sql = "SELECT DISTINCT content_type FROM BelongsTo, Containers WHERE id_owner= '".$id_owner."' AND id_container = id";
    $req = $bdd->query($sql);
    for($i = 0; $data = $req->fetch(); $i++){
        $container_type[$i] = $data['content_type'];
    }

?>
