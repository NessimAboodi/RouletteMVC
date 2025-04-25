<?php
require_once '../model/BDD_Manager.php';
$message_erreur = '';
if(isset($_POST['btnSignup'])) {
	if(isset($_POST['nom']) && $_POST['nom'] != '' &&
		isset($_POST['motdepasse']) && $_POST['motdepasse'] != '') {
		ajouteUtilisateur($_POST['nom'], $_POST['motdepasse']);
		connecteUtilisateur($_POST['nom'], $_POST['motdepasse']);
		
		header('Location: roulette.php');
	} else {
		$message_erreur = 'You must fill in all fields!';
	}
}
	
?>
<!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="UTF-8">
	<title>Registration</title>

	<link rel="stylesheet" href="../Style/style.css" />
</head>
<body>
<header id="head">
	<h2 class="alert alert-warning">Registration</h2>
</header>
<br>
<?php if($message_erreur != '')
		echo "<div class=\"alert alert-danger errorMessage\">$message_erreur</div>";
?>
<form method="post" action="index.php?page=inscription">
	<table id="inscriptionTable">
		<tr>
			<td colspan="2"><input type="text" name="nom" placeholder="Username" /></td>
		</tr>
		<tr>
			<td colspan="2"><input type="password" name="motdepasse" placeholder="Password" /></td>
		</tr>
		<tr>
			<td><br><a href="index.php?page=connexion"><div class="btn btn-info">Back to login</div></a></td>
			<td><br><input class="Player Player-Primary" name="PlayerSignup" type="submit" value="Register" /></td>
		</tr> 
	</table>
</form>
</body>
</html>