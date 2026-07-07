<?php

class ConversationManager
{
    private $db;

    public function __construct()
    {
        $this->db=DBManager::getInstance();
    }
    
}