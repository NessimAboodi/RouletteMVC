<?php

class Joueur {

	private int $identification;
	private string $nom;	
	private string $motdepasse;	
	private int $argent;

	public function __construct(int $identification, string $nom, string $motdepasse, string $argent)
	{
		$this->identification = $identification;
		$this->nom = $nom;
		$this->motdepasse = $motdepasse;
		$this->argent = $argent;
	}

	public function getIdentification() {
		return $this->identification;
	}

	public function getNom() {
		return $this->nom;
	}

	public function getMotdepasse() {
		return $this->motdepasse;
	}

	public function getArgent() {
		return $this->argent;
	}
		
	public function updateProperty($attr, $value) {
		switch($attr) {
			case 'identification':
				$this->identification = $value;
				break;
			case 'nom':
				$this->nom = $value;
				break;
			case 'motdepasse':
				$this->motdepasse = $value;
				break;
			case 'argent':
				$this->argent = $value;
				break;
			default:
				echo 'INVALID_PROPERTY';
				break;
		}
	}
}