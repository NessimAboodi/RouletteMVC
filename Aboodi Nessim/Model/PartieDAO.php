<?php
require_once('Partie.php');

class PartieDAO {

	private ?PDO $bdd;

	public function __construct() {
		$this->bdd = null;
		try {
			$this->bdd = new PDO('mysql:host=localhost;dbname=roulette_cybersecu;charset=utf8', 
				'root', 
				''
			);	
		} catch(Exception $error) {
			die('Database connection error: '.$error->getMessage());
		}
	}

	public function getAll() {
		$resultArray = [];
		$query = 'SELECT * FROM roulette_partie ORDER BY joueur DESC';
		$statement = $this->bdd->query($query);
		
		while($row = $statement->fetch()) {
			$partie = new Partie($row['identifiant'], $row['joueur'], $row['date'], $row['mise'], $row['gain']); 
			$resultArray[] = $partie;
		}
		return $resultArray;
	}

	public function ajoutePartie($joueur, $date, $mise, $gain) {
		if($this->bdd) {
			$preparedQuery = $this->bdd->prepare('INSERT INTO roulette_partie (joueur, date, mise, gain) VALUES (:player_id, :game_date, :bet_amount, :win_amount);');
			$preparedQuery->execute(array(
				'player_id' => $joueur, 
				'game_date' => $date, 
				'bet_amount' => $mise, 
				'win_amount' => $gain
			));
		}
	}
}