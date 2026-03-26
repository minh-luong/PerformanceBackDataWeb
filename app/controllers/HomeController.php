<?php

namespace App\Controllers;

use App\Cores\Controller;
use App\Cores\Helper;

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
            'username' => $_SESSION['username'] ?? 'Guest'
        ]);
    }
}
?>