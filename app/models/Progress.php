<?php
class Progress
{
    private PDO $db;

    public function __construct()
    {
        $this->db = Database::getInstance();
    }
}
