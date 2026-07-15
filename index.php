<?php

require_once 'config/config.php';
require_once 'config/autoload.php';

$action = Utils::request('action','home');


try {
    switch ($action) {


        /**
         * Page d'accueil
         */
        case 'home':
            $bookController = new BooksController();
            $bookController->showHome();
            break;

        case 'allBooks':
            $bookController = new BooksController();
            $bookController->showAllBooks();
            break;

        case 'detailBook':
            $bookController = new BooksController();
            $bookController->showDetailBookById();
            break;

        /**
         * Gestion Livre
         */
        case 'addBookForm':
            $bookController = new BooksController();
            $bookController->addBookForm();
            break;

        case 'updateBook':
            $bookController = new BooksController();
            $bookController->updateBook();
            break;

        case 'editBookForm':
            $bookController = new BooksController();
            $bookController->editBookForm();
            break;

        case 'deleteBook':
            $bookController = new BooksController();
            $bookController->deleteBook();
            break;




        /**
         * Gestion Utilisateurs
         */
        case 'connectUserForm':
            $userController = new UsersController();
            $userController->connectForm();
            break;
        
        case 'connectUser':
            $userController = new UsersController();
            $userController->connectUser();
            break;

        case 'disconnectUser':
            $userController = new UsersController();
            $userController->disconnectUser();
            break;

        case 'registerForm':
            $userController = new UsersController();
            $userController->registerForm();
            break;

        case 'addUser':
            $userController = new UsersController();
            $userController->addUser();
            break;
        
        case 'userAccount' :
            $userController = new UsersController();
            $userController->showUserProfile();
            break;

        case 'showUserProfile' :
            $userController = new UsersController();
            $userController->showUserProfileById();
            break;

        case 'updateUser':
            $userController = new UsersController();
            $userController->updateUser();
            break;


        /**Gestion Conversations */
        case "getConversations":
            $conversationsController = new ConversationsController();
            $conversationsController->showConversationsUser();
            break;

        case "startConversation":
            $conversationsController = new ConversationsController();
            $conversationsController->startConversation();
            break;

        case "sendMessage":
            $messagesController = new MessagesController();
            $messagesController->sendMessage();
            break;

        
        default:
            throw new Exception("La page demandée n'existe pas.");
    }
} catch (Exception $e) {
    echo "Erreur : " . $e->getMessage();
}