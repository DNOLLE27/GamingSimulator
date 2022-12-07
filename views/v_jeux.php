<form method="POST" action="index.php?uc=jeux&action=triAlpha"><button class="cyan"type="submit"><img class="btnTri" src="https://www.shareicon.net/data/2015/11/07/668103_sort_512x512.png"></button></form>
<form method="POST" action="index.php?uc=jeux&action=afficher"><button class="cyan" type="submit"><img class="btnTri" src="https://cdn-icons-png.flaticon.com/512/58/58989.png?w=360"></button></form>
<form method="POST" action="index.php?uc=jeux&action=triCons"><button class="cyan" type="submit"><img class="btnTri" src="includes/img/TriConsole.png"></button></form>

<p class="titreAccueil">Liste des jeux possédés :</p>

<div class="gridAccueil">
      <?php
      foreach ($lesJeux as $unJeu){
            echo '<div class="texteJeuxAccueil">'
                  . '</br>'
                  . '<img class="imageJeuxAccueil" src="'.$unJeu['imageJeux'].'">'
                  . '</br>'
                  . '<label class="nomJeux">'.$unJeu['nomJeux'].'</label>'
                  . '</br>'
                  . '</br>'
                  . '<label class="nomConsole">'.$unJeu['libelleType'].'</label>'
                  . '</br>'
                  . '</br>'
                  . '<label>Etat : '.$unJeu['libelleEtat'].'</label>'
                  . '</br></br>';
                  if(isset($_SESSION['droit']) && $_SESSION['droit'] == 2){
                        echo '<form method="POST" action="index.php?uc=jeux&action=supprimer&id='.$unJeu['idJeux'].'">'
                              . '<button class="etat" type="submit">Supprimer</button>'
                              . '</form>';
                  }
                  echo '</div>';
      }
      if(isset($_SESSION['droit']) && $_SESSION['droit'] == 2){
            echo '<div class="texteJeuxAccueil">'
            . '<p>Insérer un jeu</p>'
            . '<form method="POST" action="index.php?uc=jeux&action=inserer">'
                  . '<label>Nom : </label><input name="nom" type="text">'
                  . '<label>Console : </label><select name="console">';
                        foreach($nomsConsole as $uneConsole){
                              echo '<option value="'.$uneConsole['idType'].'">'.$uneConsole['libelleType'].'</option>';
                        };
            echo          '</select></br>'
                  . '<label>Lien image : </label><input name="image" type="text">'
                  . '<label>Etat : </label><select name="etat">';
                        foreach($nomsEtat as $unEtat){
                              echo '<option value="'.$unEtat['idEtat'].'">'.$unEtat['libelleEtat'].'</option>';
                        };
            echo        '</select></br>'
                  . '<input type="submit">'
            . '</form>'
            . '</div>';
      }
      
      ?> 
</div>