<?php
    include_once "objects.php";

    /** Gibt alle Artikel zur&uuml;ck 
        @return Artikel[]
    */
    function zeigeArtikel(){
    }

    /** Sucht einen Artikel 
        @param suchstring String nach dem gesucht werden soll
        @return Artikel
    */
    function sucheArtikel($suchstring){
    }

    /** Gibt den aktuellen Warenkorb zur&uuml;ck
        @return Warenkorb
    */
    function holeWarenkorb(){
    }

    /** Gleicht den in der Session gespeicherten Warenkorb dem aktuellen an
        @param warenkorb Warenkorb Objekt
    */
    function aktualisiereWarenkorb($warenkorb){
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
