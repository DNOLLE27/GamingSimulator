<div class="gridJeuxAccueil">
      <?php
      foreach ($jeuxAccueil as $unJeuAccueil){
            echo '<div class="texteJeuxAccueil">'
                  . '<img src="'.$unJeuAccueil['ImageJeux'].'">'
                  . '<label>'.$unJeuAccueil['nomJeux'].'</label>'
                  . '<label>'.$unJeuAccueil['nomCons'].'</label>'
                  . '</div>';
      }
      ?>  
</div>