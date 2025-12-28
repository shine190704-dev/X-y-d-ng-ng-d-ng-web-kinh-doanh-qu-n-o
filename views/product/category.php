<?php  
require_once $_SERVER['DOCUMENT_ROOT'] . '/TNU/database.php';

$db = new Database();
$conn = $db->getConnection();

// Nếu controller chưa truyền $category_id thì mặc định là 'all'
if (!isset($category_id)) {
    $category_id = 'all';
}
$sort = $_GET['sort'] ?? 'default';
$isAll = ($category_id === "all"); // kiểm tra nếu là trang TẤT CẢ
//==============thêm
$orderBy = "ORDER BY SanPhamID ASC";

// Xử lý các lựa chọn sắp xếp
if ($sort === 'price_asc') {
    $orderBy = "ORDER BY GiaSanPham ASC";
} elseif ($sort === 'price_desc') {
    $orderBy = "ORDER BY GiaSanPham DESC";
}
//=========đến đây
// ============================
// CASE 1: TẤT CẢ SẢN PHẨM
// ============================
if ($isAll) {

   $tenLoai = "TẤT CẢ SẢN PHẨM";
    $sql = "SELECT * FROM sanpham $orderBy"; // **CẬP NHẬT DÒNG NÀY**
    $products = $conn->query($sql);

} else {

    // ============================
    // CASE 2: DANH MỤC
    // ============================
    $maLoai = $category_id;

    // Lấy tên loại + ID loại
    $sql = "SELECT TenLoai, LoaiSanPhamID FROM loaisanpham WHERE MaLoai = '$maLoai'";
    $res = $conn->query($sql);

    if ($res->num_rows == 0) {
        echo "<h2>Danh mục không tồn tại!</h2>";
        return;
    }

    $row = $res->fetch_assoc();
    $tenLoai = $row['TenLoai'];
    $loaiID  = $row['LoaiSanPhamID'];

    // Lấy danh sách SP thuộc loại
    $sql = "SELECT * FROM sanpham WHERE LoaiSanPhamID = $loaiID $orderBy"; // **CẬP NHẬT DÒNG NÀY**
    $products = $conn->query($sql);
}
?>

<div class="page-wrapper">

    <div class="all-header">
        <h2 class="all-title"><?= $tenLoai ?></h2>
        <!--sưa đonạ này-->
        
        <!--đến đay-->
    </div>

    <section class="product-grid">
        <?php if ($products && $products->num_rows > 0): ?>
            
            <?php foreach ($products as $p): ?>
                <div class="product-card">
                    <img src="/TNU/assets/images/<?= $p['HinhAnhDaiDien'] ?>">

                    <p style="text-align:left;">
                        <a href="/TNU/product/detail/<?= $p['SanPhamID'] ?>">
                            <?= $p['TenSanPham'] ?>
                        </a>
                        <br>
                        <?= number_format($p['GiaSanPham'], 0, ',', '.') ?> VND
                    </p>
                </div>
            <?php endforeach; ?>

        <?php else: ?>
            <p style="text-align:center; font-size:20px; color:#3A91D7;">
                Không có sản phẩm nào.
            </p>
        <?php endif; ?>
    </section>

</div>

