<?php
    function verifConnexion($email,$mdp)
    {
        require "connexion.php";

        $sql="SELECT mdpUser, mailUser, droitUser FROM utilisateur";
        $exec=$bdd->query($sql);

        $numUtilisateurs = $exec->rowCount();

        $lesUtilisateurs=$exec->fetchAll();

        $idx = 0;
        $coValid = false;

        while ($idx < $numUtilisateurs && !$coValid)
        {
            if ($lesUtilisateurs[$idx]['mailUser'] == $email && password_verify($mdp, $lesUtilisateurs[$idx]['mdpUser']))
            {
                $coValid = true;
            }
            else
            {
                $idx++;
            }
        }
        
        if ($coValid)
        {
            return $lesUtilisateurs[$idx]['droitUser'];
        }
        else
        {
            return null;
        }
    }

    function verifData($data)
    {
        $verifData = false;
        $liste_noire = "/[]()~!#{};|<>=+";

        if (strlen($data) <= 65 && strpbrk($data, $liste_noire) === false)
        {
            $verifData = true;
        }

        return $verifData;
    }

    function verifAdminExist()
    {
        require "connexion.php";

        $sql="SELECT COUNT(*) AS numAdmin FROM utilisateur WHERE droitUser = 2";
        $exec=$bdd->prepare($sql);
        $exec->execute();
        $numAdmin=$exec->fetch();

        if ($numAdmin['numAdmin'] == 0)
        {
            return false;
        }
        else
        {
            return true;
        }
    }

    function verifMDP($mdp)
    {
        $verifMDP = false;
        $regex = "/^(?=.*[a-zA-Z])(?=.*[0-9])(?=.*[@$!%*#?&])[a-zA-Z0-9@$!%*#?&]{8,}$/";

        if (strlen($mdp) >= 8)
        {
            if (preg_match($regex,$mdp))
            {
                $verifMDP = true;
            }
        }

        return $verifMDP;
    }

    function inscrireUser($email,$mdp,$droit)
    {
        require "connexion.php";

        $temps = 0.1;
        $cost = 10;

        do
        {
            $debut = microtime(true);
            password_hash($mdp, PASSWORD_DEFAULT, ['cost' => $cost]);
            $fin = microtime(true);
            $cost++;
        }
        while (($fin - $debut) < $temps);

        $mdpHash= password_hash($mdp, PASSWORD_DEFAULT, ['cost' => $cost]);

        $sql="INSERT INTO utilisateur (mailUser, mdpUser, droitUser) VALUES ('".$email."','".$mdpHash."',".$droit.")";
        $exec=$bdd->prepare($sql);
        $exec->execute();
    }
?>