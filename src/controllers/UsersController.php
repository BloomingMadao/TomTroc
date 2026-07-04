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

        Utils::redirect('home',['registerValidate' => "true"]);

    }

    public function connectUser():void
    {
        $mail=Utils::request('mail');
        $password=Utils::request('password');
        
        if (empty($mail) || empty($password)) {
            throw new Exception("Tous les champs sont obligatoires.");
        }

        $userManager = new UserManager();
        $user=$userManager->getUserByMail($mail);

        if (!$user) {
            throw new Exception("L'utilisateur demandé n'existe pas.");
        }

        // On vérifie que le mot de passe est correct.
        if (!password_verify($password, $user->getPassword())) {
            $hash = password_hash($password, PASSWORD_DEFAULT);
            throw new Exception("Le mot de passe est incorrect : $hash");
        }

        // On connecte l'utilisateur.
        $_SESSION['user'] = $user;
        $_SESSION['idUser'] = $user->getId();

        // On redirige vers la page d'administration.
        Utils::redirect("home");
    }
}