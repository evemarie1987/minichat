<?php 

try {
	$db = new PDO('mysql:host=localhost;dbname=test', 'root', 'HeiMisaki4Ever');
} catch (PDOException $e) {
	die('Erreur : ' . $e->getMessage());
}

for ($i=0; $i < 30; $i++) { 
	$query = $db->prepare('
		INSERT INTO 
			minichat
			(pseudo, message, creationDatetime)
		VALUES
			( "moi" , "message", "2012-01-22 00:00:00" )
	');

	$query->execute();
} 

header('Location: ../index.php');
exit();