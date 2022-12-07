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
                    . '<p class="erreur">' . $etatAjoutLibelle . ' existe déja !</p>' 
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
                        . '<p class="erreur">Veuillez saisir le nom de votre marque !</p>'
                        . '<a href="index.php?uc=etat&action=modifier"> Retour </a>'  ;
        
                    }
                    else
                        if(existeEtat($modifEtatLibelle) == false || existeEtatDescription($modifEtatDescription) == false)
                        {
        
                            etatModification($id, $modifEtatLibelle, $modifEtatDescription) ;
                            echo '<div class="home">'  
                            . '<p class="valider">La marque se nomme désormais  ' . $modifEtatLibelle . ' !</p>' 
                            . '<br><a href="index.php?uc=etat"> Retour </a>' ;
                            
                        }
                        else
                            echo '<div class="home">'
                            . '<p class="erreur">La marque ' . $modifEtatLibelle . ' existe déja !</p>' 
                            . '<br><a href="index.php?uc=etat&action=modifier"> Retour </a>'  ;
                                        
                    break;
                }
        }
?>