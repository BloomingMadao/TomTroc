<?php
/**
 * la page d'accueil
 */

    $registerValidate = Utils::request('registerValidate');
?>
<div class="alert">
    <?php if($registerValidate === "true") :?>
        <p>Votre compte a bien été enregistré !</p>
    <?php endif ?>
</div>
<div class="bookList">
    <?php foreach($books as $book) { ?>
        <article>
            <img src="<?=$book->getUrlImg(); ?>" alt="Image <?=$book->getTitle(); ?>">
            <h2></h2>
        </article>

    <?php } ?>
</div>

