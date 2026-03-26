<?php

namespace App\Cores;
class Helper
{
    public static function redirect($url)
    {
        header("Location: " . BASE_URL . $url);
        exit();
    }

    public static function fullPath($path)
    {
        return BASE_URL . ltrim($path);
    }

    public static function hashPassword($userId, $password)
    {
        return md5($userId) . sha1($password);
    }
}
?>