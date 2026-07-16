<?php

/**
 * Template formulaire Ajout livre
 */

?>

<div class="book-form">
    <a href="index.php?action=userAccount" class="backLink">&larr; retour</a>
    <form action="index.php?action=updateBook" method="post" enctype="multipart/form-data">
        <h2><?= $book->getId() == -1 ? "Ajout d'un livre" : "Modifier les informations" ?></h2>
        <div class="formGrid">
            <div class="image">
                <label class="fieldLabel">Photo</label>
                <?php if ($book->getId() != -1) : ?>
                    <img src="<?= $book->getUrlImg() ?>" width="100">
                    <input type="text" value="<?= $book->getUrlImg() ?>" name="imgUrlNow" id="imgUrlNow" hidden>
                <?php endif ?>
                <label for="img"><?= $book->getId() == -1 ? "Ajouter une image" : "Modifier la photo" ?></label>
                <input type="file" name="img" id="img" hidden>
            </div>
            <div class="input">
                <label for="title">Titre</label>
                <input type="text" name="title" id="title" value="<?= $book->getTitle(); ?>" required>
                <input type="number" value="<?= $_SESSION["idUser"] ?>" name="idUser" id="idUser" hidden>
                <label for="author">Auteur</label>
                <input type="text" name="author" id="author" value="<?= $book->getAuthor(); ?>" required>
                <label for="resume">Commentaire</label>
                <textarea name="resume" id="resume"><?= $book->getResume(); ?></textarea>
                <label for="isEnable">Disponibilité</label>
                <select name="isEnable" id="isEnable">
                    <option value="disponible" <?= $book->getIsEnable() == 1 ? "selected" : "" ?>>disponible</option>
                    <option value="non-disponible" <?= $book->getIsEnable() == 0 ? "selected" : "" ?>>non-disponible</option>
                </select>
                <!-- <input type="checkbox" name="isEnable" id="isEnable"   > -->
                <input type="hidden" name="id" value="<?= $book->getId() ?>">
                <button class="btn"><?= $book->getId() == -1 ? "Ajouter un livre" : "Modifier le livre" ?></button>
            </div>
        </div>
    </form>
</div>