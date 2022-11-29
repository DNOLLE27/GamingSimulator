<div class="home">
    
    <p>Ajouter une marque<p>
        <?php
        echo '<form method="POST" action="index.php?uc=marque&action=validajout">
            <input type="text" size="15" maxlength="40" name="libelle" placeholder="Libellé de la marque">
            <input type="text" size="15" maxlength="40" name="logoMarque" placeholder="Libellé de la marque">
            <button type="submit">Valider</button>
            <br><a href="index.php?uc=marque&action=modifier"> Retour </a>
            </form>';
    
        ?>
    
</div>