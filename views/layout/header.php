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
</head>

<body>


<header class="header-full">
    <div class="header-container">
        
        <!-- LOGO -->
        <div class="logo">
            MIJURAI
        </div>

        <!-- SEARCH BOX -->
        <form class="search-box" method="GET" action="/TNU/search/index">
            <img src="/TNU/assets/images/search_icon.png" class="icon-search">
            <input type="text" name="keyword" placeholder="Tìm kiếm...">
        </form>

        <!-- MENU -->
        <nav class="menu">
            <?php
            require_once $_SERVER['DOCUMENT_ROOT'] . '/TNU/database.php';
            $db = new Database();
            $conn = $db->getConnection();
            ?>
        </nav>

        <!-- CART + USER ICON -->
        <div class="header-right">

            <!-- CART ICON -->
            <img src="/TNU/assets/images/cartbag_icon.png" class="icon-cart" alt="Giỏ hàng">


            <!-- ACCOUNT ICON -->
                    <img src="/TNU/assets/images/avatar_icon.png" class="icon-avatar" alt="Tài khoản">
                    

        </div>

    </div>
</header>

<main class="main-content">
