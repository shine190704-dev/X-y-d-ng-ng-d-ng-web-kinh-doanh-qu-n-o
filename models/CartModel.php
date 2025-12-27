<?php
class CartModel {

    private $conn;

    public function __construct() {
        require_once dirname(__DIR__) . "/database.php";
        $db = new Database();
        $this->conn = $db->getConnection();
    }
    public function getConnection() {
        return $this->conn;
    }

    public function getCartByUser($userId) {
        $sql = "SELECT * FROM giohang WHERE KhachHangID = ? AND TrangThai = 0 LIMIT 1";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $userId);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }


    public function createCart($userId) {
        $sql = "INSERT INTO giohang (KhachHangID, TrangThai) 
                VALUES (?, 0)";

        $stmt = $this->conn->prepare($sql);

        if (!$stmt) {
            die("SQL ERROR: " . $this->conn->error);
        }

        $stmt->bind_param("i", $userId);
        $stmt->execute();

        return $this->conn->insert_id;
    }

    // THÊM SẢN PHẨM VÀO GIỎ
    public function addItem($gioHangID, $ctspID, $soLuong, $donGia) {

        // Check nếu SP đã có trong giỏ tăng số lượng
        $sqlCheck = "SELECT * FROM giohangchitiet 
                     WHERE GioHangID = ? AND ChiTietSanPhamID = ?";
        $stmt = $this->conn->prepare($sqlCheck);
        $stmt->bind_param("ii", $gioHangID, $ctspID);
        $stmt->execute();
        $exist = $stmt->get_result()->fetch_assoc();

        if ($exist) {
            $sqlUpdate = "UPDATE giohangchitiet
                          SET SoLuong = SoLuong + ?
                          WHERE GioHangID = ? AND ChiTietSanPhamID = ?";
            $stmt = $this->conn->prepare($sqlUpdate);
            $stmt->bind_param("iii", $soLuong, $gioHangID, $ctspID);
            return $stmt->execute();
        }

        // Nếu chưa có thêm mới
        $sql = "INSERT INTO giohangchitiet (GioHangID, ChiTietSanPhamID, SoLuong, DonGia)
                VALUES (?, ?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("iiid", $gioHangID, $ctspID, $soLuong, $donGia);
        return $stmt->execute();
    }

    // LẤY DANH SÁCH ITEM TRONG GIỎ
    public function getItems($gioHangID) {

        $sql = "
            SELECT 
                ghct.*,
                sp.TenSanPham,
                ctsp.MauSac,
                ctsp.KichCo,
                (
                    SELECT DuongDan
                    FROM hinhanhsanpham 
                    WHERE SanPhamID = sp.SanPhamID
                    ORDER BY LaHinhDaiDien DESC
                    LIMIT 1
                ) AS DuongDan

            FROM giohangchitiet ghct
            JOIN chitietsanpham ctsp ON ghct.ChiTietSanPhamID = ctsp.ChiTietSanPhamID
            JOIN sanpham sp ON ctsp.SanPhamID = sp.SanPhamID
            WHERE ghct.GioHangID = ?
        ";

        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $gioHangID);
        $stmt->execute();
        return $stmt->get_result();
    }


    public function updateQty($id, $qty) {
    $sql = "UPDATE giohangchitiet SET SoLuong = ? WHERE GioHangChiTietID = ?";
    $stmt = $this->conn->prepare($sql);
    $stmt->bind_param("ii", $qty, $id);
    return $stmt->execute();
    }

}
