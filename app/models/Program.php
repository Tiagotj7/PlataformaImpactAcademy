<?php
class Program
{
    private PDO $db;

    public function __construct()
    {
        $this->db = Database::getInstance();
    }
}
