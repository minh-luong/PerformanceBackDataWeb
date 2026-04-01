<?php

namespace App\Controllers;

use App\Cores\Controller;
use App\Cores\Auth;
use App\Models\Group;
use App\Models\Report;
use App\Models\Category;

require_once '../app/cores/Controller.php';

class ReportController extends Controller
{
    public function groupReportPage($group_id, $month)
    {
        $members = $this->model(Group::class)->getMembersByGroupId($group_id);
        $categories = $this->model(Category::class)->getAllByGroup($group_id);
        $reportRaws = $this->model(Report::class)->getAllByGroupAndMonth($group_id, $month);

        $reports = [];
        for($i = 0; $i < count($reportRaws); $i++) {
            $uid = $reportRaws[$i]['uid'];
            $reports[$uid]['fullname'] = $reportRaws[$i]['fullname'];

            if (!isset($reports[$uid])) {
                $reports[$uid]['fullname'] = $reportRaws[$i]['fullname'];
            }
            $reports[$uid]['content'][$reportRaws[$i]['category_id']] = [
                'category_name' => $reportRaws[$i]['category_name'],
                'content' => $reportRaws[$i]['content']
            ];

            foreach($categories as $category) {
                if (!isset($reports[$uid]['content'][$category['category_id']])) {
                    $reports[$uid]['content'][$category['category_id']] = [
                        'category_name' => $category['name'],
                        'content' => ''
                    ];
                }
            }
        }

        foreach($members as $member) {
            if (!isset($reports[$member['uid']])) {
                $reports[$member['uid']]['fullname'] = $member['fullname'];

                foreach($categories as $category) {
                    $reports[$member['uid']]['content'][$category['category_id']] = [
                        'category_name' => $category['name'],
                        'content' => ''
                    ];
                }
            }
        }

        $this->view('report/group_report', [
            'menuItems' => Auth::menuItems(),
            'month' => $month,
            'categories' => $categories,
            'group' => $this->model(Group::class)->getGroupById($group_id),
            'reports' => $reports
        ]);
    }

    public function updateReportPage($group_id, $month)
    {
        $this->view('data/update_report', [
            'menuItems' => Auth::menuItems(),
            'categories' => $this->model(Category::class)->getAll(),
            'data' => $this->model(Report::class)->getAll()
        ]);
    }
}
?>