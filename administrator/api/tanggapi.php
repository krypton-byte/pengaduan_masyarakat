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
    $infoPetugas = $petugas->login(['id', 'level']);
    if($infoPetugas['level'] === 'admin'){
        echo json_encode(['status' => false], JSON_PRETTY_PRINT);
        exit();
    }
    $pengaduan = new Pengaduan(intval($_POST['id']));
    if($infoPetugas && $pengaduan->tanggapi($_POST['tanggapan'], $infoPetugas['id'])){
        echo json_encode(['status' => true, "data" => $pengaduan->getfullinfo()]);
        exit();
    }
    echo json_encode((new Pengaduan($_POST['id']))->getfullinfo(), JSON_PRETTY_PRINT);
}catch(userDoesNotExist){
    echo json_encode(['status' => false], JSON_PRETTY_PRINT);
    exit();
}
exit();
?>