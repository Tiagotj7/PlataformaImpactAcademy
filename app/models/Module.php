<?php
class Module
{
    private PDO $db;

    public function __construct()
    {
        $this->db = Database::getInstance();
    }
}
