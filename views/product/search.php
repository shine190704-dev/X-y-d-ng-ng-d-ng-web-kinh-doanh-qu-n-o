<div class="page-wrapper">

    <div class="all-header">
        <div class="sort-box">
            <span>Sắp xếp theo:</span>
            <select onchange = "window.location.href = window.location.pathname + '?keyword=<?= urlencode($keyword) ?>&sort=' + this.value">
                <option value="default" <?= $sort === 'default' ? 'selected' : '' ?>>Sự liên quan</option>
                <option value="price_asc" <?= $sort === 'price_asc' ? 'selected' : '' ?>>Giá tăng dần</option>
                <option value="price_desc" <?= $sort === 'price_desc' ? 'selected' : '' ?>>Giá giảm dần</option>
            </select>
        </div>
    </div>

    <section class="product-grid">
        <?php if ($products && $products->num_rows > 0): ?>
            <?php foreach ($products as $p): ?>
                <div class="product-card">
                    <img src="/TNU/assets/images/<?= $p['HinhAnhDaiDien'] ?>">
                    <p>
                        <a href="/TNU/product/detail/<?= $p['SanPhamID'] ?>">
                            <?= $p['TenSanPham'] ?>
                        </a><br>
                        <?= number_format($p['GiaSanPham'], 0, ',', '.') ?> VND
                    </p>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p style="text-align:center;">Không có sản phẩm nào</p>
        <?php endif; ?>
    </section>

</div>
