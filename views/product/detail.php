<div class="product-page">

    <div class="gallery">
        <div class="thumb-grid">
            <?php foreach (array_slice($images, 0, 4) as $img): ?>
                <img src="/TNU/assets/images/<?= $img['DuongDan'] ?>" 
                     class="thumb" alt="Image">
            <?php endforeach; ?>
        </div>
    </div>

    <div class="product-info">

        <h2><?= $product['TenSanPham'] ?></h2>

        <p class="price" style="font-size: 22px;">
            Giá: <?= number_format($product['GiaSanPham']) ?> VND
        </p>

        <div class="option-row">
            <div class="option-title-inline">
                <span style="font-size: 25px;">Size:</span>
                <div class="options-inline">
                    <?php foreach ($sizes as $s): ?>
                        <label>
                            <input type="radio" name="size" value="<?= $s ?>">
                            <?= $s ?>
                        </label>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>




        <!-- MÀU SẮC -->
        <div class="option-row">
            <div class="option-title-inline">
                <span style="font-size: 25px;">Màu sắc:</span>
                <div class="options-inline">
                   <?php foreach ($colors as $c): ?>
                        <label>
                            <input type="radio" name="color" value="<?= $c ?>">
                            <?= $c ?>
                        </label>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>

        <!-- BUTTON THÊM VOUCHER -->
        <button class="voucher-btn">Thêm voucher</button>

        <!-- SỐ LƯỢNG -->
        <div class="quantity-row">
            <span class="qty-title">Số lượng:</span>
            <div class="qty-control">
                <button class="qty-btn" data-type="minus">-</button>
                <span class="qty-number">1</span>
                <button class="qty-btn" data-type="plus">+</button>
            </div>
        </div>

        <!-- FORM GIỎ HÀNG -->
        <form action="/TNU/cart/add" method="POST" id="addCartForm">
            <input type="hidden" name="ctspID" id="ctspID">
            <input type="hidden" name="price" value="<?= $product['GiaSanPham'] ?>">
            <input type="hidden" name="qty" id="qtyInput" value="1">

            <button type="submit" class="add-cart">Thêm vào giỏ</button>
        </form>

        <button class="buy-now">Mua ngay</button>

        <?php if (!empty($product['MoTa'])): ?>
            <div class="product-desc">
                <?= nl2br($product['MoTa']) ?>
            </div>
        <?php endif; ?>
    </div>
</div>

<!-- TRUYỀN BIẾN THỂ SANG JS -->
<script>
    window.variations = <?= json_encode($variations, JSON_UNESCAPED_UNICODE) ?>;
</script>


<script src="/TNU/assets/js/detail.js"></script>


