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

   
   public function createUser($hoten, $ngaysinh, $sdt, $email, $matkhau, $vaiTro = 1)
{
    $sql = "INSERT INTO taikhoan (HoTen, NgaySinh, VaiTroID, SoDienThoai, Email, MatKhau)
            VALUES (?, ?, ?, ?, ?, ?)";

    $stmt = $this->conn->prepare($sql);
    if (!$stmt) die("Lỗi SQL: " . $this->conn->error);

    $hashed = password_hash($matkhau, PASSWORD_DEFAULT);
    $stmt->bind_param("ssisss", $hoten, $ngaysinh, $vaiTro, $sdt, $email, $hashed);
    $stmt->execute();
    $taiKhoanID = $stmt->insert_id;

    if ($vaiTro == 1) {
        $sql2 = "INSERT INTO khachhang (TaiKhoanID, HoTen, Email, SoDienThoai, DiaChi, NgayTao)
                 VALUES (?, ?, ?, ?, '', NOW())";

        $stmt2 = $this->conn->prepare($sql2);
        $stmt2->bind_param("isss", $taiKhoanID, $hoten, $email, $sdt);
        $stmt2->execute();

    } elseif ($vaiTro == 2) {
        $sql3 = "INSERT INTO nhanvien (TaiKhoanID, HoTen, Email, SoDienThoai, DiaChi, NgayTao)
                 VALUES (?, ?, ?, ?, '', NOW())";

        $stmt3 = $this->conn->prepare($sql3);
        $stmt3->bind_param("isss", $taiKhoanID, $hoten, $email, $sdt);
        $stmt3->execute();
    }

    return true;
}

  

}
