<?php

// use PDO;
class UsersController
{
    public function connectForm() : void 
    {
        require('src/views/templates/connectionForm.php');

    }

    public function registerForm() :void
    {
        require('src/views/templates/registerForm.php');
    }

    public function addUser():void
    {
        $username = Utils::request("username");
        $mail = Utils::request("mail");
        $password = Utils::request("password");

        if (empty($username) || empty($mail) || empty($password)) {
            throw new Exception ("Tous les champs sont obligatoire.");
        }

        $hash = password_hash($password,PASSWORD_DEFAULT);

        $user = new User(null,$username,$mail,$hash);
        $userManager = new UserManager();
        $userManager->addUser($user);

        // if(PDO PDOStatement){
        //     Utils::redirect("validate");
        // }else{
        //     Utils::redirect("Error");
        // }

    }
}