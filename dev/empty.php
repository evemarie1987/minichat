<?php 
try {
	$db = new PDO('mysql:host=localhost;dbname=test', 'root', 'HeiMisaki4Ever');
} catch (PDOException $e) {
	die('Erreur : ' . $e->getMessage());
}

$query = $db->prepare('
	TRUNCATE minichat
');

$query->execute();


setcookie('pseudo', '');
header('Location: ../index.php');
exit();