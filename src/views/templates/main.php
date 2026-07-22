<?php

/**
 * Ce fichier est le template principal qui "contient" ce qui aura été généré par les autres vues.  
 * 
 * Les variables qui doivent impérativement être définie sont : 
 *      $title string : le titre de la page.
 *      $content string : le contenu de la page. 
 */

$action = Utils::request("action", "");

?>


<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="src/css/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Playfair+Display:ital,wght@0,400..900;1,400..900&display=swap" rel="stylesheet">
    <title>TomTroc</title>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const burger = document.getElementById('burger');
            const navbar = document.getElementById('navbar');

            burger.addEventListener('click', () => {
                const isOpen = navbar.classList.toggle('open');
                burger.setAttribute('aria-expanded', isOpen);
            });
        });

    <?php if (isset($_SESSION['user'])): ?>
    document.addEventListener('DOMContentLoaded', () => {
        function refreshUnreadMessages() {
            fetch('index.php?action=getUnreadMessage')
                .then(response => response.json())
                .then(data => {
                    const badge = document.getElementById('unread-badge');
                    if (!badge) return;
                    const count = data.unread || 0;
                    badge.textContent = count;
                    badge.style.display = count > 0 ? '' : 'none';
                })
                .catch(error => console.error('Erreur lors de la récupération des messages non lus :', error));
        }

        // Rafraîchit le compteur toutes les 60 secondes (ajuste la valeur si besoin).
        setInterval(refreshUnreadMessages, 60000);
    });
    <?php endif; ?>
    </script>

</head>

<body>
    <header>
        <div id="logo">
            <a href="index.php?action=home"><img src="src/img/config/logo.png" alt="Logo Tomtroc"></a>
            <button id="burger" aria-label="Ouvrir le menu" aria-expanded="false">
                <span></span><span></span><span></span>
            </button>
        </div>

        <div id="navbar">
            <nav>
                <div id="nav-left">
                    <ul>

                        <li><a href="index.php?action=home" class="<?= $action === 'home' ? 'active' : '' ?>">Accueil</a></li>
                        <li><a href="index.php?action=allBooks" class="<?= $action === 'allBooks' ? 'active' : '' ?>">Nos livres à l'échange</a></li>

                    </ul>
                </div>

                <div id="nav-right">
                    <ul>
                        <?php
                        if (isset($_SESSION['user'])) {
                            if (!isset($_SESSION['messages'])) {
                                MessagesController::refreshUnreadCount($_SESSION['idUser']);
                            }
                            $unreadCount = (int) $_SESSION['messages'];
                            echo '<li><img src="src/img/config/Icon_messagerie.png" alt="Logo messagerie"> <a href="index.php?action=getConversations" class="' . ($action === "getConversations" ? 'active' : '') . '">Messagerie <span id="unread-badge" class="badge-unread"' . ($unreadCount === 0 ? ' style="display:none;"' : '') . '>' . $unreadCount . '</span></a></li>';
                            echo '<li><img src="src/img/config/Icon_mon_compte.png" alt="Logo utilisateur"> <a href="index.php?action=userAccount" class="' . ($action === "userAccount" ? 'active' : '') . '">Mon Compte</a></li>';
                            echo '<li><a href="index.php?action=disconnectUser">Deconnexion</a></li>';
                        } else {
                            echo '<li><a href="index.php?action=connectUserForm" class="' . ($action === "connectUserForm" || $action === "registerForm" ? 'active' : '') . '">Connexion</a></li>';
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
        <p>Politique de confidentialité</p>
        <p>Mentions Légales</p>
        <p>Tom Troc©</p>
        <img src="src/img/config/logo-simple.png" alt="Logo Tomtroc">
    </footer>


</body>

</html>