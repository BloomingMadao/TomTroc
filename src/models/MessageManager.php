<?php

class MessageManager
{
    private $db;

    public function __construct()
    {
        $this->db = DBManager::getInstance();
    }

    public function getAllMessagesOfAConversation(int $id): array
    {
        $sql = "SELECT * FROM messages WHERE id_conversation = :id ORDER BY date_create desc";
        $result = $this->db->query($sql, [
            'id' => $id,
        ]);

        $messages = [];

        while ($message = $result->fetch()) {
            $messages[] = new Message(
                $message['id'],
                $message['id_conversation'],
                $message['id_sender'],
                $message['message'],
                $message['date_create']
            );
        }
        return $messages;
    }
}
