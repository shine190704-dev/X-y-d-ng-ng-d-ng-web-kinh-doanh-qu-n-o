<div class="auth-container">
    <h2 class="auth-title">ĐĂNG KÝ</h2>

<form class="auth-form" id="registerForm" method="POST" action="/TNU/auth/register">

    <div class="input-group">
        <input type="text" name="hoten" placeholder="Họ tên" required>
    </div>

    <div class="input-group">
        <input type="date" name="ngaysinh" required>
    </div>

    <div class="input-group">
        <input type="text" name="sdt" placeholder="Số điện thoại" required>
    </div>

    <div class="input-group">
        <input type="email" name="email" placeholder="Email" required>
    </div>

    <div class="input-group">
        <input type="password" name="matkhau" placeholder="Mật khẩu" required>
    </div>

    <button type="submit" class="auth-btn">ĐĂNG KÝ</button>
    <p class="sub-text ">Bạn đã có tài khoản?<a href="/TNU/auth/login">Đăng nhập ngay</a>
    </p>

</form>

</div>

<script src="/TNU/assets/js/register.js"></script>
