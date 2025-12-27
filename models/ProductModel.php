<?php
require_once dirname(__DIR__) . '/database.php';

class ProductModel {
    private $conn;

    public function __construct() {
        $db = new Database();
        $this->conn = $db->getConnection();
    }

    // ==============================
    // 1. Lấy sản phẩm theo ID
    // ==============================

    // ==============================
    // 2. Lấy danh sách hình ảnh
    // ==============================
    public function getProductImages($sanphamid) {
        $stmt = $this->conn->prepare(
            "SELECT 
                HinhAnhID, 
                DuongDan, 
                LaHinhDaiDien 
             FROM hinhanhsanpham 
             WHERE SanPhamID = ?
             ORDER BY LaHinhDaiDien DESC"
        );

        $stmt->bind_param("i", $sanphamid);
        $stmt->execute();

        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
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
  // Lấy chi tiết sản phẩm (size, màu, giá, tồn kho)
    public function getProductDetails($sanphamid) {
        $stmt = $this->conn->prepare(
            "SELECT ChiTietSanPhamID, MauSac, KichCo, Gia, SoLuongTon 
             FROM chitietsanpham 
             WHERE SanPhamID = ? 
             ORDER BY MauSac, KichCo"
        );
        $stmt->bind_param("i", $sanphamid);
        $stmt->execute();
        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    }
}

