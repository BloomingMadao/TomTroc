<?php
/**
 * Template Conversation
 */
?>

<script>
    setInterval(function(){ location.reload(); }, 60000);
</script>

<div class="messagerie">

    <div class="conversationsList">
        <h2>Messagerie</h2>
        <?php if (empty($conversationsList)) { ?>
            <p>Vous n'avez aucune conversation pour le moment.</p>
        <?php } ?>

        <?php foreach ($conversationsList as $item) {
            $conversation = $item['conversation'];
            $otherUserItem = $item['otherUser'];
            $isActive = $selectedConversation && $selectedConversation->getId() === $conversation->getId();
        ?>
            <a class="conversationItem<?= $isActive ? '_active' : '' ?>"
               href="index.php?action=getConversations&id=<?= $conversation->getId(); ?>">
                <span class="conversationUsername"><?= $otherUserItem->getUsername(); ?></span>
            </a>
        <?php } ?>
    </div>

    <div class="conversationThread">
        <?php if ($selectedConversation && $otherUser) { ?>

            <div class="threadHeader">
                <h3><?= $otherUser->getUsername(); ?></h3>
            </div>

            <div class="threadMessages">
                <?php foreach ($messages as $message) {
                    $isMine = $message->getIdSender() === $currentUser->getId();
                ?>
                    <div class="message<?= $isMine ? '_mine' :'' ?>">
                        <p><?= $isMine ? $currentUser->getUsername() : $otherUser->getUsername()?></p>
                        <p><?= $message->getMessage(); ?></p>
                        <span class="messageDate"><?= $message->getDateCreate()->format('Y-m-d H:i:s'); ?></span>
                    </div>
                <?php } ?>
            </div>
            <hr>
            <form class="threadForm" action="index.php?action=sendMessage" method="post">
                <input type="hidden" name="id_conversation" value="<?= $selectedConversation->getId(); ?>">
                <textarea name="message" placeholder="Écrivez votre message..." required></textarea>
                <button type="submit" class="btn">Envoyer</button>
            </form>

        <?php } else { ?>
            <p>Sélectionnez une conversation pour afficher les messages.</p>
        <?php } ?>
    </div>

</div>
