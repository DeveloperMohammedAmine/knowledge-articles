<?php

namespace App\Traits;

trait saveImage
{
      protected function saveImage($image, $path) {
            $file_extension = $image -> getClientOriginalExtension();
            $file_name = time() . '.' .$file_extension;
            $image -> move($path, $file_name);
            return $file_name;
      }
   
}
