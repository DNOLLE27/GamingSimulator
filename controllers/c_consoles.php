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

        case 'supprConsole' :
        {
            $lesConsoles = getLesConsoles();
            $idSuppr = $_POST['idConsole'];
            require "views/v_consoles.php"; 
            break; 
        }

        case 'validSupprConsole' :
        {
            $lesConsoles = getLesConsoles();
            $idSupprValid = $_POST['idConSuppr'];
            supprConsole($idSupprValid);

            header("Location:index.php?uc=consoles"); 
            break; 
        }

        case 'verifAjoutConsole' :
        {
            $nomConsole = $_POST['nomConsole'];
            $marqueConsole = $_POST['marqueConsole'];
            $messageErr = "";
            $messageReu = "";

            if (!empty($nomConsole) && verifNomConsole($nomConsole))
            {
                if (!verifConoleExiste($nomConsole,$marqueConsole))
                {
                    ajoutConsole($nomConsole,$marqueConsole);
                    $messageReu = "La console ".$nomConsole." a bien été enregistrée !";
                }
                else
                {
                    $messageErr = "Erreur : La console saisie existe déjà, veuillez en saisir une autre !";
                }
            }
            else
            {
                $messageErr = "Erreur : Le nom saisi n'est pas valide, veuillez la resaisir !";
            }

            require "views/v_consoles.php"; 
            break;
        }
    }
?>