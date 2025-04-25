<?php

class Partie {

	private int $identifiant;
	private int $joueur;	
	private string $date;	
	private int $mise;
    private int $gain;


	public function __construct(int $identifiant, string $joueur, string $date, string $mise, int $gain)
	{
		$this->identifiant = $identifiant;
		$this->joueur = $joueur;
		$this->date = $date;
		$this->mise = $mise;
        $this->gain = $gain;   
	}

	public function getIdentifiant() {
		return $this->identifiant;
	}

	public function getJoueur() {
		return $this->joueur;
	}

	public function getDate() {
		return $this->date;
	}

	public function getMise() {
		return $this->mise;
	}

    public function getGain() {
		return $this->gain;
	}
		
	public function __set($attr, $value) {
		switch($attr) {
			case 'identifiant':
				$this->identifiant = $value;
				break;
			case 'joueur':
				$this->joueur = $value;
				break;
			case 'date':
				$this->date = $value;
				break;
			case 'mise':
				$this->mise = $value;
				break;
            case 'gain':
                $this->gain = $value;
                break;
			default:
				echo 'INVALID_PROPERTY';
				break;
		}
	}
}