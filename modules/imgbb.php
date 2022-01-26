<?php
    function generateFileName(string $path): string{
        return hash('sha256',microtime(true)).'.'.explode('/',getimagesize($path)['mime'])[1];
    }
    function uploadImageFromPath($path) {
        return imageUpload($path);
    }

    function imageUpload(string $path): string
    {
        $fname = hash('sha256',microtime(true)).'.'.explode('/',getimagesize($path)['mime'])[1];
        move_uploaded_file($path,dirname(__FILE__, 2).'/gambar-aduan/'.$fname);
        return $fname;
    }
    // function uploadimgbb($bs4) {
    //     $http = curl_init('https://api.imgbb.com/1/upload?key=fe62d7633e0c7a093e9f95483963332b');
    //     curl_setopt($http, CURLOPT_POST, true);
    //     curl_setopt($http, CURLOPT_RETURNTRANSFER, true);
    //     curl_setopt($http, CURLOPT_POSTFIELDS, http_build_query([
    //         "image" => $bs4
    //     ]));
    //     $result = json_decode(curl_exec($http));
    //     if(isset($result->success)) { // array_key_exist ada kesalah di php8, sebagai gantinya menggnakan fungsi isset()
    //         return $result->data->display_url;
    //     }
    // }
?>