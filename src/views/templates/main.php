<?php

/**
 * Ce fichier est le template principal qui "contient" ce qui aura été généré par les autres vues.  
 * 
 * Les variables qui doivent impérativement être définie sont : 
 *      $title string : le titre de la page.
 *      $content string : le contenu de la page. 
 */
?>


<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TomTroc</title>
</head>

<body>
    <header>
        <img src="#" alt="Logo Tomtroc">
        <h1>TomTroc</h1>
        <nav>
            <ul>
                <li><a href="#">Accueil</a></li>
                <li><a href="#">Nos livre à l'échange</a></li>
                <?php 
                    if(isset($_SESSION['user'])){
                        echo '<li><img src="#" alt="Logo messagerie"> <a href="#">Messagerie</a></li>';
                        echo '<li><img src="#" alt="Logo utilisateur"> <a href="#">Mon Compte</a></li>';
                    }
                ?>
                <li><a href="index.php?action=connectUserForm">Connexion</a></li>
            </ul>

        </nav>
    </header>

    <main>
        <?= $content /* Ici est affiché le contenu réel de la page. */ ?>
    </main>

    <footer>
        <p>
            Tom Troc©
        </p>
        <img src="" alt="Logo Tomtroc">
    </footer>
</body>

</html>