<?php

/**
 * 
 */
$success = Utils::request('success');
?>

<?php if ($success == 1): ?>
    <script>
        alert("<?= Utils::request('message') ?>")
    </script>
<?php endif ?>
<h2>Mon Compte</h2>
<div class="user">
    <div class="userInfo">
        <div class="userImg">
            <p class="round"></p>
            <i>image de profil placeholder</i>
        </div>
        <hr>
        <div class="userDetail">

            <h3 class="username"><?= $userInfo->getUsername(); ?></h3>
            <span class="label">BIBLIOTHÈQUE</span>
            <p><?= count($books); ?> livres</p>

        </div>

    </div>
    <div class="accountForm">
        <div class="formGrid">
            <form action="index.php?action=updateUser" method="post">
                <div class="input">
                    <h3>Vos informations personnelles</h3>
                    <label for="username">Pseudo</label>
                    <input type="text" name="username" id="username" value="<?= $userInfo->getUsername(); ?>">
                    <label for="mail">Adresse email</label>
                    <input type="text" name="mail" id="mail" value="<?= $userInfo->getMail(); ?>">
                    <label for="password">Mot de passe</label>
                    <input type="password" name="password" id="password" value="default">
                    <button class="btn-secondary">Enregistrer</button>
                </div>
            </form>
        </div>
    </div>
</div>

<hr>

<div class="bookList">
    <a href="index.php?action=addBookForm" class="btn">Ajouter un livre</a>
    <table>
        <thead>
            <th>Photo</th>
            <th>Titre</th>
            <th>Auteur</th>
            <th>Resumé</th>
            <th>Disponibilité</th>
            <th>Action</th>
        </thead>
        <tbody>
            <?php foreach ($books as $book) { ?>
                <tr>
                    <td style="width: 16em;"><img style="width:75px;height:100px" src="<?= $book->getUrlImg(); ?>" alt="Image <?= $book->getTitle(); ?>"></td>
                    <td style="width: 16em;"><?= $book->getTitle(); ?></td>
                    <td style="width: 16em;"><?= $book->getAuthor(); ?></td>
                    <td style="width: 16em;"><?= $book->getResume(200); ?></td>
                    <td style="width: 16em;">
                        <?php if ($book->getIsEnable()) { ?>
                            <span class="badge badge-available">disponible</span>
                        <?php } else { ?>
                            <span class="badge badge-unavailable">non dispo.</span>
                        <?php } ?>
                    </td>
                    <td style="width: 16em;">
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