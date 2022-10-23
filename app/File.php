<?php

namespace App;

use Exception;
use Illuminate\Support\Facades\File as FacadesFile;
use Illuminate\Support\Str;

class File
{
    public static function newFile($file, $path)
    {
        if($file != null)
        {
            //try{
                // $name = time().''.Str::lower(Str::random(8)).'.'.explode('/', explode(':', substr($file, 0, strpos($file, ';')))[1])[1];
                $name = time().''.Str::lower(Str::random(8)).'.'.$file->getClientOriginalExtension();
                $destinationPath = public_path($path) . '/'.$name;
                if(file_put_contents($destinationPath, file_get_contents($file))){
                    return $name;
                }
            // }catch(Exception $e)
            // {
            //     return null;
            // }
        }
        return null;
    }

    public static function remove($path, $name)
    {
        $file_path = public_path($path.'/'.$name);
        if (FacadesFile::exists($file_path)){
            FacadesFile::delete($file_path);
        }
    }
}