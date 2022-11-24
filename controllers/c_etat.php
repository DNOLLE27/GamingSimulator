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
            $lesEtats = getlesEtats();
            require "views/v_etat.php"; 
            break; 
        }
    }
?>