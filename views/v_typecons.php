<?php
    if (isset($_REQUEST['action']) && $_REQUEST['action'] == 'verifAjoutTypeCons')
    {
        echo '<div class="messErrReu">';
            if ($messageErrType != "")
            {
                echo '<p class="msgErr">'.$messageErrType.'</p>
                    <form name="retour-form" id="retour-form" method="POST" action="index.php?uc=consoles&action=ajoutTypeConsole">
                        <button type="submit">Retour</button>
                    </form>';
            }
            else
            {
                echo '<p class="msgReu">'.$messageReuType.'</p>
                    <form name="retour-form" id="retour-form" method="POST" action="index.php?uc=consoles">
                        <button type="submit">Ok</button>
                    </form>';
            }
        '</div>';
    }
    else
    {
        echo '<div class="form-typeCons">
            <h1>Ajouter un type de console</h1>
            <form name="ajout-typecons-form" id="ajout-typecons-form" method="POST" action="index.php?uc=consoles&action=verifAjoutTypeCons">
                <table>
                    <tr>
                        <th>Nom :</th>
                        <td><input type="text" name="nomType" id="nomType"></td>
                    </tr>
                    <tr>
                        <th>Marque :</th>
                        <td><select name="marqueType" id="marqueType">';
                            foreach ($lesMarques as $unMarques)
                            {
                                echo '<option value="'.$unMarques['idMarque'].'">'.$unMarques['libelleMarque'].'</option>';
                            }
                        echo '</select></td>
                    </tr>
                    <tr>
                        <td colspan="2"><button class="boutton-standard btn-modif btn-ajout-type" type="submit">Ajouter</button></td>
                    </tr>
            </form>
                    <tr>
                        <td colspan="2"><a class="retour-type" href="index.php?uc=consoles">Retour</a></td>
                    </tr>
                </table>
        </div>';
    }
?>