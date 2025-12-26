<?php
require_once dirname(__DIR__) . '/database.php';

class UserModel {

    private $conn;

    public function __construct() {
        $db = new Database();
        $this->conn = $db->getConnection();
    }

public function getUserByEmail($email) {
    $sql = "
        SELECT 
            kh.KhachHangID,
            kh.HoTen,
            kh.Email,
            kh.SoDienThoai,
            tk.NgaySinh,
            tk.MatKhau
        FROM taikhoan tk
        JOIN khachhang kh ON kh.TaiKhoanID = tk.TaiKhoanID
        WHERE tk.Email = ?
        LIMIT 1
    ";

    $stmt = $this->conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();

    return $stmt->get_result()->fetch_assoc();
}


  

}
