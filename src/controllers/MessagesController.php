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

        $message = new Message(null, $idConversation, $idUser, $content, new DateTime());

        $messageManager = new MessageManager();
        $messageManager->addMessage($message);

        Utils::redirect('getConversations', ['id' => $idConversation]);
    }
    
}