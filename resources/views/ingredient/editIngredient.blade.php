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
                  Ubah Data Bahan Baku 
                </h2>
              </div>
              <div class="mb-8">
                <form method="POST" action="/dashboard/ingredient/{{ $ingredient->id }}">
                @csrf
                @method('PUT')
                <h3 class="text-lg font-semibold text-gray-700 mb-4">
                  Masukkan Perubahan Data Bahan Baku
                </h3>
                    <div class="mb-4">
                      <label class="block text-sm font-medium text-gray-700 mb-2"
                        >Nama Bahan Baku</label
                      >
                      <input
                        type="text"
                        required
                        placeholder="Ex : Gula"
                        class="custom-input w-full px-4 py-3 rounded-xl"
                        name="name"
                        value="{{ old('name', $ingredient->name) }}"
                      />
                    </div>
                    <div class="mb-4">
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
                        value="{{ old('stock', $ingredient->stock) }}"
                      />
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
                        Simpan Perubahan
                      </button>
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </section>
</x-layout-admin>