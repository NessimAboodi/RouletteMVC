<?php
require_once('Joueur.php');

class JoueurDAO {

	private ?PDO $bdd;

	public function __construct() {
		$this->bdd = null;
		try {
			$this->bdd = new PDO('mysql:host=localhost;dbname=roulette_cybersecu;charset=utf8', 
				'root', 
				''
			);	
		} catch(Exception $exception) {
			die('Database connection failed: '.$exception->getMessage());
		}
	}

	public function getAll() {
		$joueurs = [];
		$sqlQuery = 'SELECT * FROM roulette_joueur ORDER BY argent DESC';
		$queryResult = $this->bdd->query($sqlQuery);
	
		while($data = $queryResult->fetch()) {
			$joueur = new Joueur(
				$data['identifiant'], 
				$data['nom'], 
				$data['motdepasse'], 
				$data['argent']
			);
			$joueurs[] = $joueur;
		}
		return $joueurs;
	}

	function ajouteUtilisateur($nom, $motdepasse) {
		$bdd = initialiseConnexionBDD();
		if($bdd) {
			$insertQuery = $bdd->prepare('INSERT INTO roulette_joueur (nom, motdepasse, argent) VALUES (:t_nom, :t_mdp, 500);');
			$insertQuery->execute(array(
				't_nom' => $nom, 
				't_mdp' => $motdepasse
			));
		}
	}
}