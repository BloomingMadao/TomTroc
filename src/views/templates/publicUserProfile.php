<?php

/**
 * 
 * Template User Profile public
 */

?>
<div class="profileContent">
    <div class="userInfo">
        <h2><?= $userInfo->getUsername(); ?></h2>
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
                        <td style="width: 16em;"><img style="width:75px;height:100px" src="<?= $book->getUrlImg(); ?>" alt="Image <?= $book->getTitle(); ?>"></td>
                        <td style="width: 16em;"><?= $book->getTitle(); ?></td>
                        <td style="width: 16em;"><?= $book->getAuthor(); ?></td>
                        <td style="width: 16em;"><?= $book->getResume(); ?></td>
                    </tr>
                <?php } ?>

            </tbody>

        </table>
    </div>
</div>