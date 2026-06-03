<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-[#a78bfa] leading-tight">
            {{ __('Unggah Bukti Pembayaran') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h3 class="text-2xl font-semibold mb-6">Unggah Bukti Pembayaran</h3>

                    <p class="mb-4">Nomor Pesanan: <strong>{{ $order->order_number }}</strong></p>
                    <p class="mb-6">Total Pembayaran: <strong>Rp {{ number_format($order->total_amount, 0, ',', '.') }}</strong></p>

                    @if($order->payment_method === 'bank_transfer')
                        <div class="mb-6 p-4 bg-indigo-50 dark:bg-indigo-900 rounded-lg border border-indigo-200 dark:border-indigo-700">
                            <h4 class="font-semibold text-indigo-800 dark:text-indigo-200">Instruksi Pembayaran (Transfer Bank)</h4>
                            <p class="text-sm text-indigo-700 dark:text-indigo-300 mt-1">
                                Silakan lakukan pembayaran ke nomor Bank Account berikut: <br>
                                <strong class="text-lg">336011567838233</strong> <br>
                                Atas nama: Tengku Muhammad Fathan <br>
                                Mohon selesaikan pembayaran dalam 1x24 jam.
                            </p>
                        </div>
                    @elseif($order->payment_method === 'cod')
                        <div class="mb-6 p-4 bg-blue-50 dark:bg-blue-900 rounded-lg border border-blue-200 dark:border-blue-700">
                            <h4 class="font-semibold text-blue-800 dark:text-blue-200">Instruksi Pembayaran (Bayar di Tempat)</h4>
                            <p class="text-sm text-blue-700 dark:text-blue-300 mt-1">
                                Silakan siapkan uang tunai sejumlah <strong class="text-lg">Rp {{ number_format($order->total_amount, 0, ',', '.') }}</strong> untuk dibayarkan kepada kurir saat pesanan tiba.
                            </p>
                        </div>
                    @endif

                    <form action="{{ route('checkout.storeProof', $order->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-4">
                            <label for="payment_proof" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Unggah Bukti Pembayaran <span class="text-red-500">*</span></label>
                            <input type="file" name="payment_proof" id="payment_proof"
                                   class="mt-1 block w-full border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm"
                                   required>
                            @error('payment_proof')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mt-6 flex justify-between">
                            <a href="{{ route('home') }}" class="inline-flex items-center px-6 py-3 bg-gray-300 hover:bg-gray-400 border border-transparent rounded-md font-bold text-base text-gray-800 uppercase tracking-widest focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 transition ease-in-out duration-150">
                                Kembali ke Beranda
                            </a>
                            <button type="submit"
                                    class="inline-flex items-center px-6 py-3 bg-indigo-600 hover:bg-indigo-700 border border-transparent rounded-md font-bold text-base text-white uppercase tracking-widest focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition ease-in-out duration-150">
                                Unggah Bukti
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
