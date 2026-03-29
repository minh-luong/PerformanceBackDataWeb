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

    public static function generateRandomString($length = 10)
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    public static function hashPassword($userId, $password)
    {
        return md5($userId) . sha1($password);
    }
}
?>