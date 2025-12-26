document.addEventListener("DOMContentLoaded", function () {

    const form = document.getElementById("registerForm");

    if (!form) return; // FORM KHÔNG TỒN TẠI → DỪNG JS

    const hoten = document.getElementById("hoten");
    const ngaysinh = document.getElementById("ngaysinh");
    const sdt = document.getElementById("sdt");
    const email = document.getElementById("email");
    const matkhau = document.getElementById("matkhau");

    const eHoten = document.querySelector(".error-hoten");
    const eNgaySinh = document.querySelector(".error-ngaysinh");
    const eSdt = document.querySelector(".error-sdt");
    const eEmail = document.querySelector(".error-email");
    const eMatKhau = document.querySelector(".error-matkhau");

    form.addEventListener("submit", function (e) {

        let valid = true;

        // Họ tên phải có ít nhất 2 ký tự
        if (hoten.value.trim().length < 2) {
            eHoten.textContent = "Họ tên không hợp lệ.";
            valid = false;
        } else eHoten.textContent = "";

        // Ngày sinh phải đúng dạng YYYY-MM-DD
        if (!ngaysinh.value) {
            eNgaySinh.textContent = "Vui lòng chọn ngày sinh.";
            valid = false;
        } else eNgaySinh.textContent = "";

        // Số điện thoại đúng 10 số
        if (!/^[0-9]{10}$/.test(sdt.value.trim())) {
            eSdt.textContent = "Số điện thoại phải có 10 số.";
            valid = false;
        } else eSdt.textContent = "";

        // Email regex chuẩn (CHO PHÉP SỐ)
        const emailRegex = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
        if (!emailRegex.test(email.value.trim())) {
            eEmail.textContent = "Email không hợp lệ.";
            valid = false;
        } else eEmail.textContent = "";

        // Mật khẩu ít nhất 6 ký tự
        if (matkhau.value.trim().length < 6) {
            eMatKhau.textContent = "Mật khẩu phải ít nhất 6 ký tự.";
            valid = false;
        } else eMatKhau.textContent = "";

        // Nếu có lỗi → chặn submit
        if (!valid) {
            e.preventDefault();
        }

    });
});
