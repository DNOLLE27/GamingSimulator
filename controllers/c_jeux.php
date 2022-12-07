<?php
    if (!isset($_REQUEST['action']))
    {
        $action = "afficher";
    }
    else
    {
        $action = $_REQUEST['action'];
    }

    if (isset($_REQUEST['id']))
    {
        $id = $_REQUEST['id'];
    }

    switch($action)
    {
        case 'afficher' : 
        { 
            $nomsConsole = getLesNomsConsole();
            $nomsEtat = getLesNomsEtats();
            $lesJeux = getlesJeux();
            require "views/v_jeux.php";
            break ;
        }

        case 'inserer' :
        {
            insererJeu($_POST['nom'], $_POST['image'], $_POST['console'], $_POST['etat']);
            $nomsConsole = getLesNomsConsole();
            $nomsEtat = getLesNomsEtats();
            $lesJeux = getlesJeux();
            require "views/v_jeux.php";
            break ;
        }

        case 'triAlpha' :
        {
            $nomsConsole = getLesNomsConsole();
            $nomsEtat = getLesNomsEtats();
            $lesJeux = getLesJeuxAlpha();
            require "views/v_jeux.php";
            break;
        }

        case 'triCons' :
        {
            $nomsConsole = getLesNomsConsole();
            $nomsEtat = getLesNomsEtats();
            $lesJeux = getLesJeuxCons();
            require "views/v_jeux.php";
            break;
        }

        case 'supprimer' :
        {
            supprimerJeu($id);
            $nomsConsole = getLesNomsConsole();
            $nomsEtat = getLesNomsEtats();
            $lesJeux = getLesJeux();
            require "views/v_jeux.php";
            break;
        }
    }
?>