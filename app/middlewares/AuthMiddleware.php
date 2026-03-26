<?php

namespace App\Middlewares;
use App\Cores\Helper;

require_once '../app/cores/Helper.php';

class AuthMiddleware
{
    public function handle()
    {
        if(session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        
        if (!isset($_SESSION['uid'])) {
            Helper::redirect('/login');
            exit();
        }
    }
}
?>