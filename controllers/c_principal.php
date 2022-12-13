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
        case 'consoles' : { include "c_consoles.php"; break;}
        case 'deconnexion' : { include "includes/modeles/deconnexion.php"; break; }
        case 'marque' : { include "c_marque.php"; break; }
        case 'etat' : { include "c_etat.php"; break; }
        case 'jeux' : {include "c_jeux.php"; break; }

    }
?>