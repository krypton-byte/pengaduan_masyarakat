<?php
session_start();
require '../modules/imgbb.php';
require '../modules/models.php';
header('content-type: application/json');
if(!(isset($_SESSION['username_']) && isset($_SESSION['password_']))){
    echo json_encode([ "status" => false ], JSON_PRETTY_PRINT);
    exit();
}

try {
    if(isset($_POST['id']) && ((new Pengaduan($_POST['id']))->user()['username'] === $_SESSION['username_'])){
        if((new Pengaduan($_POST['id']))->delete()){
            echo json_encode(["status" => true], JSON_PRETTY_PRINT);
            exit();
        }
    }
}catch(pengaduanTidakDitemukan){
    echo json_encode([ "status" => false ], JSON_PRETTY_PRINT);
    exit();
}
echo json_encode([ "status" => false ], JSON_PRETTY_PRINT);
?>