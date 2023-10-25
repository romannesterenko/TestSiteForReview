<?php

namespace Helpers;

class ArrayHelper
{
    public static function dd($array)
    {
        echo "<pre>";
        print_r($array);
        echo "</pre>";
    }
}