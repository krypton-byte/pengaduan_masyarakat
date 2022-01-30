<?php
session_start();
require '../../modules/models.php';
header('content-type: json/application');
$level = ['petugas' => 'petugas', 'admin'=> 'admin'];
if(!(isset($_SESSION['username']) && isset($_SESSION['password']) && isset($_POST['nama']) && isset($_POST['telp']) && isset($_POST['level']) && $level[$_POST['level']])){
    echo json_encode(['status' => false], JSON_PRETTY_PRINT);
    exit();
}

$admin = (new Petugas($_SESSION['username'], $_SESSION['password']))->login();
if($admin['level'] === 'admin'){
    try{
        $userbaru = new Petugas($_POST['username'], $_POST['password']);
        echo json_encode($userbaru->daftar($_POST['nama'], $_POST['telp'], $level[$_POST['level']]), JSON_PRETTY_PRINT);
        exit();
    }catch(Exception $e){
        echo json_encode(['status' => false, 'msg' => $e->getMessage()], JSON_PRETTY_PRINT);
        exit();
    }
}
echo json_encode(['status' => false], JSON_PRETTY_PRINT);
exit();
?>