<?php

namespace App\Controllers;

use App\Cores\Controller;
use App\Cores\Helper;
use App\Models\Account;

require_once '../app/cores/Controller.php';

class AuthController extends Controller
{
    private Account $userModel;

    public function __construct()
    {
        if(session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        $this->userModel = $this->model(Account::class);
    }

    public function loginPage()
    {
        $this->view('login');
    }

    public function loginPost()
    {
        $username = $_POST['username'] ?? '';
        $password = $_POST['password'] ?? '';

        $user = $this->userModel->findByUsername($username);

        if ($user && $user['password'] === Helper::hashPassword($user['uid'], $password)) {
            if(session_status() == PHP_SESSION_NONE) {
                session_start();
            }

            $_SESSION['uid'] = $user['uid'];
            $_SESSION['username'] = $user['username'];
            Helper::redirect('/dashboard');
            exit();
        } else {
            $this->view('login', ['error' => 'Invalid username or password']);
        }
    }

    public function logout()
    {
        session_destroy();
        Helper::redirect('/login');
    }
}
?>