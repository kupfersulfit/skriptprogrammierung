<?php
    require_once "objects.php";
    require_once "model.php";
    
    /** Gibt eine Fehlermeldung aus */
    function err($nachricht){
        echo json_encode(array("error" => "$nachricht"));
    }
    /** Gibt alle Artikel zur&uuml;ck 
        @return Artikel[]
    */
    function zeigeArtikel(){
        $artikelArray = $_SESSION['model']->holeAlleArtikel(); //TODO holeVeroeffentlichteArtikelAusDatenbank()
        if(count($artikelArray) == 0){
            err("no existing article");
        }else{
            for($i = 0; $i < count($artikelArray); $i++){ //convert object to assoc array
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
        $artikel = null; //TODO sucheArtikelInDatenbank()
        if($artikel == null){
            err("no article found");
        }else{
            echo json_encode($artikel->assoc());
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
        $korb = json_decode($warenkorb); //assoc array erzeugen
        $korb = new Warenkorb($korb); //warenkorbobjekt erzeugen
        $artikelListe = $korb->getArtikelFeld(); //hole liste aller artikel im korb
        for($i = 0; $i < count($artikelListe); $i++){ //ueberschreibe vom client empfangene mit aus der db geholten daten (um zb preisfaelschungen zu vermeiden)
            $artikelListe[$i] = null; //TODO holeArtikelAusDatenbank(artikelId)
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
    }

    /** Zerst&ouml;rt das Kundenobjekt in der Session (nicht den Warenkorb) */
    function logout(){
    }

    /** Versucht einen neuen Kunden anzulegen 
        @param kunde Kundenobjekt des anzulegenden Kunden*/
    function registriereKunde($kunde){
    }

    /** Gibt das aktuelle Kundenobjekt zur&uuml;ck 
        @return Kunde
    */
    function holeKunde(){
    }

    /** Aktualisiert das Kundenobjekt in Session und Datenbank
        @param kunde aktualisiertes Kundenobjekt
    */
    function aktualisiereKunde($kunde){
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
?>
