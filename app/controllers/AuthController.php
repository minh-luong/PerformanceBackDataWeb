<?php

namespace App\Controllers;

use App\Cores\Controller;
use App\Cores\Helper;
use App\Cores\Auth;
use App\Models\User;

require_once '../app/cores/Controller.php';
require_once '../app/cores/Auth.php';

class AuthController extends Controller
{
    private User $userModel;

    public function __construct()
    {
        if(session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        $this->userModel = $this->model(User::class);
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
            Auth::attempt($user);
            Helper::redirect('/dashboard');
            exit();
        } else {
            $this->view('login', [
                'error' => 'Invalid username or password'
            ]);
        }
    }

    public function logout()
    {
        Auth::logout();
        Helper::redirect('/login');
    }
}
?>