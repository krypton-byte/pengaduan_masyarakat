<?php
session_start();
require '../modules/imgbb.php';
require '../modules/models.php';
header('content-type: application/json');
if(!(isset($_SESSION['username']) && isset($_SESSION['password']))){
    echo json_encode([ "status" => false ], JSON_PRETTY_PRINT);
    exit();
}
$limit = (isset($_POST['limit']) && is_numeric($_POST['limit']) && intval($_POST['limit']) > 0)?intval($_POST['limit']):5;
$offset = (isset($_POST['offset']) && is_numeric($_POST['offset'])) && intval($_POST['offset']) >= 0?intval($_POST['offset']):0;
try{
    $user = new Masyarakat($_SESSION['username'], $_SESSION['password']);
    echo json_encode([
        "total" => $user->jumlahPengaduan(),
        "hasil" => $user->semuaPengaduan($limit, $offset)
    ], JSON_PRETTY_PRINT);
}catch(userDoesNotExist){
    echo json_encode([
        "status" => false
    ], JSON_PRETTY_PRINT);
}
?>