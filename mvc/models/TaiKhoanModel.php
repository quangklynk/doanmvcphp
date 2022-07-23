<?php
class TaiKhoanModel extends Database{

    private $conn;
    private $table = 'taikhoan';

    public $LoaiTK;
    public $MatKhau;
    public $TenTK;
    public $TinhTrang;

    public function __construct()
    {
        $this->conn = $this->connect();
    }

    public function read()
    {
        $query = 'SELECT * FROM ' . $this->table;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        return $stmt;
    }
    
    public function login() {
        // check SDT
        $query = 'SELECT * FROM ' . $this->table . ' WHERE TenTK = ? LIMIT 0,1';
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->TenTK);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if (empty($row['TenTK'])) {
            return false;
        }

        //check MK
        if ($row['MatKhau'] != $this->MatKhau) {
            return false;
        }

        return true;
    }

}
?>