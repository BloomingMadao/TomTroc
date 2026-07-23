<?php

class BooksController
{

    public function showHome(): void
    {
        $bookManager = new BookManager();
        $books = $bookManager->getLastBookCreate(); //getLastBooks() les 5 derniers livres ajoutés

        $view = new View("Accueil");
        $view->render("home", ['books' => $books]);
    }

    public function showAllBooks() : void 
    {
        $bookManager = new BookManager();
        $search=Utils::request('search');
        if(isset($search)){
            $books = $bookManager->getAllBooksBySearch((string)$search);
        }else{
            $books = $bookManager->getAllBooks();
        }


        $view = new View("Nos livre à l'échange");
        $view->render("allBook",['books'=>$books]);

    }

    public function showDetailBookById() : void
    {
        $id = (int)Utils::request('id');

        $bookManager = new BookManager();
        $book = $bookManager->getBookById($id);
        if(!$book){
            throw new Exception("Le livre n'a pas été retrouvé",-1);
        }

        $userManager = new UserManager();
        $user = $userManager->getUserPublicDetailById($book->getIdUser());

        $view = new View("Détail Livre");
        $view->render("detailBook",['book'=>$book,'user'=>$user]);
    }

    public function addBookForm(): void
    {
        UsersController::checkIfUserIsConnected();
        $book = new Book(-1, $_SESSION["idUser"] ?? 0, "", "", "", new DateTime(), new DateTime(), false, "",null);
        $view = new View("Ajouter livre");
        $view->render("bookForm", ['book' => $book]);
    }

    public function editBookForm(): void
    {
        UsersController::checkIfUserIsConnected();
        $id = (int)Utils::request("idBook");
        $idUser = $_SESSION['idUser'];

        $bookManager = new BookManager();
        $book = $bookManager->getBookByIds($id, $idUser);

        if (is_null($book)) {
            throw new Exception("Le livre n'a pas été retrouvé ou l'utilisateur n'est pas reconnu.");
        }

        $view = new View("Edition du livre");
        $view->render("bookForm", [
            'book' => $book
        ]);
    }

    public function updateBook(): void
    {
        UsersController::checkIfUserIsConnected();
        $id = Utils::request("id");
        $title = Utils::request("title");
        $idUser = $_SESSION["idUser"];
        $author = Utils::request("author");
        $resume = Utils::request("resume");
        $isEnable = Utils::request("isEnable");
        $imgUrlNow = Utils::request("imgUrlNow");
        $img = Utils::file('img');
        $allowedExtensions = ['jpg', 'jpeg', 'png'];

        if (empty($title) || empty($author) || empty($resume)) {
            throw new Exception("Tous les champs sont obligatoires.");
        }
        if (empty($idUser)) {
            throw new Exception("Vous devez être connecté pour ajouter un livre.");
        }

        // détection fiable d'un nouveau fichier envoyé
        $hasNewImage = isset($img) && isset($img['error']) && $img['error'] === UPLOAD_ERR_OK;

        if ($hasNewImage) {
            $imgInfo = pathinfo($img['name']);

            if ($img['size'] > 5000000) {
                throw new Exception("L'image est trop volumineuse (5 Mo maximum).");
            }
            if (!isset($imgInfo['extension']) || !in_array(strtolower($imgInfo['extension']), $allowedExtensions)) {
                throw new Exception("L'extension du fichier n'est pas valide : 'jpg', 'jpeg', 'png'.");
            }

            $path = 'src/img/' . basename($img['name']);
            $this->uploadImg($img, $path);

            // suppression de l'ancienne image si une nouvelle a été ajoutée
            if (!empty($imgUrlNow)) {
                $this->deleteImg($imgUrlNow);
            }
        } elseif (!empty($imgUrlNow)) {
            // modification sans changement d'image -> on garde l'ancienne
            $path = $imgUrlNow;
        } else {
            throw new Exception("Vous devez fournir une image.");
        }

        if(is_string($isEnable)&&$isEnable==="non-disponible"){
            $isEnable=0;
        }elseif(is_string($isEnable)&&$isEnable==="disponible"){
            $isEnable=1;
        }else{
            throw new Exception("Erreur valeur non reconnue : La valeur doit être disponible ou non-disponible");
        }


        $book = new Book(
            (int)$id,
            (int)$idUser,
            $title,
            $author,
            $resume,
            date("Y-m-d H:i:s"),
            date("Y-m-d H:i:s"),
            $isEnable,
            $path,null
        );

        $bookManager = new BookManager();

        // aiguillage ajout / modification
        if ((int)$id === -1) {
            $bookManager->addBook($book);
        } else {
            $bookManager->updateBook($book);
        }

        Utils::redirect('userAccount');
    }

    public function deleteBook()
    {
        UsersController::checkIfUserIsConnected();
        $id = (int)Utils::request('idBook');
        $idUser = (int)$_SESSION['idUser'];

        $bookManager = new BookManager();
            
        $book = $bookManager->getBookByIds($id, $idUser);

    if (is_null($book)) {
        throw new Exception("Le livre n'a pas été retrouvé ou l'utilisateur n'est pas reconnu.");
    }
        $bookManager->deleteBook($id,$idUser);
        $this->deleteImg($book->getUrlImg());

        Utils::redirect('userAccount',["success"=>1,"message"=>"Suppression du livre effectué"]);

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
