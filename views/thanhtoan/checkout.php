<div class="checkout-page-wrapper">
    <div class="checkout-header">
        <h1>ĐẶT HÀNG</h1>
    </div>

    <form action="/TNU/checkout/process" method="POST">
    <div class="checkout-container">

        <!-- LEFT -->
        <div class="checkout-info">
            <section class="order-details-section">
            <h3>Thông tin đặt hàng</h3>

            <input type="text" name="name" placeholder="Họ tên" required>
            <div class="error-msg" id="nameError"></div>

            <input type="text" name="phone" placeholder="Số điện thoại" required>
            <div class="error-msg" id="phoneError"></div>

            <input type="text" name="address" placeholder="Địa chỉ" required>
            <div class="error-msg" id="addressError"></div>

                <div class="address-row">
                    <select name="city" required>
                        <option value="">Chọn tỉnh / thành</option>
                        <option value="HCM">TP Hồ Chí Minh</option>
                        <option value="HN">Hà Nội</option>
                    </select>

                    <input type="text" name="zipcode" placeholder="Mã bưu chính">
                </div>

                <textarea name="note" placeholder="Ghi chú đơn hàng"></textarea>
            </section>

            <hr>

            <section class="shipping-section">
                <h3>Phương thức vận chuyển</h3>

                <label class="radio-option">
                    <input type="radio" name="shipping_method" value="standard" checked>
                    <span>Giao hàng tiêu chuẩn</span>
                </label>

                <label class="radio-option">
                    <input type="radio" name="shipping_method" value="express">
                    <span>Giao hàng hỏa tốc (Chỉ nội thành TP Hồ Chí Minh)</span>
                </label>
            </section>

            <hr>

            <section class="payment-section">
                <h3>Phương thức thanh toán</h3>

                <label class="radio-option">
                    <input type="radio" name="payment_method" value="cod" checked>
                    <span>COD (Thanh toán khi nhận hàng)</span><br>
                </label>
                <label class="radio-option">
                    <input type="radio" name="payment_method" value="bank">
                    <span>Thanh toán bằng chuyển khoản</span>
                 </label>
            </section>
        </div>


        <!-- RIGHT -->
        <div class="order-summary">
            <div class="product-list">
                <?php foreach ($items as $p): ?>
                    <div class="product-item">
                        <img src="/TNU/assets/images/<?= $p['DuongDan'] ?>">
                        <div class="item-details">
                            <p class="item-name"><?= $p['TenSanPham'] ?> x <?= $p['SoLuong'] ?></p>
                            <p><?= $p['MauSac'] ?>, <?= $p['KichCo'] ?></p>
                        </div>
                        <div class="item-price"><?= number_format($p['SoLuong'] * $p['DonGia']) ?>VND</div>
                    </div>
                <?php endforeach; ?>
            </div>

            <div class="discount-box">
                <input type="text" placeholder="Mã giảm giá">
                <button type="button" class="apply-btn">Áp dụng</button>
            </div>

            <div class="totals-section">
                <div class="total-row">
                    <span>Tạm tính</span>
                    <span><?= number_format($subtotal) ?>VND</span>
                </div>

                <div class="total-row">
                    <span>Phí vận chuyển</span>
                    <span><?= number_format($shippingFee) ?>VND</span>
                </div>

                <div class="total-row total-amount">
                    <span>Tổng</span>
                    <span><?= number_format($total) ?>VND</span>
                </div>
            </div>

            <button type="submit" class="complete-order-btn">HOÀN TẤT ĐƠN HÀNG</button>
        </div>

    </div> 
    </form>
</div>

<script src="/TNU/assets/js/checkout.js"></script>