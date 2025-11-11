<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Dashboard Admin - RESTO POS</title>
  <script src="/_sdk/element_sdk.js"></script>
  <script src="https://cdn.tailwindcss.com"></script>
  <link
    href="https://fonts.googleapis.com/css2?family=Geist:wght@300;400;500;600;700;800&amp;family=Geist+Mono:wght@400;500;600&amp;display=swap"
    rel="stylesheet" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />
  <link rel="stylesheet" href="{{asset('assets/css/style.css')}}" />
  <style>
    @view-transition {
      navigation: auto;
    }

.custom-input {
    width: 100%;
    padding: 0.75rem 1rem;
    border-radius: 1rem;
    border: 2px solid rgba(16, 185, 129, 0.15);
    background: white;
    color: #374151;
    font-weight: 600;
}

.custom-input:focus {
    outline: none;
    border-color: #10b981;
}

#notification-dropdown,
#profile-dropdown {
  position: absolute;
  z-index: 9999 !important;
}

  </style>
  <script src="/_sdk/data_sdk.js" type="text/javascript"></script>
</head>

<body id="{{ Route::is('transaction.create') ? 'page-transaction' : '' }}" class="gradient-bg min-h-full font-sans">
  <!-- Notification Dropdown -->
  <div id="notification-dropdown"
                class="absolute right-0 mt-2 w-80 bg-white rounded-2xl shadow-2xl border border-emerald-100 z-[9999] hidden">

                <div class="p-4 border-b border-emerald-100 bg-gradient-to-r from-emerald-50 to-white">
                  <h3 class="font-bold text-emerald-700">Notifications</h3>
                </div>
                <div class="max-h-64 overflow-y-auto">
                  <div class="p-4 border-b border-emerald-100 transition-colors opacity-50 cursor-not-allowed">
                    <div class="flex items-start space-x-3">
                      <div
                        class="w-3 h-3 bg-gradient-to-r from-emerald-500 to-emerald-600 rounded-full mt-2 flex-shrink-0 shadow-lg">
                      </div>
                      <div>
                        <p class="text-sm font-semibold text-gray-800">Low Stock Alert</p>
                        <p class="text-xs text-gray-600">Lighthouse Keychain is running low (2 items left)</p>
                        <p class="text-xs text-emerald-600 mt-1 font-medium">2 minutes ago</p>
                      </div>
                    </div>
                  </div>

                  <div class="p-4 border-b border-emerald-100 transition-colors opacity-50 cursor-not-allowed">
                    <div class="flex items-start space-x-3">
                      <div
                        class="w-3 h-3 bg-gradient-to-r from-emerald-500 to-emerald-600 rounded-full mt-2 flex-shrink-0 shadow-lg">
                      </div>
                      <div>
                        <p class="text-sm font-semibold text-gray-800">Payment Received</p>
                        <p class="text-xs text-gray-600">Transaction #1234 completed successfully</p>
                        <p class="text-xs text-emerald-600 mt-1 font-medium">15 minutes ago</p>
                      </div>
                    </div>
                  </div>

                  <div class="p-4 transition-colors opacity-50 cursor-not-allowed">
                    <div class="flex items-start space-x-3">
                      <div
                        class="w-3 h-3 bg-gradient-to-r from-emerald-500 to-emerald-600 rounded-full mt-2 flex-shrink-0 shadow-lg">
                      </div>
                      <div>
                        <p class="text-sm font-semibold text-gray-800">Daily Report Ready</p>
                        <p class="text-xs text-gray-600">Your daily sales report is ready for review</p>
                        <p class="text-xs text-emerald-600 mt-1 font-medium">1 hour ago</p>
                      </div>
                    </div>
                  </div>

                </div>
                <div class="p-4 border-t border-emerald-100 bg-emerald-50">
                  <button class="text-sm text-emerald-700 hover:text-emerald-800 font-semibold">
                    View All Notifications
                  </button>
                </div>
  </div>
  <!-- Profile Dropdown -->
  <div id="profile-dropdown"
                class="absolute right-0 mt-2 w-56 bg-white rounded-2xl shadow-2xl border border-emerald-100 z-50 hidden">
                <div class="p-4 border-b border-emerald-100 bg-gradient-to-r from-emerald-50 to-white">
                  <div class="flex items-center space-x-3">
                    <div
                      class="w-12 h-12 bg-gradient-to-br from-emerald-500 to-emerald-600 rounded-2xl flex items-center justify-center text-white font-bold shadow-xl">
                      JD
                    </div>
                    <div>
                      <p class="font-semibold text-gray-800">John Doe</p>
                      <p class="text-xs text-emerald-600 font-medium">
                        john.doe@shop.com
                      </p>
                    </div>
                  </div>
                </div>
                <div class="py-2">
                  <a href="#"
                    class="flex items-center space-x-3 px-4 py-3 text-sm text-gray-700 opacity-50 cursor-not-allowed  transition-colors font-medium">
                    <i class="fas fa-user-cog text-sm text-emerald-600"></i>
                    <span>Account Settings</span>
                  </a>
                  <a href="#"
                    class="flex items-center space-x-3 px-4 py-3 text-sm text-gray-700 opacity-50 cursor-not-allowed transition-colors font-medium">
                    <i class="fas fa-sliders-h text-sm text-emerald-600"></i>
                    <span>Preferences</span>
                  </a>
                </div>
                <div class="border-t border-emerald-100 py-2">
                  <button onclick="logout()"
                    class="flex items-center space-x-3 px-4 py-3 text-sm text-red-600 hover:bg-red-50 transition-colors w-full text-left font-medium">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewbox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1">
                      </path>
                    </svg><span>Logout</span>
                  </button>
                </div>
  </div>
  <div class="flex h-full">
    <!-- Sidebar -->
    <div id="sidebar"
      class="sidebar-transition bg-white sidebar-bg shadow-2xl border-r border-emerald-100 w-64 flex-shrink-0 z-20 fixed lg:relative lg:translate-x-0 h-full lg:h-auto -translate-x-full lg:w-64">
      <div class="p-6 border-b border-emerald-100 bg-gradient-to-r from-emerald-50 to-white">
        <div class="flex items-center space-x-3 cursor-pointer" id="logo-header" onclick="toggleSidebar()">
          <div
            class="w-12 h-12 bg-gradient-to-br from-emerald-500 to-emerald-600 rounded-2xl flex items-center justify-center text-white shadow-xl">
            <i class="fas fa-store text-xl"></i>
          </div>
          <div>
            <h1 id="shop-title"
              class="text-2xl font-bold bg-gradient-to-r from-emerald-600 to-emerald-700 bg-clip-text text-transparent">
              Treasure Cove
            </h1>
            <p class="text-emerald-600 text-sm font-semibold">
              Souvenir Shop POS
            </p>
          </div>
        </div>
      </div>
      <nav class="p-5 space-y-2">
        <!-- Menu Transaksi -->
        <div class="pos-menu">
          <button onclick="togglePOSDropdown(this)"
            class="flex items-center justify-between w-full p-4 rounded-2xl bg-gradient-to-r from-emerald-100 to-emerald-50 text-emerald-700 font-semibold hover:from-emerald-200 hover:to-emerald-100 transition-all duration-300 shadow-lg hover:shadow-xl group border border-emerald-200">
            <div class="flex items-center space-x-4">
              <div class="w-10 h-10 bg-gradient-to-br from-emerald-500 to-emerald-600 rounded-2xl flex items-center justify-center text-white shadow-lg group-hover:shadow-xl transition-all duration-300">
                <i class="fas fa-cash-register text-sm"></i>
              </div>
              <span class="text-sm font-bold tracking-tight">Transaksi</span>
            </div>
            <i class="fas fa-chevron-down pos-arrow text-sm transition-transform duration-300 text-emerald-600"></i>
          </button>
          <div class="pos-dropdown ml-12 mt-3 space-y-2 hidden">
            <a href="/dashboard/transaction"
              class="flex items-center space-x-3 p-3 rounded-xl text-gray-700 hover:bg-emerald-50 hover:text-emerald-700 transition-all duration-200 text-sm font-semibold group border border-transparent hover:border-emerald-200">
              <span>Daftar Transaksi</span>
            </a>
            <a href="/dashboard/transaction/create"
              class="flex items-center space-x-3 p-3 rounded-xl text-gray-700 hover:bg-emerald-50 hover:text-emerald-700 transition-all duration-200 text-sm font-semibold group border border-transparent hover:border-emerald-200">
              <span>Tambah Transaksi</span>
            </a>
          </div>
        </div>

        <!-- Menu Ingredient -->
        <div class="pos-menu">
          <button onclick="togglePOSDropdown(this)"
            class="flex items-center justify-between w-full p-4 rounded-2xl bg-gradient-to-r from-emerald-100 to-emerald-50 text-emerald-700 font-semibold hover:from-emerald-200 hover:to-emerald-100 transition-all duration-300 shadow-lg hover:shadow-xl group border border-emerald-200">
            <div class="flex items-center space-x-4">
              <div class="w-10 h-10 bg-gradient-to-br from-emerald-500 to-emerald-600 rounded-2xl flex items-center justify-center text-white shadow-lg group-hover:shadow-xl transition-all duration-300">
                <i class="fas fa-leaf text-sm"></i>
              </div>
              <span class="text-sm font-bold tracking-tight">Bahan Baku</span>
            </div>
            <i class="fas fa-chevron-down pos-arrow text-sm transition-transform duration-300 text-emerald-600"></i>
          </button>
          <div class="pos-dropdown ml-12 mt-3 space-y-2 hidden">
            <a href="/dashboard/ingredient"
              class="flex items-center space-x-3 p-3 rounded-xl text-gray-700 hover:bg-emerald-50 hover:text-emerald-700 transition-all duration-200 text-sm font-semibold group border border-transparent hover:border-emerald-200">
              <span>Daftar Bahan Baku</span>
            </a>
            <a href="/dashboard/ingredient/create"
              class="flex items-center space-x-3 p-3 rounded-xl text-gray-700 hover:bg-emerald-50 hover:text-emerald-700 transition-all duration-200 text-sm font-semibold group border border-transparent hover:border-emerald-200">
              <span>Tambah Bahan Baku</span>
            </a>
          </div>
        </div>

        <!-- Menu Menu -->
        <div class="pos-menu">
          <button onclick="togglePOSDropdown(this)"
            class="flex items-center justify-between w-full p-4 rounded-2xl bg-gradient-to-r from-emerald-100 to-emerald-50 text-emerald-700 font-semibold hover:from-emerald-200 hover:to-emerald-100 transition-all duration-300 shadow-lg hover:shadow-xl group border border-emerald-200">
            <div class="flex items-center space-x-4">
              <div class="w-10 h-10 bg-gradient-to-br from-emerald-500 to-emerald-600 rounded-2xl flex items-center justify-center text-white shadow-lg group-hover:shadow-xl transition-all duration-300">
                <i class="fas fa-utensils text-sm"></i>
              </div>
              <span class="text-sm font-bold tracking-tight">Menu</span>
            </div>
            <i class="fas fa-chevron-down pos-arrow text-sm transition-transform duration-300 text-emerald-600"></i>
          </button>
          <div class="pos-dropdown ml-12 mt-3 space-y-2 hidden">
            <a href="/dashboard/menu"
              class="flex items-center space-x-3 p-3 rounded-xl text-gray-700 hover:bg-emerald-50 hover:text-emerald-700 transition-all duration-200 text-sm font-semibold group border border-transparent hover:border-emerald-200">
              <span>Daftar Menu</span>
            </a>
            <a href="/dashboard/menu/create"
              class="flex items-center space-x-3 p-3 rounded-xl text-gray-700 hover:bg-emerald-50 hover:text-emerald-700 transition-all duration-200 text-sm font-semibold group border border-transparent hover:border-emerald-200">
              <span>Tambah Menu</span>
            </a>
          </div>
        </div>
      </nav>

    </div>
    <!-- Main Content -->
    <div id="main-content" class="flex-1 flex flex-col min-w-0 transition-all duration-300 w-full">
      <!-- Header -->
      <header class="glass-effect p-5 border-b border-emerald-100">
        <div class="flex items-center justify-between">
          <div class="flex items-center space-x-4">
            <!-- Sidebar Toggle Button -->
            <button id="sidebar-toggle-btn"
              class="p-3 rounded-2xl bg-emerald-600 hover:bg-emerald-700 text-white transition-all duration-300 shadow-lg border-2 border-emerald-500 transform hover:scale-105"
              onclick="toggleSidebar()">
              <i id="sidebar-toggle-icon" class="fas fa-bars text-lg"></i>
            </button>
            <h2
              class="text-xl lg:text-2xl font-bold bg-gradient-to-r from-emerald-600 to-emerald-700 bg-clip-text text-transparent">
              Point of Sale - Cashier
            </h2>
          </div>
          <div class="flex items-center space-x-4">
            <div class="text-sm text-gray-600 text-right hidden sm:block">
              <div id="current-date" class="font-medium"></div>
              <div id="current-time" class="text-xs"></div>
            </div>
            <!-- Notification Icon -->
            <div class="relative">
              <button id="notification-btn"
                class="p-3 rounded-2xl hover:bg-emerald-100 text-emerald-700 transition-colors relative shadow-lg"
                onclick="toggleNotifications()">
                <i class="fas fa-bell text-lg"></i>
                <!-- Notification Badge -->
                <span
                  class="absolute -top-1 -right-1 bg-gradient-to-r from-emerald-500 to-emerald-600 text-white text-xs rounded-full w-6 h-6 flex items-center justify-center shadow-xl">3</span>
              </button>
            </div>
            <!-- User Profile -->
            <div class="relative">
              <button id="profile-btn"
                class="flex items-center space-x-3 p-3 rounded-2xl hover:bg-emerald-100 transition-colors shadow-lg border border-emerald-200"
                onclick="toggleProfileMenu()">
                <div
                  class="w-10 h-10 bg-gradient-to-br from-emerald-500 to-emerald-600 rounded-2xl flex items-center justify-center text-white text-sm font-bold shadow-xl">
                  JD
                </div>
                <div class="text-left hidden sm:block">
                  <p class="text-sm font-semibold text-gray-800">John Doe</p>
                  <p class="text-xs text-emerald-600 font-medium">Manager</p>
                </div>
                <i class="fas fa-chevron-down text-xs text-emerald-600"></i>
              </button>
            </div>
          </div>
        </div>
      </header>
      <div class="flex-1 p-4 lg:p-6">
        <!-- Main POS Interface -->
        {{ $slot }}
      </div>
    </div>
  </div>
           
  <div id="alert-container" class="alert-container"></div>
  </div>
  <div id="logout-modal" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
    <div class="bg-white rounded-lg p-6 max-w-sm mx-4">
        <h3 class="text-lg font-semibold text-gray-800 mb-4">Confirm Logout</h3>
        <p class="text-gray-600 mb-6">Are you sure you want to logout?</p>
        <div class="flex space-x-3">
            <button onclick="document.getElementById('logout-modal').classList.add('hidden')" 
                    class="flex-1 px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition-colors">
                Cancel
            </button>
            <form method="POST" action="/logout" class="flex-1">
                @csrf
                <button type="submit" class="w-full px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition-colors">
                    Logout
                </button>
            </form>
        </div>
    </div>
</div>


{{--   <script src="{{ asset(Route::is('dashboard.transactions.create') ? 'assets/js/scriptTransaction.js' : 'assets/js/script.js') }}"></script> --}} 
{{--   <script src="{{ asset('assets/js/scriptTransaction.js') }}"></script>  --}}
  <script src="{{ asset('assets/js/script.js') }}"></script>
  <script src="{{ asset('assets/js/scriptTransaction.js') }}"></script>
  <script>
    document.addEventListener("DOMContentLoaded", function() {
      @if (session('success'))
        showToastCustom({ ...alerts.success, message: "{{ session('success') }}" });
      @elseif (session('error'))
        showToastCustom({ ...alerts.error, message: "{{ session('error') }}" });
      @elseif (session('warning'))
        showToastCustom({ ...alerts.warning, message: "{{ session('warning') }}" });
      @elseif (session('info'))
        showToastCustom({ ...alerts.info, message: "{{ session('info') }}" });
      @endif
    });
  </script>
  

</body>



</html>