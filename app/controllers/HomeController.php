<?php

namespace App\Controllers;

use App\Cores\Controller;

require_once '../app/cores/Controller.php';

class HomeController extends Controller
{
    public function index()
    {
        echo "Home Page";
    }

    public function show($id, $uid)
    {
        echo "Showing item with ID: $id, User ID: $uid";
    }
}
?>