<?php

namespace App\Models;
use App\Cores\Database;

require_once '../app/cores/Database.php';

class Report 
{
    private Database $db;

    public function __construct()
    {
        $this->db = Database::getInstance();
    }

    public function getAllByGroupAndMonth($group_id, $month)
    {
        $raw = $this->db->fetchAll("SELECT 
            mr.report_id,
            mr.uid,
            mr.month,
            u.fullname,
            c.name AS category_name,
            rd.category_id,
            rd.content
        FROM monthly_reports mr
        JOIN report_details rd 
            ON mr.report_id = rd.report_id
        JOIN categories c 
            ON rd.category_id = c.category_id
        JOIN users u 
            ON mr.uid = u.uid
        WHERE mr.group_id = ? 
            AND mr.month = ?
        ORDER BY mr.uid", [$group_id, $month]);

        return $raw;
    }
}
?>