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
            $lesJeux = getlesJeux();
            require "views/v_jeux.php";
            break ;
        }
    }
?>