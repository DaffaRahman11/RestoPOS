// ==========================
// Variabel global
// ==========================
const baseUrl = window.location.origin;
const addedProductIds = new Set();
const productStocks = {};
let alertCounter = 0;

// ==========================
// Fungsi Alert / Toast
// ==========================

  const alerts = {
    success: {
      title: "Success!",
      message: "Operation completed successfully.",
      bgColor: "bg-green-50",
      borderColor: "border-green-200",
      iconBg: "bg-green-500",
      icon: "fas fa-check",
      textColor: "text-green-800",
      messageColor: "text-green-700",
      closeColor: "text-green-600 hover:text-green-800",
    },
    error: {
      title: "Error!",
      message: "Something went wrong. Please try again.",
      bgColor: "bg-red-50",
      borderColor: "border-red-200",
      iconBg: "bg-red-500",
      icon: "fas fa-times",
      textColor: "text-red-800",
      messageColor: "text-red-700",
      closeColor: "text-red-600 hover:text-red-800",
    },
    warning: {
      title: "Warning!",
      message: "Please review your settings before proceeding.",
      bgColor: "bg-yellow-50",
      borderColor: "border-yellow-200",
      iconBg: "bg-yellow-500",
      icon: "fas fa-exclamation",
      textColor: "text-yellow-800",
      messageColor: "text-yellow-700",
      closeColor: "text-yellow-600 hover:text-yellow-800",
    },
    info: {
      title: "Information",
      message: "Here is some useful information for you.",
      bgColor: "bg-blue-50",
      borderColor: "border-blue-200",
      iconBg: "bg-blue-500",
      icon: "fas fa-info",
      textColor: "text-blue-800",
      messageColor: "text-blue-700",
      closeColor: "text-blue-600 hover:text-blue-800",
    },
  };

function showToastCustom({
    title = "Error",
    message = "",
    bgColor = "bg-red-500",
    borderColor = "border-red-700",
    iconBg = "bg-red-700",
    icon = "fas fa-exclamation",
    textColor = "text-white",
    messageColor = "text-white",
    closeColor = "text-white"
} = {}) {
    const container = document.getElementById("alert-container");
    if (!container) return;

    alertCounter++;
    const alertId = `alert-${alertCounter}`;

    const alertElement = document.createElement("div");
    alertElement.id = alertId;
    alertElement.className = `alert-item ${bgColor} ${borderColor} border rounded-xl p-4 shadow-lg mb-2 animate-slide-in-out`;

    alertElement.innerHTML = `
        <div class="flex items-start">
            <div class="w-6 h-6 ${iconBg} rounded-full flex items-center justify-center text-white mr-3 mt-0.5 flex-shrink-0">
                <i class="${icon} text-xs"></i>
            </div>
            <div class="flex-1 min-w-0">
                <h4 class="font-semibold ${textColor} mb-1">${title}</h4>
                <p class="text-sm ${messageColor}">${message}</p>
            </div>
            <button onclick="removeTopRightAlert('${alertId}')" class="${closeColor} ml-3 flex-shrink-0">
                <i class="fas fa-times"></i>
            </button>
        </div>
    `;

    container.appendChild(alertElement);

    setTimeout(() => removeTopRightAlert(alertId), 5000);
}

function removeTopRightAlert(id) {
    const el = document.getElementById(id);
    if (el) el.remove();
}

// ==========================
// Fungsi untuk load produk
// ==========================
async function fetchMenus() {
    try {
        const res = await fetch(`${baseUrl}/api/menus/getData`);
        const json = await res.json();
        if (!json.success) return [];
        return json.data;
    } catch (error) {
        console.error("Error fetching menus:", error);
        return [];
    }
}


