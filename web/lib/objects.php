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
	public function __construct(){
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
	public function __construct(){
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
	public function __construct(){
		$menge = 0;
		$artikel_feld = new ARTIKEL();
	}
	public function setArtikelFeld($anzahl){	
		//$menge += anzahl;
		//$this->artikel_feld['name'] = anzahl;
	}
}



//$obj = new SimpleClass(?Testwert?); // neue Instanz der Klasse
//$obj->displayVar(); // Aufruf der Methode



?>
