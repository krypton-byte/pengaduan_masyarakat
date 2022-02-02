<?php
session_start();
header('content-type: application/json');
require '../../modules/models.php';
if(!(isset($_SESSION['username']) && isset($_SESSION['password']))){
    echo json_encode(['status' => false], JSON_PRETTY_PRINT);
    exit();
}
try{
    $OFFSET = isset($_POST['offset']) && is_numeric($_POST['offset'])?intval($_POST['offset']):0;
    $STATUS = isset($_POST['status'])?$_POST['status']:Status::null;
    $LIMIT = isset($_POST['limit']) && is_numeric($_POST['limit'])?intval($_POST['limit']):5;
    $petugas = new Petugas($_SESSION['username'], $_SESSION['password']);

    echo json_encode($petugas->login(['level'])['level'] === 'petugas'?$petugas->semua_pengaduan($LIMIT, $OFFSET, $STATUS): ['status' => false], JSON_PRETTY_PRINT);
    exit();
}catch(userDoesNotExist){
    echo json_encode(['status' => false], JSON_PRETTY_PRINT);
    exit();
}
exit();
?>