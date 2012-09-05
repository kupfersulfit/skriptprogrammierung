<?php
    session_start();
/*    include_once 'controller_functions.php';
    include_once "objects.php";*/
    if(!isset($_SESSION['kunde'])){ 
        $_SESSION['kunde'] = "gast";
    }

    if(!isset($_REQUEST['action'])){
        echo json_encode(array('error' => 'action parameter missing'));
        die();
    }

    switch($_REQUEST['action']){
        case 'zeigeArtikel':
            exit();
        case 'sucheArtikel':
            exit();
        case 'holeWarenkorb':
            exit();
        case 'aktualisiereWarenkorb':
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
