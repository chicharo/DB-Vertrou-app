<?php
try
{
	// Connection to MySQL
	$bdd = new PDO('mysql:host=localhost;dbname=mesTests;charset=utf8', 'root', '');
}
catch(Exception $e)
{
	// En cas d'erreur, on affiche un message et on arrête tout
        die('Erreur : '.$e->getMessage());
}

// Add a new data

$req = $bdd->prepare('INSERT INTO Datas(id_container,value, laDate) VALUES(:id,:value,:laDate)');

//variables are come from the formulary

$req->execute(array(
	'id'=>$id,
	'value'=>$value,
	'laDate'=>$laDate,
));

?>