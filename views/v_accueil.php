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
                  . '<label class="nomConsole">'.$unJeuAccueil['libelleType'].'</label>'
                  . '</br>'
                  . '</br>'
                  . '<label> Etat : '.$unJeuAccueil['libelleEtat'].'</label>'
                  . '</div>';
      }
      ?>  
</div>
<p class="titreAccueil">Exemples de consoles</p>
<div class="gridAccueil">
      <?php
      foreach ($consoleAccueil as $uneConsoleAccueil){
            echo '<div class="texteJeuxAccueil">'
                  . '</br>'
                  . '<img class="imageJeuxAccueil" src="'.$uneConsoleAccueil['imageCons'].'">'
                  . '</br>'
                  . '</br>'
                  . '<label class="nomJeux">'.$uneConsoleAccueil['descriptionCons'].'</label>'
                  . '</br>'
                  . '</div>';
      }
      ?>  
</div>