<?php
    session_start();

    if(!isset($_REQUEST['action'])){
        echo json_encode(array('error' => 'action parameter missing'));
        die();
    }

    //public actions
    switch($_REQUEST['action']){
        case 'holeArtikel':
            exit();
        case 'login':
            exit();
    }

    //private actions
    if(!isset($_SESSION['kunde'])){
        echo json_encode(array('error' => 'unknown action or you need to be logged in'));
        die();
    }

    switch($_REQUEST['action']){
        case 'holeKundenDetails':
            exit();
        case 'logout':
            exit();
        default:        
    }
?>
