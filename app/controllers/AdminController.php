<?php

namespace App\Controllers;

use App\Cores\Controller;
use App\Cores\Auth;
use App\Cores\Helper;
use App\Models\User;

require_once '../app/cores/Controller.php';

class AdminController extends Controller
{
    public function manageUserPage()
    {
        $menuItems = [];
        if(Auth::role() == 'admin')
        {
            $menuItems[] = ['label' => 'Manage Users', 'url' => '/admin/users'];
        }
        $menuItems[] = ['label'=> 'My back data','url'=> '/my-data'];

        $users = $this->model(User::class)->getAll();

        $this->view('admin/user/manage_user', [
            'menuItems' => $menuItems,
            'users' => $users
        ]);
    }

    public function createUserPage()
    {
        $menuItems = [];
        if(Auth::role() == 'admin')
        {
            $menuItems[] = ['label' => 'Manage Users', 'url' => '/admin/users'];
        }
        $menuItems[] = ['label'=> 'My back data','url'=> '/my-data'];

        $this->view('admin/user/add_user', [
            'menuItems' => $menuItems
        ]);
    }

    public function createUser()
    {
        $this->model(User::class)->create($_POST['username'], '12345678', $_POST['fullname'], $_POST['role']);
        Helper::redirect('/admin/users');
    }
}
?>