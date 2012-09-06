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
	public function __construct($values=array()){
		if(isset($values["id"])){
			if($values["id"] != "" && is_int($values["id"])){
				$this->id = $values['id'];
			}else{
				$values["id"] = 0;
			}
		}
		if(isset($values["name"]))
			$this->setName($values['name']);
		if(isset($values["vorname"]))
			$this->setVorname($values['vorname']);
		if(isset($values["strasse"]))
			$this->setStrasse($values['strasse']);
		if(isset($values["plz"]))
			$this->setPlz($values['plz']);
		if(isset($values["zusatz"]))
			$this->setZusatz($values['zusatz']);
		if(isset($values["email"]))
			$this->setEmail($values['email']);
		if(isset($values["passwort"]))
			$this->setPasswort($values['passwort']);
		if(isset($values["registriertseit"]))
			$this->registriertseit = $values['registriertseit'];
	}
	
	public function assoc(){ //gibt ein assoziatives array zurueck welches das aktuelle objekt repraesentiert
        $ret = array();
        $ret['id'] = $this->id;
        $ret['name'] = $this->name;
        $ret['vorname'] = $this->vorname;
        $ret['strasse'] = $this->strasse;
        $ret['plz'] = $this->plz;
        $ret['zusatz'] = $this->zusatz;
        $ret['email'] = $this->email;
        $ret['passwort'] = $this->passwort;
        $ret['registriertseit'] = $this->registriertseit;
        return $ret;
    }
	public function getId(){
		return $this->id;
	}
	public function setName($name){
		if($name != "" && is_string($name) && strlen($name) < 256){
			$this->name = $name;
		}else{
			throw new Exception("Name ungültig.");
		}
	}
	public function getName(){
		return $this->name;
	}
	public function setVorname($vorname){
		if($vorname != "" && is_string($vorname) && strlen($vorname) < 256){
			$this->vorname = $vorname;
		}else{
			throw new Exception("Vorname ungültig.");
		}
	}
	public function getVorname(){
		return $this->vorname;
	}
	public function setStrasse($strasse){
		if($strasse != "" && is_string($strasse) && strlen($strasse) < 256){
			$this->strasse = $strasse;
		}else{
			throw new Exception("Strasse ungültig.");
		}
	}
	public function getStrasse(){
		return $this->strasse;
	}
	public function setPlz($plz){
		if (preg_match("^[0-9]{5}$" , $plz)) {
			$this->plz = $plz;
		}else{
			throw new Exception("PLZ ungültig.");
		}
	}
	public function getPlz(){
		return $this->plz;
	}
	public function setZusatz($zusatz){
		if(is_string($zusatz) && strlen($zusatz) < 256){
			$this->zusatz = $zusatz;
		}else{
			throw new Exception("Zusatz ungültig, vermutlich zu lang.");
		}
	}
	public function getZusatz(){
		return $this->zusatz;
	}
	public function setEmail($email){
		if(preg_match("/[^a-zA-Z0-9-_@.!#$%&'*\/+=?^`{\|}~]/", $email)) {
			$this->email = $email;
		}else{
			throw new Exception("emailadresse ungültig.");
		}
	}
	public function getEmail(){
		return $this->email;
	}
	public function setPasswort($pw){
		if($pw != "" && is_string($pw) && strlen($pw) < 128){
			$this->passwort = $pw;
		}else{
			throw new Exception("Passwort ungültig.");
		}
	}
	public function getPasswort(){
		return $this->passwort;
	}
	public function getRegistriertseit(){
		return $this->registriertseit;
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
	private $kategorieId;
	private $preis;
	private $seit;
	// Methoden
	public function __construct($values=array()){
		if(isset($values["id"])){
			if($values["id"] != "" && is_int($values["id"])){
				$this->id = $values["id"];
			}else{
				$this->id = 0;
			}
		}
		if(isset($values["name"]))
	        $this->setName($values["name"]);
		if(isset($values["beschreibung"]))
	        $this->setBeschreibung($values["beschreibung"]);
		if(isset($values["bildpfad"]))
	        $this->setBildpfad($values["bildpfad"]);
		if(isset($values["veroeffentlicht"]))
	        $this->setVeroeffentlicht($values["veroeffentlicht"]);
		if(isset($values["verfuegbar"]))
		    $this->setVerfuegbar($values["verfuegbar"]);
		if(isset($values["kategorieId"]))
			$this->kategorieId = $values["kategorieId"];
		if(isset($values["preis"]))
		    $this->setPreis($values["preis"]);
		if(isset($values["seit"]))
			$this->seit = $values["seit"];
	}
    public function assoc(){ //gibt ein assoziatives array zurueck welches das aktuelle objekt repraesentiert
        $ret = array();
        $ret['id'] = $this->id;
        $ret['name'] = $this->name;
        $ret['beschreibung'] = $this->beschreibung;
        $ret['bildpfad'] = $this->bildpfad;
        $ret['veroeffentlicht'] = $this->veroeffentlicht;
        $ret['verfuegbar'] = $this->verfuegbar;
        $ret['kategorieId'] = $this->kategorieId;
        $ret['preis'] = $this->preis;
        $ret['seit'] = $this->seit;
        return $ret;
    }
	public function getId(){
        return $this->id;
	}
	public function setName($name){
       if(is_string($name) && strlen($name)<256 && $name!=""){
           $this->name = $name;
       }else{
           throw new Exception('Name hat ungueltiges Format.');
       }
	}
	public function getName(){
        return $this->name;
	}
	public function setBeschreibung($beschreibung) {
       if(is_string($beschreibung) && strlen($beschreibung)<1023){
           $this->beschreibung = $beschreibung;
       }else{
           throw new Exception('Beschreibung hat ungueltiges Format.');
       }
	}
	public function getBeschreibung(){
       return $this->beschreibung;
	}
	public function setBildpfad($bildpfad){
       if(is_string($bildpfad) && strlen($bildpfad)<255){
           $this->bildpfad = $bildpfad;
       }else{
           throw new Exception('Bildpfad hat ungueltiges Format.');
       }
	}
	public function getBildpfad(){
       return $this->bildpfad;
	} 
	public function setVeroeffentlicht($veroeffentlicht){
       if($veroeffentlicht ==0 || $veroeffentlicht==1){
           $this->veroeffentlicht=$veroeffentlicht;
       }else{
           throw new Exception('Veroeffentlicht hat ungueltiges Format.');
       }
	}
	public function getVeroeffentlicht(){
       return $this->veroeffentlicht;
	}
	public function setVerfuegbar($verfuegbar){
       if(is_int($verfuegbar) && $verfuegbar >= 0){
           $this->verfuegbar=$verfuegbar;
       }else{
           throw new Exception('Verfuegbar hat ungueltiges Format.');
       }
	}
	public function getVerfuegbar(){
       return $this->verfuegbar;
	} 
	public function getKategorieId(){
       return $this->kategorieid;
	}
	public function setPreis($preis){
       if(is_float($preis) && $preis >0.0){
           $this->preis = $preis;
       }else{
           throw new Exception('Preis hat ungueltiges Format.');
       }
	}
	public function getPreis(){
       return $this->preis;
	}
	public function getSeit(){
       return $this->seit;
	}
}

