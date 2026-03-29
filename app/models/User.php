<?php

namespace App\Models;
use App\Cores\Database;

require_once '../app/cores/Database.php';

class User 
{
    private $db;

    public function __construct()
    {
        $this->db = Database::getInstance();
    }

    public function findByUsername($username)
    {
        return $this->db->fetch("SELECT * FROM users WHERE username = ?", [$username]);
    }
}
?>