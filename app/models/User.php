<?php

namespace App\Models;
use App\Cores\Database;
use App\Cores\Auth;

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

    public function getAll()
    {
        return $this->db
            ->fetchAll("SELECT uid,username,fullname,role,status FROM users WHERE uid != ?", [Auth::uid()]);
    }
}
?>