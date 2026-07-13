<?php

class ConversationsController
{
    public function showConversationsUser(): void
    {
        UsersController::checkIfUserIsConnected();
        $idUser = $_SESSION["idUser"];

        $conversationManager = new ConversationManager();
        $messageManager = new MessageManager();
        $userManager = new UserManager();

        $conversations = $conversationManager->getAllConversationsByUserId($idUser);
        $conversationsList = [];
        foreach ($conversations as $conversation) {
            $otherUser = $userManager->getUserDetailById($conversation->getOtherUserId($idUser));
            $conversationsList[] = [
                'conversation' => $conversation,
                'otherUser' => $otherUser
            ];
        }

        $selectedConversation = null;
        $messages = [];
        $otherUser = null;
        $currentUser= null;

        $idConversation = Utils::request('id');
        if ($idConversation) {
            $selectedConversation = $conversationManager->getConversationById((int) $idConversation);

            // Sécurité : l'utilisateur doit être l'un des deux participants.
            if (
                $selectedConversation &&
                ($selectedConversation->getIdUser1() === $idUser || $selectedConversation->getIdUser2() === $idUser)
            ) {
                $messages = $messageManager->getAllMessagesByConversationId($selectedConversation->getId());
                $otherUser = $userManager->getUserPublicDetailById($selectedConversation->getOtherUserId($idUser));
                $currentUser = $userManager->getUserPublicDetailById($idUser);
            } else {
                $selectedConversation = null;
            }
        }

        $view = new View('Messagerie');
        $view->render('conversations', [
            'conversationsList' => $conversationsList,
            'selectedConversation' => $selectedConversation,
            'messages' => $messages,
            'otherUser' => $otherUser,
            'currentUser' => $currentUser,
        ]);
    }

    public function startConversation(): void
    {
        UsersController::checkIfUserIsConnected();
        $idCurrentUser = $_SESSION['idUser'];
        $idOtherUser = (int) Utils::request('id');

        if (empty($idOtherUser) || $idOtherUser === $idCurrentUser) {
            throw new Exception("Impossible de démarrer cette conversation.");
        }

        $conversationManager = new ConversationManager();
        $conversation = $conversationManager->getConversationBetweenUsers($idCurrentUser, $idOtherUser);
        if (!$conversation) {
            $conversation = $conversationManager->createConversation($idCurrentUser, $idOtherUser);
        }

        Utils::redirect('getConversations', ['id' => $conversation->getId()]);
    }
}
