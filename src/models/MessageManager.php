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