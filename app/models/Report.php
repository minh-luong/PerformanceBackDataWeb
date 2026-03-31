<?php

namespace App\Models;
use App\Cores\Database;
use App\Cores\Auth;

require_once '../app/cores/Database.php';

class Report 
{
    private Database $db;

    public function __construct()
    {
        $this->db = Database::getInstance();
    }

    public function getAll($year = null)
    {
        if($year === null)
            $year = date('Y');

        $raw = $this->db
            ->fetchAll("SELECT 
                mr.report_id,
                mr.uid,
                mr.year,
                mr.month,
                c.name AS category_name,
                rd.category_id,
                rd.content
            FROM monthly_reports mr
            JOIN report_details rd 
                ON mr.report_id = rd.report_id
            JOIN categories c 
                ON rd.category_id = c.category_id
            WHERE mr.uid = ? 
                AND mr.year = ?
            ORDER BY mr.month, c.category_id", [Auth::uid(), $year]);

        $reports = [];
        for($i = 0; $i < count($raw); $i++) {
            $month = $raw[$i]['month'];
            if (!isset($reports[$month])) {
                $reports[$month] = [
                    'report_id' => $raw[$i]['report_id'],
                    'year' => $raw[$i]['year'],
                    'month' => $month,
                ];
            }
            $reports[$month]['content'][$raw[$i]['category_id']] = [
                'category_name' => $raw[$i]['category_name'],
                'content' => $raw[$i]['content']
            ];
        }

        for($month = 1; $month <=12; $month++) {
            if (!isset($reports[$month])) {
                $reports[$month] = [
                    'report_id' => null,
                    'year' => $year,
                    'month' => $month,
                    'content' => []
                ];
            }
        }

        return $reports;
    }
}
?>