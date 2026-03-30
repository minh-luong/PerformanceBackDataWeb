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

    public function changePasswordPage()
    {
        $this->view('user/change_password', [
            'menuItems' => Auth::menuItems()
        ]);
    }

    public function changePassword()
    {
        $currentPassword = $_POST['old_password'] ?? '';
        $newPassword = $_POST['new_password'] ?? '';
        $confirmNewPassword = $_POST['confirm_new_password'] ?? '';

        if ($newPassword !== $confirmNewPassword) {
            $this->view('user/change_password', [
                'menuItems' => Auth::menuItems(),
                'error' => 'New password and confirmation do not match'
            ]);
            return;
        }

        if(strlen($newPassword) < 8) {
            $this->view('user/change_password', [
                'menuItems' => Auth::menuItems(),
                'error' => 'New password must be at least 8 characters long'
            ]);
            return;
        }

        $user = $this->userModel->findByUsername(Auth::username());

        if ($user && $user['password'] === Helper::hashPassword($user['uid'], $currentPassword)) {
            $this->userModel->update($user['username'], $newPassword, $user['fullname'], $user['role']);
            Helper::redirect('/dashboard');
            exit();
        } 
        else {
            $this->view('user/change_password', [
                'menuItems' => Auth::menuItems(),
                'error' => 'Current password is incorrect'
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