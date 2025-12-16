<?php
require_once dirname(__DIR__) . '/database.php';

class ProductModel {
    private $conn;

    public function __construct() {
        $db = new Database();
        $this->conn = $db->getConnection();
    }


       public function getAllProducts($onlyActive = true) {
        if ($onlyActive) {
            $sql = "SELECT sp.SanPhamID, sp.TenSanPham, sp.GiaSanPham, sp.HinhAnhDaiDien, ls.TenLoai
                    FROM sanpham sp
                    LEFT JOIN loaisanpham ls ON sp.LoaiSanPhamID = ls.LoaiSanPhamID
                    WHERE sp.TrangThai = 1
                    ORDER BY sp.SanPhamID";
        } else {
            $sql = "SELECT sp.SanPhamID, sp.TenSanPham, sp.GiaSanPham, sp.HinhAnhDaiDien, ls.TenLoai
                    FROM sanpham sp
                    LEFT JOIN loaisanpham ls ON sp.LoaiSanPhamID = ls.LoaiSanPhamID
                    ORDER BY sp.SanPhamID";
        }

        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    }



}