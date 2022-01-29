<?php
session_start();
require '../../modules/models.php';
header('content-type: application/json');
if(!(isset($_SESSION['username']) && isset($_SESSION['password'])) &&  isset($_POST['id']) && is_numeric($_POST['id'])){
    echo json_encode([ "status" => false ], JSON_PRETTY_PRINT);
    exit();
}
try{
    $id = intval($_POST['id']);
    $info = (new Petugas($_SESSION['username'], $_SESSION['password']))->login();
    if($info['level'] === 'admin'){
        echo json_encode([ "status" => false ], JSON_PRETTY_PRINT);
        exit();
    }
    $pengaduan = new Pengaduan($id);
    $query = $pengaduan->connection->prepare('SELECT COUNT(id) FROM tanggapan WHERE id_pengaduan = ?');
    $query->bind_param('i', $id);
    $query->execute();
    if($query->get_result()->fetch_assoc()['COUNT(id)']){
        echo json_encode(['status' => $pengaduan->ubahStatus('selesai')], JSON_PRETTY_PRINT);
        exit();
    }
    echo json_encode([ "status" => false ], JSON_PRETTY_PRINT);
}catch(userDoesNotExist){
    echo json_encode([ "status" => false ], JSON_PRETTY_PRINT);
}
?>