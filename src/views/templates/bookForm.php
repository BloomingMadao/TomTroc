<?php
/**
 * Template formulaire Ajout livre
 */

?>

<div class="connection-form">
    <form action="index.php?action=addBook" method="post" enctype="multipart/form-data">
        <h2>Ajouter un livre</h2>
        <div class="formGrid">
            <label for="title">Titre</label>
            <input type="text" name="title" id="title" required>
            <input type="number" value="<?= $_SESSION["idUser"] ?>"  name="idUser" id="idUser" hidden>
            <label for="author">Auteur</label>
            <input type="text" name="author" id="author" required>
            <label for="resume">Résumé</label>
            <textarea name="resume" id="resume"></textarea>
            <label for="isEnable">Disponibilité</label>
            <input type="checkbox" name="isEnable" id="isEnable">

            <label for="img">photo</label>
            <input type="file" name="img" id="img">

            <input type="submit" value="Ajouter Livre" name="submit">
        </div>
    </form>
</div>
