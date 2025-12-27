<?php
// File: controller/CheckoutController.php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once $_SERVER['DOCUMENT_ROOT'] . '/TNU/database.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/TNU/models/OrderModel.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/TNU/models/CartModel.php'; 

class CheckoutController {
    private $orderModel;
    private $cartModel;
    private $conn;

    public function __construct() {
        $this->cartModel = new CartModel(); 
        $this->conn = $this->cartModel->getConnection(); 
        $this->orderModel = new OrderModel($this->conn); 
    }
    

    private function getCurrentUserID() {
        return $_SESSION['KhachHangID'] ?? 0; 
    }

    // HIỂN THỊ TRANG THANH TOÁN
    public function index() {
        $khachHangID = $this->getCurrentUserID();

        if ($khachHangID === 0) {
            header('Location: /TNU/auth/login?redirect=/TNU/checkout'); 
            return;
        }

        $cart = $this->cartModel->getCartByUser($khachHangID);

        $items = [];
        $subtotal = 0;
        $gioHangID = null;

        if ($cart) {
             $gioHangID = $cart['GioHangID'];
             
             //LẤY DỮ LIỆU GIỎ HÀNG THỰC TẾ
             $itemsResult = $this->cartModel->getItems($gioHangID);
             $items = $itemsResult->fetch_all(MYSQLI_ASSOC);
             
             // TÍNH TOÁN TỔNG TIỀN
             foreach($items as $item) {
                 $subtotal += $item['SoLuong'] * $item['DonGia']; 
             }
        }
        
        $shippingFee = 35000; 
        $total = $subtotal + $shippingFee;

        // Truyền các biến cần thiết sang view
        $data = [
            'items' => $items,
            'subtotal' => $subtotal,
            'shippingFee' => $shippingFee,
            'total' => $total
        ];
        require_once $_SERVER['DOCUMENT_ROOT'] . '/TNU/views/thanhtoan/checkout.php';
    }

    // XỬ LÝ ĐẶT HÀNG 
    public function processOrder() {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: /TNU/checkout'); 
            return;
        }

        $khachHangID = $this->getCurrentUserID();
        if ($khachHangID === 0) {
            header('Location: /TNU/login?error=not_logged_in');
            return;
        }
        
        $cart = $this->cartModel->getCartByUser($khachHangID);

        if (!$cart) {
             header('Location: /TNU/cart/view?error=empty_cart');
             return;
        }
        $gioHangID = $cart['GioHangID'];

        $itemsResult = $this->cartModel->getItems($gioHangID);
        $cartItems = $itemsResult->fetch_all(MYSQLI_ASSOC); 
        
        if (empty($cartItems)) {
             header('Location: //cart/view?error=empty_cart');
             return;
        }

        $subtotal = 0;
        foreach($cartItems as $item) {
            $subtotal += $item['SoLuong'] * $item['DonGia'];
        }
        $shippingFee = 35000.00; 
        $total = $subtotal + $shippingFee;

        //LẤY DỮ LIỆU TỪ FORM 
        $fullAddress = trim($_POST['address'] ?? '') . ', ' . trim($_POST['city'] ?? '');
        $paymentMethod = $_POST['payment_method'] ?? 'cod';
        $customerData = [
            'name' => trim($_POST['name'] ?? ''),
            'phone' => trim($_POST['phone'] ?? ''),
            'address' => $fullAddress, 
            'note' => trim($_POST['note'] ?? ''),
            'payment_method' => $paymentMethod, 
            'KhachHangID' => $khachHangID 
        ];

        // LƯU ĐƠN HÀNG VÀO DB
        $orderId = $this->orderModel->createOrder($customerData, $cartItems, $total);

        if ($orderId) {
            //CẬP NHẬT TRẠNG THÁI GIỎ HÀNG
            $this->cartModel->updateCartStatus($gioHangID, 0); 
            header('Location: /TNU/checkout/success?order_id=' . $orderId);
        } else {
            header('Location: /TNU/checkout?error=db_error');
        }
    }
    
    // HIỂN THỊ TRANG ĐẶT HÀNG THÀNH CÔNG
    public function success() {
        $orderId = $_GET['order_id'] ?? null;
        
        $data = [
            'orderId' => $orderId,
        ];
        require_once $_SERVER['DOCUMENT_ROOT'] . '/TNU/views/thanhtoan/success.php';
    }
}