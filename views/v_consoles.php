<div class="consoles-grid">
    <?php
        foreach ($lesConsoles as $uneConsole)
        {
            echo '<div class="element-grid">
                <p class="text-style-standard texte-consoles"><span class="texte-souligne">Nom :</span> '.$uneConsole['nomCons'].'</p>
                <p class="text-style-standard texte-consoles"><span class="texte-souligne">Marque :</span> '.$uneConsole['libelleMarque'].'</p>
            </div>';
        }
    ?>
    
    <div class="element-grid">
        <?php
            if (isset($_REQUEST['action']) && $_REQUEST['action'] == "ajoutConsole")        
            {
                echo '<form name="ajout-console-form" id="ajout-console-form" method="POST" action="index.php?uc=consoles&action=verifAjoutConsole">
                    <table class="ajout-console-table">
                        <tr>
                            <th>Nom : </th>
                            <td><input name="nomConsole" id="nomConsole" placeholder="" maxlength="15" type="text"></td>
                        </tr>
                        <tr>
                            <th>Marque : </th>
                            <td><select name="marqueConsole" id="marqueConsole">';
                                foreach ($lesMarques as $uneMarque)
                                {
                                    echo '<option value="'.$uneMarque['idMarque'].'">'.$uneMarque['libelleMarque'].'</option>';
                                }
                            echo '</select></td>
                        </tr>
                        <tr>
                            <td colspan="2"><button class="ajout-console-bouton" type="submit">Ajouter</button></td>
                        </tr>
                    </table>
                </form>';
            }
            else
            {
                echo '<a href="index.php?uc=consoles&action=ajoutConsole">
                    <img class="plus-console" src="includes/img/plus.png">
                    Ajouter une nouvelle console
                </a>';
            }
        ?>
    </div>
</div>