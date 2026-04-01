<?php

namespace App\Models;
use App\Cores\Database;
use App\Cores\Auth;

require_once '../app/cores/Database.php';

class Group 
{
    private Database $db;

    public function __construct()
    {
        $this->db = Database::getInstance();
    }

    public function getJoinedGroups()
    {
        return $this->db->fetchAll("SELECT 
                g.group_id,
                g.name,
                g.description,
                gm.role,
                g.created_at
            FROM groups g
            JOIN group_members gm 
                ON g.group_id = gm.group_id
            WHERE gm.uid = ?
            ORDER BY g.group_id", 
            [Auth::uid()]);
    }

    public function getGroupById($id)
    {
        return $this->db->fetch("SELECT * FROM groups WHERE group_id = ?", [$id]);
    }

    public function getMembersByGroupId($id)
    {
        return $this->db->fetchAll("SELECT 
                u.uid,
                u.username,
                u.fullname,
                gm.role
            FROM users u
            JOIN group_members gm 
                ON u.uid = gm.uid
            WHERE gm.group_id = ?", 
            [$id]);
    }

}
?>