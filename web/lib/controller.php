<?php
    session_start();
    include_once('controller_functions.php');
    if(!isset($_SESSION['kunde'])){ //session und TODO warenkorb erstellen
        $_SESSION['kunde'] = "gast";
    }

    if(!isset($_REQUEST['action'])){
        echo json_encode(array('error' => 'action parameter missing'));
        die();
    }

    //public actions
    switch($_REQUEST['action']){
        case 'zeigeArtikel':
            exit();
        case 'sucheArtikel':
            exit();
        case 'aktualisiereWarenkorb':
            exit();
        case 'login':
            exit();
    }

    //private actions
    if(!isset($_SESSION['kunde'])){
        echo json_encode(array('error' => 'unknown action or not logged in'));
        die();
    }

    switch($_REQUEST['action']){
        case 'holeKunde':
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
