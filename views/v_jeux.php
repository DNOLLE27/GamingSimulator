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
                  . '</div>';
      }
      ?>  
</div>