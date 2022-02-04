<?php
    class Status {
        const zero = '0';
        const proses = 'proses';
        const selesai = 'selesai';
        const null = '';
    }

    class IsNotNumeric extends Exception
    {
        public function __construct(string $message, int $code, Throwable $previous = null) {
            parent::__construct($message, $code, $previous);
        }

        public function __toString(): string
        {
            return __CLASS__.":[{$this->code}]: {$this->message}\n";
        }
    }

    class PenguaduanTelahDitanggapi extends Exception
    {
        public function __construct(string $message, int $code, Throwable $previous = null) {
            parent::__construct($message, $code, $previous);
        }

        public function __toString(): string
        {
            return __CLASS__.":[{$this->code}]: {$this->message}\n";
        }
    }

    class userDoesNotExist extends Exception
    {
        public function __construct(string $message, int $code, Throwable $previous = null) {
            parent::__construct($message, $code, $previous);
        }

        public function __toString(): string
        {
            return __CLASS__.":[{$this->code}]: {$this->message}\n";
        }
    }

    class pengaduanTidakDitemukan extends Exception
    {
        public function __construct(string $message, int $code, Throwable $previous = null) {
            parent::__construct($message, $code, $previous);
        }

        public function __toString(): string
        {
            return __CLASS__.":[{$this->code}]: {$this->message}\n";
        }
    }

    class penggunaTelahTerdaftar extends Exception
    {
        public function __construct(string $message, int $code, Throwable $previous = null) {
            parent::__construct($message, $code, $previous);
        }

        public function __toString(): string
        {
            return __CLASS__.":[{$this->code}]: {$this->message}\n";
        }
    }

    class tanggapanTidakDitemukan extends Exception
    {
        public function __construct(string $message, int $code, Throwable $previous = null) {
            parent::__construct($message, $code, $previous);
        }

        public function __toString(): string
        {
            return __CLASS__.":[{$this->code}]: {$this->message}\n";
        }
    }

    class InvalidImageType extends Exception
    {
        public function __construct(string $message, int $code, Throwable $previous = null) {
            parent::__construct($message, $code, $previous);
        }

        public function __toString(): string
        {
            return __CLASS__.":[{$this->code}]: {$this->message}\n";
        }
    }

    class Connection
    {
        protected string $host = '127.0.0.1';
        protected string $username_mysql = 'root';
        protected string $password_mysql = '';
        protected string $database = 'pengaduan_masyarakat';
        public function __construct()
        {
            $this->connection = new mysqli($this->host, $this->username_mysql, $this->password_mysql, $this->database);
        }

    }

    class Masyarakat extends Connection
    {
        public string $username;
        public string $password;
        public function __construct(string $username, string $password)
        {
            parent::__construct();
            $this->username = $username;
            $this->password = $password;
        }
        public function daftar(string $nama, string $nik, string $telp, string $avatar)
        {
            if(strlen($this->username)<4) throw new Exception("Username Terlalu Pendek", 1);
            if(strlen($this->username)>25) throw new Exception("Username Terlalu Panjang", 1);
            if(strlen($this->password)<6) throw new Exception("Password Terlalu Pendek", 1);
            if(strlen($this->$nik) !== 16 && !is_numeric($nik)) throw new Exception("NIK Tidak Valid", 1);
            if(!is_numeric($telp)) throw new IsNotNumeric("Nomer Telepon tidak valid", 2);
            if(strlen($telp) > 13) throw new IsNotNumeric("Nomer Telepon terlalu panjang", 2);
            $dpluser = $this->connection->prepare("SELECT COUNT(nik) FROM masyarakat WHERE username = ?");
            $dpluser->bind_param('s', $this->username);
            $dpluser->execute();
            if($dpluser->get_result()->fetch_assoc()['COUNT(nik)'] > 0) throw new penggunaTelahTerdaftar("Username telah terdaftar", 3);
            $pass = password_hash($this->password, PASSWORD_BCRYPT);
            $query = $this->connection->prepare("INSERT INTO masyarakat (nik, nama, username, password, telp, avatar) VALUES (?, ?, ?, ?, ?, ?)");
            $query->bind_param('ssssss', $nik, $nama, $this->username, $pass, $telp, $avatar);
            $query->execute();
            if($query->error_list && $query->error_list[0]['errno'] === 1062)
            {
                throw new penggunaTelahTerdaftar('NIK telah terdaftar', 4);
            }
        }

        public function login(array $fields = array("nik","nama","username","telp", "avatar")): array
        {
            $sfield = join(',', $fields);
            $query = $this->connection->prepare("SELECT {$sfield},password FROM masyarakat WHERE username = ?");
            $query->bind_param('s', $this->username);
            $query->execute();
            $result = $query->get_result()->fetch_assoc();
            if($result && password_verify($this->password, $result['password'])){
                return $result;
            }
            throw new userDoesNotExist('user tidak ditemukan', 1);
        }

        public function logout() {

        }

        public function pengaduan(int $id): array
        {
            $query = $this->connection->prepare("SELECT nik,isi,foto,tgl FROM pengaduan WHERE nik = ? AND id = ? ORDER BY id DESC");
            $query->bind_param('si', $this->login(['nik'])['nik'], $id);
            $query->execute();
            return $query->get_result()->fetch_assoc();
        }

        public function buatPengaduan(string $isi, string $foto): array
        {
            $query = $this->connection->prepare("INSERT INTO pengaduan (nik, isi, foto, status) VALUES (?, ?, ?, '0')");
            $query->bind_param('sss', $this->login(["nik"])["nik"], $isi, $foto);
            $query->execute();
            $js = (new Pengaduan($query->insert_id))->get();
            $js['id'] = $query->insert_id;
            return $js;
        }

        public function semuaPengaduan(int $limit = 0, int $offset = 0, string $status = Status::null): array
        {
            $param = $limit?array('sii', $this->login()['nik'], $limit, $offset):array('s', $this->login()['nik']);
            if($status!==Status::null)
            {
                array_push($param, $status);
                $param[0] = 's'.$param[0];
            }
            $queryString = 'SELECT pengaduan.tgl, pengaduan.isi, pengaduan.foto, pengaduan.status, pengaduan.id,tanggapan.tgl as waktu_tanggapan,tanggapan.id as tanggapan_id,pengaduan.isi,tanggapan.tanggapan FROM tanggapan RIGHT JOIN pengaduan ON pengaduan.id = tanggapan.id_pengaduan WHERE nik = ?'.($status !== Status::null? ' AND status = ?':'').' ORDER BY pengaduan.id DESC'.($limit?' LIMIT ? OFFSET ?':'');
            $query = $this->connection->prepare($queryString);
            $query->bind_param(...$param);
            $query->execute();
            return $query->get_result()->fetch_all(MYSQLI_ASSOC);
            
        }

        public function jumlahPengaduan(string $status = Status::null): int
        {
            $query = $this->connection->prepare('SELECT COUNT(nik) FROM pengaduan WHERE nik =?'.($status !== Status::null ?' AND status =?':''));
            $query->bind_param('s'.($status !== Status::null ? 's':''), $this->login(['nik'])['nik'], ...($status !== Status::null ?array($status):array()));
            $query->execute();
            return $query->get_result()->fetch_assoc()['COUNT(nik)'];
        }

        public function __toString(): string
        {
            return "[uname => {$this->username}]";
        }
    }

    class Petugas extends Connection {

        private string $username;
        private string $password;
    
        public function __construct($username, $password)
        {
            parent::__construct();
            $this->username = $username;
            $this->password = $password;
        }

        public function daftar(string $nama, string $telp, string $level = 'admin'): array
        {

            if(strlen($this->username)<4) throw new Exception("Username Terlalu Pendek", 1);
            if(strlen($this->username)>25) throw new Exception("Username Terlalu Panjang", 1);
            if(strlen($this->password)<6) throw new Exception("Password Terlalu Pendek", 1);
            if(!is_numeric($telp)) throw new IsNotNumeric("Nomer Telepon Tidak Valid", 2);
            if(strlen($telp)>13) throw new IsNotNumeric("Nomer Telepon Terlalu Panjang", 2);
            $uname = $this->connection->prepare("SELECT username FROM petugas WHERE username = ?");
            $uname->bind_param('s', $this->username);
            $uname->execute();
            if($uname->get_result()->fetch_assoc()) throw new penggunaTelahTerdaftar('username telah digunakan', 1);
            $pass = password_hash($this->password, PASSWORD_BCRYPT);
            $query = $this->connection->prepare("INSERT INTO petugas (nama, username, password, telp, level) VALUES (?, ?, ?, ?, ?)");
            $query->bind_param('sssss', $nama, $this->username, $pass, $telp, $level);
            $query->execute();
            return $this->get_petugas_by_id($query->insert_id);
        }

        public function get_petugas_by_id(int $id): array | null
        {
            $query = $this->connection->prepare('SELECT id, nama, username, telp, level FROM petugas WHERE id = ?');
            $query->bind_param('i', $id);
            $query->execute();
            return $query->get_result()->fetch_assoc();

        }

        public function login(array $fields = array("nama","username","telp","level")): array
        {
            $sfield = join(',', $fields);
            $query = $this->connection->prepare("SELECT {$sfield},password FROM petugas WHERE username =?");
            $query->bind_param('s', $this->username);
            $query->execute();
            $result = $query->get_result()->fetch_assoc();
            if($result and password_verify($this->password, $result['password']))
            {
                return $result;
            }
            throw new userDoesNotExist('user tidak ditemukan', 1);
        }
        public function edit_petugas(array $data): int
        {
            if(!array_key_exists('id', $data)) throw new Exception('key id tidak di set', 2);
            if($this->login(['level'])['level'] !== 'admin') throw new Exception('Hanya level admin yg bisa menggunakan fitur ini', 2);
            $id = $data['id'];
            if(!is_numeric($id)) throw new Exception('data id bertype number', 2);
            if(array_key_exists('password', $data)){
                $data['password'] = password_hash($data['password'], PASSWORD_BCRYPT);
            }
            if(array_key_exists('level', $data) && !(in_array($data['level'], ['petugas', 'admin']))){
                unset($data['level']);
            }
            $ndata = array();
            $type = '';
            foreach(array('nama','username','password','telp', 'level') as $key){
                if(array_key_exists($key, $data)){
                    $ndata[$key.' = ? '] = $data[$key];
                    $type.='s';
                }
            }
            if(!$ndata) throw new Exception('masukan form input yg akan di set', 2);
            $query = $this->connection->prepare('UPDATE petugas SET '.join(',',array_keys($ndata)).'WHERE id = ?');
            $ndata['id'] = intval($id);
            $query->bind_param($type.'i', ...array_values($ndata));
            $query->execute();
            return $query->affected_rows;

        }

        public function petugas(int $limit=0, int $offset=0, string $level = ''): array
        {
            if($this->login(['level'])['level'] !== 'admin') throw new Exception('Hanya level admin yg bisa menggunakan fitur ini', 2);
            $query = $this->connection->prepare('SELECT id, nama, username, telp, level FROM petugas'.($level?' WHERE level = ?':'').' ORDER BY petugas.nama ASC'.($limit?' LIMIT ? OFFSET ?':''));
            $params=array();
            if($level){
                array_push($params, 's', $level);
            }
            if($limit){
                if($params){
                    $params[0] .= 'ii';
                    array_push($params, $limit, $offset);
                }else{
                    array_push($params, 'ii', $limit, $offset);
                }
            }
            if($params){
                $query->bind_param(...$params);
            }
            $query->execute();
            return $query->get_result()->fetch_all(MYSQLI_ASSOC);
        }

        public function masyarakat(int $limit = 0, int $offset = 0): array
        {
            if(($this->login(['level'])['level'] !== 'admin')) throw new Exception('Hanya level admin yg bisa menggunakan fitur ini', 2);
            $query = $this->connection->prepare('SELECT nama, username, nik, avatar, telp FROM masyarakat ORDER BY masyarakat.nama ASC'.($limit?' LIMIT ? OFFSET ?':''));
            $params=$limit?array('ii', $limit, $offset):array();
            if($params){
                $query->bind_param(...$params);
            }
            $query->execute();
            return $query->get_result()->fetch_all(MYSQLI_ASSOC);
        }

        public function hapus_masyarakat(int $nik): bool
        {
            if(($this->login(['level'])['level'] !== 'admin')) throw new Exception('Hanya level admin yg bisa menggunakan fitur ini', 2);
            $query = $this->connection->prepare('DELETE FROM masyarakat WHERE nik = ?');
            $query->bind_param('i', $nik);
            $query->execute();
            return boolval($query->affected_rows);
        }

        
        public function hapus_petugas(int $id): bool
        {
            $petugas = $this->login(['id', 'level']);
            if($petugas['level'] !== 'admin') throw new Exception('Hanya level admin yg bisa menggunakan fitur ini', 2);
            if($petugas['id'] === $id) throw new Exception('id anda dgn id yg ingin dihapus terdapat kesamaan', 2);
            $query = $this->connection->prepare('DELETE FROM petugas WHERE id = ?');
            $query->bind_param('i', $id);
            $query->execute();
            return boolval($query->affected_rows);
        }

        public function jumlah_user(): int
        {
            $query = $this->connection->prepare('SELECT COUNT(nik) FROM masyarakat');
            $query->execute();
            return $query->get_result()->fetch_assoc()['COUNT(nik)'];
        }

        public function jumlah_petugas(string $filter = ''): int
        {
            $query = $this->connection->prepare('SELECT COUNT(id) FROM petugas'.($filter?' WHERE status = ?':''));
            if($filter){
                $query->bind_param('s', $filter);
            }
            $query->execute();
            return $query->get_result()->fetch_assoc()['COUNT(id)'];
        }
        public function jumlah_pengaduan(string $filter = Status::null): int
        {
            $query = $this->connection->prepare('SELECT COUNT(id) FROM pengaduan'.($filter !== Status::null ?' WHERE status = ?':''));
            if($filter !== Status::null){
                $query->bind_param('s', $filter);
            }
            $query->execute();
            return $query->get_result()->fetch_assoc()['COUNT(id)'];
        }

        public function semua_pengaduan(int $limit = 5, int $offset = 0, string $status = Status::null): array
        {
            $param = $limit?array('ii', $limit, $offset):array();
            if($status!==Status::null)
            {
                if(!$param){
                    array_push($param, 's', $status);
                }else{
                    $param[0] = 's'.$param[0];
                    array_push($param, $param[2]);
                    $param[2] = $param[1];
                    $param[1] = $status;
                }
            }
            $queryString = 'SELECT masyarakat.nik, masyarakat.telp, masyarakat.nama, pengaduan.tgl,pengaduan.isi,pengaduan.foto,pengaduan.status,pengaduan.id,tanggapan.tgl as waktu_tanggapan, masyarakat.avatar, tanggapan.id as tanggapan_id,pengaduan.isi,tanggapan.tanggapan FROM tanggapan RIGHT JOIN pengaduan ON pengaduan.id = tanggapan.id_pengaduan INNER JOIN masyarakat ON masyarakat.nik = pengaduan.nik'.($status!== Status::null?' WHERE  status = ?':'').' ORDER BY pengaduan.id DESC'.($limit?' LIMIT ? OFFSET ?':'');
            $query = $this->connection->prepare($queryString);
            $param && $query->bind_param(...$param);
            $query->execute();
            return $query->get_result()->fetch_all(MYSQLI_ASSOC);
      
        }
        public function __toString(): string
        {
            return "[ {$this->username} ]";
        }

    }

    class Pengaduan extends Connection 
    {
        private int $id_pengaduan;
        public function __construct(int $id_pengaduan)
        {
            parent::__construct();
            $this->id_pengaduan = $id_pengaduan;
            
        }

        public function ubahStatus(string $status = Status::proses): bool
        {
            $query = $this->connection->prepare('UPDATE pengaduan SET status = ? WHERE id = ?');
            $query->bind_param('si', $status, $this->id_pengaduan);
            $query->execute();
            return !$query->errno;
        }

        public function update(string $isi,string $impath=''): int
        {
            $queryString = 'UPDATE pengaduan SET isi = ?'.($impath?', foto = ?':'').' WHERE id = ?';
            $param = array('s', $isi);
            if($impath){
                $url = uploadImageFromPath($impath);
                if(!$url) throw new InvalidImageType('Tipe gambar yg anda masukan tidak valid', 1);
                $param[0] = 's'.$param[0];
                array_push($param, $impath);
            }
            $param[0] = $param[0].'i';
            array_push($param, $this->id_pengaduan);
            $query = $this->connection->prepare($queryString);
            $query->bind_param(...$param);
            $query->execute();
            return $query->affected_rows;
        }

        public function tanggapi(string $tanggapan, int $id_petugas): bool
        {
            $query1= $this->connection->prepare('SELECT COUNT(id) FROM tanggapan WHERE id_pengaduan = ?');
            $query1->bind_param('i', $this->id_pengaduan);
            $query1->execute();
            if($query1->get_result()->fetch_assoc()['COUNT(id)']) throw new PenguaduanTelahDitanggapi('Hanya bisa 1 tanggapan', 1);
            $query = $this->connection->prepare('INSERT INTO tanggapan (id_pengaduan,tanggapan,id_petugas) VALUES (?,?,?)');
            $query->bind_param('isi', $this->id_pengaduan, $tanggapan, $id_petugas);
            $query->execute();
            return $this->ubahStatus();
        }

        public function semua_tanggapan(int $timestamp = 0): array
        {
            $query = $this->connection->prepare('SELECT tgl,tanggapan,id_petugas FROM tanggapan WHERE  id_pengaduan =? AND tgl > ?');
            $query->bind_param('ii', $this->id_pengaduan, $timestamp);
            $query->execute();
            return $query->get_result()->fetch_all(MYSQLI_ASSOC);
        }

        public function get(array $fields = array('tgl', 'nik', 'isi', 'foto', 'status')): array
        {
            $sfield = join(',', $fields);
            $query = $this->connection->prepare("SELECT {$sfield} FROM pengaduan WHERE id =?");
            $query->bind_param('i', $this->id_pengaduan);
            $query->execute();
            $result = $query->get_result()->fetch_assoc();
            if($result) return $result;
            throw new pengaduanTidakDitemukan("id_pengaduan: {$this->id_pengaduan} Tidak ditemukan", $this->id_pengaduan);
        }

        public function getfullinfo(): array
        {
            $query = $this->connection->prepare('SELECT pengaduan.tgl, pengaduan.isi, pengaduan.foto, pengaduan.status, pengaduan.id,tanggapan.tgl as waktu_tanggapan,tanggapan.id as tanggapan_id,pengaduan.isi,tanggapan.tanggapan FROM tanggapan RIGHT JOIN pengaduan ON pengaduan.id = tanggapan.id_pengaduan WHERE pengaduan.id = ?');
            $query->bind_param('s', $this->id_pengaduan);
            $query->execute();
            return $query->get_result()->fetch_assoc();
        }

        public function user(): array
        {
            $query = $this->connection->prepare('SELECT nik,nama,username,telp FROM masyarakat WHERE nik=?');
            $query->bind_param('s', $this->get(['nik'])['nik']);
            $query->execute();
            return $query->get_result()->fetch_assoc();
        }

        public function delete(): int
        {
            $image = $this->connection->prepare('SELECT foto FROM pengaduan WHERE id = ?');
            $image->bind_param('i', $this->id_pengaduan);
            $image->execute();
            $data = $image->get_result()->fetch_assoc();
            if($data) unlink('../gambar-aduan/'.$data['foto']);
            $query = $this->connection->prepare('DELETE FROM pengaduan WHERE id = ?');
            $query->bind_param('i', $this->id_pengaduan);
            $query->execute();
            return $query->affected_rows;
        }
        
        public function __toString(): string
        {
            return "[ PENGADUAN: {$this->id_pengaduan} ]";
        }

    }

?>