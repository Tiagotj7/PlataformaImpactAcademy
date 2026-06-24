<?php
class User
{
    private PDO $db;

    public function __construct()
    {
        $this->db = Database::getInstance();
    }
}
