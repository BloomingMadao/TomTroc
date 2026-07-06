<?php

class ConversationManager
{
    private $db;

    public function __construct()
    {
        $this->db = DBManager::getInstance();
    }

    public function getAllUserConversation(int $idUser): array
    {
        $sql = "SELECT * FROM conversations WHERE (id_user1 = :id_user) OR (id_user2 = :id_user) ORDER BY date_create ASC";
        $result = $this->db->query($sql, [
            'id_user' => $idUser,
        ]);

        $conversations = [];

        while ($conversation = $result->fetch()) {
            $conversations[] = new Conversation(
                $conversation['id'],
                $conversation['id_user1'],
                $conversation['id_user2'],
                $conversation['id_book'],
                $conversation['date_create']
            );
        }
        return $conversations;
    }
}
