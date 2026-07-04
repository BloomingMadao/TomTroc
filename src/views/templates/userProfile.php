<div class="userInfo">
    <h2>Mon Compte</h2>
    <h3><?= $userInfo->getUsername();?></h3>

</div>

<div class="bookList">
    <?php foreach($books as $book) { ?>
        <article>
            <img src="<?=$book->getUrlImg(); ?>" alt="Image <?=$book->getTitle(); ?>">
            <h2></h2>
        </article>

    <?php } ?>
</div>

<a href="index.php?action=AddBookForm">Ajouter un livre</a>