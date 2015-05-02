<?php 

 // define database related variables
   $database = 'sensoringDB';
   $host = 192.168.1.73;
   $user = 'user';
   $pass = 'darzak';
   echo "Available";
   try
{
	// On se connecte à MySQL
	$bdd = new PDO('mysql:host=192.168.1.73;port=3306;dbname=sensoringDB;charset=utf8', 'user', 'darzak');
}
catch(Exception $e)
{
	// En cas d'erreur, on affiche un message et on arrête tout
		echo "bug";
        die('Erreur : '.$e->getMessage());
}

 $username = "";
 
 if(isset($_POST['username']))
{
$username = $_POST['username'];
$reponse = $bdd->prepare('SELECT username FROM Users WHERE username = :username'); // Check for the username posted
$reponse->execute(array(':username' => $username));
if($reponse->rowCount() == 0){
  echo "Available";
 }else{
  echo "Username not available";
 } // echo the num or rows 0 or greater than 0
}


?>