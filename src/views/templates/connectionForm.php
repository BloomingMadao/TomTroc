<?php
/**
 * Template formulaire de connexion
 */

?>

<div class="connection-form">
    <form action="index.php?action=connectUser" method="post" class="foldedCorner">
        <h2>Connexion</h2>
        <div class="formGrid">
            <label for="mail">Adresse email</label>
            <input type="text" name="login" id="login" required>
            <label for="password">Mot de passe</label>
            <input type="password" name="password" id="password" required>
            <button class="submit">Se connecter</button>
        </div>
    </form>
</div>

<p>Pas de compte ? <a href="index.php?action=registerForm">Inscrivez-vous </a></p>