<?php

/**
 * Ce fichier est le template principal qui "contient" ce qui aura été généré par les autres vues.  
 * 
 * Les variables qui doivent impérativement être définie sont : 
 *      $title string : le titre de la page.
 *      $content string : le contenu de la page. 
 */

$action=Utils::request("action","");
?>


<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="src/css/style.css">
    <title>TomTroc</title>
</head>

<body>
    <header>
        <div id="logo">
            <a href="index.php?action=home"><img src="src/img/config/logo.png" alt="Logo Tomtroc"></a>
        </div>

        <div id="navbar">
            <nav>
                <div id="nav-left">
                    <ul>

                        <li><a href="index.php?action=home" class="<?= $action === 'home' ? 'active':''?>">Accueil</a></li>
                        <li><a href="index.php?action=allBooks" class="<?= $action === 'allBooks' ? 'active':''?>">Nos livre à l'échange</a></li>

                    </ul>
                </div>

                <div id="nav-right">
                    <ul>
                        <?php
                        if (isset($_SESSION['user'])) {
                            echo '<li><img src="#" alt="Logo messagerie"> <a href="#">Messagerie</a></li>';
                            echo '<li><img src="#" alt="Logo utilisateur"> <a href="index.php?action=userAccount" class="' . ($action === "userAccount" ? 'active' : '') . '">Mon Compte</a></li>';
                            echo '<li><a href="index.php?action=disconnectUser">Deconnexion</a></li>';
                        } else {
                            echo '<li><a href="index.php?action=connectUserForm" class="'.($action === "connectUserForm" || $action ==="registerForm"?'active':'').'">Connexion</a></li>';
                        }
                        ?>
                    </ul>

                </div>

            </nav>

        </div>

    </header>

    <main>
        <?= $content /* Ici est affiché le contenu réel de la page. */ ?>
    </main>

    <footer>
        <p>
            Tom Troc©
        </p>
        <img src="src/img/config/logo-simple.png" alt="Logo Tomtroc">
    </footer>
</body>

</html>