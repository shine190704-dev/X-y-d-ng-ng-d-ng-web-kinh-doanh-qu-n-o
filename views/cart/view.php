<div class="cart-page">
    <div class="cart-container">

        <h2 class="cart-title">Giỏ hàng</h2>

        <?php if (empty($cartItems)): ?>

            <div class="cart-empty">
                <p>Giỏ hàng của bạn đang trống.</p>
                <a href="/TNU/product/all" class="cart-btn">MUA SẮM NGAY</a>
            </div>

        <?php else: ?>

            <?php 
            $total = 0; 
            foreach ($cartItems as $item): 
                $lineTotal = $item['DonGia'] * $item['SoLuong'];
                $total += $lineTotal;
            ?>
            
            <div class="cart-item">

                <div class="cart-left">

                    <img class="cart-img" 
                        src="/TNU/assets/images/<?= $item['DuongDan'] ?>" 
                        alt="product">

                    <div class="item-info">
                        
                        <a href="/TNU/product/detail/<?= $item['ChiTietSanPhamID'] ?>">
                            <?= $item['TenSanPham'] ?>
                        </a>

                        <p><?= number_format($item['DonGia'], 0, ',', '.') ?> VND</p>
                        <p><?= $item['MauSac'] ?></p>
                        <p><?= $item['KichCo'] ?></p>

                        <div class="qty-control"
                            data-id="<?= $item['GioHangChiTietID'] ?>"
                            data-price="<?= $item['DonGia'] ?>">

                            <button class="qty-btn minus">-</button>
                            <span class="qty-number"><?= $item['SoLuong'] ?></span>
                            <button class="qty-btn plus">+</button>

                        </div>

                    </div>
                </div>

                <div class="cart-right">
                    <span class="price">
                        <?= number_format($lineTotal, 0, ',', '.') ?> VND
                    </span>

                    <a class="delete-btn" 
                    href="/TNU/cart/delete/<?= $item['GioHangChiTietID'] ?>">
                    Xóa
                    </a>
                </div>

            </div>

            <?php endforeach; ?>

            <div class="cart-total">
                Tổng tiền: 
                <span><?= number_format($total, 0, ',', '.') ?> VND</span>
            </div>

            <div class="cart-actions">
                <a href="/TNU/checkout" class="cart-btn">THANH TOÁN</a>
            </div>

        <?php endif; ?>

    </div>
</div>

<script src="/TNU/assets/js/cart.js"></script>