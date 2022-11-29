<div class="auth-div">
    <?php
        if (!isset($_REQUEST['action']) || $_REQUEST['action'] == "inscription" || $_REQUEST['action'] == "connexion")
        {
            if ($typeFormulaire == "connexion")
            {
                echo '<h1>Se connecter</h1>';
            }
            else
            {
                echo '<h1>S\'inscrire</h1>';
            }

            if (!verifAdminExist() && isset($_REQUEST['action']) && $_REQUEST['action'] == "inscription")
            {
                echo '<p class="admin">Inscription de l\'administrateur</p>';
            }
        
            if ($typeFormulaire == "connexion")
            {
                echo '<form name="auth-form" id="auth-form" method="POST" action="index.php?uc=authentification&action=verifCnx">';
            }
            else
            {
                echo '<form name="auth-form" id="auth-form" method="POST" action="index.php?uc=authentification&action=verifInscr">';
            }
        
                echo '<table class="form-auth">
                    <tr>
                        <td><input name="adrEmail" id="adrEmail" type="email" placeholder="Saisissez votre adresse e-mail" size="24" maxlength="50"></td>
                    </tr>';

                if ($typeFormulaire == "inscription") 
                { 
                    echo '<tr>
                        <td><input name="adrEmailVerif" id="adrEmailVerif" type="email" placeholder="Vérifier votre adresse e-mail" size="24" maxlength="50"></td>
                    </tr>'; 
                }

                echo '<tr>
                    <td><input name="mdp" id="mdp" type="password" placeholder="Saisissez votre mot de passe" size="24" maxlength="35"></td>
                </tr>';

                if ($typeFormulaire == "inscription") 
                { 
                    echo '<tr>
                        <td><input name="mdpVerif" id="mdpVerif" type="password" placeholder="Vérifier votre mot de passe" size="24" maxlength="35"></td>
                    </tr>'; 
                }
            
                if ($typeFormulaire == "inscription")
                {
                    echo '<tr>
                        <td><button type="submit">Inscription</button></td>
                    </tr>';
                }
                else
                {
                    echo '<tr>
                        <td><button type="submit">Connexion</button></td>
                    </tr>';
                }
            
                echo '</table>
                </form>';

            if ($typeFormulaire == "connexion")
            {
                echo '<p>Vous n\'avez pas de compte ? <a href="index.php?uc=authentification&action=inscription">S\'inscrire</a> !</p>';
            }
            else
            {
                echo '<p>Vous avez un compte ? <a href="index.php?uc=authentification&action=connexion">Se connecter</a> !</p>';
            }
        }
        else
        {
            if (isset($messageErr) && $messageErr != "")
            {
                echo '<p class="msgErr">'.$messageErr.'</p>';
                if ($_REQUEST['action'] == "verifInscr")
                {
                    echo '<form name="retour-form" id="retour-form" method="POST" action="index.php?uc=authentification&action=inscription">';
                }
                else
                {
                    echo '<form name="retour-form" id="retour-form" method="POST" action="index.php?uc=authentification&action=connexion">';
                }

                    echo '<button type="submit">Retour</button>
                </form>';
            }
        
            if (isset($messageReussi) && $messageReussi != "")
            {
                echo '<p class="msgReu">'.$messageReussi.'</p>';

                if ($_REQUEST['action'] == "verifInscr")
                {
                    echo '<form name="retour-form" id="retour-form" method="POST" action="index.php?uc=authentification&action=connexion">';
                }
                else
                {
                    echo '<form name="retour-form" id="retour-form" method="POST" action="index.php">';
                }

                echo '<button type="submit">Ok</button>
                </form>';
            }
        }
    ?>
</div>