<?php
class OrderModel {
    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function createOrder($customerData, $cartItems, $total) {

        $khachHangID = $customerData['KhachHangID'];
        $address = $customerData['address'];  
        $note = $customerData['note'] ?? "";
        $payment = $customerData['payment_method'];

        $sql = "INSERT INTO donhang 
                (KhachHangID, NgayDat, TongTien, TrangThai, DiaChiGiaoHang, GhiChu, PhuongThucThanhToan)
                VALUES (?, NOW(), ?, 'Đang chờ xử lý', ?, ?, ?)";

        $stmt = $this->conn->prepare($sql);

        $stmt->bind_param(
            "idsss",
            $khachHangID,
            $total,
            $address,
            $note,
            $payment
        );

        if (!$stmt->execute()) {
            error_log("Lỗi tạo đơn hàng: " . $stmt->error);
            return false;
        }

        $orderId = $this->conn->insert_id;


        // INSERT CHI TIẾT ĐƠN HÀNG
        $sqlDetail = "INSERT INTO chitietdonhang 
                      (DonHangID, ChiTietSanPhamID, SoLuong, DonGia, ThanhTien)
                      VALUES (?, ?, ?, ?, ?)";

        $stmtDetail = $this->conn->prepare($sqlDetail);

        foreach ($cartItems as $item) {
            $chiTietID = $item['ChiTietSanPhamID'];
            $soLuong = $item['SoLuong'];
            $donGia = $item['DonGia'];
            $thanhTien = $soLuong * $donGia;

            $stmtDetail->bind_param(
                "iiidd",
                $orderId,
                $chiTietID,
                $soLuong,
                $donGia,
                $thanhTien
            );

            if (!$stmtDetail->execute()) {
                error_log("Lỗi tạo chi tiết đơn hàng: " . $stmtDetail->error);
                return false;
            }
        }

        return $orderId;
    }
}
?>