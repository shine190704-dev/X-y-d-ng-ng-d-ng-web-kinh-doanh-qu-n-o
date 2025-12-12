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
    public function getProductById($sanphamid) {
        $stmt = $this->conn->prepare(
            "SELECT 
                sp.SanPhamID, 
                sp.TenSanPham, 
                sp.GiaSanPham, 
                sp.HinhAnhDaiDien, 
                sp.MoTa
             FROM sanpham sp
             WHERE sp.SanPhamID = ? AND sp.TrangThai = 1"
        );
        if (!$stmt) die("Lỗi SQL Prepare: " . $this->conn->error);

        $stmt->bind_param("i", $sanphamid);
        $stmt->execute();

        return $stmt->get_result()->fetch_assoc();
    }

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

    // ==============================
    // 3. Lấy biến thể (size, màu, tồn kho)
    // ==============================
    public function getProductDetails($sanphamid) {
        $stmt = $this->conn->prepare(
            "SELECT 
                ChiTietSanPhamID,
                MauSac,
                KichCo,
                Gia,
                SoLuongTon
             FROM chitietsanpham
             WHERE SanPhamID = ?
             ORDER BY MauSac, KichCo"
        );

        $stmt->bind_param("i", $sanphamid);
        $stmt->execute();

        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    }
}
