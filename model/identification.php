<?php
    
/**
*@author Olivier Peurichard & Etienne Marois
*/
    session_start();
    /**
    *Connection to database
    */
include('../model/connectionDB.php');
    
    $userN = htmlspecialchars($_POST['username']);
    $pass = htmlspecialchars($_POST['password']);

    $grain = 'd145fr8m42';
    $sel = 'a6c5e784fl9c';
    $sha1 = sha1($grain.$pass.$sel);

    $sql = "SELECT username, passwd, id FROM Users WHERE username = '$userN' AND passwd = '$sha1'";
    $req = $bdd->query($sql);
    
    $data = $req->fetch();
if($userN != null AND $pass != null){
    if(($userN==$data['username'])&&($sha1==$data['passwd']))
    {
        $_SESSION['id_user']=$data['id']; //generation of sessions variables - id of client
        $_SESSION['username'] = $data['username']; //generation of sessions variables - login of client
        //setcookie('id',$data['id']); // genere un cookie contenant l'id du membre
        //setcookie('login',$data['username']); // genere un cookie contenant le login du membre
        echo "1"; // on 'retourne' la valeur 1 au javascript si la connexion est bonne
    }
    else 
    {
        echo "0"; // on 'retourne' la valeur 0 au javascript si la connexion n'est pas bonne
    }
}
else{
    echo "2";
}
    $bdd = null;
?>
