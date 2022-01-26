<?php
require 'modules/models.php';
class Migrate extends Connection {
    function __construct(){
        $this->createDB();
        $this->createTable();
        echo "Finish\n";
    }

    function createDB(){
        echo "Creating Database\n";
        $con = new mysqli($this->host, $this->username_mysql, $this->password_mysql);
    }

    function createTable(){
        echo "Restore Table\n";
        system("mysql -h {$this->host} -u {$this->username_mysql} -p {$this->database} < pengaduan.sql");
    }
}
if(php_sapi_name() == 'cli'){
    new Migrate();
}

?>