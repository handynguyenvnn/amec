<?php

namespace App\Libs\S3;
use Illuminate\Support\Facades\Storage;
use App\Libs\Constants\Constant;
use Illuminate\Http\Request;

class S3Upload
{
    /**
     * @param $request
     * @param $nameFileUpload
     * @param $categoryFile
     * @return string
     */
    public static function upload( $request, $nameFileUpload, $categoryFile)
    {
        if($request->hasFile($nameFileUpload)){
            $file = $request->file($nameFileUpload);
            $name = str_random(15).pathinfo($file)['filename'];
            $ext = $file->guessClientExtension();
            if(Storage::disk('s3')->putFileAs($categoryFile, $request->{$categoryFile}, "{$name}.{$ext}", "public")){
                return Constant::S3_URL.DS.Constant::S3_BUCKET_URL.DS.$categoryFile.DS.$name.'.'.$ext;
            }else{
                return Constant::NO_IMAGE;
            }
        }
    }
}