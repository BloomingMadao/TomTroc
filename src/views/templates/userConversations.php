<?php
/**
 * Vue Messagerie - userConversations
 */
?>

<div class="messaging">
    <aside class="conversationList">
        <h2>Messagerie</h2>
        <ul>
            <?php foreach ($conversations as $conversation): ?>
                <?php
                $otherUser = $otherUsers[$conversation->getId()];
                $conversationMessages = $messages[$conversation->getId()];
                $lastMessage = end($conversationMessages);
                $isActive = $activeConversation && $conversation->getId() === $activeConversation->getId();
                ?>
                <li class="conversationItem <?= $isActive ? 'active' : '' ?>">
                    <a href="index.php?action=showConversations&idConversation=<?= $conversation->getId() ?>">
                        <div class="avatar avatarInitials"><?= htmlspecialchars(mb_strtoupper(mb_substr($otherUser->getUsername(), 0, 2))) ?></div>
                        <div class="conversationInfo">
                            <div class="conversationTop">
                                <span class="conversationName"><?= htmlspecialchars($otherUser->getUsername()) ?></span>
                                <?php if ($lastMessage): ?>
                                    <span class="conversationDate"><?= $lastMessage->getCreationDate()->format('H:i') ?></span>
                                <?php endif; ?>
                            </div>
                            <?php if ($lastMessage): ?>
                                <p class="conversationPreview"><?= htmlspecialchars(mb_substr($lastMessage->getMessage(), 0, 30)) ?>...</p>
                            <?php endif; ?>
                        </div>
                    </a>
                </li>
            <?php endforeach; ?>
        </ul>
    </aside>

    <section class="chatWindow">
        <?php if ($activeConversation): ?>
            <?php $otherUser = $otherUsers[$activeConversation->getId()]; ?>
            <div class="chatHeader">
                <div class="avatar avatarInitials"><?= htmlspecialchars(mb_strtoupper(mb_substr($otherUser->getUsername(), 0, 2))) ?></div>
                <h2><?= htmlspecialchars($otherUser->getUsername()) ?></h2>
            </div>

            <div class="chatMessages">
                <?php foreach ($messages[$activeConversation->getId()] as $message): ?>
                    <?php $isFromCurrentUser = $message->getIdSender() === $idUser; ?>
                    <div class="messageRow <?= $isFromCurrentUser ? 'sent' : 'received' ?>">
                        <?php if (!$isFromCurrentUser): ?>
                            <div class="avatar avatarSmall avatarInitials"><?= htmlspecialchars(mb_strtoupper(mb_substr($otherUser->getUsername(), 0, 2))) ?></div>
                            <span class="messageDate"><?= $message->getCreationDate()->format('d.m H:i') ?></span>
                        <?php endif; ?>

                        <div class="messageBubble">
                            <?= htmlspecialchars($message->getMessage()) ?>
                        </div>

                        <?php if ($isFromCurrentUser): ?>
                            <span class="messageDate"><?= $message->getCreationDate()->format('d.m H:i') ?></span>
                        <?php endif; ?>
                    </div>
                <?php endforeach; ?>
            </div>

            <form class="chatForm" action="index.php?action=sendMessage" method="post">
                <input type="hidden" name="idConversation" value="<?= $activeConversation->getId() ?>">
                <input type="text" name="content" placeholder="Tapez votre message ici" required>
                <button type="submit" class="sendButton">Envoyer</button>
            </form>
        <?php else: ?>
            <p class="noConversation">Sélectionnez une conversation pour commencer à discuter.</p>
        <?php endif; ?>
    </section>
</div>