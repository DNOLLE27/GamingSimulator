
<link rel="stylesheet" href="includes/css/style.css">


<div id="Home_title">Gestion des marques</div>
    <p>Ajouter une marque : <a href="index.php?uc=marque&action=ajouter"><img src="includes/img/plus2.png" width=" 20px" /></a></p>
    
        





    <div class="Imaguss">
<?php 
    foreach ($lesMarques as $laMarque)
    {
        if (isset($_REQUEST['action']) && ($_REQUEST['action'] == 'modifier') 
            && isset($_REQUEST['id']) && ($_REQUEST['id'] == $laMarque['idMarque']))
            {
                echo 
            '<div class="boxMarque">' 
            . '<img class="imgMarque" src="includes/img/'. $laMarque['logoMarque'].'">'
            . '</div>';
                        
            }else
            echo 
            '<div class="boxMarque">' 
            . '<img class="imgMarque" src="'. $laMarque['logoMarque'].'">'
            . '</div>';
}
    ?>  
    </div