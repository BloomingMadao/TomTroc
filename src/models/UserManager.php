<?php

class UserManager
{
    private $db;

    public function __construct()
    {
        $this->db= DBManager::getInstance();
    }

    public function addUser(User $user) : void
    {

        $sql = "INSERT INTO users (mail,password,username) VALUES (:mail, :password, :username)";
        $this->db->query($sql,[
            'mail' => $user->getMail(),
            'password' => $user->getPassword(),
            'username' => $user -> getUsername()
        ]);

    }

    public function getUserByMail(string $mail) : ?User
    {
        $sql = "SELECT * FROM users WHERE mail = :mail";
        $result = $this->db->query($sql,['mail' => $mail]);
        $user= $result-> fetch();
        if ($user){
            return new User($user['id'],$user['username'],$user['mail'],$user['password']);
        }
    }



    public function getUserDetailById(int $id) : ?User
    {
        $sql = "SELECT u.* FROM users u  WHERE u.id = :id";
        $result = $this->db->query($sql,['id' => $id]);
        $user= $result-> fetch();
        if ($user){
            return new User($user['id'],$user['username'],$user['mail'],$user['password']);
        }
    }



}