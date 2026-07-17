<?php

/** 
 * Template tous les livres
 */
?>
<div class="detailBook">
    <div class="container">
        <img src="<?= $book->getUrlImg(); ?>" alt="Image <?= $book->getTitle(); ?>">
        <div class="textbloc">
            <div class="textTitle">
                <h2><?= $book->getTitle(); ?></h2>
                <p class="author">par <?= $book->getAuthor(); ?></p>
            </div>
            <hr class="divider">
            <div class="mainContent">
                <h3>description</h3>
                <p class="description"><?= $book->getResume(); ?></p>
                <h3>propriétaire</h3>
                <a href="index.php?action=showUserProfile&id=<?= $book->getIdUser() ?>">
                    <div class="userProfileCards">
                        <div class="roundPublic">
                            <img src="<?= $user->getUrlImg(); ?>" alt="">
                        </div>
                        <p><?= $book->getUsername(); ?></p>
                    </div>
                </a>

               
            </div>
             <a href="index.php?action=startConversation&id=<?= $book->getIdUser(); ?>" class="btn">Envoyer un message</a>
        </div>
    </div>
</div>