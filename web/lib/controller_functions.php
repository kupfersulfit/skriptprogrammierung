<?php
    require_once 'objects.php';
    require_once 'model.php';
    require_once 'admin.php';

    /** Gibt eine Fehlermeldung aus */
    function err($nachricht){
        echo json_encode(array(utf8_encode("error") => utf8_encode("$nachricht")));
    }

    /** Zeigt alle Artikel an */
    function zeigeArtikel(){
        $artikelArray = $_SESSION['model']->holeAlleArtikel();
        if(count($artikelArray) == 0){
            err("no existing article");
        }else{
            for($i = 0; $i < count($artikelArray); $i++){ //convert object to assoc array
                $kategorie = $artikelArray[$i]->getKategorieId();
                $kategorie = $_SESSION["model"]->holeKategorie($kategorie);
                $artikelArray[$i]->setKategorieId($kategorie->getName());
                //objekt in assoz array umwandeln
                $artikelArray[$i] = $artikelArray[$i]->assoc();
            }
            echo json_encode($artikelArray);
        }
    }

    /* Zeigt alle veroeffentlichten Artikel an */
    function zeigeVeroeffentlichteArtikel(){
        $artikelArray = $_SESSION['model']->holeAlleVeroeffentlichtenArtikel();
        if(count($artikelArray) == 0){
            err("no existing article");
        }else{
            for($i = 0; $i < count($artikelArray); $i++){ //convert object to assoc array
                //kategorienamen aus der db holen und eintragen
                $kategorie = $artikelArray[$i]->getKategorieId();
                $kategorie = $_SESSION["model"]->holeKategorie($kategorie); 
                $artikelArray[$i]->setKategorieId($kategorie->getName());
                //objekt in assoz array umwandeln
                $artikelArray[$i] = $artikelArray[$i]->assoc();
            }
            echo json_encode($artikelArray);
        }
    }

    /** Sucht einen Artikel 
        @param suchstring String nach dem gesucht werden soll
        @return Artikel
    */
    function sucheArtikel($suchstring){
        $ergebnis = $_SESSION['model']->sucheArtikel($suchstring); 
        if($ergebnis == null){
            err("no article '$suchstring' found");
        }else{
            $artikelListe = array();
            foreach($ergebnis as $artikel){
                $artikelListe[] = $artikel->assoc();
            }
            echo json_encode($artikelListe);
        }
    }

    /** Gibt falls vorhanden den aktuellen Warenkorb aus, sonst eine Fehlermeldung */
    function holeWarenkorb(){
        if(isset($_SESSION['korb'])){
            echo json_encode($_SESSION['korb']->assoc());
        }else{
            err("no shopping cart available");
        }
    }

    /** Gleicht den in der Session gespeicherten Warenkorb dem aktuellen an
        @param warenkorb nicht geprueftes Warenkorbobjekt
        @return Warenkorbobjekt mit den korrekten Daten (Preis etc. aus DB)
    */
    function aktualisiereWarenkorb($warenkorb){
        $korb = json_decode($warenkorb, true); //assoc array erzeugen
        $korb = new Warenkorb($korb); //warenkorbobjekt erzeugen
        $artikelListe = $korb->getArtikelFeld(); //hole liste aller artikel im korb
        for($i = 0; $i < count($artikelListe); $i++){
            $artikelId = $artikelListe[$i]->getId();
            $anzahl = $artikelListe[$i]->getVerfuegbar(); //hier steht bei artikeln im warenkorb die anzahl der bestellten artikel (in der db anzahl verfuegbare)
            $art = $_SESSION['model']->holeArtikel($artikelId); //hole korrekten daten aus der db 
            if($art == null){
                err("unknown article");
                return;
            }else if(!$art->getVeroeffentlicht()){
                err("article not available");
            }else if($anzahl > $art->getVerfuegbar()){ //teste ob noch genug artikel auf lager
                err("not enough ".$art->getName()." available");
                return;
            }
            $artikelListe[$i] = $_SESSION['model']->holeArtikel($artikelId); //ersetze artikeldetails um zb preisfaelschungen zu verhindern
            $artikelListe[$i]->setVerfuegbar((int) $anzahl);
        }
        $korb->setArtikelFeld($artikelListe); //update warenkorb mit den 'korrekten' daten
        $_SESSION['korb'] = $korb;
        echo json_encode($_SESSION['korb']->assoc());
    }

    /** Testet den gegebenen Login und ersetzt ggf. die Sessionvariable "Kunde"
        @param email Email des Nutzers
        @param passwort Passwort des Nutzers
        @return username warenkorb
    */
    function login($email, $passwort){
        $salz = "Die github gui ist doof";

        if(!preg_match("/^[^@]+@[^@]{3,}\.[^\.@0-9]{2,}$/", $email)){
            err("invalid email address");
            return;
        }
        $hash = crypt($passwort, $salz);
        if($_SESSION['model']->pruefeLogin($email, $hash) == true){
            $_SESSION['kunde'] = $_SESSION['model']->holeKunde($email);
            holeAngemeldetenKunde(); //kundendaten ausgeben
        }else{
            err("login failed");
        }
    }

    /** Zerst&ouml;rt das Kundenobjekt in der Session (nicht den Warenkorb) */
    function logout(){
        $_SESSION['kunde'] = new Kunde(array("id" => -1, "name" => "Guest"));
    }

    /** Versucht einen neuen Kunden anzulegen 
        @param kunde Kundenobjekt des anzulegenden Kunden*/
    function registriereKunde($kunde){
        $kunde = json_decode($kunde, true);
        try{
            $kunde = new Kunde($kunde);
        }catch(Exception $e){
            err($e->getMessage());
            return;
        }
        //pruefe ob email bereits in db
        if($_SESSION['model']->holeKunde($kunde->getEmail()) != null){
            err("Email already registered");
        }else{
            $_SESSION['model']->erstelleKunde($kunde);
        }
    }

    /** Gibt das aktuelle Kundenobjekt zur&uuml;ck 
        @return Kunde
    */
    function holeAngemeldetenKunde(){
        echo json_encode($_SESSION['kunde']->assoc()); 
    }
    
    /**  */
    function holeKunde($id){
        //TODO darf nur der Admin !!!!!!!!!!!!!!!
        $kunde = $_SESSION['model']->holeKundeMitId($id);
        if($kunde == null){
            err("no customer found");
        }else{
            $kunde->setPasswort(" ");
            echo json_encode($kunde->assoc());
        }
    }

    function holeArtikel($id){
        $art = $_SESSION['model']->holeArtikel($id);
        if($art == null){
            err("article not found");
        }else{
            echo json_encode($art->assoc());
        }
    }

    /** Gibt ein Array aller Kunden zur&uuml;ck */
    function holeAlleKunden(){
        //TODO nur dem admin erlauben !!!!!!!!!!!!!!!!!!!!!!!!
        $kunden = $_SESSION['model']->holeAlleKunden();
        for($i = 0; $i < count($kunden); $i++){
            $kunden[$i] = $kunden[$i]->assoc();
        }
        echo json_encode($kunden);
    }

    /** Aktualisiert das Kundenobjekt in Session und Datenbank
        @param kunde aktualisiertes Kundenobjekt
    */
    function aktualisiereKunde($kunde){
        $kunde = json_decode($kunde, true);
        try{
            $kunde = new Kunde($kunde);
        }catch(Exception $e){
            err($e->getMessage());
            return;
        }
        //TODO daten aktualisieren
    }

    /** Tr&auml;gt einen neuen Artikel in der Datenbank ein 
        @param artikel der einzutragende Artikel
    */
    function erstelleArtikel($artikel){
    }

    /** L&ouml;scht einen Artikel aus der Datenbank
        @param artikel der zu l&ouml;schende Artikel
    */
    function loescheArtikel($artikel){
    }

    /** Gibt die Rolle des aktuell angemeldeten Nutzers aus */
    function istAdmin(){
        $angemeldeterNutzer = $_SESSION['kunde']->getEmail();
        if(in_array($angemeldeterNutzer, $adminEmails)){
            return true;
        }else{
            return false;
        }
    }
    
    function holeRolle(){
        global $adminEmails;
        $angemeldeterNutzer = $_SESSION['kunde']->getEmail();
        if(in_array($angemeldeterNutzer, $adminEmails)){
            echo json_encode(array(utf8_encode("rolle") => utf8_encode("admin")));
        }else{
            echo json_encode(array(utf8_encode("rolle") => utf8_encode("nutzer")));
        }
    }
?>
