<?php
session_start();
header('content_type: application/json');

if(!(isset($_SESSION['username']) && isset($_SESSION['password']) && isset($_POST['id']))){
    echo json_encode(['status' => false], JSON_PRETTY_PRINT);
    exit();
}

try{
    $petugas = new Petugas($_SESSION['username'], $_SESSION['password']);
    $info = $petugas->edit_petugas($_POST);
    echo json_encode(['status' => boolval($info)], JSON_PRETTY_PRINT);
    exit();
}catch(Exception|userDoesNotExist $e){
    echo json_encode(["status" => false, "pesan" => $e->getMessage()], JSON_PRETTY_PRINT);
    exit();
}

?>