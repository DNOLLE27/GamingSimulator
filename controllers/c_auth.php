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

                if (verifData($email) && verifData($mdp))
                {
                   if (verifConnexion($email,$mdp) != null)
                    {
                        $_SESSION['droit'] = verifConnexion($email,$mdp);

                        echo verifConnexion($email,$mdp);

                        echo 'test';
                    }
                }

                require "views/v_auth.php";
                break;
        }

        case 'verifInscr' :
        {
            echo verifAdminExist();

            $email = $_POST['adrEmail'];
            $mdp = $_POST['mdp'];
            $emailVerif = $_POST['adrEmailVerif'];
            $mdpVerif = $_POST['mdpVerif'];

            if (verifData($email) && verifData($mdp) && verifData($emailVerif) && verifData($mdpVerif))
            {
                if ($email == $emailVerif && $mdp == $mdpVerif)
                {
                    if (verifAdminExist())
                    {
                        inscrireUser($email,$mdp,1);
                    }
                    else
                    {
                        inscrireUser($email,$mdp,2);
                    }
                }
            }

            echo verifAdminExist();

            require "views/v_auth.php";
            break;
        }
    }
?>