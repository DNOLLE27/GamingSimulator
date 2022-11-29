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

    function verifUserExist($email)
    {
        require "connexion.php";

        $sql="SELECT mailUser FROM utilisateur WHERE mailUser = '$email'";
        $exec=$bdd->query($sql);
        $nbUtilisateurs = $exec->rowCount();

        if ($nbUtilisateurs != 0)
        {
            return true;
        }
        else
        {
            return false;
        }
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

    function jeuxAccueil(){
        $rnd = rand(0,18);
        require "connexion.php";

        $sql="SELECT nomJeux, imageJeux, libelleType FROM jeux INNER JOIN type_console ON typeConsoleJeux = idType LIMIT 4 OFFSET $rnd";
        $exec=$bdd->query($sql);
        $curseur=$exec->fetchAll();

        return $curseur;
    }

    function consoleAccueil(){
        $rnd = rand(0,10);
        require "connexion.php";

        $sql="SELECT descriptionCons, imageCons FROM console LIMIT 4 OFFSET $rnd";
        $exec=$bdd->query($sql);
        $curseur=$exec->fetchAll();

        return $curseur;
    }



    function lEtat($id)
    {
        require "connexion.php";

        $sql="SELECT idEtat, libelleEtat, descriptionEtat FROM etat WHERE idEtat = '$id'";
        $exec=$bdd->query($sql) ;
        $exec->execute() ;
        $curseur=$exec->fetch();
        return $curseur;

    }

    function getLesEtats()
    {
        require "connexion.php";

        $sql = "select idEtat, libelleEtat, descriptionEtat "
            . "from etat " ;
        $exec=$bdd->query($sql) ;
        $exec->execute() ;
        $curseur=$exec->fetchAll();
        return $curseur;
    }

    function getLesMarques()
    {
        require "connexion.php";

        $sql = "select idMarque, libelleMarque, logoMarque "
            . "from marque " ;
        $exec=$bdd->query($sql) ;
        $exec->execute() ;
        $curseur=$exec->fetchAll();
        return $curseur;
    }

    function getLesJeux()
    {
        require "connexion.php";

        $sql="SELECT nomJeux, imageJeux, libelleType FROM jeux INNER JOIN type_console ON typeConsoleJeux = idType";
        $exec=$bdd->query($sql) ;
        $exec->execute() ;
        $curseur=$exec->fetchAll();
        return $curseur;
    }
?>