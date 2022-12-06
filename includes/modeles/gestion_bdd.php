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

    function getLesConsoles()
    {
        require "connexion.php";
        
        $sql="SELECT idCons, descriptionCons, imageCons, libelleMarque, idMarque, idType, libelleType FROM console INNER JOIN type_console ON typeCons = idType INNER JOIN marque ON marqueType = idMarque";
        $exec=$bdd->query($sql);
        $lesConsoles=$exec->fetchAll();

        return $lesConsoles;
    }

    function getUneConsole($id)
    {
        require "connexion.php";
        
        $sql="SELECT idCons, descriptionCons, imageCons, libelleMarque, idMarque, idType, libelleType FROM console INNER JOIN type_console ON typeCons = idType INNER JOIN marque ON marqueType = idMarque WHERE idCons = $id";
        $exec=$bdd->query($sql);
        $laConsole=$exec->fetch();

        return $laConsole;
    }

    function getLesTypes()
    {
        require "connexion.php";
        
        $sql="SELECT idType, libelleType FROM type_console";
        $exec=$bdd->query($sql);
        $lesTypes=$exec->fetchAll();

        return $lesTypes;
    }

    function verifConoleExiste($nom,$typeCons)
    {
        require "connexion.php";

        $sql="SELECT descriptionCons FROM console INNER JOIN type_console ON typeCons = idType WHERE descriptionCons = '$nom' AND idType = $typeCons";
        $exec=$bdd->query($sql);

        $nbCons = $exec->rowCount();

        if ($nbCons == 0)
        {
            return false;
        }
        else
        {
            return true;
        }
    }

    function verifNomConsole($nom)
    {
        $verifNomConsole = false;
        $regex = "/^[a-zA-Z0-9][a-zA-Z0-9 ]{0,15}[a-zA-Z0-9]$/";
    
        if (preg_match($regex,$nom))
        {
            $verifNomConsole = true;
        }
        
        return $verifNomConsole;
    }

    function ajoutConsole($nom,$type,$lienImage)
    {
        require "connexion.php";

        $sql="INSERT INTO console (descriptionCons,imageCons,typeCons) VALUES ('$nom','$lienImage',$type)";
        $exec=$bdd->prepare($sql);
        $exec->execute();
    }

    function modifConsole($id,$nom,$type,$lienImage)
    {
        require "connexion.php";

        $sql="UPDATE console ";

        $cptSet = 0;
        $set = false;

        if ($nom != "")
        {
            $cptSet++;
        }

        if ($type != "")
        {
            $cptSet++;
        }

        if ($lienImage != "")
        {
            $cptSet++;
        }

        if ($nom != "")
        {
            if ($cptSet - 1 != 0)
            {
                if (!$set)
                {
                    $sql .= "SET descriptionCons = '".$nom."', ";
                    $set = true;
                }
                else
                {
                    $sql .= "descriptionCons = '".$nom."', ";
                }
            }
            else
            {
                if (!$set)
                {
                    $sql .= "SET descriptionCons = '".$nom."' ";
                    $set = true;
                }
                else
                {
                    $sql .= "descriptionCons = '".$nom."' ";
                }
            }
        }

        if ($type != "")
        {
            if ($cptSet - 1 != 0)
            {
                if (!$set)
                {
                    $sql .= "SET typeCons = ".$type.", ";
                    $set = true;
                }
                else
                {
                    $sql .= "typeCons = ".$type.", ";
                }
            }
            else
            {
                if (!$set)
                {
                    $sql .= "SET typeCons = ".$type." ";
                    $set = true;
                }
                else
                {
                    $sql .= "typeCons = ".$type." ";
                }
            }
        }

        if ($lienImage != "")
        {
            if ($cptSet - 1 != 0)
            {
                if (!$set)
                {
                    $sql .= "SET imageCons = '".$lienImage."', ";
                    $set = true;
                }
                else
                {
                    $sql .= "imageCons = '".$lienImage."', ";
                }
            }
            else
            {
                if (!$set)
                {
                    $sql .= "SET imageCons = '".$lienImage."' ";
                    $set = true;
                }
                else
                {
                    $sql .= "imageCons = '".$lienImage."' ";
                }
            }
        }

        $sql .= "WHERE idCons = ".$id;
        echo $sql;

        $exec=$bdd->prepare($sql);
        $exec->execute();
    }

    function supprConsole($id)
    {
        require "connexion.php";

        $sql="DELETE FROM console WHERE idCons = $id";
        $exec=$bdd->prepare($sql);
        $exec->execute();
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


    function marqueInsertion($libelle, $logoMarque) {
        require "connexion.php" ;
        $sql = "insert into marque (libelleMarque, logoMarque) values ('$libelle', '$logoMarque')" ;
        $exec=$bdd->prepare($sql) ;
        $exec->execute() ;
        $curseur=$exec->fetch() ;
        return $curseur;
    }

    function marqueModification($id, $libelle, $logoMarque) {
        require "connexion.php" ;
        $sql = "update marque "
                . "set libelleMarque = '$libelle', logoMarque = '$logoMarque' "
                . "where idMarque = $id " ;
        $exec=$bdd->prepare($sql) ;
        $exec->execute() ;
        $curseur=$exec->fetch() ;
        return $curseur;
    }
    
    function supMarque($id) {
        require "connexion.php" ;
        $sql = "delete from marque "
                . "where idMarque = $id " ;
        $exec=$bdd->prepare($sql) ;
        $exec->execute() ;
        $curseur=$exec->fetch() ;
        return $curseur;
    }

    function existeMarque($libelle){
        require "connexion.php" ;
        $sql = "select libelleMarque "
                . "from marque "
                . "where libelleMarque = '$libelle'" ;
        $exec=$bdd->prepare($sql) ;
        $exec->execute() ;
        $curseur=$exec->fetchAll() ;
        return $curseur;
    }

    function verifTypeConsExiste($nom,$marque)
    {
        require "connexion.php";

        $sql="SELECT libelleType FROM type_console WHERE libelleType = '$nom' AND marqueType = $marque";
        $exec=$bdd->query($sql);
        $nbTypeCons = $exec->rowCount();

        if ($nbTypeCons != 0)
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    function ajoutTypeConsole($nom,$marque)
    {
        require "connexion.php";

        $sql="INSERT INTO type_console (libelleType,marqueType) VALUES ('$nom',$marque)";
        $exec=$bdd->prepare($sql);
        $exec->execute();
    }

    function getNomMarque($id)
    {
        require "connexion.php";
        
        $sql="SELECT libelleMarque, logoMarque FROM marque WHERE idMarque = $id";
        $exec=$bdd->query($sql);
        $laMarque=$exec->fetch();

        return $laMarque;
    }
?>