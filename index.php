

<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once __DIR__ . '/views/layout/header.php'; 
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
  
    $params = array_slice($segments, 2);
    require_once __DIR__ . '/views/layout/header.php';

    call_user_func_array([$controller, $method], $params);
    require_once __DIR__ . '/views/layout/footer.php';
    exit;
}

// AUTO CONTROLLER ROUTE
$controllerName = ucfirst($segments[0]) . 'Controller';
$controllerFile = __DIR__ . "/controller/$controllerName.php";

if (file_exists($controllerFile)) {

    $controller = new $controllerName();
    $method     = $segments[1] ?? 'index';
    $params     = array_slice($segments, 2);


    require_once __DIR__ . '/views/layout/header.php';

    call_user_func_array([$controller, $method], $params);

    require_once __DIR__ . '/views/layout/footer.php';
    exit;
}


require_once __DIR__ . '/views/layout/footer.php';
