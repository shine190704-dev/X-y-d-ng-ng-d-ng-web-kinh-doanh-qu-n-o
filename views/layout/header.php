<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? 'MIJURAI' ?></title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Serif:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        html, body {
            font-family: "Noto Serif", serif !important;
        }
        * {
            font-family: inherit !important;
        }
    </style>
    <link rel="stylesheet" href="/TNU/assets/css/home.css">
    <link rel="stylesheet" href="/TNU/assets/css/auth.css">
    <link rel="stylesheet" href="/TNU/assets/css/account.css">
    <link rel="stylesheet" href="/TNU/assets/css/detail-product.css">
    <link rel="stylesheet" href="/TNU/assets/css/cart.css">
    <link rel="stylesheet" href="/TNU/assets/css/checkout.css">
</head>

<body>

<?php 
if (strpos($_SERVER['REQUEST_URI'], '/checkout') !== false) {
    return;
}
?>

<header class="header-full">
    <div class="header-container">
        
        <!-- LOGO -->
        <div class="logo">
            <a href="/TNU/">MIJURAI</a>
        </div>

        <!-- SEARCH BOX -->
        <form class="search-box" method="GET" action="/TNU/search/index">
            <img src="/TNU/assets/images/search_icon.png" class="icon-search">
            <input type="text" name="keyword" placeholder="Tìm kiếm..." value="<?= htmlspecialchars($_GET['keyword'] ?? '') ?>" required>
        </form>

         <nav class="menu">
            <?php
       $db = new Database();
        $conn = $db->getConnection();

            // Lấy danh mục
            $sql = "SELECT * FROM loaisanpham ORDER BY (MaLoai = 'DM00') DESC, LoaiSanPhamID ASC";
            $categories = $conn->query($sql);

            $currentUrl = $_GET['url'] ?? '';
            ?>

            <?php foreach ($categories as $cate): ?>
                <a href="/TNU/product/<?= $cate['MaLoai'] ?>"
                   class="<?= ($currentUrl === 'product/' . $cate['MaLoai']) ? 'active' : '' ?>">
                    <?= $cate['TenLoai'] ?>
                </a>
            <?php endforeach; ?>
        </nav>


        <!-- CART + USER ICON -->
        <div class="header-right">

            <!-- CART ICON -->
            <a href="/TNU/cart/view" class="cart-icon-wrap">
                <img src="/TNU/assets/images/cartbag_icon.png" class="icon-cart" alt="Giỏ hàng">

                <?php if (!empty($cartCount) && $cartCount > 0): ?>
                    <span class="cart-badge"><?= $cartCount ?></span>
                <?php endif; ?>
            </a>

            <!-- ACCOUNT ICON -->
            <?php if(isset($_SESSION['Email'])): ?>
                <a href="/TNU/auth/account">
                    <img src="/TNU/assets/images/avatar_icon.png" class="icon-avatar" alt="Tài khoản">
                </a>
            <?php else: ?>
                <a href="/TNU/auth/login">
                    <img src="/TNU/assets/images/avatar_icon.png" class="icon-avatar" alt="Đăng nhập">
                </a>
            <?php endif; ?>

        </div>

    </div>
</header>

<main class="main-content">
