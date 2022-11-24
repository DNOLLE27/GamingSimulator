<p class="titreAccueil">Exemples de jeux</p>
<div class="gridAccueil">
      <?php
      foreach ($jeuxAccueil as $unJeuAccueil){
            echo '<div class="texteJeuxAccueil">'
                  . '</br>'
                  . '<img class="imageJeuxAccueil" src="'.$unJeuAccueil['imageJeux'].'">'
                  . '</br>'
                  . '<label class="nomJeux">'.$unJeuAccueil['nomJeux'].'</label>'
                  . '</br>'
                  . '</br>'
                  . '<label class="nomConsole">'.$unJeuAccueil['nomCons'].'</label>'
                  . '</div>';
      }
      ?>  
</div>