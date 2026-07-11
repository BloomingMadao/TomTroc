<?php

/**
 * Template formulaire de connexion
 */

?>

<div class="connection-form">
    <div class="formGrid">
        <form action="index.php?action=connectUser" method="post" class="foldedCorner">
            <div class="input">
                <h2>Connexion</h2>
                <label for="mail">Adresse email</label>
                <input type="text" name="mail" id="mail" required>
                <label for="password">Mot de passe</label>
                <input type="password" name="password" id="password" required>
                <button class="btn">Se connecter</button>
                <p>Pas de compte ? <a href="index.php?action=registerForm">Inscrivez-vous </a></p>
            </div>
        </form>
    </div>
    <img src="src/img/config/library-form.jpg" alt="photo bibliothèque">
</div>