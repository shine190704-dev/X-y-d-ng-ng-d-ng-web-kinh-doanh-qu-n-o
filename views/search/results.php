<?php
// views/search/results.php
?>

<div class="search-results-page">
    <div class="page-wrapper">
        <h2 class="section-title">
            <?php if (!empty($keyword)): ?>
                Kết quả tìm kiếm cho: "<?= htmlspecialchars($keyword) ?>"
            <?php else: ?>
                Tìm kiếm sản phẩm
            <?php endif; ?>
        </h2>

        <?php if (!empty($results)): ?>
            <p style="color: #3A91D7; margin-bottom: 20px;">Tìm thấy <?= count($results) ?> sản phẩm</p>
            
            <section class="product-grid">
                <?php foreach ($results as $p): ?>
                    <div class="product-card">
                        <img src="/DATT/assets/images/<?= htmlspecialchars($p['HinhAnhDaiDien'] ?? 'default.jpg') ?>" 
                             alt="<?= htmlspecialchars($p['TenSanPham']) ?>">
                        <p>
                            <a href="/DATT/product/<?= $p['SanPhamID'] ?>">
                                <?= htmlspecialchars($p['TenSanPham']) ?>
                            </a><br>
                            <?= number_format($p['GiaSanPham'], 0, ',', '.') ?> VNĐ
                        </p>
                    </div>
                <?php endforeach; ?>
            </section>
        <?php else: ?>
            <?php if (!empty($keyword)): ?>
                <p style="color: #e74c3c; font-size: 18px; text-align: center; padding: 50px 0;">
                    Không tìm thấy sản phẩm nào với từ khóa: "<?= htmlspecialchars($keyword) ?>"
                </p>
            <?php else: ?>
                <p style="color: #999; font-size: 18px; text-align: center; padding: 50px 0;">
                    Vui lòng nhập từ khóa để tìm kiếm
                </p>
            <?php endif; ?>
        <?php endif; ?>
    </div>
</div>