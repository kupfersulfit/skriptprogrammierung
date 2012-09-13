<?php

/**
 * @brief Objektklasse fuer 'Kunde' equivalent zum Mapping fuer die Tabelle kunden
 */
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
			if($values["id"] != "" && is_numeric($values["id"])){
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
        $ret['id'] = utf8_encode($this->id);
        $ret['name'] = utf8_encode($this->name);
        $ret['vorname'] = utf8_encode($this->vorname);
        $ret['strasse'] = utf8_encode($this->strasse);
        $ret['plz'] = utf8_encode($this->plz);
        $ret['zusatz'] = utf8_encode($this->zusatz);
        $ret['email'] = utf8_encode($this->email);
        $ret['passwort'] = utf8_encode($this->passwort);
        $ret['registriertseit'] = utf8_encode($this->registriertseit);
        return $ret;
    }
	public function getId(){
		return $this->id;
	}
	public function setName($name){
		if($name != "" && is_string($name) && strlen($name) < 256){
			$this->name = $name;
		}else{
			throw new Exception("Name ungueltig.");
		}
	}
	public function getName(){
		return $this->name;
	}
	public function setVorname($vorname){
		if($vorname != "" && is_string($vorname) && strlen($vorname) < 256){
			$this->vorname = $vorname;
		}else{
			throw new Exception("Vorname ungueltig.");
		}
	}
	public function getVorname(){
		return $this->vorname;
	}
	public function setStrasse($strasse){
		if($strasse != "" && is_string($strasse) && strlen($strasse) < 256){
			$this->strasse = $strasse;
		}else{
			throw new Exception("Strasse ungueltig.");
		}
	}
	public function getStrasse(){
		return $this->strasse;
	}
	public function setPlz($plz){
		if (preg_match("/^[0-9]{5}$/" , $plz)) {
			$this->plz = $plz;
		}else{
			throw new Exception("PLZ ungueltig.");
		}
	}
	public function getPlz(){
		return $this->plz;
	}
	public function setZusatz($zusatz){
		if(is_string($zusatz) && strlen($zusatz) < 256){
			$this->zusatz = $zusatz;
		}else{
			throw new Exception("Zusatz ungueltig, vermutlich zu lang.");
		}
	}
	public function getZusatz(){
		return $this->zusatz;
	}
	public function setEmail($email){
		if(preg_match("/^[^@]+@[^@]{3,}\.[^\.@0-9]{2,}$/", $email)) {
			$this->email = $email;
		}else{
			throw new Exception("emailadresse ungueltig.");
		}
	}
	public function getEmail(){
		return $this->email;
	}
	public function setPasswort($pw){
		if($pw != "" && is_string($pw) && strlen($pw) < 128){
			$this->passwort = $pw;
		}else{
			throw new Exception("Passwort ungueltig.");
		}
	}
	public function getPasswort(){
		return $this->passwort;
	}
	public function getRegistriertseit(){
		return $this->registriertseit;
	}
    public function setRegistriertseit($seit){
        $this->registriertseit = $seit;
    }
}

