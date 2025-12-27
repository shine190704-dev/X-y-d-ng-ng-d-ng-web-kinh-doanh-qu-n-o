document.addEventListener("DOMContentLoaded", () => {

    const variations = window.variations || [];  
    let selectedSize = null;
    let selectedColor = null;

    const ctspInput = document.querySelector("#ctspID");
    const qtyInput = document.querySelector("#qtyInput");

    // ================================
    // 2. BẮT SỰ KIỆN CHỌN SIZE
    // ================================
    document.querySelectorAll("input[name='size']").forEach(size => {
        size.addEventListener("change", () => {
            selectedSize = size.value.trim();   // ← ★ SỬA Ở ĐÂY
            console.log("Size chọn:", selectedSize);
            findVariation();
        });
    });

    // ================================
    // 3. BẮT SỰ KIỆN CHỌN MÀU
    // ================================
    document.querySelectorAll("input[name='color']").forEach(color => {
        color.addEventListener("change", () => {
            selectedColor = color.value.trim();   // ← ★ SỬA Ở ĐÂY
            console.log("Màu chọn:", selectedColor);
            findVariation();
        });
    });

    // ================================
    // 4. HÀM TÌM BIẾN THỂ ĐÚNG
    // ================================
    function findVariation() {

        if (!selectedSize || !selectedColor) return;

        console.log("Tìm biến thể với:", selectedSize, selectedColor);

        const found = variations.find(v =>
            v.KichCo.trim() === selectedSize &&
            v.MauSac.trim() === selectedColor
        );

        if (found) {
            ctspInput.value = found.ChiTietSanPhamID;
            console.log("→ Đã chọn biến thể:", found);
        } else {
            ctspInput.value = "";
            console.warn("❌ Không tìm thấy biến thể phù hợp!");
        }
    }

    // ================================
    // 5. TĂNG GIẢM SỐ LƯỢNG
    // ================================
    let quantity = 1;
    const qtyNumber = document.querySelector(".qty-number");

    document.querySelectorAll(".qty-btn").forEach(btn => {
        btn.addEventListener("click", () => {

            if (btn.dataset.type === "minus" && quantity > 1) {
                quantity++;
            }

            if (btn.dataset.type === "plus") {
                quantity++;
            }

            qtyNumber.textContent = quantity;
            qtyInput.value = quantity;
        });
    });

    // ================================
    // 6. VALIDATE KHI THÊM VÀO GIỎ
    // ================================
    document.querySelector("#addCartForm").addEventListener("submit", (e) => {

        if (!selectedSize || !selectedColor) {
            alert("Vui lòng chọn đầy đủ Size và Màu sắc!");
            e.preventDefault();
            return;
        }

        if (!ctspInput.value) {
            alert("Không tìm thấy biến thể sản phẩm hợp lệ!");
            e.preventDefault();
        }
    });

});