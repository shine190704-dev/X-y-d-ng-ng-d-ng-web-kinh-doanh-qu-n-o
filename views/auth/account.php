

<?php
if (!isset($user)) {
    header("Location: /TNU/auth/login");
    exit;
}

$hoten    = $user["HoTen"] ?? "";
$ngaysinh = $user["NgaySinh"] ?? "Chưa cập nhật";
$gmail    = $user["Email"] ?? "";
$sodt     = $user["SoDienThoai"] ?? "Chưa cập nhật";
?>



<div class="account-container">
    <div class="account-left">
        <a href="/TNU/auth/account">Tài khoản</a>
        <a href="/TNU/auth/account" class="active">Thông tin tài khoản</a>
        <a href="/TNU/auth/logout">Đăng xuất</a>
    </div>

    <div class="account-right">
        <h2>TÀI KHOẢN CỦA BẠN</h2>
        <hr>
        <div class="info-row"><span>Họ tên:</span>     <p><?= htmlspecialchars($hoten) ?></p></div>
        <div class="info-row"><span>Ngày sinh:</span>  <p><?= htmlspecialchars($ngaysinh) ?></p></div>
        <div class="info-row"><span>Gmail:</span>      <p><?= htmlspecialchars($gmail) ?></p></div>
        <div class="info-row"><span>Số điện thoại:</span><p><?= htmlspecialchars($sodt) ?></p></div>
    </div>
</div>

