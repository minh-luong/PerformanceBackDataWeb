<?php

namespace App\Controllers;

use App\Cores\Controller;

require_once '../app/cores/Controller.php';
class AuthController extends Controller
{
    public function loginPage()
    {
        $this->view('login');
    }

    public function loginPost()
    {
        echo "Login POST Request: ";
        array_map(function($item) {
            echo $item . " ";
        }, $_POST);
    }

    public function logout()
    {
        // Handle logout logic here
    }
}
?>