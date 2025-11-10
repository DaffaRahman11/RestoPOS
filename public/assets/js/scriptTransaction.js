

// Configuration object
const defaultConfig = {
  shop_name: "Treasure Cove",
  currency_symbol: "Rp",
  pay_button_text: "Complete Payment",
};

// Sample products data - 50 items
const products = [
  {
    id: 1,
    code: "PC001",
    name: "Vintage Postcard Set",
    price: 129900,
    category: "postcards",
    stock: 25,
  },
  {
    id: 2,
    code: "KC001",
    name: "Lighthouse Keychain",
    price: 85000,
    category: "keychains",
    stock: 15,
  },
  {
    id: 3,
    code: "MG001",
    name: "Seashell Magnet",
    price: 67500,
    category: "magnets",
    stock: 30,
  },
  {
    id: 4,
    code: "CL001",
    name: "Beach T-Shirt",
    price: 249900,
    category: "clothing",
    stock: 12,
  },
  {
    id: 5,
    code: "MU001",
    name: "Souvenir Coffee Mug",
    price: 159900,
    category: "mugs",
    stock: 18,
  },
  {
    id: 6,
    code: "KC002",
    name: "Anchor Keychain",
    price: 92500,
    category: "keychains",
    stock: 22,
  },
  {
    id: 7,
    code: "MG002",
    name: "City Skyline Magnet",
    price: 75000,
    category: "magnets",
    stock: 35,
  },
  {
    id: 8,
    code: "PC002",
    name: "Travel Journal",
    price: 187500,
    category: "postcards",
    stock: 8,
  },
  {
    id: 9,
    code: "CL002",
    name: "Sunset Cap",
    price: 199900,
    category: "clothing",
    stock: 14,
  },
  {
    id: 10,
    code: "MU002",
    name: "Ceramic Travel Mug",
    price: 225000,
    category: "mugs",
    stock: 10,
  },
  {
    id: 11,
    code: "KC003",
    name: "Palm Tree Keychain",
    price: 79900,
    category: "keychains",
    stock: 28,
  },
  {
    id: 12,
    code: "MG003",
    name: "Compass Magnet",
    price: 89900,
    category: "magnets",
    stock: 20,
  },
  {
    id: 13,
    code: "PC003",
    name: "Local Landmark Cards",
    price: 99900,
    category: "postcards",
    stock: 40,
  },
  {
    id: 14,
    code: "KC004",
    name: "Ship Wheel Keychain",
    price: 115000,
    category: "keychains",
    stock: 16,
  },
  {
    id: 15,
    code: "MG004",
    name: "Beach Scene Magnet",
    price: 59900,
    category: "magnets",
    stock: 45,
  },
  {
    id: 16,
    code: "CL003",
    name: "Tropical Hoodie",
    price: 399900,
    category: "clothing",
    stock: 8,
  },
  {
    id: 17,
    code: "MU003",
    name: "Insulated Tumbler",
    price: 289900,
    category: "mugs",
    stock: 12,
  },
  {
    id: 18,
    code: "KC005",
    name: "Dolphin Keychain",
    price: 87500,
    category: "keychains",
    stock: 33,
  },
  {
    id: 19,
    code: "MG005",
    name: "Sunset Magnet",
    price: 72500,
    category: "magnets",
    stock: 27,
  },
  {
    id: 20,
    code: "PC004",
    name: "Photo Album",
    price: 249900,
    category: "postcards",
    stock: 6,
  },
  {
    id: 21,
    code: "CL004",
    name: "Beach Shorts",
    price: 229900,
    category: "clothing",
    stock: 18,
  },
  {
    id: 22,
    code: "MU004",
    name: "Glass Water Bottle",
    price: 199900,
    category: "mugs",
    stock: 15,
  },
  {
    id: 23,
    code: "KC006",
    name: "Starfish Keychain",
    price: 69900,
    category: "keychains",
    stock: 42,
  },
  {
    id: 24,
    code: "MG006",
    name: "Tropical Fish Magnet",
    price: 85000,
    category: "magnets",
    stock: 31,
  },
  {
    id: 25,
    code: "PC005",
    name: "Greeting Card Pack",
    price: 149900,
    category: "postcards",
    stock: 22,
  },
  {
    id: 26,
    code: "CL005",
    name: "Sun Hat",
    price: 269900,
    category: "clothing",
    stock: 11,
  },
  {
    id: 27,
    code: "MU005",
    name: "Enamel Camp Mug",
    price: 175000,
    category: "mugs",
    stock: 19,
  },
  {
    id: 28,
    code: "KC007",
    name: "Seahorse Keychain",
    price: 99900,
    category: "keychains",
    stock: 24,
  },
  {
    id: 29,
    code: "MG007",
    name: "Coral Reef Magnet",
    price: 65000,
    category: "magnets",
    stock: 38,
  },
  {
    id: 30,
    code: "PC006",
    name: "Scrapbook Kit",
    price: 329900,
    category: "postcards",
    stock: 4,
  },
  {
    id: 31,
    code: "CL006",
    name: "Tank Top",
    price: 189900,
    category: "clothing",
    stock: 25,
  },
  {
    id: 32,
    code: "MU006",
    name: "Stainless Steel Mug",
    price: 219900,
    category: "mugs",
    stock: 13,
  },
  {
    id: 33,
    code: "KC008",
    name: "Treasure Chest Keychain",
    price: 129900,
    category: "keychains",
    stock: 17,
  },
  {
    id: 34,
    code: "MG008",
    name: "Pirate Ship Magnet",
    price: 97500,
    category: "magnets",
    stock: 26,
  },
  {
    id: 35,
    code: "PC007",
    name: "Memory Book",
    price: 215000,
    category: "postcards",
    stock: 9,
  },
  {
    id: 36,
    code: "CL007",
    name: "Windbreaker Jacket",
    price: 459900,
    category: "clothing",
    stock: 5,
  },
  {
    id: 37,
    code: "MU007",
    name: "Bamboo Travel Cup",
    price: 169900,
    category: "mugs",
    stock: 21,
  },
  {
    id: 38,
    code: "KC009",
    name: "Crab Keychain",
    price: 75000,
    category: "keychains",
    stock: 36,
  },
  {
    id: 39,
    code: "MG009",
    name: "Lighthouse Magnet",
    price: 82500,
    category: "magnets",
    stock: 29,
  },
  {
    id: 40,
    code: "PC008",
    name: "Sticker Collection",
    price: 119900,
    category: "postcards",
    stock: 34,
  },
  {
    id: 41,
    code: "CL008",
    name: "Beach Towel",
    price: 299900,
    category: "clothing",
    stock: 7,
  },
  {
    id: 42,
    code: "MU008",
    name: "Collapsible Cup",
    price: 139900,
    category: "mugs",
    stock: 23,
  },
  {
    id: 43,
    code: "KC010",
    name: "Octopus Keychain",
    price: 102500,
    category: "keychains",
    stock: 19,
  },
  {
    id: 44,
    code: "MG010",
    name: "Wave Pattern Magnet",
    price: 57500,
    category: "magnets",
    stock: 41,
  },
  {
    id: 45,
    code: "PC009",
    name: "Bookmark Set",
    price: 89900,
    category: "postcards",
    stock: 37,
  },
  {
    id: 46,
    code: "CL009",
    name: "Flip Flops",
    price: 169900,
    category: "clothing",
    stock: 20,
  },
  {
    id: 47,
    code: "MU009",
    name: "Double Wall Tumbler",
    price: 249900,
    category: "mugs",
    stock: 11,
  },
  {
    id: 48,
    code: "KC011",
    name: "Sand Dollar Keychain",
    price: 62500,
    category: "keychains",
    stock: 44,
  },
  {
    id: 49,
    code: "MG011",
    name: "Pelican Magnet",
    price: 79900,
    category: "magnets",
    stock: 32,
  },
  {
    id: 50,
    code: "PC010",
    name: "Art Print Collection",
    price: 279900,
    category: "postcards",
    stock: 3,
  },
];

