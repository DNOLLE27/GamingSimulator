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
            $lesTypes = getLesTypes();
            require "views/v_consoles.php"; 
            break; 
        }

        case 'modifConsole' :
        {
            $lesConsoles = getLesConsoles();
            $lesTypes = getLesTypes();
            $idModif = $_POST['idConsole'];
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
            $typeConsole = $_POST['typeConsole'];
            $lienImageConsole = $_POST['lienImage'];
            $messageErr = "";
            $messageReu = "";

            if (!empty($nomConsole) && verifNomConsole($nomConsole))
            {
                if (!verifConoleExiste($nomConsole,$typeConsole))
                {
                    ajoutConsole($nomConsole,$typeConsole,$lienImageConsole);
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

        case 'verifModifConsole' :
        {
            $lesConsoles = getLesConsoles();
            $idConsoleModif = $_POST['idConsModif'];
            $nomConsoleModif = $_POST['nomConsoleModif'];
            $typeConsoleModif = $_POST['typeConsoleModif'];
            $lienImageConsoleModif = $_POST['lienImageModif'];
            $ancienneConsole = getUneConsole($idConsoleModif);
            $messageErrModif = "";
            $messageReuModif = "";

            if ($nomConsoleModif != "" || $lienImageConsoleModif != "" || $typeConsoleModif != $ancienneConsole['idType'])
            {
                if ($nomConsoleModif != "" || $typeConsoleModif != $ancienneConsole['idType'])
                {
                    if ($nomConsoleModif == "" && $typeConsoleModif != $ancienneConsole['idType'])
                    {
                        $verifConsoleExiste = verifConoleExiste($ancienneConsole['descriptionCons'],$typeConsoleModif);
                    }
                    else
                    {
                        $verifConsoleExiste = verifConoleExiste($nomConsoleModif,$typeConsoleModif);
                    }

                    if (!$verifConsoleExiste)
                    {
                        if ($typeConsoleModif == $ancienneConsole['idType'])
                        {
                            $typeConsoleModif = "";
                        }

                        modifConsole($idConsoleModif,$nomConsoleModif,$typeConsoleModif,$lienImageConsoleModif);
                        $messageReuModif = "La console ".$ancienneConsole['descriptionCons']." a bien été modifié !";
                    }
                    else
                    {
                        $messageErrModif = "Vous ne pouvez pas saisir ces données car elle correspondent déjà à une autre console existante !";
                    }
                }
                else
                {
                    $typeConsoleModif = "";

                    modifConsole($idConsoleModif,$nomConsoleModif,$typeConsoleModif,$lienImageConsoleModif);
                    $messageReuModif = "La console ".$ancienneConsole['descriptionCons']." a bien été modifié !";
                }
            }
            else
            {
                $messageErrModif = "Aucune donnée n'a été modifié. Veuillez en saisir au moins une pour réaliser une modification !";
            }

            require "views/v_consoles.php"; 
            break;
        }
    }
?>