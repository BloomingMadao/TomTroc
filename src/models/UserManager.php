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

        $sql = "INSERT INTO users (mail,password,username,url_img) VALUES (:mail, :password, :username, :url_img)";
        $this->db->query($sql,[
            'mail' => $user->getMail(),
            'password' => $user->getPassword(),
            'username' => $user -> getUsername(),
            'url_img' => $user->getUrlImg()
        ]);

    }

    public function updateUser(User $user) : void 
    {
        $sql="UPDATE users set mail =:mail, password = :password, username = :username WHERE id = :id";
        $this->db->query($sql,[
            'id'=>$user->getId(),
            'mail'=>$user->getMail(),
            'password'=>$user->getPassword(),
            'username'=>$user->getUsername(),
        ]);
    }

    public function getUserByMail(string $mail) : ?User
    {
        $sql = "SELECT * FROM users WHERE mail = :mail";
        $result = $this->db->query($sql,['mail' => $mail]);
        $user= $result-> fetch();
        if ($user){
            return new User($user['id'],$user['username'],$user['mail'],$user['password'],$user['user_img']);
        }
    }



    public function getUserDetailById(int $id) : ?User
    {
        $sql = "SELECT u.* FROM users u  WHERE u.id = :id";
        $result = $this->db->query($sql,['id' => $id]);
        $user= $result-> fetch();
        if ($user){
            return new User($user['id'],$user['username'],$user['mail'],$user['password'],$user['user_img']);
        }
    }

        public function getUserPublicDetailById(int $id) : ?User
    {
        $sql = "SELECT u.id,u.username,u.user_img FROM users u  WHERE u.id = :id";
        $result = $this->db->query($sql,['id' => $id]);
        $user= $result-> fetch();
        if ($user){
            return new User($user['id'],$user['username'],null,null,$user['user_img']);
        }
    }



}