let checkoutItems = [];
let filteredProducts = [...products];
let sidebarVisible = true;
let currentCategory = "";
let currentSort = "name";
let currentPaymentMethod = "cash";

// Pagination variables
let currentPage = 1;
const itemsPerPage = 10;

// Dark mode functionality
let isDarkMode = false;

function toggleDarkMode() {
  isDarkMode = !isDarkMode;
  const body = document.body;
  const icon = document.getElementById("dark-mode-icon");

  if (isDarkMode) {
    body.classList.add("dark");
    icon.className = "fas fa-sun text-lg";
    localStorage.setItem("darkMode", "true");
  } else {
    body.classList.remove("dark");
    icon.className = "fas fa-moon text-lg";
    localStorage.setItem("darkMode", "false");
  }
}

function initDarkMode() {
  const savedMode = localStorage.getItem("darkMode");
  if (savedMode === "true") {
    isDarkMode = true;
    document.body.classList.add("dark");
    document.getElementById("dark-mode-icon").className = "fas fa-sun text-lg";
  }
}

// Initialize the application
function init() {
  initDarkMode();
  renderProducts();
  setupEventListeners();
  updateTime();
  setInterval(updateTime, 1000);

  // Initialize sidebar state
  const isMobile = window.innerWidth < 1024;
  const mainContent = document.getElementById("main-content");
  const toggleBtn = document.getElementById("sidebar-toggle-btn");
  const toggleIcon = document.getElementById("sidebar-toggle-icon");

  if (sidebarVisible && !isMobile) {
    toggleBtn.style.display = "none";
    toggleIcon.className = "fas fa-times text-lg";
    mainContent.style.marginLeft = "0";
  } else {
    if (!isMobile && !sidebarVisible) {
      toggleBtn.style.display = "block";
      mainContent.style.marginLeft = "0";
      mainContent.style.width = "100%";
    }
    toggleIcon.className = "fas fa-bars text-lg";
  }
}

// POS Dropdown functionality
function togglePOSDropdown() {
  const dropdown = document.getElementById("pos-dropdown");
  const arrow = document.getElementById("pos-arrow");

  dropdown.classList.toggle("hidden");

  if (dropdown.classList.contains("hidden")) {
    arrow.style.transform = "rotate(0deg)";
  } else {
    arrow.style.transform = "rotate(180deg)";
  }
}

// Switch POS views
function switchPOSView(view) {
  const headerTitle = document.querySelector("header h2");

  // Update header title
  switch (view) {
    case "cashier":
      headerTitle.textContent = "Point of Sale - Cashier";
      break;
    case "transactions":
      headerTitle.textContent = "Point of Sale - Transactions";
      break;
    case "refunds":
      headerTitle.textContent = "Point of Sale - Refunds";
      break;
    case "discounts":
      headerTitle.textContent = "Point of Sale - Discounts";
      break;
    case "daily-close":
      headerTitle.textContent = "Point of Sale - Daily Close";
      break;
  }
}

// Element SDK implementation
const element = {
  defaultConfig: defaultConfig,
  onConfigChange: async (config) => {
    const shopTitleEl = document.getElementById("shop-title");
    if (shopTitleEl) {
      shopTitleEl.textContent = config.shop_name || defaultConfig.shop_name;
    }

    // Update currency symbols
    const currencySymbol =
      config.currency_symbol || defaultConfig.currency_symbol;

    // Update all price displays
    document.querySelectorAll(".price-display").forEach(function (el) {
      const price = parseFloat(el.dataset.price);
      if (!isNaN(price)) {
        el.textContent = currencySymbol + price.toLocaleString("id-ID");
      }
    });

    // Update pay button text
    const payButtonTextEl = document.getElementById("pay-button-text");
    if (payButtonTextEl) {
      payButtonTextEl.textContent =
        config.pay_button_text || defaultConfig.pay_button_text;
    }
  },
  mapToCapabilities: function (config) {
    return {
      recolorables: [
        {
          get: function () {
            return config.primary_color || "#0ea5e9";
          },
          set: function (value) {
            config.primary_color = value;
            if (window.elementSdk) {
              window.elementSdk.setConfig({ primary_color: value });
            }
          },
        },
        {
          get: function () {
            return config.background_color || "#f8fafc";
          },
          set: function (value) {
            config.background_color = value;
            if (window.elementSdk) {
              window.elementSdk.setConfig({ background_color: value });
            }
          },
        },
      ],
      borderables: [],
      fontEditable: {
        get: function () {
          return config.font_family || "system-ui";
        },
        set: function (value) {
          config.font_family = value;
          if (window.elementSdk) {
            window.elementSdk.setConfig({ font_family: value });
          }
        },
      },
      fontSizeable: {
        get: function () {
          return config.font_size || 16;
        },
        set: function (value) {
          config.font_size = value;
          if (window.elementSdk) {
            window.elementSdk.setConfig({ font_size: value });
          }
        },
      },
    };
  },
  mapToEditPanelValues: function (config) {
    return new Map([
      ["shop_name", config.shop_name || defaultConfig.shop_name],
      [
        "currency_symbol",
        config.currency_symbol || defaultConfig.currency_symbol,
      ],
      [
        "pay_button_text",
        config.pay_button_text || defaultConfig.pay_button_text,
      ],
    ]);
  },
};

