<?php

/** 
 * Template tous les livres
 */
?>

<div class="allBookList">
    <div class="heading">
        <h2>Nos livres à l'échange</h2>
        <form action="index.php?action=allBooks&search=<?= Utils::request('search') ?>" method="get">
          <input type="hidden" name="action" value="allBooks">
        <input type="text" placeholder="Rechercher un livre" id="search" name="search" value="<?= Utils::request('search') ?>" >   
        <button type="submit"></button>
        </form>

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