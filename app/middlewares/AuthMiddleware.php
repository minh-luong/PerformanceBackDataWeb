<?php

namespace App\Middlewares;
use App\Cores\Helper;
use App\Cores\Auth;

require_once '../app/cores/Helper.php';
require_once '../app/cores/Auth.php';

class AuthMiddleware
{
    public function handle()
    {        
        if (!Auth::check()) {
            Helper::redirect('/login');
            exit();
        }

    }
}
?>