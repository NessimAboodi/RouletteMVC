<<?php
require_once '../model/BDD_Manager.php';

$message_erreur = '';
$message_info = '';
$message_resultat = '';
$gagne = false;

if(isset($_GET['btnJouer'])) {
	if($_GET['mise'] < 0) {
		$message_erreur = 'Bet amount must be positive';
	} else if($_GET['mise'] == 0) {
		$message_erreur = 'You need to place a bet...';
	} else if($_GET['mise'] > $_SESSION['joueur_argent']) {
		$message_erreur = 'You cannot bet more than you have...';
	} else if($_GET['numero'] == 0 && !isset($_GET['parite'])) {
		$message_erreur = 'You need to bet on something!';
	} else {
		$_SESSION['joueur_argent'] -= $_GET['mise'];
		$gain = 0;
		$numero = rand(1, 36);

		$miseJoueur = intval($_GET['mise']);
		$numeroJoueur = intval($_GET['numero']);
		$message_info = "The ball stopped on $numero! ";
		if($_GET['numero']!= '') {
			$message_info .= "You bet on ".$numeroJoueur."!";
			if($numeroJoueur == $numero) {
				$message_resultat = "Jackpot! You win ". $miseJoueur*35 ."€ !";
				$gagne = true;
				$gain = $miseJoueur*35;
				$_SESSION['joueur_argent'] += $gain;
			} else {
				$message_resultat = "Missed!";
			}
		} else {
			$message_info .= "You bet that the result would be ".$_GET['parite'];
			$parite = $numero%2 == 0 ? 'even' : 'odd';
			if($parite == $_GET['parite']) {
				$message_resultat = "Well done! You win ". $miseJoueur*2 ."€ !";
				$gagne = true;
				$gain = $miseJoueur*2;
				$_SESSION['joueur_argent'] += $gain;
			} else {
				$message_resultat = "Sorry, you lost!";
			}
		}
		majUtilisateur($_SESSION['joueur_id'], $_SESSION['joueur_argent']);
		ajoutePartie($_SESSION['joueur_id'], date('Y-m-d h:i:s'), $_GET['mise'], $gain);
	}
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="UTF-8">
	<title>Roulette</title>
	<link rel="stylesheet" href="../Style/style.css" />
</head>
<body>
<header id="head">
	<h2 class="alert alert-warning">Roulette Game</h2>
</header>
<br>
<?php 
if($message_erreur != '')
		echo "<div class=\"alert alert-danger errorMessage\">$message_erreur</div>";

if($message_info != '') {
	echo "<div class=\"alert alert-info infoMessage\">$message_info</div>";
	if($gagne) {
		echo "<div class=\"alert alert-success resultMessage\">$message_resultat</div>";
	} else {
		echo "<div class=\"alert alert-danger resultMessage\">$message_resultat</div>";
	}
}
?>
<div id="intro">
	<h3><?= $_SESSION['joueur_nom'] ?></h3>
	<h4><?= $_SESSION['joueur_argent'] ?> €</h4>
</div>
<br>
	<form method="get" action="index.php?page=roulette" id="formJeu">
	<table id="rouletteTable">

		<tr class="bborder">
			<td colspan="3"><input type="number" min="1" max="<?= $_SESSION['joueur_argent'] ?>" name="mise" placeholder="Your bet" /></td>
		</tr>
		
		<tr class="bborder">
			<td id="textSliderNombre">Bet on a number</td>
			<td>
					<label class="switch">
			  <input type="checkbox">
			  <span class="slider round" id="selecteurJeu"></span>
			</label> 
			</td>
			
			<td id="textSliderParite">Bet on even/odd</td>
		</tr>

		<tr class="bborder" id="trJeu">
			<td id="tdJeuNombre" colspan="3">
			<div class="blockJeu">
				Choose your number<br><br>
				<input type="number" name="numero" min="1" max="36" />
			</div>
			</td>
			<td id="tdJeuParite" colspan="3">
			<div class="blockJeu">
				Choose even or odd<br><br>
				
				<input id="btnRadioPair" class="checkBoxParite" name="parite" value="even" type="radio">
				<label for="btnRadioPair" id="labelRadioPair" class="labelRadioParite">Even</label>
				<input id="btnRadioImpair" class="checkBoxParite" name="parite" value="odd" type="radio">
				<label for="btnRadioImpair" id="labelRadioImpair" class="labelRadioParite">Odd</label>
			   
			</div>
			</td>
		</tr>

		<tr>
			<td colspan="3"><input type="submit" name="Player" class="Player Player-success" value="Play" /></td>
		</tr>
		<tr>
			<td colspan="3"><a href="connexion.php?deco" id="quitButton" class="Player Player-danger">Quit</a></td>
		</tr>
	</table>
	</form>

</body>
</html>