<?php

/**
 * 
 * Template User Profile public
 */

?>
<div class="profileContent">
    <div class="userInfo">
        <p class="round"></p>
        <hr>
        <h3><?= $userInfo->getUsername(); ?></h3>
        <span class="label">BIBLIOTHÈQUE</span>
        <p class="bookCount"><?= count($books); ?> livres</p>
        <a href="index.php?action=startConversation&id=<?= $userInfo->getId(); ?>" class='btn-secondary'>Envoyer un message</a>
    </div>

    <div class="bookList">
        <table>
            <thead>
                <tr>
                    <th>Photo</th>
                    <th>Titre</th>
                    <th>Auteur</th>
                    <th>Resumé</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($books as $book) { ?>
                    <tr>
                        <td class="img"><img class="bookImg" src="<?= $book->getUrlImg(); ?>" alt="Image <?= $book->getTitle(); ?>"></td>
                        <td class="title"><?= $book->getTitle(); ?></td>
                        <td class="author"><?= $book->getAuthor(); ?></td>
                        <td class="resume"><?= $book->getResume(70); ?></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>