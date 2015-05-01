<?php
try
{
	// On se connecte à MySQL
	$bdd = new PDO('mysql:host=mysql.hostinger.fr;dbname=u336515382_db;charset=utf8', 'u336515382_user', 'Darzak97410');
}
catch(Exception $e)
{
	// En cas d'erreur, on affiche un message et on arrête tout
        die('Erreur : '.$e->getMessage());
}

$id = 3;
$name = "Peurichard";
$Fname = "Olivier";
$age = 21;

// On ajoute une entree dans people
$req = $bdd->prepare('INSERT INTO people(id,family_name,first_name,age) VALUES(:id,:family_name,:first_name,:age)');

$req->execute(array(
	'id'=>$id,
	'family_name'=>$name,
	'first_name'=>$Fname,
	'age'=>$age
));

// On récupère tout le contenu de la table jeux_video
$reponse = $bdd->query('SELECT * FROM people');

// On affiche chaque entrée une à une
while ($donnees = $reponse->fetch())
{
?>
    <p>
    <strong>Id</strong> : <?php echo $donnees['id']; ?><br />
    <strong>family name</strong> : <?php echo $donnees['family_name']; ?><br />
    <strong>first name</strong> : <?php echo $donnees['first_name']; ?><br />
    <strong>Years old</strong> : <?php echo $donnees['age']; ?><br />
   </p>
<?php
}

$reponse->closeCursor(); // Termine le traitement de la requête

?>