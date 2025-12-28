<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once __DIR__ . '/database.php'; 


spl_autoload_register(function ($class) {
    $paths = [
        __DIR__ . "/controller/$class.php",
        __DIR__ . "/models/$class.php",
    ];

    foreach ($paths as $path) {
        if (file_exists($path)) {
            require_once $path;
            return;
        }
    }
});

// ========================
// HÀM LẤY SỐ LƯỢNG GIỎ HÀNG
// ========================
if (!function_exists('getCartCount')) {
    function getCartCount() {

        if (!isset($_SESSION['KhachHangID'])) return 0;

        require_once __DIR__ . "/models/CartModel.php";
        $cartModel = new CartModel();

        $cart = $cartModel->getCartByUser($_SESSION['KhachHangID']);
        if (!$cart) return 0; //kiêm tra xem có giỏ hàng hay ch

        $items = $cartModel->getItems($cart['GioHangID']);

        $count = 0;
        foreach ($items as $it) {
            $count += $it['SoLuong'];
        }

        return $count;
    }
}
// GET URL
$url = $_GET['url'] ?? '';
$url = rtrim($url, '/');
$segments = ($url === '' || $url === 'index.php')
    ? []
    : explode('/', $url);
// ========================
// HOME PAGE – SHOW FEATURED PRODUCTS
// ======================== 
if (empty($segments)) {

    $db   = new Database();
    $conn = $db->getConnection();

    $sql = "
        SELECT 
            sp.SanPhamID,
            sp.TenSanPham,
            sp.GiaSanPham,
            (
                SELECT DuongDan 
                FROM hinhanhsanpham 
                WHERE SanPhamID = sp.SanPhamID 
                      AND LaHinhDaiDien = 1
                LIMIT 1
            ) AS HinhAnh
        FROM sanpham sp
        LIMIT 20
    ";
    $cartCount = getCartCount();
    $noibat = $conn->query($sql);
    $title  = "Sản phẩm";

    require_once __DIR__ . '/views/layout/header.php';
    ?>

    <section class="banner">
        <img src="/TNU/assets/images/banner.png" alt="Banner">
    </section>

    <div class="page-wrapper">
        <h2 class="section-title">SẢN PHẨM NỔI BẬT</h2>

        <section class="product-grid">
            <?php foreach ($noibat as $sp): ?>
                <div class="product-card">
                    <img src="/TNU/assets/images/<?= $sp['HinhAnh'] ?>" alt="">
                    <p>
                        <a href="/TNU/product/detail/<?= $sp['SanPhamID'] ?>">
                            <?= $sp['TenSanPham'] ?>
                        </a>
                        <br>
                        <?= number_format($sp['GiaSanPham'], 0, ',', '.') ?> VND
                    </p>
                </div>
            <?php endforeach; ?></section>
    </div>

    <?php
    require_once __DIR__ . '/views/layout/footer.php';
    exit;
            }
            // ROUTE AUTH
if ($segments[0] === 'auth') {

    $controller = new AuthController();
    $method = $segments[1] ?? 'login';
      $cartCount = getCartCount();
    $params = array_slice($segments, 2);
    require_once __DIR__ . '/views/layout/header.php';

    call_user_func_array([$controller, $method], $params);
    require_once __DIR__ . '/views/layout/footer.php';
    exit;
}

// ROUTE PRODUCT
if ($segments[0] === 'product') {
    $controller = new ProductController();
    $method = $segments[1] ?? 'all';
    $cartCount = getCartCount();
    require_once __DIR__ . '/views/layout/header.php';
   // DM00 / DM01 / DM02
    if (isset($segments[1]) && preg_match('/^DM[0-9]+$/', $segments[1])) {
        $controller->category($segments[1]);
        require_once __DIR__ . '/views/layout/footer.php';
        exit;
    }
    // detail
    if ($method === 'detail') {
        call_user_func_array([$controller, 'detail'], array_slice($segments, 2));
        require_once __DIR__ . '/views/layout/footer.php';
        exit;
    }

    // all
    call_user_func_array([$controller, $method], array_slice($segments, 2));

    require_once __DIR__ . '/views/layout/footer.php';
    exit;
}

// ROUTE CART

if ($segments[0] === 'cart') {

    $controller = new CartController();
    $method = $segments[1] ?? 'view';
    $params = array_slice($segments, 2);

    // AJAX
    if ($method === 'updateQty') {
        call_user_func_array([$controller, $method], $params);
        exit;
    }

    // add / delete
    if (in_array($method, ['add'])) {
        call_user_func_array([$controller, $method], $params);
        exit;
    }

    $cartCount = getCartCount();
    require_once __DIR__ . '/views/layout/header.php';

    call_user_func_array([$controller, $method], $params);

    require_once __DIR__ . '/views/layout/footer.php';
    exit;
}

// ROUTE CHECKOUT
if ($segments[0] === 'checkout') {

    $controllerName = 'CheckoutController';
    $method = $segments[1] ?? 'index';
    
    // Yêu cầu Controller
    require_once __DIR__ . '/controller/CheckoutController.php';
    $controller = new $controllerName();

    // ĐẶT HÀNG 
    if ($method === 'process') {
        $controller->processOrder(); 
        exit;
    } 
    
    else if($method === 'index') {
        
        $cartCount = getCartCount();
        require_once __DIR__ . '/views/layout/header.php';
        $controller->index();
        require_once __DIR__ . '/views/layout/footer.php';
        exit;       
    }else if($method === 'success') {
        $cartCount = getCartCount();
        require_once __DIR__ . '/views/layout/header.php';
        $controller->success(); 
        require_once __DIR__ . '/views/layout/footer.php';
        exit;
        
    } else {
        http_response_code(404);
        echo "404 - Phương thức '{$method}' trong Checkout không tồn tại.";
        exit;
    }
}

// AUTO CONTROLLER ROUTE
$controllerName = ucfirst($segments[0]) . 'Controller';
$controllerFile = __DIR__ . "/controller/$controllerName.php";

if (file_exists($controllerFile)) {

    $controller = new $controllerName();
    $method     = $segments[1] ?? 'index';
    $params     = array_slice($segments, 2);

   $cartCount = getCartCount();
    require_once __DIR__ . '/views/layout/header.php';

    call_user_func_array([$controller, $method], $params);

    require_once __DIR__ . '/views/layout/footer.php';
    exit;
}


require_once __DIR__ . '/views/layout/footer.php';