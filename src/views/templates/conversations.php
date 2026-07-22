<?php
/**
 * Template Conversation
 */
?>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        setInterval(function(){ location.reload(); }, 60000);
    });
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
            $lastMessage = $item['lastMessage'];
            $isActive = $selectedConversation && $selectedConversation->getId() === $conversation->getId();
            $isUnread = $item['isUnread'];
        ?>
            <a class="conversationItem<?= $isActive ? '_active' : '' ?>"
               href="index.php?action=getConversations&id=<?= $conversation->getId(); ?>">
                <div class="roundPublic"> <img src="<?= $otherUserItem->getUrlImg(); ?>" alt="Photo de profil"></div>
                <div class="conversationInfo">
                    <div class="conversationTop">
                        <span class="conversationUsername"><?= $otherUserItem->getUsername(); ?><?php if ($isUnread) { ?><span class="unreadIndicator" title="Message non lu">!</span><?php } ?></span>
                        <?php if ($lastMessage) { ?>
                            <span class="conversationDate"><?= Utils::formatShortDate($lastMessage->getDateCreate()); ?></span>
                        <?php } ?>
                    </div>
                    <?php if ($lastMessage) { ?>
                        <span class="conversationPreview"><?= Utils::truncate($lastMessage->getMessage(), 28); ?></span>
                    <?php } ?>
                </div>
            </a>
        <?php } ?>
    </div>

    <div class="conversationThread">
        <?php if ($selectedConversation && $otherUser) { ?>

            <div class="threadHeader">
                <a href="index.php?action=getConversations" class="backLink">&larr; retour</a>
                <div class="threadUser">
                    <div class="roundPublic"><img src="<?= $otherUser->getUrlImg() ?>" alt=""></div>
                    <h3><?= $otherUser->getUsername(); ?></h3>
                </div>
            </div>

            <div class="threadMessages">
                <?php foreach ($messages as $message) {
                    $isMine = $message->getIdSender() === $currentUser->getId();
                ?>
                    <div class="message<?= $isMine ? '_mine' :'' ?>">
                        <?php if (!$isMine) { ?>
                            <div class="roundPublic"><img src="<?= $otherUser->getUrlImg() ?>" alt=""></div>
                        <?php } ?>
                        <span class="messageDate"><?= $message->getDateCreate()->format('d.m.y H:i'); ?></span>
                        <p><?= $message->getMessage(); ?></p>
                    </div>
                <?php } ?>
            </div>
            <hr>
            <form class="threadForm" action="index.php?action=sendMessage" method="post">
                <input type="hidden" name="id_conversation" value="<?= $selectedConversation->getId(); ?>">
                <textarea name="message" placeholder="Tapez votre message ici" required></textarea>
                <button type="submit" class="btn">Envoyer</button>
            </form>

        <?php } else { ?>
            <p>Sélectionnez une conversation pour afficher les messages.</p>
        <?php } ?>
    </div>

</div>