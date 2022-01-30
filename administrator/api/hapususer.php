<?php
session_start();
header('content-type: application/json');
require '../../modules/models.php';
if(!(isset($_SESSION['username']) && isset($_SESSION['password']) && isset($_POST['nik']))){
    echo json_encode(['status' => false], JSON_PRETTY_PRINT);
    exit();
}
try{
    $masyarakat = new Petugas($_SESSION['username'], $_SESSION['password']);
    echo json_encode(['status' => $masyarakat->hapus_masyarakat(intval($_POST['nik']))], JSON_PRETTY_PRINT);
    exit();
}catch (Exception){
    echo json_encode(['status' => false], JSON_PRETTY_PRINT);
    exit();
}
?>