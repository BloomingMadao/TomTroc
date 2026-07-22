<?php

// use PDO;
class UsersController
{

    public static function checkIfUserIsConnected(): void
    {
        // On vérifie que l'utilisateur est connecté.
        if (!isset($_SESSION['user'])) {
            Utils::redirect("connectUserForm");
        }
    }

    public function connectForm(): void
    {
        $view = new View("Connexion");
        $view->render("connectionForm");
    }

    public function registerForm(): void
    {
        $view = new View("Inscription");
        $view->render("registerForm");
    }

    public function addUser(): void
    {
        $username = Utils::request("username");
        $mail = Utils::request("mail");
        $password = Utils::request("password");

        if (empty($username) || empty($mail) || empty($password)) {
            throw new Exception("Tous les champs sont obligatoire.");
        }

        $hash = password_hash($password, PASSWORD_DEFAULT);

        $user = new User(null, $username, $mail, $hash, URL_IMG_USER_DEFAULT);
        $userManager = new UserManager();
        $userManager->addUser($user);

        Utils::redirect('home', ['registerValidate' => "true"]);
    }

    public function connectUser(): void
    {
        $mail = Utils::request('mail');
        $password = Utils::request('password');

        if (empty($mail) || empty($password)) {
            throw new Exception("Tous les champs sont obligatoires.");
        }

        $userManager = new UserManager();
        $user = $userManager->getUserByMail($mail);

        if (!$user) {
            throw new Exception("L'utilisateur demandé n'existe pas.");
        }

        // On vérifie que le mot de passe est correct.
        if (!password_verify($password, $user->getPassword())) {
            $hash = password_hash($password, PASSWORD_DEFAULT);
            throw new Exception("Le mot de passe est incorrect : $hash");
        }

        $messageManager = new MessageManager();
        $unreadMessages = $messageManager->getNumberUnreadMessagesByUserId($user->getId());

        // On connecte l'utilisateur.
        $_SESSION['user'] = $user;
        $_SESSION['idUser'] = $user->getId();
        $_SESSION['messages'] = $unreadMessages;


        // On redirige vers la page d'administration.
        Utils::redirect("home");
    }

    public function showUserProfile(): void
    {
        $this->checkIfUserIsConnected();
        $idUser = $_SESSION['idUser'];
        $userDetail = [];

        $userManager = new UserManager();
        $user = $userManager->getUserDetailById($idUser);
        $userDetail[] = $user;

        $bookManager = new BookManager();
        $booksUser =  $bookManager->getAllBooksByUserId($idUser);


        $view = new View("Profile");
        $view->render("userProfile", ['books' => $booksUser, 'userInfo' => $user]);
    }

    public function showUserProfileById(): void
    {
        $idUser = Utils::request("id");
        $userDetail = [];

        $userManager = new UserManager();
        $user = $userManager->getUserPublicDetailById($idUser);
        $userDetail[] = $user;

        $bookManager = new BookManager();
        $booksUser =  $bookManager->getAllBooksByUserId($idUser);


        $view = new View("Profile");
        $view->render("publicUserProfile", ['books' => $booksUser, 'userInfo' => $user]);
    }


    public function updateUser(): void
    {
        $this->checkIfUserIsConnected();
        $idUser = $_SESSION['idUser'];
        $username = Utils::request("username");
        $mail = Utils::request("mail");
        $password = Utils::request("password");
        $hash = "";
        if (isset($password)) {
            $hash = password_hash($password, PASSWORD_DEFAULT);
        }
        $user = new User($idUser, $username, $mail, $hash, '');
        $userManager = new UserManager();
        $userManager->updateUser($user);

        Utils::redirect('userAccount', ['success' => 1, "message" => "compte utilisateur mis à jour"]);
    }

    public function updateUserImg(): void
    {
        $this->checkIfUserIsConnected();
        $idUser = $_SESSION['idUser'];
        $img = Utils::file('img');
        $imgInfo = pathinfo($img['name']);
        $allowedExtensions = ['jpg', 'jpeg', 'png'];
        $userManager = new UserManager();
        $user = $userManager->getUserDetailById($idUser);
        if (empty($idUser)) {
            throw new Exception("Vous devez être connecté pour ajouter un livre.");
        }

        if ($img['size'] > 5000000) {
            throw new Exception("L'image est trop volumineuse (5 Mo maximum).");
        }
        if (!isset($imgInfo['extension']) || !in_array(strtolower($imgInfo['extension']), $allowedExtensions)) {
            throw new Exception("L'extension du fichier n'est pas valide : 'jpg', 'jpeg', 'png'.");
        }

        $basePath='src/img/' . $idUser . '/';
        $path = $basePath . basename($img['name']);

        if ($user->getUrlImg() !== $path && $user->getUrlImg() !== URL_IMG_USER_DEFAULT) {

            $this->deleteImg($user->getUrlImg());
            $this->checkIfDirExist($basePath);
            $this->uploadImg($img, $path);

            $userManager->updateUserImg($idUser, $path);
        } else {
            throw new Exception("Une erreur est survenue", -1);
        }

        Utils::redirect('userAccount');
    }

    public function disconnectUser(): void
    {
        unset($_SESSION['user']);

        Utils::redirect("home");
    }

    private function checkIfDirExist(string $basePath):void
    {
        if (! is_dir($basePath)) {
            mkdir($basePath);
        }
    }
    private function uploadImg(array $file, string $url): void
    {

        move_uploaded_file($file['tmp_name'], $url);
    }

    private function deleteImg(string $url): void
    {
        if (!empty($url) && file_exists($url)) {
            unlink($url);
        }
    }
}
