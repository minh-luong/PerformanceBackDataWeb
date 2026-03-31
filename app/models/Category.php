<?php

namespace App\Models;
use App\Cores\Database;

require_once '../app/cores/Database.php';

class Category 
{
    private Database $db;

    public function __construct()
    {
        $this->db = Database::getInstance();
    }

    public function getAll()
    {
        return $this->db->fetchAll("SELECT * FROM categories");
    }
}
?>