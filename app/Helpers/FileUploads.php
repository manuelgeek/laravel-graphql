<?php


namespace App\Helpers;


use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class FileUploads
{
    public static function init()
    {
        return new self();
    }

    public function uploadImage( $image, $folder = "/upload/logo/")
    {
        $image_name= Str::slug($image->getClientOriginalName()).'.'.$image->getClientOriginalExtension();

        $path = public_path() . $folder;

        if (!file_exists(public_path() . $folder)) {
            mkdir(public_path() . $folder, 0777, true);
        }

        $image->move($path, $image_name);

        return $folder . $image_name;
    }

    public function updateImage($image, $oldFilename,  $folder = "/upload/logo/" )
    {
        $image_name = Str::slug($image->getClientOriginalName()).'.'.$image->getClientOriginalExtension();

        $path = public_path() . $folder ;

        if (!file_exists(public_path() . $folder)) {
            mkdir(public_path() . $folder, 0777, true);
        }
        $image->move($path, $image_name);

        if ($oldFilename != null && strpos($oldFilename, $folder) !== false){
            $this->deletePic($oldFilename);
        }

        return $folder . $image_name;
    }

    public function deletePic($oldFilename)
    {
        return File::delete(public_path().$oldFilename);
    }
}
