<?php
session_start();
header('content-type: application/json');
require '../../modules/models.php';
if(!(isset($_SESSION['username']) && isset($_SESSION['password']))){
    echo json_encode(['status' => false], JSON_PRETTY_PRINT);
    exit();
}
$OFFSET = isset($_POST['offset']) && is_numeric($_POST['offset'])?intval($_POST['offset']):0;
$LIMIT = isset($_POST['limit']) && is_numeric($_POST['limit'])?intval($_POST['limit']):5;
try{
    $petugas = new Petugas($_SESSION['username'], $_SESSION['password']);
    echo json_encode(['masyarakat'=>$petugas->masyarakat($LIMIT, $OFFSET), 'total' => $petugas->jumlah_user()], JSON_PRETTY_PRINT);
    exit();
}catch (Exception){
    echo json_encode(['status' => false], JSON_PRETTY_PRINT);
    exit();
}
echo json_encode(['status' => false], JSON_PRETTY_PRINT);
    exit();
?>