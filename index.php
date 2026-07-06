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


        case 'showAllConversations' : 
            $conversationController = new ConversationsController();
            $conversationController->showAllConversations();
            break;

        
        default:
            throw new Exception("La page demandée n'existe pas.");
    }
} catch (Exception $e) {
    echo "Erreur : " . $e->getMessage();
}