<?php

class ConversationManager
{
    private $db;

    public function __construct()
    {
        $this->db=DBManager::getInstance();
    }

    public function getAllConversationsByUserId(int $idUser) : array
    {
        $sql="SELECT * FROM conversations WHERE id_user1 = :id_user  or id_user2 =:id_user";
        $result = $this->db->query($sql,[
            'id_user'=>$idUser
        ]);
        $conversations = [];
        while($conversation=$result->fetch()){
            $conversations[]=new Conversation(
                $conversation['id'],
                $conversation['id_user1'],
                $conversation['id_user2'],
                $conversation['date_create'],
            );
        }
        return $conversations;
    }

    public function getConversationBetweenUsers(int $idUser1, int $idUser2) : ?Conversation
    {
        $sql = "SELECT * FROM conversations 
                WHERE (id_user1 = :id_user1 AND id_user2 = :id_user2)
                   OR (id_user1 = :id_user2 AND id_user2 = :id_user1)";
        $result = $this->db->query($sql, [
            'id_user1' => $idUser1,
            'id_user2' => $idUser2
        ]);
        $conversation = $result->fetch();
        if ($conversation) {
            return new Conversation(
                $conversation['id'],
                $conversation['id_user1'],
                $conversation['id_user2'],
                $conversation['date_create']
            );
        }
        return null;
    }


    public function getConversationById(int $id) : ?Conversation
    {
        $sql = "SELECT * FROM conversations WHERE id = :id";
        $result = $this->db->query($sql, ['id' => $id]);
        $conversation = $result->fetch();
        if ($conversation) {
            return new Conversation(
                $conversation['id'],
                $conversation['id_user1'],
                $conversation['id_user2'],
                $conversation['date_create']
            );
        }
        return null;
    }

    public function createConversation(int $idUser1, int $idUser2) : Conversation
    {
        $sql = "INSERT INTO conversations (id_user1, id_user2, date_create) VALUES (:id_user1, :id_user2, NOW())";
        $this->db->query($sql, [
            'id_user1' => $idUser1,
            'id_user2' => $idUser2
        ]);

        $newId = (int) $this->db->getPDO()->lastInsertId();

        return $this->getConversationById($newId);
    }

    
}