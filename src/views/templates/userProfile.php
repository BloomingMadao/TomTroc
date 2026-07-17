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

<div class="user">
    <h2>Mon Compte</h2>
    <div class="userBlock">
        <div class="userContainer">
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

</div>

<hr>

<div class="bookList">
    <table>
        <thead>
            <tr>
                <th>Photo</th>
                <th>Titre</th>
                <th>Auteur</th>
                <th>Resumé</th>
                <th>Disponibilité</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($books as $book) { ?>
                <tr>
                    <td class="img">
                        <img class="bookImg" src="<?= $book->getUrlImg(); ?>" alt="Image <?= $book->getTitle(); ?>">
                    </td>
                    <td class="title"><?= $book->getTitle(); ?></td>
                    <td class="author"><?= $book->getAuthor(); ?></td>
                    <td class="resume"><?= $book->getResume(75); ?></td>
                    <td class="isEnable">
                        <?php if ($book->getIsEnable()) { ?>
                            <span class="badge badge-available">disponible</span>
                        <?php } else { ?>
                            <span class="badge badge-unavailable">non dispo.</span>
                        <?php } ?>
                    </td>
                    <td class="action">
                        <nav>
                            <ul class="navTable">
                                <li class="edit"><a href="index.php?action=editBookForm&idBook=<?= $book->getId(); ?>">Editer</a></li>
                                <li class="delete"><a href="index.php?action=deleteBook&idBook=<?= $book->getId(); ?>" <?= Utils::askConfirmation("Êtes-vous sûr de vouloir supprimer ce livre ?") ?>>Supprimer</a></li>
                            </ul>

                        </nav>
                    </td>
                </tr>
            <?php } ?>

        </tbody>
    </table>
    <a href="index.php?action=addBookForm" class="btn">Ajouter un livre</a>
</div>