class Warenkorb {
	// Member-Variablen
	private $artikel_feld;
	// Methoden
	public function __construct($values = array()){
		$this->artikel_feld = array();
		foreach($values as $val){
			$this->artikel_feld[] = new Artikel($val);
		}
	}
    public function assoc(){ //gibt ein assoziatives array zurueck welches das aktuelle objekt repraesentiert
		$ret = array();
		foreach($this->artikel_feld as $artikel){
			$ret[] = $artikel->assoc();
		}
		return $ret;
	}
	public function setArtikelFeld($neu_artikel_feld){
		$this->artikel_feld = $neu_artikel_feld;
	}
	public function getArtikelFeld(){
		return $this->artikel_feld;
	}	
}

class Bestellung{
	private $id;
	private $kundenId;
	private $bestelldatum;
	private $statusId;
	private $zahlungsmethodeId;
	private $lieferungsmethode;
	
	public function __construct($values = array()){

		if(isset($values["id"])){
			if($values["id"] != "" && is_int($values["id"])){
				$this->id = $values["id"];
			}else{
				$this->id = 0;
			}
		}
		if(isset($values["kundenId"]))
			$this->kosten = $values["kundenId"];
		if(isset($values["bestelldatum"]))
			$this->kosten = $values["bestelldatum"];
		if(isset($values["statusId"]))
			$this->kosten = $values["statusId"];
		if(isset($values["zahlungsmethodeId"]))
			$this->kosten = $values["zahlungsmethodeId"];
		if(isset($values["lieferungsmethodeId"]))
			$this->kosten = $values["lieferungsmethodeId"];
	}
	
