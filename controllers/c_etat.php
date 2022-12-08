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
            $lesEtats = getlesEtats();
            require "views/v_etat.php"; 
            break; 
        }
        case "ajouter" : { 
            $lesEtats = getlesEtats();
            
        
            require "views/v_etat.php" ; 
            break ;
        }
        case "validajout" : {
            $etatAjoutLibelle = $_POST['libelleEtat'] ;
            $etatAjoutDescription = $_POST['descriptionEtat'] ;
            if($etatAjoutLibelle == "" || $etatAjoutDescription == "")
            {
                
    
            }
            else
                if(existeEtat($etatAjoutLibelle) == false)
                {
                    etatInsertion($etatAjoutLibelle, $etatAjoutDescription) ;
                    
                    
                }
                else
                    echo '<div class="home">'
                    . '<p class="text-style-standard">' . $etatAjoutLibelle . ' existe déja !</p>' 
                    . '<br><a href="index.php?uc=etat&action=ajouter"> Retour </a>'  ;
            break;
            }
            case "modifier" : {
                $lesEtats = getLesEtats() ;
                require "views/v_etat.php" ; 
                break ;             
                }
        
                case "valider" : {
                    $modifEtatLibelle = $_POST['modifEtatLibelle'];
                    $modifEtatDescription = $_POST['modifEtatDescription'];
                    if($modifEtatLibelle == "" || $modifEtatDescription == "")
                    {
                        echo '<div class="home">'
                        . '<p class="text-style-standard">Veuillez saisir le nom de votre état et sa description !</p>'
                        . '<a href="index.php?uc=etat&action=modifier"> Retour </a>'  ;
        
                    }
                    else
                        if(existeEtat($modifEtatLibelle) == false || existeEtatDescription($modifEtatDescription) == false)
                        {
        
                            etatModification($id, $modifEtatLibelle, $modifEtatDescription) ;
                            echo '<div class="home">'  
                            . '<p class="text-style-standard">L'."'".'état se nomme désormais  ' . $modifEtatLibelle . ' avec ' . $modifEtatDescription . ' en description.   !</p>' 
                            . '<br><a href="index.php?uc=etat"> Retour </a>' ;
                            
                        }
                        else
                            echo '<div class="home">'
                            . '<p class="text-style-standard">L'."'".'état' . $modifEtatLibelle . ' existe déja !</p>' 
                            . '<br><a href="index.php?uc=etat&action=modifier"> Retour </a>'  ;
                                        
                    break;
                }
        }
?>