function renderMenuRow(menu) {
    const row = document.createElement("tr");
    row.className = "hover:bg-green-50 transition-all duration-200";

    // disable jika max_portion <= 0
    if (menu.max_portion <= 0) {
        row.classList.add("opacity-50", "pointer-events-none", "bg-gray-100");
    }

    row.innerHTML = `
        <td class="px-3 lg:px-6 py-3 text-xs lg:text-sm font-medium text-gray-800">${menu.name}</td>
        <td class="px-3 lg:px-6 py-3 text-xs lg:text-sm font-semibold text-green-700">Rp${Number(menu.price).toLocaleString("id-ID")}</td>
        <td class="px-3 lg:px-6 py-3 text-xs lg:text-sm text-gray-600">
            <span>${menu.max_portion}</span>
        </td>
        <td class="px-3 lg:px-6 py-3 text-center">
            <button data-id="${menu.id}" class="add-to-cart px-3 py-2 text-white text-xs font-semibold rounded-lg transition-all duration-200 bg-emerald-500 hover:bg-emerald-600">Tambah</button>
        </td>
    `;

    // simpan data di dataset
    row.dataset.id = menu.id;
    row.dataset.name = menu.name;
    row.dataset.price = menu.price;
    row.dataset.maxPortion = menu.max_portion;

    return row;
}

async function loadMenus() {
    const tableBody = document.getElementById("products-table-body");
    const menus = await fetchMenus();

    menus.forEach(menu => {
        // simpan max_portion di productStocks
        productStocks[menu.id] = menu.max_portion;

        let row = tableBody.querySelector(`tr[data-id="${menu.id}"]`);

        if (row) {
            // update harga
            row.querySelector("td:nth-child(2)").textContent = "Rp" + Number(menu.price).toLocaleString("id-ID");
            row.dataset.price = menu.price;
            row.dataset.maxPortion = menu.max_portion;

            // jika menu sudah ada di checkout, disable tr
            if (addedProductIds.has(menu.id) || menu.max_portion <= 0) {
                row.classList.add("opacity-50", "pointer-events-none", "bg-gray-100");
            } else {
                row.classList.remove("opacity-50", "pointer-events-none", "bg-gray-100");
            }

            // update sisa porsi dari productStocks dikurangi checkout qty
            const checkoutQty = getCheckoutQuantity(menu.id);
            const remaining = productStocks[menu.id] - checkoutQty;
            row.querySelector("span").textContent = remaining >= 0 ? remaining : 0;

        } else {
            row = renderMenuRow(menu);
            tableBody.appendChild(row);
        }
    });

    updateCheckoutItems();
}



// ==========================
// Fungsi Checkout
// ==========================
function updateCheckoutItems() {
    const checkoutList = document.getElementById("checkout-items-list");

    checkoutList.querySelectorAll(".checkout-item").forEach(itemCard => {
        const id = itemCard.dataset.id;
        const tr = document.querySelector(`button.add-to-cart[data-id="${id}"]`)?.closest("tr");
        if (!tr) return;

        const basePrice = parseInt(tr.dataset.price);
        const quantityInput = itemCard.querySelector(".quantity-input");
        const priceDisplay = itemCard.querySelector(".price-display");

        let qty = parseInt(quantityInput.value) || 0;

        // jangan biarkan qty melebihi stok aktual
        const maxStock = productStocks[id];
        if (qty > maxStock) qty = maxStock;
        quantityInput.value = qty;

        // update harga
        priceDisplay.textContent = "Rp" + (basePrice * qty).toLocaleString("id-ID");

        // update sisa porsi di tabel
        const remaining = maxStock - qty;
        tr.querySelector("span").textContent = remaining >= 0 ? remaining : 0;

        // disable tr kalau habis
        if (remaining <= 0) {
            tr.classList.add("opacity-50", "pointer-events-none", "bg-gray-100");
        } else {
            if (!addedProductIds.has(id)) {
                tr.classList.remove("opacity-50", "pointer-events-none", "bg-gray-100");
            }
        }
    });
}


