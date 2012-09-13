<?php
    ini_set('display_errors', '1'); //TODO just for debugging !!!! 
    require_once 'objects.php';
    require_once 'controller_functions.php';
    session_start();
    
    if(!isset($_SESSION['model'])){
        $_SESSION['model'] = new DatabaseModel();
    }

    if(!isset($_SESSION['kunde'])){
        $_SESSION['kunde'] = new Kunde(array("id" => -1, "name" => "Guest"));
    }

    if(!isset($_SESSION['korb'])){
        $_SESSION['korb'] = new Warenkorb();
    }

    if(!isset($_REQUEST['action'])){
        err("'action' parameter missing");
        die();
    }

    switch($_REQUEST['action']){
        case 'zeigeVeroeffentlichteArtikel':
            zeigeVeroeffentlichteArtikel();
            exit();
        case 'zeigeArtikel':
            zeigeArtikel();
            exit();
        case 'sucheArtikel':
            if(!isset($_GET['muster'])){
                err("'muster' parameter missing");
            }else{
                sucheArtikel($_GET['muster']);
            }
            exit();
        case 'holeArtikel':
            if(!isset($_GET['id'])){
                err("'id' parameter not set");
            }else if(!is_numeric($_GET['id'])){
                err("format not valid");
            }else{
                holeArtikel($_GET['id']);
            }
            exit();
        case 'holeWarenkorb':
            holeWarenkorb();
            exit();
        case 'aktualisiereWarenkorb':
            if(!isset($_POST['warenkorb'])){
                err("'warenkorb' parameter missing");
            }else{
               aktualisiereWarenkorb($_POST['warenkorb']);
            } 
            exit();
        case 'login':
            if(!isset($_POST['email'])){
                err("'email' parameter missing");
            }else if(!isset($_POST['passwort'])){
                err("'passwort' parameter missing");
            }else{
                login($_POST['email'], $_POST['passwort']);
            }
            exit();
        case 'registriereKunde':
            if(!isset($_POST['kunde'])){
                err("'kunde' parameter missing");
            }else{
                registriereKunde($_POST['kunde']);
            }
            exit();
        case 'holeAngemeldetenKunde':
            holeAngemeldetenKunde();
            exit();
        case 'holeKunde':
            if(!isset($_POST['id'])){
                err("'id' parameter missing");
            }else if(!is_numeric($_POST['id'])){
                err('invalid id format');
            }else{
                holeKunde($_POST['id']);
            }
            exit();
        case 'loescheKunde':
            if(!isset($_POST['kunde'])){
                err("'kunde' parameter missing");
            }else{
                loescheKunde($_POST['kunde']);
            }
            exit();
        case 'holeRolle':
            holeRolle();
            exit();
        case 'holeAlleKunden':
            holeAlleKunden();
            exit();
        case 'aktualisiereKunde':
            if(!isset($_POST['kunde'])){
                err("'kunde' parameter missing");
            }else{
                aktualisiereKunde($_POST['kunde']);
            }
            exit();
        case 'logout':
            logout();
            exit();
        case 'erstelleArtikel':
            if(!isset($_POST['artikel'])){
                err("'artikel' parameter missing");
            }else{
                erstelleArtikel($_POST['artikel']);
            }
            exit();
        case 'aktualisiereArtikel':
            if(!isset($_POST['artikel'])){
                err("'artikel' parameter missing");
            }else{
                aktualisiereArtikel($_POST['artikel']);
            }
            exit();
        case 'loescheArtikel':
            if(!isset($_POST['artikel'])){
                err("'artikel' parameter missing");
            }else{
                loescheArtikel($_POST['artikel']);
            }
            exit();
        case 'bestelle':
            if(!isset($_POST['methoden'])){
                err("'methoden' parameter missing");
            }else{
                bestelle($POST['methoden']);
            }
            exit();
        case 'holeBestellungen':
            holeBestellungen();
            exit();
        case 'holeAlleBestellungen':
            holeAlleBestellungen();
            exit();
        case 'holeArtikelVonBestellung':
            if(!isset($_POST['bestellung'])){
                err("'bestellung' parameter missing");
            }else{
                holeArtikelVonBestellung($_POST['bestellung']);
            }
        default:   
            echo json_encode(array('error' => 'unknown action'));     
    }

?>
