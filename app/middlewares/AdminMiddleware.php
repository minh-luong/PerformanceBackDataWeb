<?php

namespace App\Middlewares;
use App\Cores\Helper;
use App\Cores\Auth;

require_once '../app/cores/Helper.php';
require_once '../app/cores/Auth.php';

class AdminMiddleware
{
    public function handle()
    {        
        if (!Auth::check() || Auth::role() !== 'admin') {
            if($_SERVER['REQUEST_METHOD'] === 'GET') {
                Helper::redirect('/');
            } 
            else {
                http_response_code(403);
                header('Content-Type: application/json');
                echo json_encode(['error' => 'No permission']);
            }
            exit();
        }

    }
}
?>