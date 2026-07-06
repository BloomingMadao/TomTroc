<?php
/**
 * Template formulaire Ajout livre
 */

?>

<div class="connection-form">
    <form action="index.php?action=updateBook" method="post" enctype="multipart/form-data">
        <h2><?= $book->getId() == -1 ? "Ajout d'un livre" : "Modification du livre' "?></h2>
        <div class="formGrid">
            <label for="title">Titre</label>
            <input type="text" name="title" id="title" value="<?= $book->getTitle(); ?>" required>
            <input type="number" value="<?= $_SESSION["idUser"] ?>"  name="idUser" id="idUser" hidden>
            <label for="author">Auteur</label>
            <input type="text" name="author" id="author" value="<?= $book->getAuthor(); ?>" required>
            <label for="resume">Résumé</label>
            <textarea name="resume" id="resume"><?= $book->getResume(); ?></textarea>
            <label for="isEnable">Disponibilité</label>
            <input type="checkbox" name="isEnable" id="isEnable" <?= $book->getIsEnable() == 1 ? "checked":"" ?>  >
            <?php if ($book->getId() !=-1) : ?>
            <label>Image Actuel :</label>
            <img src="<?= $book->getUrlImg() ?>" width="100">
            <input type="text" value="<?= $book->getUrlImg() ?>" name="imgUrlNow" id="imgUrlNow" hidden>
            <?php endif ?>
            <label for="img"><?= $book->getId() == -1 ? "Ajouter une image" : "Changer l'image" ?></label>
            <input type="file" name="img" id="img">
            <input type="hidden" name="id" value="<?= $book->getId() ?>">
            <button class="submit"><?= $book->getId() == -1 ? "Ajouter un livre" : "Modifier le livre" ?></button>
        </div>
    </form>
</div>
