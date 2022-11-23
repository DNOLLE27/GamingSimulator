<?php
    if (!isset($_REQUEST['uc']))
    {
        $uc = "accueil";
    }
    else
    {
        $uc = $_REQUEST['uc'];
    }

    switch($uc)
    {
        case 'accueil' : { include "c_accueil.php"; break; }
        case 'authentification' : { include "c_auth.php"; break; }
        case 'deconnexion' : { include "includes/modeles/deconnexion.php"; break; }
    }
?>