function updateCheckoutItems() {
    const checkoutList = document.getElementById("checkout-items-list");

    checkoutList.querySelectorAll(".checkout-item").forEach(itemCard => {
        const id = itemCard.dataset.id;
        const tr = document.querySelector(`button.add-to-cart[data-id="${id}"]`)?.closest("tr");
        if (!tr) return;

        const basePrice = parseInt(tr.dataset.price);
        const quantityInput = itemCard.querySelector(".quantity-input");
        const priceDisplay = itemCard.querySelector(".price-display");

        quantityInput.max = productStocks[id];

        let qty = parseInt(quantityInput.value) || 0;
        const oldQty = qty;

        // kalau stok berubah jadi lebih kecil dari quantity sekarang
        if (qty > productStocks[id]) {
            qty = productStocks[id];
            showToastCustom({
                title: "Stok Berubah",
                message: `Stok produk ini turun menjadi ${productStocks[id]}. Quantity kamu disesuaikan.`,
                bgColor: "bg-yellow-50",
                borderColor: "border-yellow-200",
                iconBg: "bg-yellow-500",
                icon: "fas fa-exclamation-triangle",
                textColor : "text-yellow-800",
                messageColor : "text-yellow-700",
                closeColor : "text-yellow-600 hover:text-yellow-800"
            });
        }

        quantityInput.value = qty;
        const total = basePrice * qty;
        priceDisplay.textContent = "Rp" + total.toLocaleString("id-ID");

        // update stok yang tersisa di tabel produk
        tr.querySelector("span").textContent = productStocks[id] - qty;
    });
}


function addItemToCheckout(tr, id, name, priceText) {
    const checkoutList = document.getElementById("checkout-items-list");
    const checkoutContainer = document.getElementById("checkout-items-container");
    const emptyCheckout = document.getElementById("empty-checkout");
    const maxStock = productStocks[id];

    addedProductIds.add(id);
    tr.classList.add("opacity-50", "pointer-events-none", "bg-gray-100");

    checkoutContainer.classList.remove("hidden");
    emptyCheckout.classList.add("hidden");

    const itemCard = document.createElement("div");
    itemCard.className = "checkout-item bg-gray-50 rounded-xl p-3 border border-gray-200 shadow-sm";
    itemCard.dataset.id = id;

    itemCard.innerHTML = `
        <div class="flex items-center justify-between mb-2">
            <span class="font-medium text-gray-800 text-sm">${name}</span>
            <button class="remove-item text-red-500 hover:text-red-700 hover:bg-red-100 rounded-lg w-7 h-7 flex items-center justify-center transition-all duration-200 group">
                <i class="fas fa-trash text-xs group-hover:scale-110 transition-transform"></i>
            </button>
        </div>
        <div class="flex items-center justify-between">
            <div class="flex items-center space-x-2">
                <button class="decrease w-7 h-7 bg-emerald-200 hover:bg-emerald-300 rounded-lg text-xs font-bold text-emerald-700">-</button>
                <input type="number" value="1" min="1" max="${maxStock}" class="quantity-input w-12 h-7 text-center font-medium border border-gray-300 rounded-lg text-xs">
                <button class="increase w-7 h-7 bg-emerald-200 hover:bg-emerald-300 rounded-lg text-xs font-bold text-emerald-700">+</button>
            </div>
            <span class="price-display font-semibold text-emerald-700 text-sm" data-price="${priceText}">
                Rp${Number(priceText).toLocaleString("id-ID")}
            </span>
        </div>
    `;

    checkoutList.appendChild(itemCard);

    // update sisa porsi di tabel setelah card dibuat
    tr.querySelector("span").textContent = maxStock - 1;

    setupCheckoutItemEvents(itemCard, tr, id);
    updateTotalAmount();
    syncCheckoutDataToForm();
}



