<div id="Home_title">Gestion de l'état des jeux</div>
    <p>Ajouter un etat : <a href="index.php?uc=etat&action=ajouter"><img src="includes/img/plus2.png" width=" 20px" /></a></p>
    
    <table class="table table-striped">   
        <tr>
            <th>Etat</th>
            <th>Composition</th>
            <th></th>  
            
        </tr>
        <?php
        foreach ($lesEtats as $lEtat) 
        {
            if (isset($_REQUEST['action']) && ($_REQUEST['action'] == 'modifier') 
            && isset($_REQUEST['id']) && ($_REQUEST['id'] == $lEtat['idEtat']))
            {
                echo '<tr>'
                . '<form method="POST" action="index.php?uc=etat&action=valider&id='.$lEtat['idEtat'].'">'
                . '<td>' . '<input type="text" size="15" maxlength="40" name="modif" value="' . $lEtat['descriptionEtat'] . '" >' . '</td>'
                . '<td>' . '<input type="submit" value="Valider" >' . '</td>'
                . '<td>' 
                . '</tr>'
                . '</form>';
            }else
                echo '<tr>'
                . '<td>' .$lEtat['libelleEtat']. '</td>'
                . '<td>' .$lEtat['descriptionEtat']. '</td>'
                . '<td>' . '<a href="index.php?uc=marque&action=modifier&id='.$lEtat['idEtat'].'"><button>Modifier</button></a>' . '</td>'
                . '</tr>';
            
            

        }
         
        ?>
    </table>


