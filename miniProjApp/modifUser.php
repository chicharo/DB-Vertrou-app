<?php
try
{
	// On se connecte à MySQL
	$bdd = new PDO('mysql:host=localhost;dbname=mesTests;charset=utf8', 'root', '');
}
catch(Exception $e)
{
	// En cas d'erreur, on affiche un message et on arrête tout
        die('Erreur : '.$e->getMessage());
}

// On ajoute une entree dans people
$req = $bdd->prepare('UPDATE Users SET passwd = :passwd, firstname = :firstname, lastname = :lastname, email = : email, birth = :birth WHERE id = :id);

$req->execute(array(
	'id'=>$id,
	'passwd'=>$passwd,
	'firstname'=>$firstname,
	'lastname'=>$lastname,
	'email'=>$email,
	'birth'=>$birth
));

?>
