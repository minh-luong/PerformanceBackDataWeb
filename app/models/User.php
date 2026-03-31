<?php

namespace App\Models;
use App\Cores\Database;
use App\Cores\Auth;
use App\Cores\Helper;

require_once '../app/cores/Database.php';

class User 
{
    private Database $db;

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

    public function create($username, $password, $fullname, $role)
    {
        $uid = Helper::generateRandomString(40);
        $hashedPassword = Helper::hashPassword($uid, $password);
        return $this->db->execute("INSERT INTO users (uid, username, password, fullname, role) VALUES (?, ?, ?, ?, ?)", 
            [$uid, $username, $hashedPassword, $fullname, $role]);
    }

    public function update($username, $password, $fullname, $role)
    {
        $uid = Auth::uid();
        $hashedPassword = Helper::hashPassword($uid, $password);
        return $this->db->execute("UPDATE users SET password = ?, fullname = ?, role = ? WHERE uid = ?", 
            [$hashedPassword, $fullname, $role, $uid]);
    }

    public function checkPassword($uid, $password)
    {
        $user = $this->db->fetch("SELECT password FROM users WHERE uid = ?", [$uid]);
        if (!$user) {
            return false;
        }
        return Helper::hashPassword($uid, $password) === $user['password'];
    }
}
?>