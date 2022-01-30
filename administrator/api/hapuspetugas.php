<?php
session_start();
header('content-type: application/json');
require '../../modules/models.php';
if(!(isset($_SESSION['username']) && isset($_SESSION['password']) && isset($_POST['id']))){
    echo json_encode(['status' => false], JSON_PRETTY_PRINT);
    exit();
}
try{
    $masyarakat = new Petugas($_SESSION['username'], $_SESSION['password']);
    echo json_encode(['status' => $masyarakat->hapus_petugas(intval($_POST['id']))], JSON_PRETTY_PRINT);
    exit();
}catch (Exception){
    echo json_encode(['status' => false], JSON_PRETTY_PRINT);
    exit();
}
?>