<?php

class MessagesController
{
        /**
     * Traite l'envoi d'un nouveau message dans une conversation existante.
     */
    public function sendMessage(): void
    {
        UsersController::checkIfUserIsConnected();
        $idUser = $_SESSION['idUser'];

        $idConversation = (int) Utils::request('id_conversation');
        $content = trim((string) Utils::request('message'));

        if (empty($idConversation) || $content === '') {
            throw new Exception("Le message ne peut pas être vide.");
        }

        $conversationManager = new ConversationManager();
        $conversation = $conversationManager->getConversationById($idConversation);

        // Sécurité : l'utilisateur doit être l'un des deux participants de la conversation.
        if (!$conversation ||
            ($conversation->getIdUser1() !== $idUser && $conversation->getIdUser2() !== $idUser)
        ) {
            throw new Exception("Vous n'avez pas accès à cette conversation.");
        }

        $message = new Message(null, $idConversation, $idUser, $content, new DateTime(),0);

        $messageManager = new MessageManager();
        $messageManager->addMessage($message);

        Utils::redirect('getConversations', ['id' => $idConversation]);
    }

    public static function refreshUnreadCount(int $idUser): int
    {
        $messageManager = new MessageManager();
        $count = $messageManager->getNumberUnreadMessagesByUserId($idUser);
        $_SESSION['messages'] = $count;
        return $count;
    }

    public function getUnreadMessage(): void
    {
        UsersController::checkIfUserIsConnected();
        $idUser = $_SESSION['idUser'];

        $messageManager = new MessageManager();
        $unreadCount = $messageManager->getNumberUnreadMessagesByUserId($idUser);
        $_SESSION['messages'] = $unreadCount;

        // Réponse JSON destinée à un appel AJAX (fetch), pas de redirection ici.
        header('Content-Type: application/json');
        echo json_encode(['unread' => $unreadCount]);
        exit;
    }
    
}