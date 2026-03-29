<?php

namespace App\Controllers;

use App\Cores\Controller;
use App\Cores\Helper;
use App\Cores\Auth;

require_once '../app/cores/Controller.php';

class HomeController extends Controller
{
    public function index()
    {
        Helper::redirect('/dashboard');
    }

    public function showDashboard()
    {
        $menuItems = [];
        if(Auth::role() == 'admin')
        {
            $menuItems[] = ['label' => 'Manage Users', 'url' => '/admin/users'];
        }
        $menuItems[] = ['label'=> 'My back data','url'=> '/my-data'];

        $this->view('dashboard', [
            'fullname' => Auth::fullname(),
            'menuItems' => $menuItems
        ]);
    }
}
?>