<?php
    session_start();
    ini_set('display_errors', '1'); //TODO just for debugging !!!! 
    require_once 'controller_functions.php';
    require_once 'objects.php';
    
    if(!isset($_SESSION['model'])){
        $_SESSION['model'] = new DatabaseModel();
    }

    if(!isset($_SESSION['kunde'])){ 
        $_SESSION['kunde'] = "gast";
    }

    if(!isset($_REQUEST['action'])){
        err("'action' parameter missing");
        die();
    }

    switch($_REQUEST['action']){
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
            exit();
        case 'registriereKunde':
            exit();
        case 'holeKunde':
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
