<?php

    use Illuminate\Support\Facades\Storage;


    if(!function_exists('uploadFile')) {
        function uploadFile($file, $path) {
            $file_extension = $file -> getClientOriginalExtension(); //get the original name of file in the user machine
            $file_name = time() . '.' .$file_extension; // time just to make file name unique
            $file -> move($path, $file_name);
            return $file_name;
        }    
    }

    if(!function_exists('unlinkFile')) {
        function unlinkFile($pathAndName) {
            if (file_exists($pathAndName)) { // Check if the file exists in the storage
                unlink($pathAndName); // Then Delete the file
            }
            return false; // return false if file not exist
        }    
    }



?>