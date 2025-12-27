<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once __DIR__ . "/../models/CartModel.php";

class CartController {

    private $cartModel;

    public function __construct() {
        $this->cartModel = new CartModel();
    }


    //  THÊM SẢN PHẨM VÀO GIỎ
    public function add() {

        if (!isset($_SESSION['KhachHangID'])) {
            header("Location: /TNU/auth/login");
            exit;
        }

        $userId = $_SESSION['KhachHangID'];

        $ctspID = $_POST['ctspID'] ?? null;
        $qty    = $_POST['qty'] ?? 1;
        $price  = $_POST['price'] ?? 0;

        if (!$ctspID) {
            echo "Thiếu dữ liệu sản phẩm.";
            exit;
        }

        $cart = $this->cartModel->getCartByUser($userId);
        $cartID = $cart ? $cart['GioHangID'] : $this->cartModel->createCart($userId);

        $this->cartModel->addItem($cartID, $ctspID, $qty, $price);

        header("Location: /TNU/cart/view");
        exit;
    }

    //  HIỂN THỊ GIỎ HÀNG

    public function view() {

        if (!isset($_SESSION['KhachHangID'])) {
            header("Location: /TNU/auth/login");
            exit;
        }

        $userId = $_SESSION['KhachHangID'];

        $cart = $this->cartModel->getCartByUser($userId);
        $cartID = $cart ? $cart['GioHangID'] : null;

        $cartItems = $cartID ? $this->cartModel->getItems($cartID) : [];

        require __DIR__ . '/../views/cart/view.php';
    }


    public function count() {
    if (!isset($_SESSION['KhachHangID'])) {
        echo 0;
        return;
    }

    $cart = $this->cartModel->getCartByUser($_SESSION['KhachHangID']);
    if (!$cart) {
        echo 0;
        return;
    }

    $items = $this->cartModel->getItems($cart['GioHangID']);

    $count = 0;
    foreach ($items as $it) {
        $count += $it['SoLuong'];
    }

    echo $count;
}

}