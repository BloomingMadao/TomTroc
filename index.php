<?php

require_once 'config/config.php';
require_once 'config/autoload.php';

$action = Utils::request('action','home');


try {
    switch ($action) {

        case 'home':
            $bookController = new BooksController();
            $bookController->showHome();
            break;

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

        
        default:
            throw new Exception("La page demandée n'existe pas.");
    }
} catch (Exception $e) {
    //throw $th;
}