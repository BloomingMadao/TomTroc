<?php

/** 
 * Template tous les livres
 */
?>

<div class="bookList">
    <h2>Nos livres à l'échange</h2>
    <?php foreach ($books as $book) { ?>
        <article>
            <img src="<?= $book->getUrlImg(); ?>" alt="Image <?= $book->getTitle(); ?>" width="175">
            <h2></h2>
        </article>
    <?php } ?>

</div>