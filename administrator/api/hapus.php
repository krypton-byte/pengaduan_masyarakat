<?php
session_start();
require '../../modules/models.php';
header('content-type: application/json');
if(!(isset($_SESSION['username']) && isset($_SESSION['password']) && is_numeric($_POST['id']))){
    echo json_encode(['status' => false], JSON_PRETTY_PRINT);
    exit();
}
try{
    $user = new Petugas($_SESSION['username'], $_SESSION['password']);
    echo json_encode(['status' => $user->login(['level'])['level'] === 'petugas'?boolval((new Pengaduan($_POST['id']))->delete()):false]);

}catch (userDoesNotExist){
    echo 'a';
    echo json_encode(['status' => false], JSON_PRETTY_PRINT);
}
?>