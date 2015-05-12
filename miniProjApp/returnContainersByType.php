<?php
function constructDivContainers($type, $id_owner){
    try{
    // Connection to database
    //$bdd = new PDO('mysql:host=localhost;dbname=mesTests;charset=utf8', 'root', '');
    $bdd = new PDO('mysql:host=192.168.1.65;dbname=sensoringDB;charset=utf8', 'user', 'darzak');
    }
    catch(Exception $e){
    // If there is an error, we stop all
        die('Erreur : '.$e->getMessage());
    }

//recuperation of id by type in an array
    $sql = "SELECT id FROM BelongsTo, Containers WHERE id_owner= '".$id_owner."' AND id_container = id AND content_type ='".$type."'";
    $req = $bdd->query($sql);
    for($i = 0; $data = $req->fetch(); $i++){
        $id_type[$i] = $data['id'];
    }
//Construction of a string with all the id of this type
    $idOfType = '';
    for($f=0;$f<count($id_type); $f++){
        /*if($f=count($id_type)-1){
        $idOfType = $idOfType . ''. $id_type[$f];
        }
        else{*/
            $idOfType = $idOfType . $id_type[$f] . '/';
        //}
    }

    return $idOfType;
}
?>