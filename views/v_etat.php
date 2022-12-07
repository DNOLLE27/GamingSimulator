<div id="Home_title">Gestion de l'état des jeux</div>
<div class="etat">    
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
                . '<td>' . '<input class="inputEtat" type="text" size="15" maxlength="2000" name="modifEtatLibelle" value="' . $lEtat['libelleEtat'] . '" >' . '</td>'
                . '<td>' . '<input class="inputEtat" type="text" size="15" maxlength="2000" name="modifEtatDescription" value="' . $lEtat['descriptionEtat'] . '" >' . '</td>'
                . '<td>' . '<input class="validEtat" type="submit" value="Valider" ></form>' . '</td>'
                . '<td>' . '<a href="index.php?uc=etat"><button>Retour</button></a>' . '</td>'
                . '<td>' 
                . '</tr>';
            }else 
                    echo '<tr>'
                    . '<td>' .$lEtat['libelleEtat']. '</td>'
                    . '<td ><p class="descEtat">' .$lEtat['descriptionEtat']. '</p></td>'
                    . '<td>' . '<a href="index.php?uc=etat&action=modifier&id='.$lEtat['idEtat'].'"><button>Modifier</button></a>' . '</td>'
                    . '</tr>';
            
               

        }

        if(isset($_REQUEST['action']) && ($_REQUEST['action'] == 'ajouter')){
            echo '<tr>'
            . '<form method="POST" action="index.php?uc=etat&action=valider&id='.$lEtat['idEtat'].'">'
            . '<td>' . '<input class="inputEtat" type="text" size="15" maxlength="2000" name="modifEtatLibelle" >' . '</td>'
            . '<td>' . '<input class="inputEtat" type="text" size="15" maxlength="2000" name="modifEtatDescription" >' . '</td>'
            . '<td>' . '<input class="validEtat" type="submit" value="Valider" ></form>' . '</td>'
            . '<td>' . '<a href="index.php?uc=etat"><button>Retour</button></a>' . '</td>'
            . '<td>' 
            . '</tr>';
        }
        
        echo '<div class="btnAddEtat"><a href="index.php?uc=etat&action=ajouter"><button>Ajouter</button></a></div>';
          
        ?>
    </table>
    </div>;  


