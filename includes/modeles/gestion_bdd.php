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
        require "connexion.php";

        $sql1="SELECT count(*) from jeux";
        $exec1=$bdd->query($sql1);
        $curseur1=$exec1->fetch();
        $rnd = rand(0,$curseur1[0]-4);

        $sql2="SELECT nomJeux, imageJeux, libelleType, libelleEtat FROM jeux "
        . "INNER JOIN type_console ON typeConsoleJeux = idType "
        . "INNER JOIN etat on idEtat = etatJeux "
        . "ORDER BY idJeux "
        . "LIMIT 4 OFFSET $rnd ";
        $exec2=$bdd->query($sql2);
        $curseur2=$exec2->fetchAll();

        return $curseur2;
    }

    function consoleAccueil(){
        require "connexion.php";

        $sql1="SELECT count(*) from console";
        $exec1=$bdd->query($sql1);
        $curseur1=$exec1->fetch();
        $rnd = rand(0,$curseur1[0]-4);

        $sql2="SELECT descriptionCons, imageCons FROM console LIMIT 4 OFFSET $rnd";
        $exec2=$bdd->query($sql2);
        $curseur2=$exec2->fetchAll();

        return $curseur2;
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

        $sql="SELECT idJeux, nomJeux, imageJeux, libelleType, libelleEtat FROM jeux "
        . "INNER JOIN type_console ON typeConsoleJeux = idType "
        . "INNER JOIN etat on idEtat = etatJeux "
        . "ORDER BY idJeux";
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
    }

    function marqueModification($id, $libelle, $logoMarque) {
        require "connexion.php" ;
        $sql = "update marque "
                . "set libelleMarque = '$libelle', logoMarque = '$logoMarque' "
                . "where idMarque = $id " ;
        $exec=$bdd->prepare($sql) ;
        $exec->execute() ;
    }
    
    function supMarque($id) {
        require "connexion.php" ;
        $sql = "delete from marque "
                . "where idMarque = $id " ;
        $exec=$bdd->prepare($sql) ;
        $exec->execute() ;
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

    function existeLogoMarque($logoMarque){
        require "connexion.php" ;
        $sql = "select logoMarque "
                . "from marque "
                . "where logoMarque = '$logoMarque'" ;
        $exec=$bdd->prepare($sql) ;
        $exec->execute() ;
        $curseur=$exec->fetchAll() ;
        return $curseur;
    }
    function getLesNomsConsole(){
        require "connexion.php";
        $sql = "select idType, libelleType from type_console";
        $exec=$bdd->prepare($sql) ;
        $exec->execute() ;
        $curseur=$exec->fetchAll() ;
        return $curseur;
    }

    function verifSupprMarque(){
        require "connexion.php" ;
        $sql = "select idMarque "
                . "from marque "
                . "where idMarque not in (select marqueType from type_console) " ;
        $exec=$bdd->prepare($sql) ;
        $exec->execute() ;
        $curseur=$exec->fetchAll() ;
        return $curseur;
    }

    function etatInsertion($libelle, $description) {
        require "connexion.php" ;
        $sql = "insert into etat (libelleEtat, descriptionEtat) values ('$libelle', '$description')" ;
        $exec=$bdd->prepare($sql) ;
        $exec->execute() ;
        $curseur=$exec->fetch() ;
        return $curseur;
    }

    function etatModification($id, $libelle, $description) {
        require "connexion.php" ;
        $sql = "update etat "
                . "set libelleEtat = '$libelle', descriptionEtat = '$description' "
                . "where idEtat = $id " ;
        $exec=$bdd->prepare($sql) ;
        $exec->execute() ;
        $curseur=$exec->fetch() ;
        return $curseur;
    }

    function existeEtat($libelle){
        require "connexion.php" ;
        $sql = "select libelleEtat "
                . "from etat "
                . "where libelleEtat = '$libelle'" ;
        $exec=$bdd->prepare($sql) ;
        $exec->execute() ;
        $curseur=$exec->fetchAll() ;
        return $curseur;
    }

    function existeEtatDescription($description){
        require "connexion.php" ;
        $sql = "select descriptionEtat "
                . "from etat "
                . "where descriptionEtat = '$description'" ;
        $exec=$bdd->prepare($sql) ;
        $exec->execute() ;
        $curseur=$exec->fetchAll() ;
        return $curseur;
    }

    function getLesNomsEtats(){
        require "connexion.php";
        $sql = "select idEtat, libelleEtat from etat";
        $exec=$bdd->query($sql) ;
        $exec->execute() ;
        $curseur=$exec->fetchAll() ;
        return $curseur;
    }

    function getLesJeuxAlpha(){

        require "connexion.php";

        $sql="SELECT idJeux, nomJeux, imageJeux, libelleType, libelleEtat FROM jeux "
        . "INNER JOIN type_console ON typeConsoleJeux = idType "
        . "INNER JOIN etat on idEtat = etatJeux "
        . "ORDER BY nomJeux";
        $exec=$bdd->query($sql) ;
        $exec->execute() ;
        $curseur=$exec->fetchAll();
        return $curseur;
    }

    function getLesJeuxCons(){
        
        require "connexion.php";

        $sql="SELECT idJeux, nomJeux, imageJeux, libelleType, libelleEtat FROM jeux "
        . "INNER JOIN type_console ON typeConsoleJeux = idType "
        . "INNER JOIN etat on idEtat = etatJeux "
        . "ORDER BY libelleType";
        $exec=$bdd->query($sql) ;
        $exec->execute() ;
        $curseur=$exec->fetchAll();
        return $curseur;
    }

    function insererJeu($nom, $image, $console, $etat){
        require "connexion.php";

        $sql="INSERT INTO jeux(nomJeux, imageJeux, typeConsoleJeux, etatJeux) VALUES ('$nom', '$image', $console, $etat)";
        $exec=$bdd->prepare($sql) ;
        $exec->execute() ;
    }

    function supprimerJeu($id){
        require "connexion.php";

        $sql="DELETE FROM jeux WHERE idJeux = $id";
        $exec=$bdd->prepare($sql) ;
        $exec->execute() ;
    }

    function getLesTypes()
    {
        require "connexion.php";
        
        $sql="SELECT idType, libelleType FROM type_console";
        $exec=$bdd->query($sql);
        $lesTypes=$exec->fetchAll();

        return $lesTypes;
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

?>