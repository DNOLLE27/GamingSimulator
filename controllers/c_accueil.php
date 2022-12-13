<?php
    if (!isset($_REQUEST['action']))
    {
        $action = "afficher";
    }
    else
    {
        $action = $_REQUEST['action'];
    }

    switch($action)
    {
        case 'afficher' : 
        { 
            $jeuxAccueil = jeuxAccueil();
            $consoleAccueil = consoleAccueil();
            require "views/v_accueil.php"; 
            break; 
        }
    }
?>