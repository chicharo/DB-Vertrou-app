<?php
try
{
	// On se connecte à MySQL
$bdd = new PDO('mysql:host=192.168.1.73;port=3306;dbname=sensoringDB;port=3306;charset=utf8', 'root', 'Darzak97410');
}
catch(Exception $e)
{
	// En cas d'erreur, on affiche un message et on arrête tout
        die('Erreur : '.$e->getMessage());
}

// On ajoute une entree dans people
$req = $bdd->prepare('INSERT INTO Users(id,passwd,firstname,lastname,email,birth) VALUES(:id,:passwd,:firstname,:lastname,:email,:birth)');

$req->execute(array(
	'id'=>$id,
	'passwd'=>$passwd,
	'firstname'=>$firstname,	
	'lastname'=>$lastname,
	'email'=>$email,
	'birth'=>$birth
));

?>