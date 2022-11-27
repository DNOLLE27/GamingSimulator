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
            $lesConsoles = getLesConsoles();
            require "views/v_consoles.php"; 
            break; 
        }

        case 'ajoutConsole' :
        {
            $lesConsoles = getLesConsoles();
            $lesMarques = getLesMarques();
            require "views/v_consoles.php"; 
            break; 
        }

        case 'verifAjoutConsole' :
        {
            $nomConsole = $_POST['nomConsole'];
            $marqueConsole = $_POST['marqueConsole'];

            if (!empty($nomConsole) && verifNomConsole($nomConsole))
            {
                if (!verifConoleExiste($nomConsole,$marqueConsole))
                {
                    ajoutConsole($nomConsole,$marqueConsole);
                }
            }
        }
    }
?>