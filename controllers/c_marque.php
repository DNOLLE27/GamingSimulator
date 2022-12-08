<?php
    if (!isset($_REQUEST['action']))
    {
        $action = "afficher";
    }
    else
    {
        $action = $_REQUEST['action'];
    }

    if (!isset($_REQUEST['id']))
	$id = 0 ;
else
	$id = $_REQUEST['id'] ;

    switch($action)
    {
        case 'afficher' : 
        { 
            $lesMarques = getlesMarques();
            require "views/v_marque.php"; 
            break ; 
        }
        case "ajouter" : {
            $lesMarques = getlesMarques(); 
            
            require "views/v_marque.php" ; 
            break ;             
        }
        case "validajout" : {
            $marqueAjoutLibelle = $_POST['libelle'] ;
            $marqueAjoutLogo = $_POST['logoMarque'] ;
            if($marqueAjoutLibelle == "" || $marqueAjoutLogo == "")
            {
                echo '<div class="home">'
                . '<p class="erreur">Veuillez saisir une marque !</p>'
                . '<a href="index.php?uc=marque&action=ajouter"> Retour </a>'  ;

            }
            else
            {
                if(existeMarque($marqueAjoutLibelle) == false)
                {
                    marqueInsertion($marqueAjoutLibelle, $marqueAjoutLogo) ;
                    echo '<div class="home">'  
                    . '<p class="valider">La marque ' . $marqueAjoutLibelle . ' a bien été ajouté !</p>' 
                    . '<br><a href="index.php?uc=marque"> Retour </a>' ;
                
                }
                else
                {
                    
                    echo '<div class="home">'
                    . '<p class="erreur">La marque ' . $marqueAjoutLibelle . ' existe déja !</p>' 
                    . '<br><a href="index.php?uc=marque&action=ajouter"> Retour </a>'  ;
                }
            break;
            }
        }

        case "modifier" : {
        $lesMarques = getLesMarques() ;
        require "views/v_marque.php" ; 
        break ;             
        }

        case "valider" : {
            $modifMarqueLibelle = $_POST['modifMarqueLibelle'];
            $modifMarqueLogo = $_POST['modifMarqueLogo'];
            if($modifMarqueLibelle == "" || $modifMarqueLogo == "")
            {
                echo '<div class="home">'
                . '<p class="erreur">Veuillez saisir le nom de votre marque !</p>'
                . '<a href="index.php?uc=marque&action=modifier"> Retour </a>'  ;

            }
            else
            {
                if(existeMarque($modifMarqueLibelle) == false || existeLogoMarque($modifMarqueLogo) == false)
                {

                    marqueModification($id, $modifMarqueLibelle, $modifMarqueLogo) ;
                    echo '<div class="home">'  
                    . '<p class="valider">La marque se nomme désormais  ' . $modifMarqueLibelle . ' !</p>' 
                    . '<br><a href="index.php?uc=marque"> Retour </a>' ;
                    
                }
                else
                {
                    echo '<div class="home">'
                    . '<p class="erreur">La marque ' . $modifMarqueLibelle . ' existe déja !</p>' 
                    . '<br><a href="index.php?uc=marque&action=modifier"> Retour </a>'  ;
                }
            }
                                
            break;
        }

        case "supprimer" : {
            
            supMarque($id) ;
            echo '<div class="home">'  
                    . '<p class="valider">La marque sélectionné a bien été supprimé !</p>' 
                    . '<br><a href="index.php?uc=marque"> Retour </a>' ;
            break;
        }
}
?>