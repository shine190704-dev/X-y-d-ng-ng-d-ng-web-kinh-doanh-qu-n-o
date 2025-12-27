document.addEventListener("DOMContentLoaded", () => {

    document.querySelectorAll(".qty-control").forEach(control => {

        const minusBtn = control.querySelector(".minus");
        const plusBtn  = control.querySelector(".plus");
        const qtyEl    = control.querySelector(".qty-number");

        const id       = control.dataset.id;
        const price    = parseInt(control.dataset.price);

        const lineTotalEl = control.closest(".cart-item").querySelector(".price");

        // NÚT TRỪ
        minusBtn.addEventListener("click", () => {
            updateQty(id, -1, qtyEl, price, lineTotalEl);
        });

        // NÚT CỘNG
        plusBtn.addEventListener("click", () => {
            updateQty(id, 1, qtyEl, price, lineTotalEl);
        });

    });
});


function updateQty(id, change, qtyEl, price, lineTotalEl) {

    let current = parseInt(qtyEl.textContent);
    let updated = current + change;

    if (updated < 1) return;

    fetch(`/TNU/cart/updateQty/${id}/${updated}`)
        .then(res => res.json())
        .then(data => {

            if (data.status !== "OK") {
                alert("Cập nhật thất bại");
                return;
            }

            // CẬP NHẬT SỐ LƯỢNG HIỂN THỊ
            qtyEl.textContent = updated;

            // CẬP NHẬT TIỀN TRONG MỘT DÒNG
            let newLineTotal = price * updated;
            lineTotalEl.textContent =
                newLineTotal.toLocaleString("vi-VN") + " VND";

            // CẬP NHẬT TỔNG TIỀN TOÀN GIỎ
            updateCartTotal();

            // CẬP NHẬT ICON GIỎ HÀNG TRÊN HEADER
            const cartIcon = document.querySelector(".cart-count");
            if (cartIcon) {
                cartIcon.textContent = data.cartCount;
            }
        })
        .catch(err => {
            console.error("Lỗi:", err);
            alert("Không thể cập nhật giỏ hàng");
    });
}



function updateCartTotal() {

    let total = 0;

    document.querySelectorAll(".cart-item").forEach(item => {
        const priceText = item.querySelector(".price").textContent.replace(" VND", "");
        const money = parseInt(priceText.replace(/\./g, ""));
        total += money;
    });

    document.querySelector(".cart-total span").textContent =
        total.toLocaleString("vi-VN") + " VND";
}