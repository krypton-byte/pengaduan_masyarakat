<?php
session_start();
require '../modules/imgbb.php';
require '../modules/models.php';
header('content-type: application/json');
if(!(isset($_SESSION['username_']) && isset($_SESSION['password_']))){
    echo json_encode([ "status" => false ], JSON_PRETTY_PRINT);
    exit();
}
if(isset($_POST['isi']) && isset($_POST['id'])){
    $params = [$_POST['isi']];
    if(isset($_FILES['image'])){
        $img = uploadImageFromPath($_FILES['image']['tmp_name']);
        if(!$img) throw new Exception("Error Processing Request", 1);
        array_push($params, $img);
    }
    $pengaduan = new Pengaduan($_POST['id']);
    try{
        if($pengaduan->user()['username'] === $_SESSION['username_'] && $pengaduan->update(...$params)){
            echo json_encode(['status' => true, 'hasil' => ($pengaduan->get(['foto', 'id', 'tgl', 'status', 'isi']))]);
            exit();
        }
    }catch (Exception){
        echo json_encode([ "status" => false ], JSON_PRETTY_PRINT);
        exit();
    }
}
echo json_encode([ "status" => false ], JSON_PRETTY_PRINT);
?>