/**
 * @brief Objektklasse fuer 'Artikel' equivalent zum Mapping fuer die Tabelle artikel
 */
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
	public function __construct($values=array()){
		if(isset($values["id"])){
			if($values["id"] != "" && is_numeric($values["id"])){
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
		if(isset($values["kategorieid"]))
			$this->kategorieid = $values["kategorieid"];
		if(isset($values["preis"]))
		    $this->setPreis($values["preis"]);
		if(isset($values["seit"]))
			$this->seit = $values["seit"];
	}
    public function assoc(){ //gibt ein assoziatives array zurueck welches das aktuelle objekt repraesentiert
        $ret = array();
        $ret['id'] = utf8_encode($this->id);
        $ret['name'] = utf8_encode($this->name);
        $ret['beschreibung'] = utf8_encode($this->beschreibung);
        $ret['bildpfad'] = utf8_encode($this->bildpfad);
        $ret['veroeffentlicht'] = utf8_encode($this->veroeffentlicht);
        $ret['verfuegbar'] = utf8_encode($this->verfuegbar);
        $ret['kategorieid'] = utf8_encode($this->kategorieid);
        $ret['preis'] = utf8_encode($this->preis);
        $ret['seit'] = utf8_encode($this->seit);
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
       if(is_numeric($verfuegbar) && $verfuegbar >= 0){
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
	public function setKategorieId($kategorieid){
        $this->kategorieid = $kategorieid;
	}
	public function setPreis($preis){
       if(/*is_float($preis) &&*/ $preis >0.0){
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
/**
 * @brief Objektklasse fuer 'Warenkorb'
 */
class Warenkorb {
	// Member-Variablen
	private $artikel_feld;
	// Methoden
	public function __construct($values = array()){
		$this->artikel_feld = array();
        if(count($values) > 0){
		    foreach($values as $val){
                $this->artikel_feld[] = new Artikel($val);
		    }
        }
	}
    public function assoc(){ //gibt ein assoziatives array zurueck welches das aktuelle objekt repraesentiert
		$ret = array();
        if(count($this->artikel_feld) > 0){
    		foreach($this->artikel_feld as $artikel){
    			$ret[] = $artikel->assoc();
    		}
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

/**
 * @brief Objektklasse fuer 'Bestellung' equivalent zum Mapping fuer die Tabelle bestellungen
 */
class Bestellung{
	private $id;
	private $kundenid;
	private $bestelldatum;
	private $statusid;
	private $zahlungsmethodeid;
	private $lieferungsmethodeid;
	
	public function __construct($values = array()){

		if(isset($values["id"])){
			if($values["id"] != "" && is_int($values["id"])){
				$this->id = $values["id"];
			}else{
				$this->id = 0;
			}
		}
		if(isset($values["kundenid"]))
			$this->kundenid = $values["kundenid"];
		if(isset($values["bestelldatum"]))
			$this->bestelldatum = $values["bestelldatum"];
		if(isset($values["statusid"]))
			$this->statusid = $values["statusid"];
		if(isset($values["zahlungsmethodeid"]))
			$this->zahlungsmethodeid = $values["zahlungsmethodeid"];
		if(isset($values["lieferungsmethodeid"]))
			$this->lieferungsmethodeid = $values["lieferungsmethodeid"];
	}
	
	function getId(){
		return $this->id;
	}
	function getKundenid(){
		return $this->kundenid;
	}
	function getBestelldatum(){
		return $this->bestelldatum;
	}
	function getStatusid(){
		return $this->statusid;
	}
	function getZahlunsgmethodeid(){
		return $this->zahlungsmethodeid;
	}
	function getLieferunsgmethodeid(){
        return $this->lieferungsmethodeid;
	}	
}
/**
 * @brief Objektklasse fuer 'Status' equivalent zum Mapping fuer die Tabelle status
 */
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
       if(is_string($name) && strlen($name)<128 && $name!=""){
           $this->name = $name;
       }else{
           throw new Exception('Name hat ungueltiges Format.');
       }
	}
	function getName(){
		return $this->name;
	}
	public function setBeschreibung($beschreibung) {
       if(is_string($beschreibung) && strlen($beschreibung)<512){
           $this->beschreibung = $beschreibung;
       }else{
           throw new Exception('Beschreibung hat ungueltiges Format.');
       }
	}
	function getBeschreibung(){
		return $this->beschreibung;
	}
}
/**
 * @brief Objektklasse fuer 'Zahlungsmethoden' equivalent zum Mapping fuer die Tabelle zahlungsmethoden
 */
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
       if(is_string($name) && strlen($name)<128 && $name!=""){
           $this->name = $name;
       }else{
           throw new Exception('Name hat ungueltiges Format.');
       }
	}
	function getName(){
		return $this->name;
	}
	public function setBeschreibung($beschreibung) {
       if(is_string($beschreibung) && strlen($beschreibung)<256){
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
/**
 * @brief Objektklasse fuer 'Lieferungsmethode' equivalent zum Mapping fuer die Tabelle lieferungsmethode
 */
class Lieferungsmethode{
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
       if(is_string($name) && strlen($name)<128 && $name!=""){
           $this->name = $name;
       }else{
           throw new Exception('Name hat ungueltiges Format.');
       }
	}
	function getName(){
		return $this->name;
	}
	public function setBeschreibung($beschreibung) {
       if(is_string($beschreibung) && strlen($beschreibung)<512){
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


/**
 * @brief Objekt fuer Kategorien equivalent zur Datenbanktabelle 'Kategorie' 
 */ 
class Kategorie{
	private $id;
	private $name;
	private $beschreibung;
	private $superkategorie;
	
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
		if(isset($values["superkategorie"]))
			$this->setSuperkategorie = $values["superkategorie"];
	}
	
	function getId(){
		return $this->id;
	}
	public function setName($name){
       if(is_string($name) && strlen($name)<128 && $name!=""){
           $this->name = $name;
       }else{
           throw new Exception('Name hat ungueltiges Format.');
       }
	}
	function getName(){
		return $this->name;
	}
	public function setBeschreibung($beschreibung) {
       if(is_string($beschreibung) && strlen($beschreibung)<512){
           $this->beschreibung = $beschreibung;
       }else{
           throw new Exception('Beschreibung hat ungueltiges Format.');
       }
	}
	function getBeschreibung(){
		return $this->beschreibung;
	}
	public function setSuperkategorie($superkategorie) {
       if(is_numeric($superkategorie)){
           $this->superkategorie = $superkategorie;
       }else{
           throw new Exception('Superkategorie hat ungueltiges Format.');
       }
	}
	function getSuperkategorie(){
		return $this->superkategorie;
	}
}

//$obj = new SimpleClass(?Testwert?); // neue Instanz der Klasse
//$obj->displayVar(); // Aufruf der Methode



?>
