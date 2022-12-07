
<link rel="stylesheet" href="includes/css/style.css">


<div id="Home_title">Gestion des marques</div>
    
    
        





    
<?php 
echo '<div class="Imaguss">';
    foreach ($lesMarques as $laMarque)
    {
        
        if (isset($_REQUEST['action']) && ($_REQUEST['action'] == 'modifier') 
            && isset($_REQUEST['id']) && ($_REQUEST['id'] == $laMarque['idMarque']))
            {
                echo 
            '<div class="boxMarque">' 
            . '<form method="POST" action="index.php?uc=marque&action=valider&id='.$laMarque['idMarque'].'">'
                . '<td>' . '<input class="nomMarque" type="text" size="15" maxlength="2000" name="modifMarqueLibelle" value="' . $laMarque['libelleMarque'] . '" >' . '</td>'
                . '<td>' . '<input class="nomMarque" type="text" size="15" maxlength="2000" name="modifMarqueLogo" value="' . $laMarque['logoMarque'] . '" >' . '</td>'
                . '<td>' . '<br><input class="btnMarqueVal" type="submit" value="Valider" >' . '</td>'
                . '<td>' 
                . '</tr>'
                . '</form>' 
                . '</div>';
                        
            }else
            echo 
            '<div class="boxMarque">' 
            . '<img class="imgMarque" src="'. $laMarque['logoMarque'].'">';
            if(isset($_SESSION['droit']) && $_SESSION['droit'] == "2"){
            echo '<td>' . '<a href="index.php?uc=marque&action=modifier&id='.$laMarque['idMarque'].'"><button>Modifier</button></a>' . '</td>';
            if($laMarque['idMarque'] > 6){
                echo '<td>' . '<a href="index.php?uc=marque&action=supprimer&id='.$laMarque['idMarque'].'"><button>Supprimer</button></a>' . '</td>';
            }
            }
            echo '</div>';   
            
            
            
           
}
if(isset($_SESSION['droit']) && $_SESSION['droit'] == "2"){
echo '<div class="boxMarque">';
if(isset($_REQUEST['action']) && ($_REQUEST['action'] == 'ajouter')){
    echo '<form method="POST" action="index.php?uc=marque&action=validajout">
    <input class="nomMarque" type="text" size="15" maxlength="2000" name="libelle" placeholder="nom"><br>
    <input class="nomMarque" type="text" size="15" maxlength="2000" name="logoMarque" placeholder="logo">
    <button class="btnMarqueV" type="submit">Valider</button>
    </form>
    <a href="index.php?uc=marque"><button> Retour </button></a>';
    }else
        
        echo '<p class="ajoutMarquebtn"><a href="index.php?uc=marque&action=ajouter"><button>Ajouter</button></a></p>';
        }
    ?>  
    
    
    </div>
    </div>