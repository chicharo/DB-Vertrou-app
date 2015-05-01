<?php
try
{
	// On se connecte à MySQL
	$bdd = new PDO('mysql:host=192.168.1.73;port=3306;dbname=sensoringDB;port=3306;charset=utf8', 'user', 'darzak');
}
catch(Exception $e)
{
	// En cas d'erreur, on affiche un message et on arrête tout
        die('Erreur : '.$e->getMessage());
}

// On ajoute une entree dans people
$req = $bdd->prepare('INSERT INTO Users(pseudo,passwd,firstname,lastname,email,birth) VALUES(:pseudo,:passwd,:firstname,:lastname,:email,:birth)');

$req->execute(array(
	'pseudo'=>htmlspecialchars($_POST['pseudo']),
	'passwd'=>htmlspecialchars($_POST['passwd']),
	'firstname'=>htmlspecialchars($_POST['firstName']),
	'lastname'=>htmlspecialchars($_POST['lastName']),
	'email'=>htmlspecialchars($_POST['email']),
	'birth'=>htmlspecialchars($_POST['birth'])
));

?>
