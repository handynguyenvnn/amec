<?php

namespace App\Libs\ImagePath;
use App\Libs\Constants\Constant;

class Process
{
    public static function convertURL($html = '')
    {
        $dom = new \DOMDocument();
        $dom->loadHTML(mb_convert_encoding($html, 'HTML-ENTITIES', 'UTF-8'));
        $dom->preserveWhiteSpace = false;
        if ($dom->getElementsByTagName('img')) {
            $images = $dom->getElementsByTagName('img');
            $arrayImg = array();
            $arrayNewImg = array();
            foreach ($images as $key => $img) {
                $arrayImg[] =  $img->getAttribute('src');
                $arrayNewImg[] = Constant::BASE_URL.$img->getAttribute('src');
            }
        }
        return str_replace(array_unique($arrayImg), array_unique($arrayNewImg), $html);
    }
}