
<link rel="stylesheet" href="includes/css/style.css">


<div id="Home_title">Gestion des marques</div>
    <p class="ajoutMarque"><a href="index.php?uc=marque&action=ajouter"><button>Ajouter</button></a></p>
    
        





    
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
                . '<td>' . '<input type="text" size="15" maxlength="2000" name="modifMarqueLibelle" value="' . $laMarque['libelleMarque'] . '" >' . '</td>'
                . '<td>' . '<input type="text" size="15" maxlength="2000" name="modifMarqueLogo" value="' . $laMarque['logoMarque'] . '" >' . '</td>'
                . '<td>' . '<input type="submit" value="Valider" >' . '</td>'
                . '<td>' 
                . '</tr>'
                . '</form>' 
                . '</div>';
                        
            }else
            echo 
            '<div class="boxMarque">' 
            . '<img class="imgMarque" src="'. $laMarque['logoMarque'].'">'
            . '<td>' . '<a href="index.php?uc=marque&action=modifier&id='.$laMarque['idMarque'].'"><button>Modifier</button></a>' . '</td>';
            if($laMarque['idMarque'] > 6){
                echo '<td>' . '<a href="index.php?uc=marque&action=supprimer&id='.$laMarque['idMarque'].'"><button>Supprimer</button></a>' . '</td>';
            }
            echo '</div>';                
            
           
}
    ?>  
    </div>