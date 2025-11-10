<x-layout-admin>
          <section id="forms" class="mb-12">
            <div class="glass-effect rounded-2xl p-6 shadow-xl">
              <div class="flex items-center mb-6">
                <div
                  class="w-10 h-10 bg-gradient-to-br from-green-500 to-green-600 rounded-xl flex items-center justify-center text-white shadow-lg mr-4"
                >
                  <i class="fa-solid fa-boxes-packing text-lg"></i>
                </div>
                <h2 class="text-2xl font-bold text-gray-800">
                  Tambah Data Produk 
                </h2>
              </div>
              <!-- Medium Form Card -->
              <div class="mb-8">
                <form method="POST" action="/dashboard/product">
                @csrf
                <h3 class="text-lg font-semibold text-gray-700 mb-4">
                  Masukkan Data Produk Baru
                </h3>
                  <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                    <div>
                      <label
                        class="block text-sm font-medium text-gray-700 mb-2"
                        >Barcode (Kode Produk)</label
                      >
                      <input
                        type="text"
                        required
                        autofocus
                        placeholder="Ex : 012356789"
                        class="custom-input w-full px-4 py-3 rounded-xl"
                        name="barcode"
                      />
                    </div>
                    <div>
                      <label
                        class="block text-sm font-medium text-gray-700 mb-2"
                        >Pilih Kategori</label
                      >
                      <select
                            class="custom-input w-full px-4 py-3 rounded-xl"
                            name ="category_id"
                            required
                          >
                          <option disabled selected>Pilih Kategori</option>
                          @foreach ($categories as $category )  
                          <option value="{{ $category->id }}">{{ $category->name }}</option>
                          @endforeach
                      </select>
                    </div>
                  </div>
                  <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-2"
                      >Nama Produk</label
                    >
                    <input
                      type="text"
                      required
                      placeholder="Ex : Tape Bondowoso"
                      class="custom-input w-full px-4 py-3 rounded-xl"
                      name="name"
                    />
                  </div>
                  <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-4">
                    <div>
                      <label
                        class="block text-sm font-medium text-gray-700 mb-2"
                        >Harga Beli</label
                      >
                      <input
                        type="text"
                        required
                        placeholder="Rp."
                        class="custom-input w-full px-4 py-3 rounded-xl"
                        name="purchase_price"
                      />
                    </div>
                    <div>
                      <label
                        class="block text-sm font-medium text-gray-700 mb-2"
                        >Harga Jual</label
                      >
                      <input
                        type="text"
                        required
                        placeholder="Rp."
                        class="custom-input w-full px-4 py-3 rounded-xl"
                        name="selling_price"
                      />
                    </div>
                    <div>
                      <label
                        class="block text-sm font-medium text-gray-700 mb-2"
                        >Stock</label
                      >
                      <input
                        type="text"
                        required
                        placeholder="Ex : 30"
                        class="custom-input w-full px-4 py-3 rounded-xl"
                        name="stock"
                      />
                    </div>
                  </div>
                  <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                    <div>
                      <button type="reset"
                        class="w-full px-6 py-3 bg-gradient-to-r from-white-500 to-white-600 border-2 border-red-500 text-red-600 hover:text-white rounded-xl hover:from-red-600 hover:to-red-700 transition-all duration-300 shadow-lg font-semibold"
                      >
                        Reset
                      </button>
                    </div>
                    <div>
                      <button type="submit"
                        class="w-full px-6 py-3 bg-gradient-to-r from-blue-500 to-blue-600  text-white rounded-xl hover:from-blue-600 hover:to-blue-700 transition-all duration-300 shadow-lg font-semibold"
                      >
                        Simpan Produk
                      </button>
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </section>
</x-layout-admin>