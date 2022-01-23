<?php
session_start();
require '../../modules/models.php';
header('content-type: application/json');
if(!(isset($_SESSION['username']) && isset($_SESSION['password']))){
    echo json_encode(['status' => false], JSON_PRETTY_PRINT);
    exit();
}
try{
    $petugas = new Petugas($_SESSION['username'], $_SESSION['password']);
    $response = [
        'pengaduan' => [
            '0' => $petugas->jumlah_pengaduan(Status::zero),
            'proses' => $petugas->jumlah_pengaduan(Status::proses),
            'selesai' => $petugas->jumlah_pengaduan(Status::selesai)
        ],
        'pengguna' => $petugas->jumlah_user(),
    ];
    if(isset($_POST['line'])){
        $chart = array();
        $interv = 7;
        $cdate = new DateTime();
        $cday = intval($cdate->format('d'));
        $cmonth = $cdate->format('m');
        $cyear = $cdate->format('Y');
        while($interv >= 0){
            $cdate_ ="$cyear-$cmonth-".strval($cday-$interv);
            $nextdate =  "$cyear-$cmonth-".strval($cday+1-$interv);
            $val = $petugas->connection->prepare("SELECT COUNT(id) FROM pengaduan WHERE tgl > ? AND tgl < ?");
            $val->bind_param('ss', $cdate_, $nextdate);
            $val->execute();
            array_push($chart, $val->get_result()->fetch_assoc()['COUNT(id)']);
            $interv--;
        }
        $response['chart'] = $chart;
    }
    echo json_encode($response, JSON_PRETTY_PRINT);
    exit();
}catch(userDoesNotExist){
    echo json_encode(['status' => false], JSON_PRETTY_PRINT);
    exit();
}

?>