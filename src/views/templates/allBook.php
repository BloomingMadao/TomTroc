<?php

/** 
 * Template tous les livres
 */
?>

<div class="allBookList">
    <div class="heading">
          <h2>Nos livres à l'échange</h2>
        <input type="text" placeholder="Rechercher un livre">   
    </div>
    <div class="books">
        <?php foreach ($books as $book) { ?>
            <div class="container">
                <a href="index.php?action=detailBook&id=<?= $book->getId(); ?>"><img src="<?= $book->getUrlImg(); ?>" alt="Image <?= $book->getTitle(); ?>"></a>
                <p class="title"><?= $book->getTitle(); ?></p>
                <p class="author"><?= $book->getAuthor(); ?></p>
                <p class="seller">Vendu par : <?= $book->getUsername(); ?> </p>
            </div>
        <?php } ?>

    </div>


</div>