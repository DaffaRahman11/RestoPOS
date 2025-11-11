<x-layout-admin>
              <div class="grid grid-cols-1 xl:grid-cols-3 gap-6">
            <!-- Products Section -->
            <div class="xl:col-span-2">
              <div class="glass-effect rounded-2xl p-6 shadow-xl">
                <!-- Header with Search and Filters -->
                <div class="flex flex-col sm:flex-row sm:items-center space-y-3 sm:space-y-0 sm:space-x-3 w-full mb-6">
                  <!-- Search Input -->
                  <div class="relative flex-1 w-full">
                    <input
                      type="text"
                      id="search-input"
                      placeholder="Cari Menu Berdasarkan Nama"
                      class="custom-input pl-10 pr-10 py-3 rounded-xl w-full text-sm"
                    />
                    <!-- Icon search -->
                    <i
                      class="fas fa-search absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"
                    ></i>
                    <!-- Icon X untuk clear -->
                    <button
                      type="button"
                      id="clear-search"
                      class="absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-400 hover:text-gray-600 hidden"
                    >
                      <i class="fas fa-times"></i>
                    </button>
                  </div>
                </div>
                <!-- Products Table -->
                <div class="overflow-x-auto rounded-xl shadow-sm">
                  <table class="w-full border-separate border-spacing-0 overflow-hidden rounded-xl shadow-sm">
                    <thead class="bg-gradient-to-r from-emerald-100 to-green-200 border-b border-emerald-300 shadow-sm ">
                      <tr>
                        <th
                          class="px-3 lg:px-6 py-3 lg:py-4 text-left text-xs lg:text-sm font-semibold text-emerald-800"
                        >
                          Nama Manu
                        </th>
                        <th
                          class="px-3 lg:px-6 py-3 lg:py-4 text-left text-xs lg:text-sm font-semibold text-emerald-800"
                        >
                          Harga
                        </th>
                        <th
                          class="px-3 lg:px-6 py-3 lg:py-4 text-left text-xs lg:text-sm font-semibold text-emerald-800"
                        >
                          Sisa Porsi
                        </th>
                        <th
                          class="px-3 lg:px-6 py-3 lg:py-4 text-center text-xs lg:text-sm font-semibold text-emerald-800"
                        >
                          Aksi
                        </th>
                      </tr>
                    </thead>
                    <tbody
                      id="products-table-body"
                      class="divide-y divide-gray-200"
                    >
                    </tbody>
                  </table>
                </div>
                <!-- Pagination -->
                <div id="pagination-container" class="pagination-container">
                  <!-- Pagination will be rendered here -->
                </div>
              </div>
            </div>
            <!-- Checkout Section -->
            <div class="xl:col-span-1">
              <form method="POST" action="/dashboard/transaction">
              @csrf
              <div class="glass-effect rounded-2xl p-6 shadow-xl">
                <div class="flex items-center mb-6">
                  <div
                    class="w-10 h-10 bg-gradient-to-br from-orange-500 to-orange-600 rounded-xl flex items-center justify-center text-white shadow-lg mr-4"
                  >
                    <i class="fas fa-cash-register text-lg"></i>
                  </div>
                  <h3 class="text-xl font-bold text-gray-800">Checkout</h3>
                </div>
                <!-- Checkout Items -->
                <div id="checkout-items" class="mb-6">
                  <!-- Default empty state -->
                  <div
                    id="empty-checkout"
                    class="text-center text-gray-500 py-8"
                  >
                    <div
                      class="w-16 h-16 bg-gradient-to-br from-emerald-100 to-emerald-200 rounded-2xl flex items-center justify-center mx-auto mb-4 shadow-lg"
                    >
                      <i
                        class="fas fa-shopping-cart text-2xl text-emerald-600"
                      ></i>
                    </div>
                    <p class="text-lg font-semibold text-gray-700 mb-2">
                      Belum ada item
                    </p>
                    <p class="text-sm text-gray-500">
                      Klik produk untuk menambahkan
                    </p>
                  </div>
                  <!-- Scrollable items container (hidden by default) -->
                  <div id="checkout-items-container" class="hidden">
                    <div
                      class="max-h-64 overflow-y-auto space-y-3 pr-2 scrollbar-thin scrollbar-thumb-emerald-300 scrollbar-track-emerald-100"
                    >
                      <div id="checkout-items-list" class="space-y-3">
                        <!-- Items will be rendered here -->
{{--                         <div class="checkout-item bg-gray-50 rounded-xl p-3 border border-gray-200 shadow-sm">
                          <div class="flex items-center justify-between mb-2">
                            <span class="font-medium text-gray-800 text-sm">
                              <!-- item.name -->
                            </span>
                            <button
                              class="text-red-500 hover:text-red-700 hover:bg-red-100 rounded-lg w-7 h-7 flex items-center justify-center transition-all duration-200 group"
                            >
                              <i class="fas fa-trash text-xs group-hover:scale-110 transition-transform"></i>
                            </button>
                          </div>

                          <div class="flex items-center justify-between">
                            <div class="flex items-center space-x-2">
                              <button
                                class="w-7 h-7 bg-emerald-200 hover:bg-emerald-300 rounded-lg text-xs font-bold transition-colors text-emerald-700 hover:text-emerald-800"
                              >
                                -
                              </button>

                              <input
                                type="number"
                                value="0"
                                min="0"
                                max="10"
                                placeholder="0"
                                class="w-12 h-7 text-center font-medium border border-gray-300 rounded-lg focus:border-emerald-500 focus:outline-none text-xs"
                              >

                              <button
                                class="w-7 h-7 bg-emerald-200 hover:bg-emerald-300 rounded-lg text-xs font-bold transition-colors text-emerald-700 hover:text-emerald-800"
                              >
                                +
                              </button>
                            </div>

                            <span class="font-semibold text-emerald-700 text-sm">
                              Rp0
                            </span>
                          </div>
                        </div> --}}
                      </div>
                    </div>
                  </div>
                </div>
                <input type="hidden" name="items" id="items-data">
                <!-- Payment Method -->
                <div class="mb-4">
                  <label class="block text-sm font-semibold text-gray-700 mb-3"
                    >Metode Pembayaran</label
                  >
                  <div class="custom-dropdown" id="payment-dropdown">
                    <button
                      type="button"
                      class="custom-dropdown-button w-full"
                      onclick="toggleDropdown('payment-dropdown')"
                    >
                      <span id="payment-selected">Tunai</span>
                      <i class="fas fa-chevron-down custom-dropdown-arrow"></i>
                    </button>
                    <div class="custom-dropdown-menu hidden">
                      <div
                        class="custom-dropdown-item"
                        onclick="selectPayment('cash', 'Tunai')"
                      >
                        <i
                          class="fas fa-money-bill-wave mr-2 text-green-600"
                        ></i>
                        Tunai
                      </div>
                      <div
                        class="custom-dropdown-item"
                        onclick="selectPayment('card', 'Kartu Kredit')"
                      >
                        <i class="fas fa-credit-card mr-2 text-blue-600"></i>
                        Kartu Kredit
                      </div>
                      <div
                        class="custom-dropdown-item"
                        onclick="selectPayment('debit', 'Kartu Debit')"
                      >
                        <i class="fas fa-credit-card mr-2 text-purple-600"></i>
                        Kartu Debit
                      </div>
                      <div
                        class="custom-dropdown-item"
                        onclick="selectPayment('ewallet', 'E-Wallet')"
                      >
                        <i class="fas fa-mobile-alt mr-2 text-orange-600"></i>
                        E-Wallet
                      </div>
                    </div>
                  </div>
                </div>
                <input type="hidden" id="payment-method" name="payment_method" value="cash">
                <!-- Amount Paid -->
                <div class="mb-4">
                  <label
                    for="amount-paid"
                    class="block text-sm font-semibold text-gray-700 mb-3"
                    >Jumlah Bayar</label
                  >
                  <div class="relative">
                    <span
                      class="absolute left-4 top-1/2 transform -translate-y-1/2 text-lg font-semibold text-gray-600"
                      >Rp</span
                    >
                    <input
                      type="text"
                      id="amount-paid"
                      placeholder="0"
                      class="custom-input w-full pl-12 pr-4 py-3 rounded-xl text-lg font-semibold text-right"
                      oninput="formatCurrencyInput(this)"
                      onkeypress="return isNumberKey(event)"
                    />
                  </div>
                </div>
                <!-- Totals -->
                <div
                  class="bg-gradient-to-r from-emerald-50 to-green-50 rounded-xl p-4 border border-emerald-200 mb-4"
                >
                  <div class="space-y-2">
                    <div class="flex justify-between text-sm">
                      <span class="text-gray-600">Total:</span>
                      <span
                        id="total-amount"
                        class="font-bold text-emerald-700 text-lg"
                        >Rp0</span
                      >
                    </div>
                    <div class="flex justify-between text-sm">
                      <span class="text-gray-600">Kembalian:</span>
                      <span
                        id="change-amount"
                        class="font-semibold text-gray-800"
                        >Rp0</span
                      >
                    </div>
                  </div>
                </div>
                <input type="hidden" name="total_price" id="total-data">
                <input type="hidden" name="paid_amount" id="amount-paid-data">
                <input type="hidden" name="change_amount" id="change-data">

                <!-- Pay Button -->
                <button
                  id="pay-button"
                  disabled
                  class="w-full px-6 py-4 bg-gradient-to-r from-emerald-500 to-emerald-600 hover:from-emerald-600 hover:to-emerald-700 disabled:from-gray-300 disabled:to-gray-400 disabled:cursor-not-allowed text-white rounded-xl transition-all duration-300 shadow-lg hover:shadow-xl font-bold text-lg"
                >
                  <i class="fas fa-credit-card mr-3"></i>
                  <span id="pay-button-text">Bayar Sekarang</span>
                </button>
              </div>
              </form>
            </div>
            
          </div>

          {{-- <script src="{{ asset('assets/js/scriptTransaction.js') }}"></script> --}}
</x-layout-admin>