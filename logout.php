<?php
session_start();
$position = $_SESSION['position'];
session_destroy();
header('location: '.($position == 'administrator'?'administrator/':'').'login.php');
?>