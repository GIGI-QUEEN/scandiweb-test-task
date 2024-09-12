<?php

namespace App\Core;

class  Helpers
{
    public static function dd($value)
    {
        echo "<pre>";
        var_dump($value);
        echo "</pre>";

        die();
    }

    public static function base_path($path)
    {
        return BASE_PATH . $path;
    }
}
