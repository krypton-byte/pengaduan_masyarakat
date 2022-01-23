<?php
header('content-type: application/json');
require '../../modules/models.php';
$OFFSET = isset($_POST['offset']) && is_numeric($_POST['offset'])?intval($_POST['offset']):0;
$STATUS = isset($_POST['status'])?$_POST['status']:'';
$LIMIT = isset($_POST['limit']) && is_numeric($_POST['limit'])?intval($_POST['limit']):5;
$o = new Administrator(1, 2);
echo json_encode($o->semua_pengaduan($LIMIT, $OFFSET, $STATUS), JSON_PRETTY_PRINT);
exit();
?>