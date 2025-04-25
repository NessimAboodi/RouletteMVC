<?php
require_once '../model/BDD_Manager.php';
$message_erreur = '';
if(isset($_POST['btnConnect'])) {
	if(isset($_POST['nom']) && $_POST['nom'] != '' &&
		isset($_POST['motdepasse']) && $_POST['motdepasse'] != '') {
		$message_erreur = connecteUtilisateur($_POST['nom'], $_POST['motdepasse']);
		if($message_erreur == '') {
		}header('Location: roulette.php');
	}else {
		$message_erreur = 'You must fill in all fields!';
	}
}	
?>
<!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="UTF-8">
	<title>Login</title>
	<link rel="stylesheet" href="../Style/style.css" />
</head>
<body>
<header id="head">
	<h2 class="alert alert-warning">Login</h2>
</header>
<br>
<?php if($message_erreur != '')
	echo "<div class=\"alert alert-danger errorMessage\">$message_erreur</div>";
?>
<form method="post" action="index.php?page=connexion">
	<table id="connexionTable">
		<tr>
			<td colspan="3"><input type="text" name="nom" placeholder="Username" /></td>
		</tr>
		<tr>
			<td colspan="3"><input type="password" name="motdepasse" placeholder="Password" /></td>
		</tr>
		<tr>
			<td><br><a href="#"><input class="Player Player-warning" name="PlayerErase" type="reset" value="Clear" /></a></td>
			<td><br><a href="index.php?page=inscription"><div class="Player Player-info">Register</div></a></td>
			<td><br><input class="Player Player-primary" name="PlayerConnect" type="submit" value="Play" /></td>
		</tr> 
	</table>
</form>
<br><br>
</body>
</html>