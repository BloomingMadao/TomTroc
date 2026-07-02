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
        
        default:
            throw new Exception("La page demandée n'existe pas.");
    }
} catch (Exception $e) {
    //throw $th;
}