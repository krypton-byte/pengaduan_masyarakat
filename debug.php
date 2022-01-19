<?php
    require 'modules/models.php';
    $db = new Connection();
    $y = $db->connection->query('SELECT * FROM petugas')->fetch_array(MYSQLI_ASSOC);
    echo $y['nama'];
?>