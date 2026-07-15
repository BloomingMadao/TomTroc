<?php

/**
 * 
 * Template User Profile public
 */

?>
<div class="profileContent">
    <div class="userInfo">
        <p class="round"></p>
        <h3><?= $userInfo->getUsername(); ?></h3>
            <span class="label">BIBLIOTHÈQUE</span>
            <p><?= count($books); ?> livres</p>
        <a href="index.php?action=startConversation&id=<?= $userInfo->getId(); ?>" class='btn-secondary'>Envoyer un message</a>

    </div>

    <div class="bookList">
        <table>
            <thead>
                <th>Photo</th>
                <th>Titre</th>
                <th>Auteur</th>
                <th>Resumé</th>
            </thead>
            <tbody>
                <?php foreach ($books as $book) { ?>
                    <tr>
                        <td ><img style="width:75px;height:100px" src="<?= $book->getUrlImg(); ?>" alt="Image <?= $book->getTitle(); ?>"></td>
                        <td ><?= $book->getTitle(); ?></td>
                        <td><?= $book->getAuthor(); ?></td>
                        <td><?= $book->getResume(70); ?></td>
                        
                    </tr>
                <?php } ?>

            </tbody>

        </table>
    </div>
</div>