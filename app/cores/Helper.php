<?php

namespace App\Cores;
class Helper
{
    public static function redirect($url)
    {
        header("Location: " . BASE_URL . $url);
        exit();
    }
}
?>