// Setup event untuk quantity & remove
function setupCheckoutItemEvents(itemCard, tr, id) {
    const quantityInput = itemCard.querySelector(".quantity-input");
    const priceDisplay = itemCard.querySelector(".price-display");
    const btnDecrease = itemCard.querySelector(".decrease");
    const btnIncrease = itemCard.querySelector(".increase");

    const updatePriceAndStock = () => {
        let qty = parseInt(quantityInput.value) || 0;
        const maxStock = productStocks[id];

        if (qty > maxStock) {
            qty = maxStock;
            showToastCustom({
                title: "Quantity Terlalu Banyak",
                message: `Stok terbaru hanya ${maxStock}, quantity kamu disesuaikan.`,
                bgColor: "bg-red-50",
                borderColor: "border-red-200",
                iconBg: "bg-red-500",
                icon: "fas fa-times",
                textColor : "text-red-800",
                messageColor : "text-red-700",
                closeColor : "text-red-600 hover:text-red-800"
            });
        }

        quantityInput.value = qty;
        const basePrice = parseInt(priceDisplay.dataset.price);
        priceDisplay.textContent = "Rp" + (basePrice * qty).toLocaleString("id-ID");
        tr.querySelector("span").textContent = productStocks[id] - qty;
        updateTotalAmount();
    };

    // 🔹 Event tombol +
    btnIncrease.addEventListener("click", () => {
        let qty = parseInt(quantityInput.value) || 0;
        const maxStock = productStocks[id];
        if (qty < maxStock) {
            qty++;
            quantityInput.value = qty;
            updatePriceAndStock();
        } else {
            showToastCustom({
                title: "Stok Habis",
                message: "Tidak bisa menambah lagi, stok sudah habis.",
                bgColor: "bg-yellow-50",
                borderColor: "border-yellow-200",
                iconBg: "bg-yellow-500",
                icon: "fas fa-exclamation-triangle",
                textColor : "text-yellow-800",
                messageColor : "text-yellow-700",
                closeColor : "text-yellow-600 hover:text-yellow-800"
            });
        }
    });

    // 🔹 Event tombol -
    btnDecrease.addEventListener("click", () => {
        let qty = parseInt(quantityInput.value) || 0;
        if (qty > 0) {
            qty--;
            quantityInput.value = qty;
            updatePriceAndStock();
        }
    });

    // 🔹 Event input manual
    quantityInput.addEventListener("input", updatePriceAndStock);

    // 🔹 Enter key → kembali fokus ke search
    quantityInput.addEventListener("keydown", e => {
        if (e.key === "Enter") {
            e.preventDefault();
            const searchInput = document.getElementById("search-input");
            if (searchInput) {
                searchInput.focus();
                searchInput.select();
            }
        }
    });

    // 🔹 Tombol hapus
    itemCard.querySelector(".remove-item").addEventListener("click", () => {
        itemCard.remove();
        updateTotalAmount();
        addedProductIds.delete(id);

        tr.classList.remove("opacity-50", "pointer-events-none", "bg-gray-100");
        tr.querySelector("span").textContent = productStocks[id];

        const checkoutContainer = document.getElementById("checkout-items-container");
        const emptyCheckout = document.getElementById("empty-checkout");
        if (document.getElementById("checkout-items-list").children.length === 0) {
            checkoutContainer.classList.add("hidden");
            emptyCheckout.classList.remove("hidden");
        }
    syncCheckoutDataToForm();
    });
}




// ==========================
// Hitung total keseluruhan checkout
// ==========================

function updateTotalAmount() {
    const totalElement = document.getElementById("total-amount");
    if (!totalElement) return;

    let total = 0;
    const checkoutItems = document.querySelectorAll(".checkout-item");

    checkoutItems.forEach(itemCard => {
        const priceDisplay = itemCard.querySelector(".price-display");
        const basePrice = parseInt(priceDisplay.dataset.price);
        const qtyInput = itemCard.querySelector(".quantity-input");
        const qty = parseInt(qtyInput.value) || 0;
        total += basePrice * qty;
    });

    totalElement.textContent = "Rp" + total.toLocaleString("id-ID");

    // 🔹 kalau tidak ada item di checkout → reset semua input pembayaran
    const amountPaidInput = document.getElementById("amount-paid");
    const changeElement = document.getElementById("change-amount");
    const payButton = document.getElementById("pay-button");

    if (checkoutItems.length === 0) {
        if (amountPaidInput) amountPaidInput.value = "";
        if (changeElement) changeElement.textContent = "Rp0";
        if (payButton) payButton.disabled = true;
        return;
    }

    // 🔹 kalau masih ada item → lanjut hitung kembalian
    updateChange();
    syncCheckoutDataToForm();
}

function formatCurrencyInput(input) {
    let value = input.value.replace(/[^0-9]/g, "");
    if (value === "") {
        input.value = "";
        updateChange();
        return;
    }
    input.value = parseInt(value).toLocaleString("id-ID");
    updateChange();
}

function isNumberKey(evt) {
    const charCode = evt.which ? evt.which : evt.keyCode;
    if (charCode > 31 && (charCode < 48 || charCode > 57)) return false;
    return true;
}

