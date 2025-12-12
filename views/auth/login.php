<div class="auth-container">
    <h2 class="auth-title">ĐĂNG NHẬP</h2>
    <form class="auth-form" method="POST" action="/TNU/auth/login">
        <div class="input-group">
            <input type="text" name="email" id="email" placeholder="Email" required>
            <span class="error error-email"></span>
        </div>

        <div class="input-group">
            <input type="password" name="matkhau" id="password" placeholder="Mật khẩu" required>
            <span class="error error-password"></span>
        </div>

        <button type="submit" class="auth-btn">ĐĂNG NHẬP</button>

        <p class="sub-text">
            Chưa có tài khoản? <a href="/TNU/auth/register">Đăng ký ngay</a>
        </p>
    </form>
</div>

<script src="/TNU/assets/js/login.js"></script>
