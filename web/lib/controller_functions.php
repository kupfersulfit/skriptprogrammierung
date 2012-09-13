<?php
    require_once 'objects.php';
    require_once 'model.php';
    require_once 'admin.php';

    /** Gibt eine Fehlermeldung aus */
    function err($nachricht){
        echo json_encode(array(utf8_encode("error") => utf8_encode("$nachricht")));
    }

    /** Gibt eine Erfolgsmeldung aus */
    function success(){
        echo json_encode(array(utf8_encode("success") => utf8_encode("success")));
    }

    /** Zeigt alle Artikel an */
    function zeigeArtikel(){
        $artikelArray = $_SESSION['model']->holeAlleArtikel();
        if(count($artikelArray) == 0){
            err("no existing article");
        }else{
            for($i = 0; $i < count($artikelArray); $i++){ 
                $kategorie = $artikelArray[$i]->getKategorieId();
                $kategorie = $_SESSION["model"]->holeKategorie($kategorie); //kategorienamen aus der db holen
                $artikelArray[$i]->setKategorieId($kategorie->getName()); //wird ggf auf null/leerstring gesetzt
                $artikelArray[$i] = $artikelArray[$i]->assoc(); //objekt in assoz. array umwandeln
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
            for($i = 0; $i < count($artikelArray); $i++){
                $kategorie = $artikelArray[$i]->getKategorieId();
                $kategorie = $_SESSION["model"]->holeKategorie($kategorie); 
                $artikelArray[$i]->setKategorieId($kategorie->getName());
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
            err("no article '.$suchstring.' found");
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
        $korb = json_decode($warenkorb, true); //assoz array aus json string erzeugen
        try{
            $korb = new Warenkorb($korb); //warenkorbobjekt erzeugen
        }catch(Exception $e){
            err($e->getMessage());
            return;
        }
        $artikelListe = $korb->getArtikelFeld(); //hole liste aller artikel im neuen korb
        for($i = 0; $i < count($artikelListe); $i++){
            $artikelId = $artikelListe[$i]->getId();
            $anzahl = $artikelListe[$i]->getVerfuegbar(); //merken zum uebernehmen, hier steht bei artikeln im warenkorb die anzahl der bestellten artikel (in der db anzahl verfuegbare)
            $art = $_SESSION['model']->holeArtikel($artikelId); //hole korrekten daten aus der db falls die per js bekommenen falsch sein sollten
            if($art == null){
                err("unknown article id");
                return;
            }else if(!$art->getVeroeffentlicht()){
                err("article not published");
                return;
            }else if($anzahl > $art->getVerfuegbar()){ //teste ob noch genug artikel auf lager
                err("not enough ".$art->getName()." available");
                return;
            }
            $artikelListe[$i] = $art; //ersetze artikeldetails um zb preisfaelschungen zu verhindern
            $artikelListe[$i]->setVerfuegbar((int) $anzahl);
        }
        $korb->setArtikelFeld($artikelListe); //warenkorb objekt mit den 'korrekten' daten updaten
        $_SESSION['korb'] = $korb; //neuen warenkorb in der session speichern
        echo json_encode($_SESSION['korb']->assoc()); //und zurueckschicken
    }

    /** Testet den gegebenen Login und ersetzt ggf. die Sessionvariable "Kunde"
        @param email Email des Nutzers
        @param passwort Passwort des Nutzers
        @return username warenkorb
    */
    function login($email, $passwort){
        if($_SESSION['kunde']->getEmail() != ""){
            err("already logged in");
            return;
        }else if(!preg_match("/^[^@]+@[^@]{3,}\.[^\.@0-9]{2,}$/", $email)){
            err("invalid email address");
            return;
        }
        $hash = crypt($passwort, $email);
        if($_SESSION['model']->pruefeLogin($email, $hash) == true){
            $_SESSION['kunde'] = $_SESSION['model']->holeKunde($email);
            $_SESSION['kunde']->setPasswort(" ");
            holeAngemeldetenKunde(); //kundendaten ausgeben
        }else{
            err("login failed");
        }
    }

    /** Zerst&ouml;rt das Kundenobjekt in der Session (nicht den Warenkorb) */
    function logout(){
        $_SESSION['kunde'] = new Kunde(array("id" => -1, "name" => "Guest"));
        if($_SESSION['kunde']->getName() == "Guest"){
            success();
        }else{
            err("logout failed");
        }
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
            $kunde->setPasswort(crypt($kunde->getPasswort(), $kunde->getEmail())); //passwort verschluesseln
            date_default_timezone_set('Europe/Berlin');
            $kunde->setRegistriertseit(date("Y-m-d H:i:s", time()));
            $_SESSION['model']->erstelleKunde($kunde);
            success();
        }
    }

    /** Loescht den angegebenen Kunden 
        @param kunde der zu l&ouml;schende Kunde 
    */
    function loescheKunde($kunde){
        if(!istAdmin()){
            err("only an admin can delete customers");
            return;
        }
        try{
            $kunde = json_decode($kunde, true); //nicht direkt auf das array element zugreiffen, um die fehlerpruefung mitzunehmen
        }catch(Exception $e){
            err($e->getMessage());
            return;
        }
        if($_SESSION['model']->loescheKunde($kunde['email']) == null){
            err("deletion failed");
            return;
        }
        success();
    }

    /** Gibt das aktuelle Kundenobjekt zur&uuml;ck 
        @return Kunde
    */
    function holeAngemeldetenKunde(){
        echo json_encode($_SESSION['kunde']->assoc()); 
    }
    
    /** Gibt die Daten eines bestimmten Kunden aus */
    function holeKunde($id){
        if(!istAdmin()){
            err('only admins can see customer details');
            return;
        }
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
        if(!istAdmin()){
            err('only admins can see all customers');
            return;
        }
        $kunden = $_SESSION['model']->holeAlleKunden();
        for($i = 0; $i < count($kunden); $i++){
            $kunden[$i] = $kunden[$i]->assoc();
        }
        echo json_encode($kunden);
    }

    /** Aktualisiert das Kundenobjekt in der Datenbank und ggf in der Session
        @param kunde aktualisiertes Kundenobjekt
    */
    function aktualisiereKunde($kunde){
        $kunde = json_decode($kunde, true);
        if(!istAdmin() && $kunde['id'] != $_SESSION['kunde']->getId()){
            err("only admins can edit other customers");
            return;
        }

        //hole aktuelles pw aus der db 
        $alterkunde = $_SESSION['model']->holeKundeMitId($kunde['id']);
        //vermeide dass das pw geloescht wird
        $kunde['passwort'] = $alterkunde->getPasswort(); 
        try{
            $kunde = new Kunde($kunde);
        }catch(Exception $e){
            err($e->getMessage());
            return;
        }
        $_SESSION['model']->aktualisiereKunde($kunde);

        //falls der angemeldete admin seine daten aktualisiert hat, session updaten
        if($_SESSION['kunde']->getId() == $kunde->getId()){
            $_SESSION['kunde'] = $_SESSION['model']->holeKundeMitId($kunde->getId());
        }
        success();
    }

    /** Tr&auml;gt einen neuen Artikel in der Datenbank ein 
        @param artikel der einzutragende Artikel
    */
    function erstelleArtikel($artikel){
        if(!istAdmin()){
            err('only admins can create articles');
            return;
        }
        $artikel = json_decode($artikel, true);
        try{
            $artikel = new Artikel($artikel);
        }catch(Exception $e){
            err($e->getMessage());
            return;
        }
        if($_SESSION['model']->erstelleArtikel($artikel) == false){
            err('article not created');
        }
    }

    /** L&ouml;scht einen Artikel aus der Datenbank
        @param artikel der zu l&ouml;schende Artikel
    */
    function loescheArtikel($artikel){
        if(!istAdmin()){
            err("only admins can delete articles");
            return;
        }
        $artikel = json_decode($artikel, true);
        try{
            $artikel = new Artikel($artikel); //um die fehlerpruefung mitzunehmen
        }catch(Exception $e){
            err($e->getMessage());
        }
        if($_SESSION['model']->loescheArtikel($artikel->getId()) == null){
            err("article not deleted");
        }else{
            success();
        }
    }

    /** Aktualisiert Artikeldaten in der DB 
        @param artikel der zu aktualisierende Artikel
    */
    function aktualisiereArtikel($artikel){
        if(!istAdmin()){
            err("only admins can update articles");
            return;
        }
        $artikel = json_decode($artikel, true);
        try{
            $artikel = new Artikel($artikel);
        }catch(Exception $e){
            err($e->getMessage());
        }
        $_SESSION['model']->aktualisiereArtikel($artikel);
    }

    /** Testet ob der aktuell angemeldete Nutzer ein Admin ist */
    function istAdmin(){
        global $adminEmails;
        $angemeldeterNutzer = $_SESSION['kunde']->getEmail();
        if(in_array($angemeldeterNutzer, $adminEmails)){
            return true;
        }else{
            return false;
        }
    }
    
    /** Gibt die Rolle des aktuell angemeldeten Nutzers aus */
    function holeRolle(){
        if($_SESSION['kunde']->getEmail() == ""){
            echo json_encode(array(utf8_encode("rolle") => utf8_encode("guest")));
        }else if(istAdmin()){
            echo json_encode(array(utf8_encode("rolle") => utf8_encode("admin")));
        }else{
            echo json_encode(array(utf8_encode("rolle") => utf8_encode("nutzer")));
        }
    }

    /** Gibt eine Bestellung auf */
    function bestelle($bestellungsinfos){
        if($_SESSION['kunde']->getId() == -1){
            err("you need to be logged in to order");
            return;
        }

        //zu bestellende artikel aus warenkorb holen
        $alleArtikel = $_SESSION['korb']->getArtikelFeld();
        if(count($alleArtikel) < 1){
            err("you need to order at least 1 item");
            return;
        }

        //erneut pruefen ob noch genug artikel auf lager
        foreach($alleArtikel as $artikel){
            $tempArtikel = $_SESSION['model']->holeArtikel($artikel->getId()); //aktuellen db eintrag holen
            if($tempArtikel->getVerfuegbar() < $artikel->getVerfuegbar()){
                err("not enough ".$artikel->getName()." available");
                return;
            }
        }

        //bestellung anlegen
        $bestellungsinfos = json_decode($bestellungsinfos, true); //TODO
        $bestellung = array();
        $bestellung['id'] = "";
        $bestellung['kundenid'] = $_SESSION['kunde']->getId();
        date_default_timezone_set('Europe/Berlin');
        $bestellung['bestelldatum'] = date("Y-m-d H:i:s", time());
        $bestellung['statusid'] = 1; //1 ^= offen/in bearbeitung
        $bestellung['zahlungsmethodeid'] = ""; //TODO
        $bestellung['lieferungsmethodeid'] = ""; //TODO
        try{
            $bestellung = new Bestellung($bestellung);
        }catch(Exception $e){
            err($e->getMessage());
            return;
        }

        //bestellung in db eintragen
        if($_SESSION['model']->erstelleBestellung($bestellung, $alleArtikel) == false){
            err("order could not be completed");
        }

        //artikelanzahl (verfuegbar) in der DB anpassen
        for($i = 0; $i < count($alleArtikel); $i++){
            $tempArtikel = $_SESSION['model']->holeArtikel($alleArtikel[$i]->getId()); //aktuellen db eintrag holen
            $tempArtikel->setVerfuegbar($tempArtikel->getVerfuegbar() - $alleArtikel[$i]->getVerfuegbar()); //anzahl vorhanderner artikel anpassen
            $_SESSION['model']->aktualisiereArtikel($tempArtikel); //aenderung in db eintragen
        }

        //warenkorb leeren
        $_SESSION['korb'] = new Warenkorb();
        success();
    }
?>