function updateChange() {
    const totalText = document.getElementById("total-amount").textContent.replace(/[^\d]/g, "");
    const paidText = document.getElementById("amount-paid").value.replace(/[^\d]/g, "");

    const total = parseInt(totalText) || 0;
    const paid = parseInt(paidText) || 0;
    const change = paid - total;

    const changeElement = document.getElementById("change-amount");
    const payButton = document.getElementById("pay-button");

    // 🔹 kalau total 0 → reset semua field
    if (total === 0) {
        changeElement.textContent = "Rp0";
        payButton.disabled = true;
        return;
    }

    // 🔹 tampilkan kembalian
    changeElement.textContent = "Rp" + (change >= 0 ? change.toLocaleString("id-ID") : "0");

    // 🔹 aktif/nonaktifkan tombol bayar
    payButton.disabled = change < 0;
    syncCheckoutDataToForm();
}

function syncCheckoutDataToForm() {
    const itemsInput = document.getElementById("items-data");
    const totalInput = document.getElementById("total-data");
    const paidInput = document.getElementById("amount-paid-data");
    const changeInput = document.getElementById("change-data");

    if (!itemsInput || !totalInput || !paidInput || !changeInput) return;

    // 🔹 Ambil semua item checkout
    const checkoutItems = Array.from(document.querySelectorAll(".checkout-item")).map(item => {
        const id = item.dataset.id;
        const qty = parseInt(item.querySelector(".quantity-input").value) || 0;
        return { id, qty };
    });

    // 🔹 Ambil nilai total, bayar, kembalian
    const totalText = document.getElementById("total-amount")?.textContent.replace(/[^\d]/g, "") || "0";
    const paidText = document.getElementById("amount-paid")?.value.replace(/[^\d]/g, "") || "0";
    const changeText = document.getElementById("change-amount")?.textContent.replace(/[^\d]/g, "") || "0";

    // 🔹 Masukkan ke input hidden
    itemsInput.value = JSON.stringify(checkoutItems);
    totalInput.value = totalText;
    paidInput.value = paidText;
    changeInput.value = changeText;
}

function selectPayment(value, label) {
  const selectedText = document.getElementById("payment-selected");
  const hiddenInput = document.getElementById("payment-method");
  const dropdown = document.getElementById("payment-dropdown");
  const menu = dropdown.querySelector(".custom-dropdown-menu");

  // update tampilan & nilai
  selectedText.textContent = label;
  hiddenInput.value = value;

  // tutup dropdown
  menu.classList.add("hidden");
}


