<?php
    function uploadImageFromPath($path) {
        return uploadimgbb(base64_encode(file_get_contents($path)));
    }

    function uploadimgbb($bs4) {
        $http = curl_init('https://api.imgbb.com/1/upload?key=fe62d7633e0c7a093e9f95483963332b');
        curl_setopt($http, CURLOPT_POST, true);
        curl_setopt($http, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($http, CURLOPT_POSTFIELDS, http_build_query([
            "image" => $bs4
        ]));
        $result = json_decode(curl_exec($http));
        if(isset($result->success)) { // array_key_exist ada kesalah di php8, sebagai gantinya menggnakan fungsi isset()
            return $result->data->display_url;
        }
    }
?>