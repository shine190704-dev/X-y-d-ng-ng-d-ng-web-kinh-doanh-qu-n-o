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
    // ==============================
    // 1. Lấy sản phẩm theo ID
    // 1. Lấy sản phẩm theo ID (ĐÃ BỔ SUNG LẤY DANH MỤC)
// ==============================
public function getProductById($sanphamid) {
    $sql = "SELECT 
                sp.SanPhamID,
                sp.TenSanPham, 
                sp.GiaSanPham, 
                sp.HinhAnhDaiDien,
                sp.MoTa,

                -- LẤY DANH MỤC
                ls.LoaiSanPhamID,
                ls.TenLoai,
                ls.MaLoai

            FROM sanpham sp
            LEFT JOIN loaisanpham ls 
                ON sp.LoaiSanPhamID = ls.LoaiSanPhamID
            WHERE sp.SanPhamID = ? 
              AND sp.TrangThai = 1";

    $stmt = $this->conn->prepare($sql);

    if (!$stmt) {
        die("Lỗi SQL Prepare: " . $this->conn->error);
    }

    $stmt->bind_param("i", $sanphamid);
    $stmt->execute();

    return $stmt->get_result()->fetch_assoc();
}


    // ==============================
    // 4. Lấy sản phẩm theo loại
    // ==============================
    public function getProductsByType($loaisanphamid) {
        $stmt = $this->conn->prepare(
            "SELECT sp.SanPhamID, sp.TenSanPham, sp.GiaSanPham, sp.HinhAnhDaiDien, ls.TenLoai
             FROM sanpham sp
             LEFT JOIN loaisanpham ls ON sp.LoaiSanPhamID = ls.LoaiSanPhamID
             WHERE sp.LoaiSanPhamID = ? AND sp.TrangThai = 1
             ORDER BY sp.SanPhamID"
        );
        $stmt->bind_param("i", $loaisanphamid);
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

    // ==============================
    // 5. Tìm kiếm sản phẩm
    // ==============================
    public function searchProducts($keyword)
    {
        $keyword = '%' . $keyword . '%';

        // SORT giống category
        $orderBy = "ORDER BY SanPhamID ASC";

        $sql = "
            SELECT 
                SanPhamID,
                TenSanPham,
                GiaSanPham,
                HinhAnhDaiDien
            FROM sanpham
            WHERE TenSanPham LIKE ?
        ";

        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("s", $keyword);
        $stmt->execute();

        return $stmt->get_result();
    }
}


