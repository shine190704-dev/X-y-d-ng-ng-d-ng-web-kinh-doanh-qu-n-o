<?php
// ========================
// ONLY SHOW PRODUCTS – REMOVE ALL FEATURES
// ========================

// AUTOLOAD MODEL + CONTROLLER
spl_autoload_register(function ($class) {
    $paths = [
        __DIR__ . "/controllers/$class.php",
        __DIR__ . "/models/$class.php",
    ];

    foreach ($paths as $path) {
        if (file_exists($path)) {
            require_once $path;
            return;
        }
    }
});

require_once __DIR__ . '/database.php';


// GET URL
$url = $_GET['url'] ?? '';
$url = rtrim($url, '/');
$segments = $url === '' ? [] : explode('/', $url);


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



// ROUTE PRODUCT
if ($segments[0] === 'product') {

    $controller = new ProductController();
    $method = $segments[1] ?? 'all';

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

// ========================
// NOT FOUND
// ========================
http_response_code(404);
echo "404 - Không tìm thấy trang.";
exit;
