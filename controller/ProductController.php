<?php

class ProductController {

    private $db;
    private $conn;

    public function __construct() {
        require_once $_SERVER['DOCUMENT_ROOT'] . '/DATT/database.php';
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

}