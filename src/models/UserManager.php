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

        if($this->db){
            echo 'ça fonctionne';
        }
    }

    public function getUserByMail(string $mail) : ?User
    {
        $sql = "SELECT * FROM users WHERE mail = :mail";
        $result = $this->db->query($sql,['mail' => $mail]);
        $user= $result-> fetch();
        if ($user){
            return new User($user['id'],$user['username'],$user['mail'],$user['password']);
        }
        var_dump($user);
    }


}