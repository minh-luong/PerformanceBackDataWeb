<?php

namespace App\Controllers;

use App\Cores\Controller;
use App\Cores\Auth;
use App\Models\Report;
use App\Models\Category;

require_once '../app/cores/Controller.php';

class ReportController extends Controller
{
    public function manageMyDataPage()
    {
        $this->view('data/manage_data', [
            'menuItems' => Auth::menuItems(),
            'categories' => $this->model(Category::class)->getAll(),
            'data' => $this->model(Report::class)->getAll()
        ]);
    }

    public function editDataPage($year, $month)
    {
        $this->view('data/edit_data', [
            'menuItems' => Auth::menuItems(),
            'categories' => $this->model(Category::class)->getAll(),
            'data' => $this->model(Report::class)->getAll()
        ]);
    }
}
?>