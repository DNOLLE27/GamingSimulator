<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>GamingSimulator-WEB</title>
        <link rel="stylesheet" href="includes/css/style.css">
    </head>

    <body>
        <div class="grid-nav">
            <div class="grid-nav-logo">
                <a href="index.php"><img class="menu-logo" src="includes/img/logo.png"></a>
            </div>
            <div class="grid-nav-titre">
                <a class="nom-ent" href="index.php">GamingSimulator</a>
            </div>
            <div class="grid-nav-menu">
                <nav>
                    <ul>
                        <li><a class="lien-menu" href="index.php?uc=jeux">Jeux</a></li>
                        <li>|</li>
                        <li><a class="lien-menu" href="index.php?uc=consoles">Consoles</a></li>
                        <li>|</li>
                        <li><a class="lien-menu" href="index.php?uc=marque">Marques</a></li>
                        <li>|</li>
                        <li><a class="lien-menu" href="index.php?uc=etat">Etats</a></li>
                    </ul>
                </nav>
            </div>
            <?php
                if (isset($_SESSION['droit']))
                {
                    echo '<div class="grid-nav-deco">
                        <a class="lien-deco" href="index.php?uc=deconnexion"><img class="menu-deco-logo" src="includes/img/iconeCompte-bleu.png"></a>
                    </div>
                    <div class="grid-nav-deco-texte">
                        <a class="lien-deco" href="index.php?uc=deconnexion">'.$_SESSION['email'].' (se déconnecter)</a>
                    </div>';
                }
                else
                {
                    echo '<div class="grid-nav-deco">
                        <a class="lien-co" href="index.php?uc=authentification"><img class="menu-deco-logo" src="includes/img/iconeCompte-bleu.png"></a>
                    </div>
                    <div class="grid-nav-deco-texte">
                        <a class="lien-co" href="index.php?uc=authentification">Connexion</a>
                    </div>';
                }
            ?>
        </div>