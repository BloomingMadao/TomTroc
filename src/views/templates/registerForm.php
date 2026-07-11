<?php

/**
 * Template formulaire de Inscription
 */

?>

<div class="connection-form">
    <div class="formGrid">
        <form action="index.php?action=addUser" method="post">
            <div class="input">
                <h2>Inscription</h2>
                <label for="username">Pseudo</label>
                <input type="text" name="username" id="username" required>
                <label for="mail">Adresse email</label>
                <input type="text" name="mail" id="mail" required>
                <label for="password">Mot de passe</label>
                <input type="password" name="password" id="password" required>
                <button class="btn">S'inscrire</button>
                <p>Déjà inscrit ? <a href="index.php?action=connectUserForm">Connectez-vous</a></p>
            </div>
        </form>
    </div>
    <img src="src/img/config/library-form.jpg" alt="photo bibliothèque">
</div>