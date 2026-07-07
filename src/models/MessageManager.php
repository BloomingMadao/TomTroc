<?php
class MessageManager
{
    private $db;

    public function __construct()
    {
        $this->db=DBManager::getInstance();
    }
}