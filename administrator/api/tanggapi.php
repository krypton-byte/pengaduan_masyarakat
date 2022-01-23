<?php
session_start();
header('content-type: application/json');
require '../../modules/models.php';
if(!(isset($_SESSION['username']) && isset($_SESSION['password']) && isset($_POST['tanggapan']) && isset($_POST['id']))){
    echo json_encode(['status' => false], JSON_PRETTY_PRINT);
    exit();
}
try{
    $petugas = new Petugas($_SESSION['username'], $_SESSION['password']);
    $petugas->tanggapi(intval($_POST['id']), $_POST['tanggapan']);
    echo json_encode((new Pengaduan($_POST['id']))->getfullinfo(), JSON_PRETTY_PRINT);
    exit();
}catch(userDoesNotExist){
    echo json_encode(['status' => false], JSON_PRETTY_PRINT);
    exit();
}
exit();
?>