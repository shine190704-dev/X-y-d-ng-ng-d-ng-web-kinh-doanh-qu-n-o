<?php

class ProductController {

    private $db;
    private $conn;

    public function __construct() {
        require_once $_SERVER['DOCUMENT_ROOT'] . '/TNU/database.php';
        $this->db = new Database();
        $this->conn = $this->db->getConnection();
    }

    private function loadView($viewFile, $pageTitle = '', $data = []) {
        global $title;

        $title = $pageTitle ? "$pageTitle - MIJURAI" : "MIJURAI";
        extract($data);

        $base = dirname(__DIR__);
        require $base . "/views/$viewFile.php";
    }

    // TẤT CẢ SẢN PHẨM

    public function all() {

        $sql = "SELECT * FROM sanpham ORDER BY SanPhamID ASC";
        $products = $this->conn->query($sql);

        $this->loadView("product/category", "TẤT CẢ SẢN PHẨM", [
            "tenLoai" => "TẤT CẢ SẢN PHẨM",
            "products" => $products,
            "category_id" => "all"
        ]);
    }

    public function index() {
        $this->all();
    }

 // CHI TIẾT SẢN PHẨM

  // CHI TIẾT SẢN PHẨM

public function detail($id) {

    //LẤY THÔNG TIN SẢN PHẨM
    $stmt = $this->conn->prepare(
        "SELECT * FROM sanpham WHERE SanPhamID = ?"
    );
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $product = $stmt->get_result()->fetch_assoc();

    //LẤY HÌNH ẢNH
    $stmtImg = $this->conn->prepare(
        "SELECT DuongDan, LaHinhDaiDien 
         FROM hinhanhsanpham 
         WHERE SanPhamID = ?"
    );
    $stmtImg->bind_param("i", $id);
    $stmtImg->execute();
    $images = $stmtImg->get_result()->fetch_all(MYSQLI_ASSOC);
    if (empty($images) && !empty($product["HinhAnhDaiDien"])) {
    $images[] = [
        "DuongDan" => $product["HinhAnhDaiDien"],
        "LaHinhDaiDien" => 1
    ];
}


    //LẤY BIẾN THỂ (SIZE + MÀU + TỒN KHO)
    $stmtVar = $this->conn->prepare(
        "SELECT ct.*, IFNULL(k.SoLuongTonKho, 0) AS SoLuongTonKho
         FROM chitietsanpham ct
         LEFT JOIN kho k ON k.ChiTietSanPhamID = ct.ChiTietSanPhamID
         WHERE ct.SanPhamID = ?"
    );
    $stmtVar->bind_param("i", $id);
    $stmtVar->execute();
    $variationsRaw = $stmtVar->get_result()->fetch_all(MYSQLI_ASSOC);
    $variations = array_map(function ($v) {
        $v["MauSac"] = trim($v["MauSac"]);
        $v["KichCo"] = trim($v["KichCo"]);
        return $v;
    }, $variationsRaw);

    $colors = array_values(array_unique(array_column($variations, "MauSac")));
    $sizes  = array_values(array_unique(array_column($variations, "KichCo")));
    $this->loadView("product/detail", $product["TenSanPham"], [
        "product"    => $product,
        "images"     => $images,
        "colors"     => $colors,
        "sizes"      => $sizes,
        "variations" => $variations
    ]);
}
 // DANH MỤC SẢN PHẨM

    public function category($maLoai) {

          if ($maLoai === "all" || $maLoai === "DM00") {
            return $this->all();
        }
        $stmt = $this->conn->prepare(
            "SELECT TenLoai, LoaiSanPhamID 
             FROM loaisanpham 
             WHERE MaLoai = ?"
        );
        $stmt->bind_param("s", $maLoai);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows == 0) {
            echo "<h2>Danh mục không tồn tại!</h2>";
            return;
        }

        $row = $result->fetch_assoc();
        $tenLoai = $row["TenLoai"];
        $loaiID  = $row["LoaiSanPhamID"];


        $stmt2 = $this->conn->prepare(
            "SELECT * FROM sanpham WHERE LoaiSanPhamID = ?"
        );
        $stmt2->bind_param("i", $loaiID);
        $stmt2->execute();
        $products = $stmt2->get_result();

        $this->loadView("product/category", $tenLoai, [
            "tenLoai" => $tenLoai,
            "products" => $products,
            "category_id" => $maLoai
        ]);
    }
}