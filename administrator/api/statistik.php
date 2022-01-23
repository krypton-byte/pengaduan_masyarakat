<?php
require '../../modules/models.php';
header('content-type: application/json');
$admin = new Administrator(1, 2);
$response = [
    'pengaduan' => [
        '0' => $admin->jumlah_pengaduan(Status::zero),
        'proses' => $admin->jumlah_pengaduan(Status::proses),
        'selesai' => $admin->jumlah_pengaduan(Status::selesai)
    ],
    'pengguna' => $admin->jumlah_user(),
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
        $val = $admin->connection->prepare("SELECT COUNT(id) FROM pengaduan WHERE tgl > ? AND tgl < ?");
        $val->bind_param('ss', $cdate_, $nextdate);
        $val->execute();
        array_push($chart, $val->get_result()->fetch_assoc()['COUNT(id)']);
        $interv--;
    }
    $response['chart'] = $chart;
}
echo json_encode($response, JSON_PRETTY_PRINT);
?>