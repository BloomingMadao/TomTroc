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
<hr>
<div>
    <h2>Rejoignez nos lecteurs passionnés</h2>
    <p>Donnez une nouvelle vie à vos livre en les échangeant avec d'autres amoureux de la lecture. Nous croyons en la magie du partage de connaissances et d'histoires à travers les livres.</p>
    <button><a href="index.php?action=allBooks">Découvrir</a></button>
    <img src="#" alt="photo pile de livres">
</div>
<hr>
<div class="bookList">
    <h2>Les derniers livres ajoutés</h2>
    <?php foreach($books as $book) { ?>
        <article>
            <img src="<?=$book->getUrlImg(); ?>" alt="Image <?=$book->getTitle(); ?>" width="250">
            <h2></h2>
        </article>
    <?php } ?>
    <button><a href="index.php?action=allBooks">Voir tous les livres</a></button>
</div>
<hr>
<div>
    <h2>Comment ça marche ?</h2>
    <p>&eacute;changer des livres avec TomTroc c&rsquo;est simple et amusant ! Suivez ces &eacute;tapes pour commencer :</p>
    <div>Inscrivez-vous gratuitement sur notre plateforme.</div>
    <div>Ajoutez les livres que vous souhaitez &eacute;changer à votre profil.</div>
    <div>Parcourez les livres disponibles chez d&rsquo;autres membres.</div>
    <div>Proposez un &eacute;change et discutez avec d&rsquo;autres passionn&eacute;s de lecture.</div>
    <button><a href="index.php?action=allBooks">Voir tous les livres</a></button>  
</div>
<hr>
<div>
    <img src="#" alt="photo bibliothèque">
    <h2>Nos valeurs</h2>
    <p>Chez Tom Troc, nous mettons l'accent sur le partage, la découverte de la communauté. Nos valeurs sont ancrées dans notre passion pour les livres et notre déisr de créer des liens entre les lecteurs. Nous croyons en la puissance des histoires pour rassembler les gens et inspirer des conversations enrichissantes.</p>
    <br>
    <p>Notre association a été fondée avec une conviction profonde : chaque livre mérite d'être lu et partagé.</p>
    <br>
    <p>Nous sommes passionnés par la création d'une plateforme conviviale qui permet aux lecteurs de se connecter, de partager leurs découvertes littéraires et d'échanger des livres qui attendent patiemment sur les étagères.</p>
    <br>
    <i>L'équipe Tom Troc</i>
    <img src="#" alt="Logo Coeur">
</div>

