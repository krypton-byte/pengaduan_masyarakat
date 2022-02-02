<?php
session_start();
$position = $_SESSION['position'];
if($position === 'petugas'){
    unset($_SESSION['username']);
    unset($_SESSION['password']);
    unset($_SESSION['nama']);
    unset($_SESSION['level']);  
}else{
    unset($_SESSION['username_']);
    unset($_SESSION['password_']);
    unset($_SESSION['level_']);  
    unset($_SESSION['nama_']);   
}
header('location: '.($position == 'administrator'?'administrator/':'').'login.php');
?>