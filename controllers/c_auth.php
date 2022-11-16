<?php
    if (!isset($_REQUEST['action']))
    {
        $action = "connexion";
    }
    else
    {
        $action = $_REQUEST['action'];
    }

    switch($action)
    {
        case 'connexion' : 
        {
            $typeFormulaire = "connexion";
            require "views/v_auth.php"; 
            break; 
        }

        case 'inscription' : 
        {
            $typeFormulaire = "inscription";
            require "views/v_auth.php"; 
            break; 
        }

        case 'verifCnx' :
        {
                $email = $_POST['adrEmail'];
                $mdp = $_POST['mdp'];

                $messageErr = "";
                $messageReussi = "";

                if (verifData($email) && verifData($mdp))
                {
                    if (verifConnexion($email,$mdp) != null)
                    {
                        $_SESSION['email'] = $email;
                        $_SESSION['droit'] = verifConnexion($email,$mdp);

                        $messageReussi = "Vous êtes bien connecté en tant que : ".$email." !";
                    }
                    else
                    {
                        $messageErr = "Mot de passe ou adresse e-mail incorrecte !";
                    }
                }
                else
                {
                    $messageErr = "Les données saisies ne sont pas valides, veuillez les resaisir !";
                }

                require "views/v_auth.php";
                break;
        }

        case 'verifInscr' :
        {
            $email = $_POST['adrEmail'];
            $mdp = $_POST['mdp'];
            $emailVerif = $_POST['adrEmailVerif'];
            $mdpVerif = $_POST['mdpVerif'];

            $messageErr = "";

            if (verifData($email) && verifData($mdp) && verifData($emailVerif) && verifData($mdpVerif))
            {
                if ($email == $emailVerif && $mdp == $mdpVerif)
                {
                    if (!verifUserExist($email))
                    {
                        if (verifMDP($mdp))
                        {
                            if (verifAdminExist())
                            {
                                inscrireUser($email,$mdp,1);
                                $messageReussi = "Inscription de : ".$email." réussi !";
                            }
                            else
                            {
                                inscrireUser($email,$mdp,2);
                                $messageReussi = "Inscription de : ".$email." réussi !";
                            }
                        }
                        else
                        {
                            $messageErr = "Le mot de pase saisi n'est pas valide, veuillez vérifier si ce mot de passe contient 8 caractères minimum et au moins contenir une majuscule, une minuscule, un chiffre et un caractère spécial autorisé (@, $, !, %, *, #, ? et &) !";
                        }
                    }
                    else
                    {
                        $messageErr = "L'adresse e-mail saisie correspond déjà à un utilisateur enregistré, veuillez vous connecter !";
                    }
                }
                else
                {
                    $messageErr = "Le mot de passe ou l'adresse e-mail n'a pas pu être vérifié, veuillez les resaisir !";
                }
            }
            else
            {
                $messageErr = "Les données saisies sont incorrectes, veuillez les resaisir ! </br> (Le mot de passe doit contenir 8 caractère minimum et il doit au moins contenir une majuscule, une minuscule, un chiffre et un caractère spécial autorisé (@, $, !, %, *, #, ? et &) et l'adresse e-mail doit avoir un format correcte (exemple@mail.com) !)";
            }

            require "views/v_auth.php";
            break;
        }
    }
?>