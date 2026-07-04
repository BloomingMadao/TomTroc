<?php

    $registerValidate = Utils::request('registerValidate');
?>

<div>
    <?php if($registerValidate === "true") :?>
        <p>Votre compte a bien été enregistré !</p>
    <?php endif ?>
    <article><?="test"; ?></article>
</div>

