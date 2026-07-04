<?php

class UserManager
{
    public function addUser(User $user) : void
    {
        $db = DBManager::getInstance();
        $sql = "INSERT INTO users (mail,password,username) VALUES (:mail, :password, :username)";
        $db->query($sql,[
            'mail' => $user->getMail(),
            'password' => $user->getPassword(),
            'username' => $user -> getUsername()
        ]);

        if($db){
            echo 'ça fonctionne';
        }
    }


}