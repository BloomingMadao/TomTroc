<?php 
/**
 * 
 */
$success = Utils::request('success');
?>

<?php if ($success==1): ?>
    <script>alert("<?= Utils::request('message') ?>")</script>
<?php endif ?>

<div class="userInfo">
    <h2>Mon Compte</h2>
    <h3><?= $userInfo->getUsername(); ?></h3>

</div>

<div class="connection-form">
    <form action="index.php?action=updateUser" method="post">
        <h3>Vos informations personnelles</h3>
        <div class="formGrid">
            <label for="username">Pseudo</label>
            <input type="text" name="username" id="username" value="<?= $userInfo->getUsername(); ?>">
            <label for="mail">Adresse email</label>
            <input type="text" name="mail" id="mail" value="<?= $userInfo->getMail(); ?>">
            <label for="password">Mot de passe</label>
            <input type="password" name="password" id="password" value="<?= $userInfo->getPassword(); ?>">
            <button class="submit">Enregistrer</button>
        </div>
    </form>
</div>
<hr>
<a href="index.php?action=addBookForm">Ajouter un livre</a>
<hr>
<div class="bookList">
    <table style="border:1px solid black;border-collapse: collapse;">
        <thead style="border:1px solid black;border-collapse: collapse;">
            <th style="border:1px solid black;">Photo</th>
            <th style="border:1px solid black;">Titre</th>
            <th style="border:1px solid black;">Auteur</th>
            <th style="border:1px solid black;">Resumé</th>
            <th style="border:1px solid black;">Disponibilité</th>
            <th style="border:1px solid black;">Action</th>
        </thead>
        <tbody>
            <?php foreach ($books as $book) { ?>
                <tr>
                    <td style="width: 16em;border:1px solid black;border-collapse: collapse;"><img style="width:75px;height:100px" src="<?= $book->getUrlImg(); ?>" alt="Image <?= $book->getTitle(); ?>"></td>
                    <td style="width: 16em;border:1px solid black;border-collapse: collapse;"><?= $book->getTitle(); ?></td>
                    <td style="width: 16em;border:1px solid black;border-collapse: collapse;"><?= $book->getAuthor(); ?></td>
                    <td style="width: 16em;border:1px solid black;border-collapse: collapse;"><?= $book->getResume(); ?></td>
                    <td style="width: 16em;border:1px solid black;border-collapse: collapse;"><?php if ($book->getIsEnable()) {
                            echo 'disponible';
                        } else {
                            echo 'non-disponible';
                        } ?></td>
                    <td style="width: 16em;border:1px solid black;border-collapse: collapse;">
                        <nav>
                            <ul>
                                <li><a href="index.php?action=editBookForm&idBook=<?= $book->getId(); ?>">Editer</a></li>
                                <li><a href="index.php?action=deleteBook&idBook=<?= $book->getId(); ?>" <?= Utils::askConfirmation("Êtes-vous sûr de vouloir supprimer ce livre ?") ?>>Supprimer</a></li>
                            </ul>

                        </nav>
                    </td>
                </tr>
            <?php } ?>

        </tbody>

    </table>
</div>