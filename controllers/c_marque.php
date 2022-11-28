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
            $lesMarques = getlesMarques();
            require "views/v_marque.php"; 
            break ; 
        }
    }
?>