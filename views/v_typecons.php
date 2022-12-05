<div class="form-typeCons">
    <h1>Ajouter un type de console</h1>
    <form name="ajout-typecons-form" id="ajout-typecons-form" method="POST" action="index.php?uc=consoles&action=modifConsole">
        <table>
            <tr>
                <th>Nom :</th>
                <td><input type="text" name="sc" id="nomType"></td>
            </tr>
            <tr>
                <th>Marque :</th>
                <td><select name="marqueType" id="marqueType">';
                <?php 
                    foreach ($lesMarques as $unMarques)
                    {
                        echo '<option value="'.$unMarques['idMarque'].'">'.$unMarques['libelleMarque'].'</option>';
                    }
                ?>
                </select></td>
            </tr>
            <tr>
                <td colspan="2"><button class="boutton-standard btn-modif" type="submit">Ajouter</button></td>
            </tr>
        </table>
    </form>
</div>