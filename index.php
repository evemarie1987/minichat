<?php 

include 'dev/dev.php';

include 'functions.php';

try {
	$db = new PDO('mysql:host=localhost;dbname=openclassrooms', 'openclassrooms', '');
} catch (PDOException $e) {
	die('Erreur : ' . $e->getMessage());
}

if (array_key_exists('page', $_GET) AND $_GET['page'] > 0) {
	$page = $_GET['page'];
}
else {
	$page = 1;
}

$limit = 10;
$offset = ($page - 1) * $limit;

$query = $db->prepare('
	SELECT 
		pseudo,
		message AS content,
		creationDatetime
	FROM minichat
	ORDER BY creationDatetime DESC
	LIMIT '.$limit.' OFFSET '.$offset
);

$query->execute();

$messages = $query->fetchAll(PDO::FETCH_ASSOC);

$query = $db->prepare('
	SELECT COUNT(*)
	FROM minichat
');
$query->execute();

$messagesTotal = $query->fetchColumn();

$pagesTotal = $messagesTotal / $limit;

if (!is_int($pagesTotal)) {
	$pagesTotal = (int)$pagesTotal + 1;
}

if (array_key_exists('pseudo', $_COOKIE)) {
	$pseudo = $_COOKIE['pseudo'];
}
else {
	$pseudo = '';
}

include 'index.phtml';