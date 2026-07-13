<?php

// use PDO;
class UsersController
{

    static function checkIfUserIsConnected(): void
    {
        // On vérifie que l'utilisateur est connecté.
        if (!isset($_SESSION['user'])) {
            Utils::redirect("connectionForm");
        }
    }

    public function connectForm() : void 
    {
        $view = new View("Connexion");
        $view->render("connectionForm");

    }

    public function registerForm() :void
    {
        $view = new View("Inscription");
        $view->render("registerForm");
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

    public function showUserProfile() : void
    {
        $this->checkIfUserIsConnected();
        $idUser=$_SESSION['idUser'];
        $userDetail=[];

        $userManager=new UserManager();
        $user=$userManager->getUserDetailById($idUser);
        $userDetail[]=$user;

        $bookManager = new BookManager();
        $booksUser =  $bookManager->getAllBooksByUserId($idUser);


        $view = new View("Profile");
        $view->render("userProfile",['books'=>$booksUser,'userInfo'=>$user]);
    }

   public function showUserProfileById() : void
    {
        $idUser=Utils::request("id");
        $userDetail=[];

        $userManager=new UserManager();
        $user=$userManager->getUserPublicDetailById($idUser);
        $userDetail[]=$user;

        $bookManager = new BookManager();
        $booksUser =  $bookManager->getAllBooksByUserId($idUser);


        $view = new View("Profile");
        $view->render("publicUserProfile",['books'=>$booksUser,'userInfo'=>$user]);
    }

    public function disconnectUser():void
    {
        unset($_SESSION['user']);

        Utils::redirect("home");
    }





}