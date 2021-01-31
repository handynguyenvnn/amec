<?php

namespace App\Libs\Pass;

class PassScoreRate
{
    public static function equal($number1=null, $number2= null)
    {
        return ($number1>=$number2) ? 1 : 0;
    }
}