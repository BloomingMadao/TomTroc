<?php

/**
 * la page d'accueil
 */

$registerValidate = Utils::request('registerValidate');
// $password="password";
// $hash = password_hash($password,PASSWORD_DEFAULT);
// var_dump($hash);

?>
<?php if ($registerValidate === "true") : ?>
<div class="alert">
    <p>Votre compte a bien été enregistré !</p>
</div>
<?php endif ?>
<hr>
<div class="content">
    <div class="presentation">
        <div class="text-bloc">
            <h2>Rejoignez nos lecteurs passionnés</h2>
            <p>Donnez une nouvelle vie à vos livre en les échangeant avec d'autres amoureux de la lecture. Nous croyons en la magie du partage de connaissances et d'histoires à travers les livres.</p>
            <a href="index.php?action=allBooks" class="btn">Découvrir</a>
        </div>
        <div class="img">
            <img src="src/img/config/hamza.jpg" alt="photo pile de livres">

        </div>
    </div>

</div>
<hr>
<div class="content">
    <div class="lastBookList">
        <h2>Les derniers livres ajoutés</h2>
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
        <a href="index.php?action=allBooks" class="btn">Voir tous les livres</a>
    </div>
</div>

<hr>
<div class="content">
    <div class="explanation">
        <h2>Comment ça marche ?</h2>
        <p>Échanger des livres avec TomTroc c&rsquo;est simple et amusant ! Suivez ces &eacute;tapes pour commencer :</p>
        <div class="steps">
            <div class="container">
                <p>Inscrivez-vous gratuitement sur notre plateforme.</p>
            </div>
            <div class="container">
                <p>Ajoutez les livres que vous souhaitez &eacute;changer à votre profil.</p>
            </div>
            <div class="container">
                <p>Parcourez les livres disponibles chez d&rsquo;autres membres.</p>
            </div>
            <div class="container">
                <p>Proposez un &eacute;change et discutez avec d&rsquo;autres passionn&eacute;s de lecture.</p>
            </div>
        </div>
        <a href="index.php?action=allBooks" class="btn-secondary">Voir tous les livres</a>
    </div>

</div>

<hr>
<div class="content">
    <div class=values>
        <img src="src/img/config/darwin_vegher.jpg" alt="photo bibliothèque" id="imgSeparate">
        <h2>Nos valeurs</h2>
        <div class="text-bloc">
            <p>Chez Tom Troc, nous mettons l'accent sur le partage, la découverte de la communauté. Nos valeurs sont ancrées dans notre passion pour les livres et notre déisr de créer des liens entre les lecteurs. Nous croyons en la puissance des histoires pour rassembler les gens et inspirer des conversations enrichissantes.</p>
            <p>Notre association a été fondée avec une conviction profonde : chaque livre mérite d'être lu et partagé.</p>
            <p>Nous sommes passionnés par la création d'une plateforme conviviale qui permet aux lecteurs de se connecter, de partager leurs découvertes littéraires et d'échanger des livres qui attendent patiemment sur les étagères.</p>
        </div>
        <div class="signature">
            <i>L'équipe Tom Troc</i>
            <img src="src\img\config\logo_coeur.svg" alt="Logo Coeur" id="heart">
        </div>
    </div>
</div>