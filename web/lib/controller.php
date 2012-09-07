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
            if(!isset($_GET['warenkorb'])){
                err("'warenkorb' parameter missing");
            }else{
               aktualisiereWarenkorb($_GET['warenkorb']);
            } 
            exit();
        case 'login':
            if(!isset($_POST['email'])){
                err("'email' parameter missing");
            }else if(!isset($_POST['passwort'])){
                err("'passwort' parameter missing");
            }else if($_SESSION['kunde']->getEmail() != ""){
                err("already logged in");
            }else{
                login($_POST['email'], $_POST['passwort']);
            }
            exit();
        case 'registriereKunde':
            if(!isset($_GET['kunde'])){
                err("'kunde' parameter missing");
            }else{
                registriereKunde($_GET['kunde']);
            }
            exit();
        case 'holeKunde':
            holeKunde();
            exit();
        case 'holeAlleKunden':
            holeAlleKunden();
            exit();
        case 'aktualisiereKunde':
            exit();
        case 'logout':
            logout();
            exit();
        case 'erstelleArtikel':
            exit();
        case 'loescheArtikel':
            exit();
        default:   
            echo json_encode(array('error' => 'unknown action'));     
    }

?>
