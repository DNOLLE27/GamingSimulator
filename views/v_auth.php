<?php
    if (!isset($_REQUEST['action']) || $_REQUEST['action'] == "inscription" || $_REQUEST['action'] == "connexion")
    {
        if (!verifAdminExist())
        {
            echo '<p>Inscription de l\'administrateur</p>';
        }

        if ($typeFormulaire == "connexion")
        {
            echo '<form name="auth-form" id="auth-form" method="POST" action="index.php?uc=authentification&action=verifCnx">';
        }
        else
        {
            echo '<form name="auth-form" id="auth-form" method="POST" action="index.php?uc=authentification&action=verifInscr">';
        }

            echo '<input name="adrEmail" id="adrEmail" type="email" placeholder="Saisissez votre adresse e-mail" size="24" maxlength="50">';
            if ($typeFormulaire == "inscription") { echo '<input name="adrEmailVerif" id="adrEmailVerif" type="email" placeholder="Vérifier votre adresse e-mail" size="24" maxlength="50">'; }
            echo '<input name="mdp" id="mdp" type="password" placeholder="Saisissez votre mot de passe" size="24" maxlength="35">';
            if ($typeFormulaire == "inscription") { echo '<input name="mdpVerif" id="mdpVerif" type="password" placeholder="Vérifier votre mot de passe" size="24" maxlength="35">'; }

            if ($typeFormulaire == "inscription")
            {
                echo '<button type="submit">Inscription</button>';
            }
            else
            {
                echo '<button type="submit">Connexion</button>';
            }

            echo '</form>';
    }
    else
    {
        if ($messageErr != "")
        {
            echo '<p>'.$messageErr.'</p>';
        }

        if ($messageReussi != "")
        {
            echo '<p>'.$messageReussi.'</p>';
        }
    }
?>