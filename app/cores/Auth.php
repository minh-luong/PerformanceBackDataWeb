<?php

namespace App\Cores;

class Auth
{
    public static function attempt($user)
    {
        if(session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        $_SESSION['user'] = [
            'uid' => $user['uid'],
            'username' => $user['username'],
            'fullname' => $user['fullname'],
            'role' => $user['role']
        ];
    }

    public static function check()
    {
        if(session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        
        return isset($_SESSION['user']['uid']);
    }

    public static function user()
    {
        if(self::check()) {
            return $_SESSION['user'];
        }
        return null;
    }

    public static function uid()
    {
        $user = self::user();
        return $user ? $user['uid'] : null;
    }

    public static function fullname()
    {
        $user = self::user();
        return $user ? $user['fullname'] : null;
    }

    public static function username()
    {
        $user = self::user();
        return $user ? $user['username'] : null;
    }

    public static function role()
    {
        $user = self::user();
        return $user ? $user['role'] : null;
    }

    public static function logout()
    {
        if(session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        unset($_SESSION['user']);
        session_destroy();
    }

    public static function menuItems()
    {
        $menuItems = [];
        if(Auth::role() == 'admin')
        {
            $menuItems[] = ['label' => 'Manage Users', 'url' => '/admin/users'];
        }
        $menuItems[] = ['label'=> 'My back data','url'=> '/my-data'];

        return $menuItems;
    }
}
?>