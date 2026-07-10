<?php

/** 
 * Template tous les livres
 */

?>

<div class="allBookList">
    <div class="heading">
          <h2>Détail Livre</h2>
        <input type="text" placeholder="Rechercher un livre">   
    </div>
    <div class="books">
            <div class="container">
                <img src="<?= $book->getUrlImg(); ?>" alt="Image <?= $book->getTitle(); ?>">
                <p class="title"><?= $book->getTitle(); ?></p>
                <p class="author"><?= $book->getAuthor(); ?></p>
                <p class="seller"><?= $book->getUsername(); ?> </p>
            </div>
    </div>
</div>