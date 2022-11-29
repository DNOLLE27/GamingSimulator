<?php
    if (isset($_REQUEST['action']) && $_REQUEST['action'] == 'verifAjoutConsole')
    {  
        echo '<div class="messErrReu">';
            if ($messageErr != "")
            {
                echo '<p class="msgErr">'.$messageErr.'</p>
                    <form name="retour-form" id="retour-form" method="POST" action="index.php?uc=consoles&action=ajoutConsole">
	                    <button type="submit">Retour</button>
                    </form>';
            }
            else
            {
                echo '<p class="msgReu">'.$messageReu.'</p>
                    <form name="retour-form" id="retour-form" method="POST" action="index.php?uc=consoles">
	                    <button type="submit">Ok</button>
                    </form>';
            }
        '</div>';
    }
    else
    {
        echo '<div class="consoles-grid">';
            foreach ($lesConsoles as $uneConsole)
                {
                    if (isset($_REQUEST['action']) && $_REQUEST['action'] == 'supprConsole' && $uneConsole['idCons'] == $idSuppr)
                    {
                        echo '<div class="element-grid">
                            <p class="text-style-standard texte-consoles">Voulez-vous supprimer la console '.$uneConsole['nomCons'].' ?</p>

                            <table>
                                <form name="validSuppr-form" id="validSuppr-form" method="POST" action="index.php?uc=consoles&action=validSupprConsole">
                                    <input type="hidden" name="idConSuppr" id="idConSuppr" value="'.$idSuppr.'">
                                    <tr>
	                                    <td><button class="boutton-standard btn-oui" type="submit">Oui</button></td>
                                </form>
                                
                                <form name="validSuppr-form" id="validSuppr-form" method="POST" action="index.php?uc=consoles">
                                        <td><button class="boutton-standard btn-non" type="submit">Non</button></td>
                                </form>
                                    </tr>
                                </form>
                            </table>
                        </div>';
                    }
                    else
                    {
                        echo '<div class="element-grid">
                            <p class="text-style-standard texte-consoles"><span class="texte-souligne">Nom :</span> '.$uneConsole['nomCons'].'</p>
                            <p class="text-style-standard texte-consoles"><span class="texte-souligne">Marque :</span> '.$uneConsole['libelleMarque'].'</p>';
                        if (isset($_SESSION['droit']) && $_SESSION['droit'] == "2")
                        {
                            echo '<table>
                                    <tr>
                                        <td>
                                            <form name="modif-console-form" id="modif-console-form" method="POST" action="index.php?uc=consoles&action=modifConsole">
                                                <input type="hidden" name="idConsole" id="idConsole" value="'.$uneConsole['idCons'].'">
                                                <button class="boutton-standard btn-modif" type="submit">Modifier</button>
                                            </form>
                                        </td>
                                        <td>
                                            <form name="suppr-console-form" id="suppr-console-form" method="POST" action="index.php?uc=consoles&action=supprConsole">
                                                <input type="hidden" name="idConsole" id="idConsole" value="'.$uneConsole['idCons'].'">
                                                <button class="boutton-standard btn-suppr" type="submit">Supprimer</button>  
                                            </form>
                                        </td>
                                    </tr>
                                </table>';
                        }
                        echo '</div>';
                    }
                }
            
            echo '<div class="element-grid">';
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
                                </form>
                                <tr>
                                    <td colspan="2"><a href="index.php?uc=consoles">Retour</a></td>
                                </tr>
                            </table>';
                    }
                    else
                    {
                        if (isset($_SESSION['droit']) && $_SESSION['droit'] == "2")
                        {
                            echo '<a href="index.php?uc=consoles&action=ajoutConsole">
                                <img class="plus-console" src="includes/img/plus.png">
                                Ajouter une nouvelle console
                            </a>';
                        }
                    }
            echo '</div>
        </div>';
    }
?>