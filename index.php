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


// ========================
// PRODUCT DETAIL – NO FUNCTIONS
// ========================

if ($segments[0] === 'product' && ($segments[1] ?? '') === 'detail' && isset($segments[2])) {
    $id = intval($segments[2]);

    $db = new Database();
    $conn = $db->getConnection();

    // Thông tin sản phẩm
    $sql = "
        SELECT sp.*, 
               (SELECT DuongDan FROM hinhanhsanpham 
                WHERE SanPhamID = sp.SanPhamID LIMIT 1) AS HinhAnh
        FROM sanpham sp
        WHERE sp.SanPhamID = $id
    ";
    $product = $conn->query($sql)->fetch_assoc();

    if (!$product) {
        http_response_code(404);
        echo "404 - Sản phẩm không tồn tại";
        exit;
    }

    // Hình ảnh
    $imgSql = "SELECT DuongDan FROM hinhanhsanpham WHERE SanPhamID = $id";
    $images = $conn->query($imgSql)->fetch_all(MYSQLI_ASSOC);

    // Biến thể
    $varSql = "SELECT * FROM chitietsanpham WHERE SanPhamID = $id";
    $variations = $conn->query($varSql)->fetch_all(MYSQLI_ASSOC);
    $colors = array_unique(array_column($variations, "MauSac"));
    $sizes  = array_unique(array_column($variations, "KichCo"));

    $title = "Chi tiết sản phẩm";

    require_once __DIR__ . '/views/layout/header.php';
    require_once __DIR__ . "/views/product/detail.php";
    require_once __DIR__ . '/views/layout/footer.php';
    exit;
}

// ========================
// NOT FOUND
// ========================
http_response_code(404);
echo "404 - Không tìm thấy trang.";
exit;
