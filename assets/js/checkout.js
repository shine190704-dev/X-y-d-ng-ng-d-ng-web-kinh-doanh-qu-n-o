document.addEventListener("DOMContentLoaded", function () {

    const nameInput = document.querySelector("input[name='name']");
    const phoneInput = document.querySelector("input[name='phone']");
    const addressInput = document.querySelector("input[name='address']");

    const nameError = document.getElementById("nameError");
    const phoneError = document.getElementById("phoneError");
    const addressError = document.getElementById("addressError");

    // Regex tên: chỉ chữ + dấu + khoảng trắng
    const nameRegex = /^[A-Za-zÀ-ỹ\s]+$/;


    nameInput.addEventListener("input", function () {
        const val = nameInput.value.trim();

        if (val === "") {
            nameError.textContent = "Họ tên không được để trống";
            setError(nameInput);
        }
        else if (!nameRegex.test(val)) {
            nameError.textContent = "Tên không được chứa số hoặc ký tự đặc biệt";
            setError(nameInput);
        }
        else {
            nameError.textContent = "";
            setSuccess(nameInput);
        }
    });

    phoneInput.addEventListener("input", function () {
        const val = phoneInput.value.trim();

        if (val === "") {
            phoneError.textContent = "Số điện thoại không được để trống";
            setError(phoneInput);
        }
        else if (!/^[0-9]+$/.test(val)) {
            phoneError.textContent = "Chỉ được nhập số";
            setError(phoneInput);
        }
        else if (val.length !== 10) {
            phoneError.textContent = "Số điện thoại phải đúng 10 số";
            setError(phoneInput);
        }
        else {
            phoneError.textContent = "";
            setSuccess(phoneInput);
        }
    });

    
    addressInput.addEventListener("input", function () {
        if (addressInput.value.trim() === "") {
            addressError.textContent = "Địa chỉ không được để trống";
            setError(addressInput);
        } else {
            addressError.textContent = "";
            setSuccess(addressInput);
        }
    });

    function setError(input) {
        input.classList.add("input-error");
        input.classList.remove("input-success");
    }

    function setSuccess(input) {
        input.classList.remove("input-error");
        input.classList.add("input-success");
    }
});