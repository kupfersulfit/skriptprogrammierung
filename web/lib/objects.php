<?php
class Kunde {
	// Member-Variablen
	private $id;
	private $name;
	private $vorname;
	private $strasse;
	private $plz;
	private $zusatz;
	private $email;
	private $passwort;
	private $registriertseit;
	// Methoden
	public function __construct($new_var = ??){
		$this->var = $new_var;
	}
	public function setPasswort(){
	
	}
}

class Artikel {
	// Member-Variablen
	private $id;
	private $name;
	private $beschreibung;
	private $bildpfad;
	private $veroeffentlicht;
	private $verfuegbar;
	private $kategorieid;
	private $preis;
	private $seit;
	// Methoden
	public function __construct($new_var = ??){
		$this->var = $new_var;
	}
	public function setBeschreibung() {
		
	}
}

class Warenkorb {
	// Member-Variablen
	private $artikel_feld;
	private $menge;
	private $summe;
	// Methoden
	public function __construct($new_var = ??){
		$menge = 0;
		$artikel_feld = new ARTIKEL();
	}
	public function setAtrikelFeld($anzahl){	
		//$menge += anzahl;
		//$this->artikel_feld['name'] = anzahl;
	}
}



//$obj = new SimpleClass(?Testwert?); // neue Instanz der Klasse
//$obj->displayVar(); // Aufruf der Methode



?>
