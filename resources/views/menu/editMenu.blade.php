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
                  Ubah Data Menu 
                </h2>
              </div>
              @foreach (['success', 'error'] as $msg)
                  @if (session($msg))
                      <div class="bg-{{ $msg == 'success' ? 'green' : 'red' }}-50 border border-{{ $msg == 'success' ? 'green' : 'red' }}-200 rounded-xl p-4 alert-animation mb-4">
                          <div class="flex items-start">
                              <div class="w-6 h-6 bg-{{ $msg == 'success' ? 'green' : 'red' }}-500 rounded-full flex items-center justify-center text-white mr-3 mt-0.5">
                                  <i class="fas fa-{{ $msg == 'success' ? 'check' : 'times' }} text-xs"></i>
                              </div>
                              <div class="flex-1">
                                  <h4 class="font-semibold text-{{ $msg == 'success' ? 'green' : 'red' }}-800 mb-1">
                                      {{ ucfirst($msg) }}!
                                  </h4>
                                  <p class="text-sm text-{{ $msg == 'success' ? 'green' : 'red' }}-700">
                                      {{ session($msg) }}
                                  </p>
                              </div>
                              <button class="text-{{ $msg == 'success' ? 'green' : 'red' }}-600 hover:text-{{ $msg == 'success' ? 'green' : 'red' }}-800 ml-3"
                              onclick="this.closest('div.bg-{{ $msg == 'success' ? 'green' : 'red' }}-50').remove()"
                              >
                                  <i class="fas fa-times"></i>
                              </button>
                          </div>
                      </div>
                  @endif
              @endforeach
              <!-- Medium Form Card -->
              <div class="mb-8" 
                  x-data="{
                      ingredients: @json(count($ingredientsData) ? $ingredientsData->toArray() : [['ingredient_id' => '', 'quantity_used' => '']])
                  }">
                  <form method="POST" action="/dashboard/menu/{{ $menu->id }}">
                      @csrf
                      @method('PUT')

                      <h3 class="text-lg font-semibold text-gray-700 mb-4">
                          Masukkan Perubahan Data Menu
                      </h3>

                      {{-- Nama & Harga Menu --}}
                      <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
                          <div>
                              <label class="block text-sm font-medium text-gray-700 mb-2">Nama Menu</label>
                              <input
                                  type="text"
                                  name="name"
                                  required
                                  value="{{ old('name', $menu->name) }}"
                                  placeholder="Ex: Nasi Goreng"
                                  class="custom-input w-full px-4 py-3 rounded-xl"
                              />
                          </div>
                          <div>
                              <label class="block text-sm font-medium text-gray-700 mb-2">Harga Menu</label>
                              <input
                                  type="number"
                                  name="price"
                                  required
                                  value="{{ old('price', $menu->price) }}"
                                  placeholder="Rp."
                                  class="custom-input w-full px-4 py-3 rounded-xl"
                              />
                          </div>
                      </div>

                      {{-- Dinamis Input Bahan Baku --}}
                      <template x-for="(row, index) in ingredients" :key="index">
                          <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                              <div>
                                  <label class="block text-sm font-medium text-gray-700 mb-2">Pilih Bahan Baku</label>
                                  <select
                                      class="custom-input w-full px-4 py-3 rounded-xl"
                                      x-model="row.ingredient_id"
                                      :name="'ingredients[' + index + '][ingredient_id]'"
                                      required
                                  >
                                      <option disabled value="">Pilih Bahan Baku</option>
                                      @foreach ($allIngredients as $ingredient)
                                          <option 
                                              :value="{{ json_encode($ingredient->id) }}" 
                                              x-bind:selected="row.ingredient_id == {{ json_encode($ingredient->id) }}"
                                          >
                                              {{ $ingredient->name }}
                                          </option>
                                      @endforeach
                                  </select>
                              </div>
                              <div>
                                  <label class="block text-sm font-medium text-gray-700 mb-2">Jumlah Bahan Baku</label>
                                  <input
                                      type="number"
                                      placeholder="Ex: 30"
                                      class="custom-input w-full px-4 py-3 rounded-xl"
                                      x-model="row.quantity_used"
                                      :name="'ingredients[' + index + '][quantity_used]'"
                                      required
                                  />
                              </div>
                          </div>
                      </template>

                      {{-- Tombol Tambah & Hapus --}}
                      <div class="flex gap-4 mb-6">
                          <button
                              type="button"
                              @click="ingredients.push({ ingredient_id: '', quantity_used: '' })"
                              class="px-6 py-2 bg-gradient-to-r from-blue-500 to-blue-600 text-white text-sm rounded-xl hover:from-blue-600 hover:to-blue-700 transition-all duration-300 shadow-md font-medium flex items-center gap-2"
                          >
                              <i class="fa-solid fa-plus"></i> Tambah Bahan Baku
                          </button>

                          <button
                              type="button"
                              @click="if (ingredients.length > 1) ingredients.pop()"
                              class="px-6 py-2 bg-gradient-to-r from-red-500 to-red-600 text-white text-sm rounded-xl hover:from-red-600 hover:to-red-700 transition-all duration-300 shadow-md font-medium flex items-center gap-2"
                          >
                              <i class="fa-solid fa-minus"></i> Hapus Baris Terakhir
                          </button>
                      </div>

                      {{-- Tombol Submit & Reset --}}
                      <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                          <div></div>
                          <div></div>
                          <div>
                              <button
                                  type="reset"
                                  class="w-full px-6 py-3 border-2 border-red-500 text-red-600 hover:text-white rounded-xl hover:bg-red-600 transition-all duration-300 shadow-lg font-semibold"
                              >
                                  Reset
                              </button>
                          </div>
                          <div>
                              <button
                                  type="submit"
                                  class="w-full px-6 py-3 bg-gradient-to-r from-green-500 to-green-600 text-white rounded-xl hover:from-green-600 hover:to-green-700 transition-all duration-300 shadow-lg font-semibold"
                              >
                                  Simpan Menu
                              </button>
                          </div>
                      </div>
                  </form>
              </div>

              {{-- Pastikan Alpine.js sudah terpasang --}}
              <script src="//unpkg.com/alpinejs" defer></script>
            </div>
          </section>
</x-layout-admin>