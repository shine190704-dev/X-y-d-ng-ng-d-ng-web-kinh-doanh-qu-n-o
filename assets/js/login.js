document.addEventListener("DOMContentLoaded", function () {
    const form = document.querySelector(".auth-form");
    const email = document.getElementById("email");
    const password = document.getElementById("password");
    const errorEmail = document.querySelector(".error-email");
    const errorPassword = document.querySelector(".error-password");

    form.addEventListener("submit", function (e) {
        let valid = true;

        // Reset lỗi
        errorEmail.textContent = "";
        errorPassword.textContent = "";

        // Kiểm tra email
        if (email.value.trim() === "") {
            errorEmail.textContent = "Vui lòng nhập email.";
            valid = false;
        } else if (!/^\S+@\S+\.\S+$/.test(email.value.trim())) {
            errorEmail.textContent = "Email không hợp lệ!";
            valid = false;
        }

        // Kiểm tra mật khẩu
        if (password.value.trim() === "") {
            errorPassword.textContent = "Vui lòng nhập mật khẩu.";
            valid = false;
        }

        // Nếu lỗi → chặn submit
        if (!valid) {
            e.preventDefault();
        }
    });
});