// ==========================
// Inisialisasi halaman (perbaikan)
// ==========================
document.addEventListener("DOMContentLoaded", () => {

    const isTransactionPage = document.body.id === "page-transaction";
    if (!isTransactionPage) return;

    const searchInput = document.getElementById("search-input");
    const tableBody = document.getElementById("products-table-body");
    const amountPaidInput = document.getElementById("amount-paid");
    const changeAmountEl = document.getElementById("change-amount");
    const payButton = document.getElementById("pay-button");
    const clearBtn = document.getElementById("clear-search");


    

    // auto fokus ke search
    if (searchInput) {
        searchInput.focus();
    }

     if (amountPaidInput) {
        amountPaidInput.addEventListener("input", updateChange);
    }

    // cegah form submit global bila ada form pembungkus
    const nearestForm = document.querySelector("form");
    if (nearestForm) {

        nearestForm.addEventListener("keydown", (e) => {
            if (e.key === "Enter") e.preventDefault();
        });

        nearestForm.addEventListener("submit", (e) => {
            e.preventDefault();
            // jika mau lakukan submit manual, panggil fungsi submit di sini
        });
    }

    // cegah Enter di Amount Paid agar tidak menyebar / submit
    if (amountPaidInput) {
        amountPaidInput.addEventListener("keydown", (e) => {
            if (e.key === "Enter") {
                e.preventDefault();
                e.stopPropagation();
                // kembali fokus ke search (opsional)
                if (searchInput) {
                    setTimeout(() => {
                        searchInput.focus();
                        searchInput.select();
                    }, 10);
                }
            }
        });
    }

    // load produk & interval
    loadMenus();
    setInterval(loadMenus, 5000);

    // klik tombol "Tambah"
    tableBody.addEventListener("click", e => {
        const btn = e.target.closest(".add-to-cart");
        if (!btn) return;

        const tr = btn.closest("tr");
        const id = btn.dataset.id;
        const name = tr.dataset.name; // pake dataset
        const priceText = tr.dataset.price; // pake dataset

        addItemToCheckout(tr, id, name, priceText);
        focusToQuantityInput(id);
    });


    // deteksi barcode di search
    if (searchInput) {
        // elemen pesan hasil pencarian
        let notFoundMsg = document.getElementById("not-found-msg");
        if (!notFoundMsg) {
            notFoundMsg = document.createElement("p");
            notFoundMsg.id = "not-found-msg";
            notFoundMsg.className = "text-center text-gray-500 italic mt-3 hidden";
            // letakkan setelah tabel
            tableBody.parentElement.appendChild(notFoundMsg);
        }

        searchInput.addEventListener("input", () => {
            const value = searchInput.value.trim().toLowerCase();
            const rows = Array.from(tableBody.querySelectorAll("tr"));

            // reset pesan
            notFoundMsg.classList.add("hidden");
            notFoundMsg.textContent = "";

            // kalau kosong → tampilkan semua produk dan sembunyikan pesan
            if (!value) {
                rows.forEach(tr => tr.classList.remove("hidden"));
                notFoundMsg.classList.add("hidden");
                return;
            }

            let foundCount = 0;
            rows.forEach(tr => {
                const name = tr.dataset.name.toLowerCase(); // pake dataset
                if (name.includes(value)) {
                    tr.classList.remove("hidden");
                    foundCount++;
                } else {
                    tr.classList.add("hidden");
                }
            });

            if (foundCount === 0) {
                notFoundMsg.textContent = "Maaf, pencarian berdasarkan nama tidak ditemukan.";
                notFoundMsg.classList.remove("hidden");
            } else {
                notFoundMsg.classList.add("hidden");
            }
        });

    }

    
    if (payButton && nearestForm) {
        payButton.addEventListener("click", () => {
            // Optional: validasi dulu
            if (payButton.disabled) return;

            // 🔹 kirim manual
            nearestForm.submit();
        });
    }

    if (searchInput && clearBtn) {
        // Tampilkan tombol X kalau ada teks
        searchInput.addEventListener("input", () => {
            if (searchInput.value.trim() !== "") {
            clearBtn.classList.remove("hidden");
            } else {
            clearBtn.classList.add("hidden");
            }
        });

        // Klik tombol X → hapus teks & sembunyikan tombol
        clearBtn.addEventListener("click", () => {
            searchInput.value = "";
            clearBtn.classList.add("hidden");

            // Tampilkan semua baris kembali
            const tableBody = document.getElementById("products-table-body");
            tableBody.querySelectorAll("tr").forEach(tr => tr.classList.remove("hidden"));

            // sembunyikan pesan not found
            const notFoundMsg = document.getElementById("not-found-msg");
            if (notFoundMsg) notFoundMsg.classList.add("hidden");

            // fokus kembali ke search
            searchInput.focus();
        });
    }

    



});


// ==========================
// Fungsi bantu fokus
// ==========================
function focusToQuantityInput(productId) {
    const itemCard = document.querySelector(`.checkout-item[data-id="${productId}"]`);
    if (!itemCard) return;

    const qtyInput = itemCard.querySelector(".quantity-input");
    if (!qtyInput) return;

    // Fokus & seleksi angka biar langsung bisa ganti
    qtyInput.focus();
    qtyInput.select();

    // Pastikan handler lama gak numpuk
    qtyInput.onkeydown = (e) => {
        // Gunakan "e.code" biar konsisten di semua browser
        if (e.code === "Enter" || e.key === "Enter") {
            e.preventDefault();

            const searchInput = document.getElementById("search-input");
            if (searchInput) {
                // Timeout kecil supaya nunggu repaint browser selesai
                setTimeout(() => {
                    searchInput.focus();
                    searchInput.select();
                }, 10);
            }
        }
    };
}



