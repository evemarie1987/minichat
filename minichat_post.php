<?php 

if (array_key_exists('pseudo', $_POST) AND array_key_exists('message', $_POST)) {
	if ($_POST['pseudo'] != '' AND $_POST['message'] != '') {
		try {
			$db = new PDO('mysql:host=localhost;dbname=openclassrooms', 'openclassrooms', '');
		} catch (PDOException $e) {
			die('Erreur : ' . $e->getMessage());
		}

		$query = $db->prepare('
			INSERT INTO 
				minichat
				(pseudo, message, creationDatetime)
			VALUES
				( ? , ? , NOW())
		');
		
		$query->execute([
			$_POST['pseudo'],
			$_POST['message']
		]);

		setcookie('pseudo', $_POST['pseudo']);
	}
}

header('Location: index.php');
exit();