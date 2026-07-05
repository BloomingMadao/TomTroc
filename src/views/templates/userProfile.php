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
                <td><img src="<?= $book->getUrlImg(); ?>" alt="Image <?= $book->getTitle(); ?>"></td>
                <td><?= $book->getTitle(); ?></td>
                <td><?= $book->getAuthor(); ?></td>
                <td><?= $book->getResume(); ?></td>
                <td><?php if ($book->getIsEnable()) {
                        echo 'disponible';
                    } else {
                        echo 'non-disponible';
                    } ?></td>
                <td><a href="#">Editer</a> <a href="">Suppimer</a></td>
            </tr>
            <?php } ?>

        </tbody>

    </table>
</div>