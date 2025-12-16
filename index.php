<?php

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

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}



require_once __DIR__ . '/database.php';


// GET URL
$url = $_GET['url'] ?? '';
$url = rtrim($url, '/');
$segments = $url === '' ? [] : explode('/', $url);



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




http_response_code(404);
echo "404 - Không tìm thấy trang.";
exit;
require_once __DIR__ . '/views/layout/header.php';



require_once __DIR__ . '/views/layout/footer.php';
