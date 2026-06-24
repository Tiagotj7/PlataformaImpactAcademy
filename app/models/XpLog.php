<?php
class XpLog
{
    private PDO $db;

    public function __construct()
    {
        $this->db = Database::getInstance();
    }
}
