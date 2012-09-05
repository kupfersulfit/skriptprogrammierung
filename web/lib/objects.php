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
	public function __construct($values){
	
		$values; //ist ein ass.array noch zurechtschneiden
	
		$this->id = $values['id'];
		$this->setName($values['name']);
		$this->setVorname($values['vorname']);
		$this->setPlz($values['plz']);
		$this->setZusatz($values['zusatz']);
		$this->setEmail($values['email']);
		$this->setPasswort($values['passwort']);
		$this->setRegestriertseit($values['regestriertseit']);
	}
//	public function setId($id){
//		$this->id = $id;
//	}
	public function getId(){
		return $this->id;
	}
	public function setName($name){
		$this->name = $name;
	}
	public function getName(){
		return $this->name;
	}
	public function setVorname($vorname){
		$this->vorname = $vorname;
	}
	public function getVorname(){
		return $this->vorname;
	}
	public function setPlz($plz){
		$this->plz = $plz;
	}
	public function getPlz(){
		return $this->plz;
	}
	public function setZusatz($zusatz){
		$this->zusatz = $zusatz;
	}
	public function getZusatz(){
		return $this->zusatz;
	}
	public function setEmail($email){
		$this->email = $email;
	}
	public function getEmail(){
		return $this->email;
	}
	public function setPasswort($pw){
		$this->passwort = $pw;
	}
	public function getPasswort(){
		return $this->passwort;
	}
	public function setRegestriertseit($seit){
		$this->regestriertseit = $seit;
	}
	public function getRegestriertseit(){
		return $this->regestriertseit;
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
	public function setId(){
	
	}
	public function getId(){
	
	}
	public function setName(){
	
	}
	public function getName(){
	
	}
	public function setBeschreibung() {
		
	}
	public function getBeschreibung(){
	
	}
	public function setBildpfad(){
	
	}
	public function getBildpfad(){
	
	}	
	public function setVeroeffentlicht(){
	
	}
	public function getVeroeffentlicht(){
	
	}
	public function setVerfuegbar(){
	
	}
	public function getVerfuegbar(){
	
	}	
	public function setKategorieid(){
	
	}
	public function getKategorieid(){
	
	}
	public function setPreis(){
	
	}
	public function getPreis(){
	
	}
	public function setSeit(){
	
	}
	public function getSeit(){
	
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
	public function getArtikelFeld(){
		return $this->artikel_feld;
	}	
	public function setMenge($menge){
		$this->menge = $menge;
	}
	public function getMenge(){
		return $this->menge;
	}
	public function setSumme($summe){
		$this->summe = $summe;
	}
	public function getSumme(){
		return $this->summe;
	}
}



//$obj = new SimpleClass(?Testwert?); // neue Instanz der Klasse
//$obj->displayVar(); // Aufruf der Methode



?>
