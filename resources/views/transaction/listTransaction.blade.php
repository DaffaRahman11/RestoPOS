<x-layout-admin>
          -xl shadow-lg overflow-hidden"
                  ><section id="tables" class="mb-12">
            <div class="glass-effect rounded-2xl p-6 shadow-xl">
              <div class="flex items-center mb-6">
                <div
                  class="w-10 h-10 bg-gradient-to-br from-green-500 to-green-600 rounded-xl flex items-center justify-center text-white shadow-lg mr-4"
                >
                  <i class="fa-solid fa-boxes-packing text-lg"></i>
                </div>
                <h2 class="text-2xl font-bold text-gray-800">
                  Data Transaksi 
                </h2>
                <a class="ml-auto px-3 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600 transition-colors text-sm font-medium" href="/dashboard/transaction/create"
                  >
                    <i class="fas fa-plus mr-2"></i>Tambah Transaksi Baru
                </a>
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
                  
              <!-- Large Table -->
              <div>
                <h3 class="text-lg font-semibold text-gray-700 mb-4">
                  Data Transaksi Yang Telah Dilakukan
                </h3>
                <div class="overflow-x-auto">
                  <table
                    class="w-full bg-white rounded
                    <thead class="bg-gradient-to-r from-emerald-50 to-green-50">
                      <tr>
                        <th
                          class="px-6 py-4 text-left text-sm font-semibold text-emerald-800"
                        >
                          Kode Transaksi
                        </th>
                        <th
                          class="px-6 py-4 text-left text-sm font-semibold text-emerald-800"
                        >
                          Total Transaksi
                        </th>
                        <th
                          class="px-6 py-4 text-left text-sm font-semibold text-emerald-800"
                        >
                          Metode Pembayaran
                        </th>
                        <th
                          class="px-6 py-4 text-left text-sm font-semibold text-emerald-800"
                        >
                          Dibuat Oleh
                        </th>
                        <th
                          class="px-6 py-4 text-left text-sm font-semibold text-emerald-800"
                        >
                          Waktu
                        </th>
                      </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                      @foreach ( $transactions as $transaction )
                      <tr class="table-row-hover">
                        <td class="px-6 py-4 text-sm font-medium text-gray-800">
                          {{ $transaction->transaction_code }}
                        </td>
                        <td class="px-6 py-4 text-sm font-medium text-gray-800">
                          {{ $transaction->total_price }}
                        </td>
                        <td class="px-6 py-4 text-sm font-medium text-gray-800">
                          {{ $transaction->payment_method }}
                        </td>
                        <td class="px-6 py-4 text-sm font-medium text-gray-800">
                          {{ $transaction->user_id }}
                        </td>
                        <td class="px-6 py-4 text-sm font-medium text-gray-800">
                          {{ $transaction->created_at }}
                        </td>
                      </tr>
                      @endforeach
                    </tbody> 
                  </table>
                </div>
              </div>
            </div>
          </section>
</x-layout-admin>