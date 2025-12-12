<?php

class ProductController {

    private $conn;

    public function __construct() {
        require_once __DIR__ . '/../database.php';
        $db = new Database();
        $this->conn = $db->getConnection();
    }


    // ==========================
    // TRANG CHỦ (HIỂN THỊ SẢN PHẨM NỔI BẬT)
    // ==========================
    public function index() {

        $sql = "
            SELECT 
                sp.SanPhamID,
                sp.TenSanPham,
                sp.GiaSanPham,
                (
                    SELECT DuongDan 
                    FROM hinhanhsanpham 
                    WHERE SanPhamID = sp.SanPhamID AND LaHinhDaiDien = 1
                    LIMIT 1
                ) AS HinhAnh
            FROM sanpham sp
            WHERE sp.NoiBat = 1
            LIMIT 20
        ";

        $products = $this->conn->query($sql);

        // Truyền dữ liệu sang view home
        require __DIR__ . '/../views/product/home.php';
    }



    // ==========================
    // TRANG CHI TIẾT SẢN PHẨM
    // ==========================
    public function detail($id) {

        // ------- Lấy thông tin sản phẩm -------
        $stmt = $this->conn->prepare("
            SELECT * FROM sanpham WHERE SanPhamID = ?
        ");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $product = $stmt->get_result()->fetch_assoc();


        // ------- Lấy hình ảnh -------
        $stmtImg = $this->conn->prepare("
            SELECT DuongDan, LaHinhDaiDien
            FROM hinhanhsanpham 
            WHERE SanPhamID = ?
        ");
        $stmtImg->bind_param("i", $id);
        $stmtImg->execute();
        $images = $stmtImg->get_result()->fetch_all(MYSQLI_ASSOC);


        // Nếu ko có hình → gán hình đại diện trong bảng sản phẩm
        if (empty($images) && !empty($product["HinhAnhDaiDien"])) {
            $images[] = [
                "DuongDan" => $product["HinhAnhDaiDien"],
                "LaHinhDaiDien" => 1
            ];
        }


        // ------- Lấy biến thể (size + màu + tồn kho) -------
        $stmtVar = $this->conn->prepare("
            SELECT ct.*, IFNULL(k.SoLuongTonKho, 0) AS SoLuongTonKho
            FROM chitietsanpham ct
            LEFT JOIN kho k ON k.ChiTietSanPhamID = ct.ChiTietSanPhamID
            WHERE ct.SanPhamID = ?
        ");
        $stmtVar->bind_param("i", $id);
        $stmtVar->execute();
        $variationsRaw = $stmtVar->get_result()->fetch_all(MYSQLI_ASSOC);


        // Xử lý sạch dữ liệu
        $variations = array_map(function ($v) {
            $v["MauSac"] = trim($v["MauSac"]);
            $v["KichCo"] = trim($v["KichCo"]);
            return $v;
        }, $variationsRaw);

        // Tách danh sách màu & size
        $colors = array_values(array_unique(array_column($variations, "MauSac")));
        $sizes  = array_values(array_unique(array_column($variations, "KichCo")));


        // ------- Gọi View Chi Tiết -------
        require __DIR__ . '/../views/product/detail.php';
    }
}