	function getId(){
		return $this->id;
	}
	function getKundenId(){
		return $this->kundenId;
	}
	function getBestelldaum(){
		return $this->bestelldatum;
	}
	function getStatusId(){
		return $this->statusId;
	}
	function getZahlunsgmethodeId(){
		return $this->zahlungsmethodeId;
	}
	function getLieferunsgmethodeId(){
		return $this->lieferunsgmethodeId;
	}	
}

class Status{
	private $id;
	private $name;
	private $beschreibung;
	
	public function __construct($values = array()){

		if(isset($values["id"])){
			if($values["id"] != "" && is_int($values["id"])){
				$this->id = $values["id"];
			}else{
				$this->id = 0;
			}
		}
		if(isset($values["name"]))
			$this->setName($values["name"]);
		if(isset($values["beschreibung"]))
	        $this->setBeschreibung($values["beschreibung"]);
	}
	
	function getId(){
		return $this->id;
	}
	public function setName($name){
       if(is_string($name) && strlen($name)<256 && $name!=""){
           $this->name = $name;
       }else{
           throw new Exception('Name hat ungueltiges Format.');
       }
	}
	function getName(){
		return $this->name;
	}
	public function setBeschreibung($beschreibung) {
       if(is_string($beschreibung) && strlen($beschreibung)<1023){
           $this->beschreibung = $beschreibung;
       }else{
           throw new Exception('Beschreibung hat ungueltiges Format.');
       }
	}
	function getBeschreibung(){
		return $this->beschreibung;
	}
}

class Zahlungsmethoden{
	private $id;
	private $name;
	private $beschreibung;
	private $skript;
	private $kosten;
	
	public function __construct($values = array()){

		if(isset($values["id"])){
			if($values["id"] != "" && is_int($values["id"])){
				$this->id = $values["id"];
			}else{
				$this->id = 0;
			}
		}
		if(isset($values["name"]))
			$this->setName($values["name"]);
		if(isset($values["beschreibung"]))
	        $this->setBeschreibung($values["beschreibung"]);
		if(isset($values["skript"]))
			$this->skript = $values["skript"];
		if(isset($values["kosten"]))
			$this->kosten = $values["kosten"];
	}
	
	function getId(){
		return $this->id;
	}
	public function setName($name){
       if(is_string($name) && strlen($name)<256 && $name!=""){
           $this->name = $name;
       }else{
           throw new Exception('Name hat ungueltiges Format.');
       }
	}
	function getName(){
		return $this->name;
	}
	public function setBeschreibung($beschreibung) {
       if(is_string($beschreibung) && strlen($beschreibung)<1023){
           $this->beschreibung = $beschreibung;
       }else{
           throw new Exception('Beschreibung hat ungueltiges Format.');
       }
	}
	function getBeschreibung(){
		return $this->beschreibung;
	}
	function getSkript(){
		return $this->skript;
	}
	function getKosten(){
		return $this->kosten;
	}
}

class Status{
	private $id;
	private $name;
	private $beschreibung;
	private $kosten;
	
	public function __construct($values = array()){
	
		if(isset($values["id"])){
			if($values["id"] != "" && is_int($values["id"])){
				$this->id = $values["id"];
			}else{
				$this->id = 0;
			}
		}
		if(isset($values["name"]))
			$this->setName($values["name"]);
		if(isset($values["beschreibung"]))
	        $this->setBeschreibung($values["beschreibung"]);
		if(isset($values["kosten"]))
			$this->kosten = $values["kosten"];
	}
	
	function getId(){
		return $this->id;
	}
	public function setName($name){
       if(is_string($name) && strlen($name)<256 && $name!=""){
           $this->name = $name;
       }else{
           throw new Exception('Name hat ungueltiges Format.');
       }
	}
	function getName(){
		return $this->name;
	}
	public function setBeschreibung($beschreibung) {
       if(is_string($beschreibung) && strlen($beschreibung)<1023){
           $this->beschreibung = $beschreibung;
       }else{
           throw new Exception('Beschreibung hat ungueltiges Format.');
       }
	}
	function getBeschreibung(){
		return $this->beschreibung;
	}
	function getKosten(){
		return $this->kosten;
	}
}

//$obj = new SimpleClass(?Testwert?); // neue Instanz der Klasse
//$obj->displayVar(); // Aufruf der Methode



?>
