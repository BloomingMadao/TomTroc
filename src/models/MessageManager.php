<?php
class MessageManager
{
    private $db;

    public function __construct()
    {
        $this->db=DBManager::getInstance();
    }

    public function getAllMessagesByConversationId(int $idConversation) : array
    {
        $sql = "SELECT * from messages WHERE id_conversation = :id_conversation";
        $result=$this->db->query($sql,[
            'id_conversation'=>$idConversation
        ]);
        $messages = [];
        while($message=$result->fetch()){
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

    public function getLastMessageByConversationId(int $idConversation) : ?Message
    {
        $sql = "SELECT * FROM messages WHERE id_conversation = :id_conversation
                ORDER BY date_create DESC LIMIT 1";
        $result = $this->db->query($sql, [
            'id_conversation' => $idConversation
        ]);
        $message = $result->fetch();
        if (!$message) {
            return null;
        }
        return new Message(
            $message['id'],
            $message['id_conversation'],
            $message['id_sender'],
            $message['message'],
            $message['date_create']
        );
    }

    public function addMessage(Message $message) : void
    {
        $sql = "INSERT INTO messages (id_conversation, id_sender, message, date_create) 
                VALUES (:id_conversation, :id_sender, :message, NOW())";
        $this->db->query($sql, [
            'id_conversation' => $message->getIdConversation(),
            'id_sender' => $message->getIdSender(),
            'message' => $message->getMessage()
        ]);
    }

}