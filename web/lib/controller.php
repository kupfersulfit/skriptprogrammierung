<?php
    ini_set('display_errors', '1'); //TODO just for debugging !!!! 
    require_once 'controller_functions.php';
    require_once 'model.php';
    require_once 'objects.php';
    session_start();
    
    if(!isset($_SESSION['model'])){
        $_SESSION['model'] = new DatabaseModel();
    }

    if(!isset($_SESSION['kunde'])){
        $gast = new Kunde(array("id" => -1, "name" => "Guest"));
        $_SESSION['kunde'] = $gast;
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
            exit();
        case 'holeKunde':
            echo json_encode(array("id" => "1", "name" => "mustermann", "vorname" => "max", "strasse" => "Elmstreet 666", "plz" => "66666", "zusatz" => "", "email" => "max@mustermann.de", "passwort" => "", "registriertseit" => "2012-09-06"));
            exit();
        case 'aktualisiereKunde':
            exit();
        case 'logout':
            exit();
        case 'erstelleArtikel':
            exit();
        case 'loescheArtikel':
            exit();
        default:   
            echo json_encode(array('error' => 'unknown action'));     
    }

?>
