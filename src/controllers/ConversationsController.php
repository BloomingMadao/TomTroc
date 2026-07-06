<?php

class ConversationsController
{
    public function showAllConversations(): void
    {
        $idUser = $_SESSION['idUser'];

        $conversationManager = new ConversationManager();
        $conversations = $conversationManager->getAllUserConversation($idUser);

        $messageManager = new MessageManager();
        $userManager = new UserManager();

        $messages = [];
        $otherUsers = [];

        foreach ($conversations as $conversation) {
            $messages[$conversation->getId()] = $messageManager->getAllMessagesOfAConversation($conversation->getId());

            $idOtherUser = $conversation->getIdUser1() === $idUser
                ? $conversation->getIdUser2()
                : $conversation->getIdUser1();

            $otherUsers[$conversation->getId()] = $userManager->getUserDetailById($idOtherUser);
        }

        $idConversationActive = (int) Utils::request('idConversation', 0);
        $activeConversation = null;
        foreach ($conversations as $conversation) {
            if ($conversation->getId() === $idConversationActive) {
                $activeConversation = $conversation;
                break;
            }
        }

        $view = new View("Messagerie");
        $view->render("userConversations", [
            'conversations' => $conversations,
            'messages' => $messages,
            'otherUsers' => $otherUsers,
            'activeConversation' => $activeConversation,
            'idUser' => $idUser,
        ]);
    }
}