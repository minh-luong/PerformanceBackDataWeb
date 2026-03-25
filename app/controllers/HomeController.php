<?php

namespace App\Controllers;

use App\Cores\Controller;
use App\Cores\Helper;

require_once '../app/cores/Controller.php';
require_once '../app/cores/Helper.php';

class HomeController extends Controller
{
    public function index()
    {
        Helper::redirect('/login');
    }

    public function showDashboard()
    {
        $this->view('dashboard');
    }
}
?>