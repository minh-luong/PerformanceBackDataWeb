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
        

        $this->view('dashboard', [
            'fullname' => Auth::fullname(),
            'menuItems' => Auth::menuItems()
        ]);
    }
}
?>