// Initialize Element SDK
if (window.elementSdk) {
  window.elementSdk.init(element);
}

function renderProducts() {
  const tableBody = document.getElementById("products-table-body");
  if (!tableBody) return;

  tableBody.innerHTML = "";

  // Calculate pagination
  const startIndex = (currentPage - 1) * itemsPerPage;
  const endIndex = startIndex + itemsPerPage;
  const paginatedProducts = filteredProducts.slice(startIndex, endIndex);

  paginatedProducts.forEach(function (product) {
    // Calculate remaining stock after checkout items
    const checkoutItem = checkoutItems.find((item) => item.id === product.id);
    const reservedQuantity = checkoutItem ? checkoutItem.quantity : 0;
    const remainingStock = product.stock - reservedQuantity;

    const isLowStock = remainingStock <= 5 && remainingStock > 0;
    const isOutOfStock = remainingStock <= 0;

    const row = document.createElement("tr");
    row.className = "hover:bg-green-50 transition-all duration-200";

    // Translate category to Indonesian
    const categoryTranslation = {
      keychains: "Gantungan Kunci",
      magnets: "Magnet",
      postcards: "Kartu Pos",
      clothing: "Pakaian",
      mugs: "Mug & Gelas",
    };

    const isInCheckout = checkoutItems.some(function (item) {
      return item.id === product.id;
    });

    const isDisabled = remainingStock <= 0 || isInCheckout;

    row.innerHTML = `
                    <td class="px-3 lg:px-6 py-3 lg:py-4 text-xs lg:text-sm font-medium ${
                      isInCheckout ? "text-gray-400" : "text-gray-800"
                    }">${product.code}</td>
                    <td class="px-3 lg:px-6 py-3 lg:py-4 text-xs lg:text-sm ${
                      isInCheckout
                        ? "text-gray-400"
                        : "text-gray-800 cursor-pointer hover:text-emerald-600"
                    } transition-colors" ${
      !isInCheckout
        ? `onclick="addToCheckout(${JSON.stringify(product).replace(
            /"/g,
            "&quot;"
          )})"`
        : ""
    }>${product.name}</td>
                    <td class="px-3 lg:px-6 py-3 lg:py-4 text-xs lg:text-sm font-semibold ${
                      isInCheckout ? "text-gray-400" : "text-green-700"
                    } price-display" data-price="${
      product.price
    }">Rp${product.price.toLocaleString("id-ID")}</td>
                    <td class="px-3 lg:px-6 py-3 lg:py-4 text-xs lg:text-sm ${
                      isInCheckout ? "text-gray-400" : "text-gray-600"
                    } hidden sm:table-cell">${
      categoryTranslation[product.category] || product.category
    }</td>
                    <td class="px-3 lg:px-6 py-3 lg:py-4 text-xs lg:text-sm">
                        <span class="px-2 py-1 rounded-full text-xs font-medium ${
                          isOutOfStock
                            ? "bg-red-100 text-red-800"
                            : isLowStock
                            ? "bg-yellow-100 text-yellow-800"
                            : isInCheckout
                            ? "bg-gray-100 text-gray-500"
                            : "bg-green-100 text-green-800"
                        }">
                            ${remainingStock}
                        </span>
                    </td>
                    <td class="px-3 lg:px-6 py-3 lg:py-4 text-center">
                        <button 
                            onclick="addToCheckout(${JSON.stringify(
                              product
                            ).replace(/"/g, "&quot;")})"
                            class="px-3 py-2 text-white text-xs font-semibold rounded-lg transition-all duration-200 ${
                              isDisabled
                                ? "opacity-50 cursor-not-allowed bg-gray-400"
                                : "bg-emerald-500 hover:bg-emerald-600"
                            }"
                            title="${
                              isInCheckout
                                ? "Sudah Dipilih"
                                : "Tambah ke Keranjang"
                            }"
                            ${isDisabled ? "disabled" : ""}
                        >
                            ${isInCheckout ? "Dipilih" : "Tambah"}
                        </button>
                    </td>
                `;

    tableBody.appendChild(row);
  });

  renderPagination();
}

function renderPagination() {
  const paginationContainer = document.getElementById("pagination-container");
  if (!paginationContainer) return;

  const totalPages = Math.ceil(filteredProducts.length / itemsPerPage);

  if (totalPages <= 1) {
    paginationContainer.innerHTML = "";
    return;
  }

  let paginationHTML = "";

  // Previous button
  paginationHTML += `
                <button class="pagination-btn ${
                  currentPage === 1 ? "opacity-50 cursor-not-allowed" : ""
                }" 
                        onclick="changePage(${currentPage - 1})" 
                        ${currentPage === 1 ? "disabled" : ""}>
                    <i class="fas fa-chevron-left"></i>
                </button>
            `;

  // Page numbers
  const maxVisiblePages = 5;
  let startPage = Math.max(1, currentPage - Math.floor(maxVisiblePages / 2));
  let endPage = Math.min(totalPages, startPage + maxVisiblePages - 1);

  if (endPage - startPage + 1 < maxVisiblePages) {
    startPage = Math.max(1, endPage - maxVisiblePages + 1);
  }

  if (startPage > 1) {
    paginationHTML += `<button class="pagination-btn" onclick="changePage(1)">1</button>`;
    if (startPage > 2) {
      paginationHTML += `<span class="px-2 text-gray-500">...</span>`;
    }
  }

  for (let i = startPage; i <= endPage; i++) {
    paginationHTML += `
                    <button class="pagination-btn ${
                      i === currentPage ? "active" : ""
                    }" 
                            onclick="changePage(${i})">
                        ${i}
                    </button>
                `;
  }

  if (endPage < totalPages) {
    if (endPage < totalPages - 1) {
      paginationHTML += `<span class="px-2 text-gray-500">...</span>`;
    }
    paginationHTML += `<button class="pagination-btn" onclick="changePage(${totalPages})">${totalPages}</button>`;
  }

  // Next button
  paginationHTML += `
                <button class="pagination-btn ${
                  currentPage === totalPages
                    ? "opacity-50 cursor-not-allowed"
                    : ""
                }" 
                        onclick="changePage(${currentPage + 1})" 
                        ${currentPage === totalPages ? "disabled" : ""}>
                    <i class="fas fa-chevron-right"></i>
                </button>
            `;

  paginationContainer.innerHTML = paginationHTML;
}

function changePage(page) {
  const totalPages = Math.ceil(filteredProducts.length / itemsPerPage);
  if (page < 1 || page > totalPages) return;

  currentPage = page;
  renderProducts();
}

function addToCheckout(product) {
  const existingItem = checkoutItems.find((item) => item.id === product.id);
  if (!existingItem) {
    checkoutItems.push({ ...product, quantity: 0 });
    renderCheckout();
    renderProducts(); // Re-render to show disabled state
  }
}

function removeFromCheckout(productId) {
  checkoutItems = checkoutItems.filter(function (item) {
    return item.id !== productId;
  });
  renderCheckout();
  renderProducts(); // Re-render to enable product again
}

function updateQuantity(productId, newQuantity) {
  if (newQuantity <= 0) {
    removeFromCheckout(productId);
    return;
  }

  const item = checkoutItems.find(function (item) {
    return item.id === productId;
  });
  const product = products.find(function (p) {
    return p.id === productId;
  });

  if (item && product) {
    // Stok maksimal yang bisa dipilih adalah stok asli produk
    const maxAvailableStock = product.stock;

    if (newQuantity > maxAvailableStock) {
      // Tampilkan peringatan jika melebihi stok
      showStockWarning(product.name, maxAvailableStock);
      // Reset input ke nilai maksimal yang diizinkan
      const quantityInput = document.querySelector(
        `input[onchange*="${productId}"]`
      );
      if (quantityInput) {
        quantityInput.value = item.quantity;
      }
      return;
    }

    item.quantity = newQuantity;
    renderCheckout();
    renderProducts(); // Update tampilan stok di tabel
  }
}

function updateQuantityRealtime(productId, value) {
  const newQuantity = parseInt(value) || 0;
  const product = products.find(function (p) {
    return p.id === productId;
  });

  if (product) {
    // Hanya tampilkan peringatan visual jika melebihi stok, tapi jangan update quantity
    const quantityInput = document.querySelector(
      `input[oninput*="${productId}"]`
    );
    if (newQuantity > product.stock) {
      // Tampilkan peringatan visual
      showStockWarning(product.name, product.stock);
      if (quantityInput) {
        quantityInput.style.borderColor = "#ef4444";
        quantityInput.style.backgroundColor = "#fef2f2";
      }
    } else {
      // Hapus peringatan jika ada
      removeStockWarning();
      if (quantityInput) {
        quantityInput.style.borderColor = "";
        quantityInput.style.backgroundColor = "";
      }
    }

    // TIDAK update quantity saat sedang mengetik - hanya visual feedback
  }
}

function updateQuantityFromInput(productId, value) {
  const newQuantity = parseInt(value) || 0;
  const product = products.find(function (p) {
    return p.id === productId;
  });

  if (product && newQuantity > product.stock) {
    // Jika melebihi stok saat selesai mengetik, kembalikan ke stok maksimal
    const item = checkoutItems.find(function (item) {
      return item.id === productId;
    });
    if (item) {
      item.quantity = product.stock;
      renderCheckout();
      renderProducts();
      showStockWarning(product.name, product.stock);
    }
  } else {
    updateQuantity(productId, newQuantity);
  }
}

function showStockWarning(productName, availableStock) {
  // Remove existing warning if any
  removeStockWarning();

  const warningMsg = document.createElement("div");
  warningMsg.className =
    "stock-warning fixed top-4 right-4 bg-red-500 text-white px-6 py-4 rounded-xl shadow-2xl z-50 max-w-sm animate-pulse";
  warningMsg.innerHTML = `
                <div class="flex items-start space-x-3">
                    <div class="w-8 h-8 bg-white bg-opacity-20 rounded-full flex items-center justify-center flex-shrink-0">
                        <i class="fas fa-exclamation-triangle text-lg"></i>
                    </div>
                    <div class="flex-1">
                        <p class="font-bold text-sm">Stok Tidak Mencukupi!</p>
                        <p class="text-xs mt-1 opacity-90">${productName} hanya tersisa ${availableStock} item</p>
                    </div>
                    <button onclick="removeStockWarning()" class="text-white hover:text-red-200 text-lg font-bold">×</button>
                </div>
            `;
  document.body.appendChild(warningMsg);

  // Auto remove after 3 seconds
  setTimeout(() => {
    removeStockWarning();
  }, 3000);
}

function removeStockWarning() {
  const existingWarning = document.querySelector(".stock-warning");
  if (existingWarning) {
    existingWarning.remove();
  }
}

function validateQuantityInput(input, productId, maxStock) {
  const value = parseInt(input.value);

  if (value > maxStock) {
    input.style.borderColor = "#ef4444";
    input.style.backgroundColor = "#fef2f2";

    // Tampilkan tooltip peringatan
    const tooltip = document.createElement("div");
    tooltip.className =
      "absolute bg-red-500 text-white text-xs px-2 py-1 rounded mt-1 z-10";
    tooltip.textContent = `Maksimal ${maxStock} item`;
    tooltip.style.left = "50%";
    tooltip.style.transform = "translateX(-50%)";

    const parent = input.parentElement;
    parent.style.position = "relative";
    parent.appendChild(tooltip);

    setTimeout(() => {
      tooltip.remove();
      input.style.borderColor = "";
      input.style.backgroundColor = "";
    }, 2000);
  } else {
    input.style.borderColor = "";
    input.style.backgroundColor = "";
  }
}

function handleQuantityKeypress(event, productId) {
  if (event.key === "Enter") {
    const newQuantity = parseInt(event.target.value) || 1;
    updateQuantity(productId, newQuantity);
    event.target.blur(); // Remove focus from input
  }
}

function renderCheckout() {
  const emptyCheckout = document.getElementById("empty-checkout");
  const checkoutContainer = document.getElementById("checkout-items-container");
  const checkoutList = document.getElementById("checkout-items-list");

  if (checkoutItems.length === 0) {
    // Show empty state, hide items container
    emptyCheckout.classList.remove("hidden");
    checkoutContainer.classList.add("hidden");
  } else {
    // Hide empty state, show items container
    emptyCheckout.classList.add("hidden");
    checkoutContainer.classList.remove("hidden");

    // Render items in the scrollable list
    checkoutList.innerHTML = checkoutItems
      .map(function (item) {
        return `
                    <div class="checkout-item bg-gray-50 rounded-xl p-3 border border-gray-200 shadow-sm">
                        <div class="flex items-center justify-between mb-2">
                            <span class="font-medium text-gray-800 text-sm">${
                              item.name
                            }</span>
                            <button onclick="removeFromCheckout(${
                              item.id
                            })" class="text-red-500 hover:text-red-700 hover:bg-red-100 rounded-lg w-7 h-7 flex items-center justify-center transition-all duration-200 group">
                                <i class="fas fa-trash text-xs group-hover:scale-110 transition-transform"></i>
                            </button>
                        </div>
                        <div class="flex items-center justify-between">
                            <div class="flex items-center space-x-2">
                                <button onclick="updateQuantity(${
                                  item.id
                                }, ${item.quantity - 1})" class="w-7 h-7 bg-emerald-200 hover:bg-emerald-300 rounded-lg text-xs font-bold transition-colors text-emerald-700 hover:text-emerald-800 ${item.quantity <= 0 ? "opacity-50 cursor-not-allowed" : ""}" ${item.quantity <= 0 ? "disabled" : ""}>-</button>
                                <input 
                                    type="number" 
                                    value="${item.quantity || ""}" 
                                    min="0" 
                                    max="${item.stock}"
                                    placeholder="0"
                                    onchange="updateQuantityFromInput(${
                                      item.id
                                    }, this.value)"
                                    onkeypress="handleQuantityKeypress(event, ${
                                      item.id
                                    })"
                                    oninput="updateQuantityRealtime(${
                                      item.id
                                    }, this.value)"
                                    onblur="updateQuantityFromInput(${
                                      item.id
                                    }, this.value)"
                                    class="w-12 h-7 text-center font-medium border border-gray-300 rounded-lg focus:border-emerald-500 focus:outline-none text-xs ${
                                      item.quantity === 0
                                        ? "border-orange-300 bg-orange-50"
                                        : item.quantity > item.stock
                                        ? "border-red-300 bg-red-50"
                                        : ""
                                    }"
                                >
                                <button onclick="updateQuantity(${
                                  item.id
                                }, ${item.quantity + 1})" class="w-7 h-7 bg-emerald-200 hover:bg-emerald-300 rounded-lg text-xs font-bold transition-colors text-emerald-700 hover:text-emerald-800">+</button>
                            </div>
                            <span class="font-semibold text-emerald-700 text-sm">Rp${(
                              item.price * item.quantity
                            ).toLocaleString("id-ID")}</span>
                        </div>
                    </div>
                    `;
      })
      .join("");
  }

  updateTotals();
}

function calculateTotal() {
  return checkoutItems.reduce(function (total, item) {
    return total + item.price * item.quantity;
  }, 0);
}

function calculateChange() {
  const total = calculateTotal();
  const paidInput = document.getElementById("amount-paid");
  const paidValue = paidInput.value.replace(/[^\d]/g, ""); // Remove non-digits
  const paid = parseFloat(paidValue) || 0;
  return Math.max(0, paid - total);
}

// Format currency input with Rp prefix and thousand separators
function formatCurrencyInput(input) {
  // Get the raw value (numbers only)
  let value = input.value.replace(/[^\d]/g, "");

  // Format with thousand separators
  if (value) {
    const formatted = parseInt(value).toLocaleString("id-ID");
    input.value = formatted;
  } else {
    input.value = "";
  }

  // Update totals after formatting
  updateTotals();
}

// Allow only numbers and control keys
function isNumberKey(evt) {
  const charCode = evt.which ? evt.which : evt.keyCode;

  // Allow backspace, delete, tab, escape, enter
  if (
    [8, 9, 27, 13, 46].indexOf(charCode) !== -1 ||
    // Allow Ctrl+A, Ctrl+C, Ctrl+V, Ctrl+X
    (charCode === 65 && evt.ctrlKey === true) ||
    (charCode === 67 && evt.ctrlKey === true) ||
    (charCode === 86 && evt.ctrlKey === true) ||
    (charCode === 88 && evt.ctrlKey === true)
  ) {
    return true;
  }

  // Ensure that it is a number and stop the keypress
  if (charCode < 48 || charCode > 57) {
    evt.preventDefault();
    return false;
  }

  return true;
}

function updateTotals() {
  const total = calculateTotal();
  const change = calculateChange();

  document.getElementById(
    "total-amount"
  ).textContent = `Rp${total.toLocaleString("id-ID")}`;
  document.getElementById(
    "change-amount"
  ).textContent = `Rp${change.toLocaleString("id-ID")}`;

  const payButton = document.getElementById("pay-button");
  payButton.disabled = checkoutItems.length === 0;
}

function toggleSidebar() {
  const sidebar = document.getElementById("sidebar");
  const mainContent = document.getElementById("main-content");
  const toggleBtn = document.getElementById("sidebar-toggle-btn");
  const toggleIcon = document.getElementById("sidebar-toggle-icon");
  const isMobile = window.innerWidth < 1024;

  sidebarVisible = !sidebarVisible;

  if (sidebarVisible) {
    sidebar.style.transform = "translateX(0)";
    toggleIcon.className = "fas fa-times text-lg";

    // Desktop: hide toggle button and adjust main content
    if (!isMobile) {
      toggleBtn.style.display = "none";
      mainContent.style.marginLeft = "0";
    } else {
      // Mobile: add overlay
      const overlay = document.createElement("div");
      overlay.id = "sidebar-overlay";
      overlay.className = "fixed inset-0 bg-black bg-opacity-50 z-10 lg:hidden";
      overlay.onclick = () => toggleSidebar();
      document.body.appendChild(overlay);
    }
  } else {
    sidebar.style.transform = "translateX(-100%)";
    toggleIcon.className = "fas fa-bars text-lg";

    // Desktop: show toggle button and make main content full width
    if (!isMobile) {
      toggleBtn.style.display = "block";
      mainContent.style.marginLeft = "0";
      mainContent.style.width = "100%";
    } else {
      // Remove overlay
      const overlay = document.getElementById("sidebar-overlay");
      if (overlay) overlay.remove();
    }
  }
}

// Handle window resize to maintain sidebar state
function handleResize() {
  const sidebar = document.getElementById("sidebar");
  const mainContent = document.getElementById("main-content");
  const toggleBtn = document.getElementById("sidebar-toggle-btn");
  const overlay = document.getElementById("sidebar-overlay");
  const toggleIcon = document.getElementById("sidebar-toggle-icon");
  const isMobile = window.innerWidth < 1024;

  if (!isMobile) {
    // Desktop mode - remove mobile overlay
    if (overlay) overlay.remove();

    if (sidebarVisible) {
      toggleBtn.style.display = "none";
      mainContent.style.marginLeft = "0";
    } else {
      toggleBtn.style.display = "block";
      mainContent.style.marginLeft = "0";
      mainContent.style.width = "100%";
    }
  } else {
    // Mobile mode - always show toggle button and reset main content styles
    toggleBtn.style.display = "block";
    mainContent.style.marginLeft = "";
    mainContent.style.width = "";

    if (sidebarVisible && !overlay) {
      const newOverlay = document.createElement("div");
      newOverlay.id = "sidebar-overlay";
      newOverlay.className =
        "fixed inset-0 bg-black bg-opacity-50 z-10 lg:hidden";
      newOverlay.onclick = () => toggleSidebar();
      document.body.appendChild(newOverlay);
    }
  }

  // Update sidebar transform and icon
  if (sidebarVisible) {
    sidebar.style.transform = "translateX(0)";
    toggleIcon.className = "fas fa-times text-lg";
  } else {
    sidebar.style.transform = "translateX(-100%)";
    toggleIcon.className = "fas fa-bars text-lg";
  }
}

// Add resize event listener
window.addEventListener("resize", handleResize);

// Custom dropdown functions
function toggleDropdown(dropdownId) {
  const dropdown = document.getElementById(dropdownId);
  const menu = dropdown.querySelector(".custom-dropdown-menu");
  const isOpen = !menu.classList.contains("hidden");

  // Close all other dropdowns
  document.querySelectorAll(".custom-dropdown-menu").forEach((menu) => {
    menu.classList.add("hidden");
  });
  document.querySelectorAll(".custom-dropdown").forEach((dropdown) => {
    dropdown.classList.remove("open");
  });

  // Toggle current dropdown
  if (!isOpen) {
    menu.classList.remove("hidden");
    dropdown.classList.add("open");
  }
}

function selectCategory(value, text) {
  currentCategory = value;
  document.getElementById("category-selected").textContent = text;
  document.getElementById("category-dropdown").classList.remove("open");
  document
    .querySelector("#category-dropdown .custom-dropdown-menu")
    .classList.add("hidden");
  currentPage = 1; // Reset to first page when filtering
  filterProducts();
}

function selectSort(value, text) {
  currentSort = value;
  document.getElementById("sort-selected").textContent = text;
  document.getElementById("sort-dropdown").classList.remove("open");
  document
    .querySelector("#sort-dropdown .custom-dropdown-menu")
    .classList.add("hidden");
  currentPage = 1; // Reset to first page when sorting
  sortProducts();
}

function selectPayment(value, text) {
  currentPaymentMethod = value;
  document.getElementById("payment-selected").textContent = text;
  document.getElementById("payment-dropdown").classList.remove("open");
  document
    .querySelector("#payment-dropdown .custom-dropdown-menu")
    .classList.add("hidden");
}

function setupEventListeners() {
  // Search functionality
  const searchInput = document.getElementById("search-input");
  if (searchInput) {
    searchInput.oninput = function (e) {
      currentPage = 1; // Reset to first page when searching
      filterProducts();
    };
  }

  // Amount paid input - handled by formatCurrencyInput function

  // Pay button
  const payButton = document.getElementById("pay-button");
  if (payButton) {
    payButton.onclick = function () {
      if (checkoutItems.length > 0) {
        const total = calculateTotal();
        const paidInput = document.getElementById("amount-paid");
        const paidValue = paidInput.value.replace(/[^\d]/g, ""); // Remove non-digits
        const paid = parseFloat(paidValue) || 0;

        if (paid >= total) {
          // Process payment
          checkoutItems = [];
          document.getElementById("amount-paid").value = "";
          renderCheckout();
          renderProducts();

          // Show success message
          const successMsg = document.createElement("div");
          successMsg.className =
            "fixed top-4 right-4 bg-green-500 text-white px-6 py-3 rounded-lg shadow-lg z-50";
          successMsg.textContent = "Payment completed successfully!";
          document.body.appendChild(successMsg);

          setTimeout(() => {
            successMsg.remove();
          }, 3000);
        } else {
          // Show insufficient payment message
          const errorMsg = document.createElement("div");
          errorMsg.className =
            "fixed top-4 right-4 bg-red-500 text-white px-6 py-3 rounded-lg shadow-lg z-50";
          errorMsg.textContent = "Insufficient payment amount!";
          document.body.appendChild(errorMsg);

          setTimeout(() => {
            errorMsg.remove();
          }, 3000);
        }
      }
    };
  }
}

function filterProducts() {
  const searchInput = document.getElementById("search-input");
  if (!searchInput) return;

  const searchTerm = searchInput.value.toLowerCase();

  filteredProducts = products.filter(function (product) {
    const matchesSearch = product.name.toLowerCase().includes(searchTerm);
    const matchesCategory =
      !currentCategory || product.category === currentCategory;
    return matchesSearch && matchesCategory;
  });

  sortProducts();
}

function sortProducts() {
  const sortBy = currentSort;

  filteredProducts.sort(function (a, b) {
    switch (sortBy) {
      case "name":
        return a.name.localeCompare(b.name);
      case "price-low":
        return a.price - b.price;
      case "price-high":
        return b.price - a.price;
      case "category":
        return a.category.localeCompare(b.category);
      default:
        return 0;
    }
  });

  renderProducts();
}

function updateTime() {
  const now = new Date();
  const timeString = now.toLocaleTimeString();
  const dateString = now.toLocaleDateString("en-US", {
    weekday: "long",
    year: "numeric",
    month: "long",
    day: "numeric",
  });

  document.getElementById("current-time").textContent = timeString;
  document.getElementById("current-date").textContent = dateString;
}

function toggleNotifications() {
  const dropdown = document.getElementById("notification-dropdown");
  const profileDropdown = document.getElementById("profile-dropdown");

  // Close profile dropdown if open
  profileDropdown.classList.add("hidden");

  // Toggle notification dropdown
  dropdown.classList.toggle("hidden");
}

function toggleProfileMenu() {
  const dropdown = document.getElementById("profile-dropdown");
  const notificationDropdown = document.getElementById("notification-dropdown");

  // Close notification dropdown if open
  notificationDropdown.classList.add("hidden");

  // Toggle profile dropdown
  dropdown.classList.toggle("hidden");
}

function logout() {
  // Show logout confirmation
  const confirmMsg = document.createElement("div");
  confirmMsg.className =
    "fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50";
  confirmMsg.innerHTML = `
                <div class="bg-white rounded-lg p-6 max-w-sm mx-4">
                    <h3 class="text-lg font-semibold text-gray-800 mb-4">Confirm Logout</h3>
                    <p class="text-gray-600 mb-6">Are you sure you want to logout?</p>
                    <div class="flex space-x-3">
                        <button onclick="this.parentElement.parentElement.parentElement.remove()" class="flex-1 px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition-colors">
                            Cancel
                        </button>
                        <button onclick="performLogout()" class="flex-1 px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition-colors">
                            Logout
                        </button>
                    </div>
                </div>
            `;
  document.body.appendChild(confirmMsg);
}

function performLogout() {
  // Remove confirmation dialog
  document.querySelector(".fixed.inset-0").remove();

  // Show logout success message
  const successMsg = document.createElement("div");
  successMsg.className =
    "fixed top-4 right-4 bg-green-500 text-white px-6 py-3 rounded-lg shadow-lg z-50";
  successMsg.textContent = "Logged out successfully!";
  document.body.appendChild(successMsg);

  setTimeout(() => {
    successMsg.remove();
    // In a real app, this would redirect to login page
  }, 2000);
}

// Close dropdowns when clicking outside
document.addEventListener("click", function (event) {
  const notificationBtn = document.getElementById("notification-btn");
  const notificationDropdown = document.getElementById("notification-dropdown");
  const profileBtn = document.getElementById("profile-btn");
  const profileDropdown = document.getElementById("profile-dropdown");

  // Close notification dropdown if clicking outside
  if (
    !notificationBtn.contains(event.target) &&
    !notificationDropdown.contains(event.target)
  ) {
    notificationDropdown.classList.add("hidden");
  }

  // Close profile dropdown if clicking outside
  if (
    !profileBtn.contains(event.target) &&
    !profileDropdown.contains(event.target)
  ) {
    profileDropdown.classList.add("hidden");
  }

  // Close custom dropdowns if clicking outside
  const customDropdowns = document.querySelectorAll(".custom-dropdown");
  customDropdowns.forEach((dropdown) => {
    if (!dropdown.contains(event.target)) {
      dropdown.classList.remove("open");
      dropdown.querySelector(".custom-dropdown-menu").classList.add("hidden");
    }
  });
});

// Product management functions
function showAddProductModal() {
  const modal = document.createElement("div");
  modal.className =
    "fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 p-4";
  modal.innerHTML = `
                <div class="bg-white rounded-2xl p-6 max-w-md w-full max-h-[90%] overflow-y-auto">
                    <div class="flex items-center justify-between mb-6">
                        <h3 class="text-xl font-bold text-gray-800">Tambah Produk Baru</h3>
                        <button onclick="this.closest('.fixed').remove()" class="text-gray-500 hover:text-gray-700 text-2xl">×</button>
                    </div>
                    
                    <form onsubmit="addNewProduct(event)">
                        <div class="space-y-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Kode Produk</label>
                                <input type="text" name="code" required class="custom-input w-full px-4 py-3 rounded-xl" placeholder="Contoh: PC001">
                            </div>
                            
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Nama Produk</label>
                                <input type="text" name="name" required class="custom-input w-full px-4 py-3 rounded-xl" placeholder="Nama produk">
                            </div>
                            
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Harga</label>
                                <input type="number" name="price" required min="0" step="100" class="custom-input w-full px-4 py-3 rounded-xl" placeholder="0">
                            </div>
                            
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Kategori</label>
                                <select name="category" required class="custom-input w-full px-4 py-3 rounded-xl">
                                    <option value="">Pilih Kategori</option>
                                    <option value="keychains">Gantungan Kunci</option>
                                    <option value="magnets">Magnet</option>
                                    <option value="postcards">Kartu Pos</option>
                                    <option value="clothing">Pakaian</option>
                                    <option value="mugs">Mug & Gelas</option>
                                </select>
                            </div>
                            
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Stok</label>
                                <input type="number" name="stock" required min="0" class="custom-input w-full px-4 py-3 rounded-xl" placeholder="0">
                            </div>
                        </div>
                        
                        <div class="flex space-x-3 mt-6">
                            <button type="button" onclick="this.closest('.fixed').remove()" class="flex-1 px-4 py-3 border border-gray-300 rounded-xl text-gray-700 hover:bg-gray-50 transition-colors font-medium">
                                Batal
                            </button>
                            <button type="submit" class="flex-1 px-4 py-3 bg-gradient-to-r from-emerald-500 to-emerald-600 text-white rounded-xl hover:from-emerald-600 hover:to-emerald-700 transition-colors font-medium">
                                Tambah Produk
                            </button>
                        </div>
                    </form>
                </div>
            `;
  document.body.appendChild(modal);
}

function addNewProduct(event) {
  event.preventDefault();
  const formData = new FormData(event.target);

  const newProduct = {
    id: products.length + 1,
    code: formData.get("code"),
    name: formData.get("name"),
    price: parseInt(formData.get("price")),
    category: formData.get("category"),
    stock: parseInt(formData.get("stock")),
  };

  // Check if code already exists
  if (products.some((p) => p.code === newProduct.code)) {
    showNotification("Kode produk sudah ada!", "error");
    return;
  }

  products.push(newProduct);
  filteredProducts = [...products];
  currentPage = 1; // Reset to first page
  renderProducts();

  // Close modal
  event.target.closest(".fixed").remove();
  showNotification("Produk berhasil ditambahkan!", "success");
}

function editProduct(productId) {
  const product = products.find((p) => p.id === productId);
  if (!product) return;

  const modal = document.createElement("div");
  modal.className =
    "fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 p-4";
  modal.innerHTML = `
                <div class="bg-white rounded-2xl p-6 max-w-md w-full max-h-[90%] overflow-y-auto">
                    <div class="flex items-center justify-between mb-6">
                        <h3 class="text-xl font-bold text-gray-800">Edit Produk</h3>
                        <button onclick="this.closest('.fixed').remove()" class="text-gray-500 hover:text-gray-700 text-2xl">×</button>
                    </div>
                    
                    <form onsubmit="updateProduct(event, ${productId})">
                        <div class="space-y-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Kode Produk</label>
                                <input type="text" name="code" required class="custom-input w-full px-4 py-3 rounded-xl" value="${
                                  product.code
                                }">
                            </div>
                            
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Nama Produk</label>
                                <input type="text" name="name" required class="custom-input w-full px-4 py-3 rounded-xl" value="${
                                  product.name
                                }">
                            </div>
                            
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Harga</label>
                                <input type="number" name="price" required min="0" step="100" class="custom-input w-full px-4 py-3 rounded-xl" value="${
                                  product.price
                                }">
                            </div>
                            
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Kategori</label>
                                <select name="category" required class="custom-input w-full px-4 py-3 rounded-xl">
                                    <option value="keychains" ${
                                      product.category === "keychains"
                                        ? "selected"
                                        : ""
                                    }>Gantungan Kunci</option>
                                    <option value="magnets" ${
                                      product.category === "magnets"
                                        ? "selected"
                                        : ""
                                    }>Magnet</option>
                                    <option value="postcards" ${
                                      product.category === "postcards"
                                        ? "selected"
                                        : ""
                                    }>Kartu Pos</option>
                                    <option value="clothing" ${
                                      product.category === "clothing"
                                        ? "selected"
                                        : ""
                                    }>Pakaian</option>
                                    <option value="mugs" ${
                                      product.category === "mugs"
                                        ? "selected"
                                        : ""
                                    }>Mug & Gelas</option>
                                </select>
                            </div>
                            
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Stok</label>
                                <input type="number" name="stock" required min="0" class="custom-input w-full px-4 py-3 rounded-xl" value="${
                                  product.stock
                                }">
                            </div>
                        </div>
                        
                        <div class="flex space-x-3 mt-6">
                            <button type="button" onclick="this.closest('.fixed').remove()" class="flex-1 px-4 py-3 border border-gray-300 rounded-xl text-gray-700 hover:bg-gray-50 transition-colors font-medium">
                                Batal
                            </button>
                            <button type="submit" class="flex-1 px-4 py-3 bg-gradient-to-r from-blue-500 to-blue-600 text-white rounded-xl hover:from-blue-600 hover:to-blue-700 transition-colors font-medium">
                                Update Produk
                            </button>
                        </div>
                    </form>
                </div>
            `;
  document.body.appendChild(modal);
}

function updateProduct(event, productId) {
  event.preventDefault();
  const formData = new FormData(event.target);

  const productIndex = products.findIndex((p) => p.id === productId);
  if (productIndex === -1) return;

  const updatedProduct = {
    ...products[productIndex],
    code: formData.get("code"),
    name: formData.get("name"),
    price: parseInt(formData.get("price")),
    category: formData.get("category"),
    stock: parseInt(formData.get("stock")),
  };

  // Check if code already exists (excluding current product)
  if (
    products.some((p) => p.code === updatedProduct.code && p.id !== productId)
  ) {
    showNotification("Kode produk sudah ada!", "error");
    return;
  }

  products[productIndex] = updatedProduct;
  filteredProducts = [...products];
  renderProducts();

  // Close modal
  event.target.closest(".fixed").remove();
  showNotification("Produk berhasil diupdate!", "success");
}

function deleteProduct(productId) {
  const product = products.find((p) => p.id === productId);
  if (!product) return;

  const modal = document.createElement("div");
  modal.className =
    "fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 p-4";
  modal.innerHTML = `
                <div class="bg-white rounded-2xl p-6 max-w-sm w-full">
                    <div class="text-center">
                        <div class="w-16 h-16 bg-red-100 rounded-full flex items-center justify-center mx-auto mb-4">
                            <i class="fas fa-trash text-2xl text-red-600"></i>
                        </div>
                        <h3 class="text-lg font-bold text-gray-800 mb-2">Hapus Produk</h3>
                        <p class="text-gray-600 mb-6">Apakah Anda yakin ingin menghapus produk "${product.name}"? Tindakan ini tidak dapat dibatalkan.</p>
                        
                        <div class="flex space-x-3">
                            <button onclick="this.closest('.fixed').remove()" class="flex-1 px-4 py-3 border border-gray-300 rounded-xl text-gray-700 hover:bg-gray-50 transition-colors font-medium">
                                Batal
                            </button>
                            <button onclick="confirmDeleteProduct(${productId})" class="flex-1 px-4 py-3 bg-red-600 text-white rounded-xl hover:bg-red-700 transition-colors font-medium">
                                Hapus
                            </button>
                        </div>
                    </div>
                </div>
            `;
  document.body.appendChild(modal);
}

function confirmDeleteProduct(productId) {
  const productIndex = products.findIndex((p) => p.id === productId);
  if (productIndex === -1) return;

  products.splice(productIndex, 1);
  filteredProducts = [...products];

  // Adjust current page if necessary
  const totalPages = Math.ceil(filteredProducts.length / itemsPerPage);
  if (currentPage > totalPages && totalPages > 0) {
    currentPage = totalPages;
  }

  renderProducts();

  // Close modal
  document.querySelector(".fixed.inset-0").remove();
  showNotification("Produk berhasil dihapus!", "success");
}

function showNotification(message, type = "success") {
  const notification = document.createElement("div");
  notification.className = `fixed top-4 right-4 px-6 py-4 rounded-lg shadow-lg z-50 max-w-sm ${
    type === "success" ? "bg-green-500 text-white" : "bg-red-500 text-white"
  }`;
  notification.innerHTML = `
                <div class="flex items-center space-x-3">
                    <i class="fas ${
                      type === "success"
                        ? "fa-check-circle"
                        : "fa-exclamation-circle"
                    } text-lg"></i>
                    <span class="font-medium">${message}</span>
                </div>
            `;
  document.body.appendChild(notification);

  setTimeout(() => {
    notification.remove();
  }, 4000);
}

// Initialize the application
init();
// </script>
