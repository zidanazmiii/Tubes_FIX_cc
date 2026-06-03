{{-- Menggunakan layout utama aplikasi --}}
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-[#a78bfa] leading-tight" style="font-family:'Poppins',Arial,sans-serif;">
            {{ __('Pilih Metode Pembayaran') }}
        </h2>
    </x-slot>
    <style>
        body {
            background: url('/images/bg-cake.jpg') no-repeat center center fixed;
            background-size: cover;
            font-family: 'Poppins', 'Segoe UI', Arial, sans-serif;
        }
        .bg-white {
            background: rgba(255,255,255,0.95) !important;
            border-radius: 18px;
            box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.18);
        }
        .text-indigo-600, .text-pink-600 {
            color: #a78bfa !important;
        }
        .bg-indigo-600, .bg-pink-500, .bg-purple-600, .bg-[#a78bfa] {
            background-color: #a78bfa !important;
            color: #fff !important;
            font-weight: bold !important;
        }
        .rounded, .rounded-md, .rounded-lg, .rounded-xl {
            border-radius: 18px !important;
        }
        .shadow, .shadow-md, .shadow-lg, .shadow-xl {
            box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.18) !important;
        }
        .hover\:bg-indigo-700:hover, .hover\:bg-pink-600:hover, .hover\:bg-purple-700:hover {
            background: #a78bfa !important;
            color: #fff !important;
        }
        .focus\:ring-indigo-500:focus, .focus\:ring-purple-400:focus {
            box-shadow: 0 0 0 2px #a78bfa !important;
        }
    </style>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 md:p-8 text-gray-900">
                    <h3 class="text-2xl font-semibold mb-6">Ringkasan Pesanan & Pembayaran</h3>

                    @if (session('error'))
                        <div class="mb-4 p-4 bg-red-100 border border-red-400 text-red-700 rounded">
                            {{ session('error') }}
                        </div>
                    @endif

                    {{-- Detail Pengiriman --}}
                    <div class="mb-6 border-b pb-4">
                        <h4 class="text-lg font-semibold mb-2">Detail Pengiriman:</h4>
                        <p><strong>Nama Penerima:</strong> {{ $shippingDetails['recipient_name'] }}</p>
                        <p><strong>No. Telepon:</strong> {{ $shippingDetails['recipient_phone'] }}</p>
                        <p><strong>Alamat:</strong> {{ $shippingDetails['shipping_address'] }}, {{ $shippingDetails['postal_code'] }}</p>
                        <a href="{{ route('checkout.shipping') }}" class="text-sm text-indigo-600 hover:underline mt-1 inline-block">Ubah Alamat</a>
                    </div>

                    {{-- Ringkasan Item Keranjang --}}
                    <div class="mb-6 border-b pb-4">
                        <h4 class="text-lg font-semibold mb-2">Item Pesanan:</h4>
                        @foreach ($cartItems as $item)
                            <div class="flex justify-between items-center py-2 border-t first:border-t-0">
                                <div>
                                    <p class="font-medium">{{ $item->product->name }} (x{{ $item->quantity }})</p>
                                    <p class="text-sm text-gray-600">Harga Satuan: Rp {{ number_format($item->product->price, 0, ',', '.') }}</p>
                                </div>
                                <p class="font-semibold">Rp {{ number_format($item->product->price * $item->quantity, 0, ',', '.') }}</p>
                            </div>
                        @endforeach
                        <div class="flex justify-between items-center mt-3 pt-3 border-t-2">
                            <p class="text-xl font-bold">Total Pesanan:</p>
                            <p class="text-xl font-bold">Rp {{ number_format($totalPrice, 0, ',', '.') }}</p>
                        </div>
                    </div>


                    {{-- Form Pemilihan Metode Pembayaran --}}
                    <form action="{{ route('checkout.process') }}" method="POST" id="payment-form">
                        @csrf
                        <h4 class="text-lg font-semibold mb-3">Pilih Metode Pembayaran:</h4>
                        <div class="space-y-4">
                            {{-- ContohA Metode Pembayaran - Anda perlu menyesuaikan ini --}}
                            <div>
                                <label for="payment_method_bank_transfer" class="flex items-center p-4 border rounded-lg cursor-pointer hover:bg-gray-50 transition-colors">
                                    <input type="radio" name="payment_method" id="payment_method_bank_transfer" value="bank_transfer" class="h-5 w-5 text-indigo-600 focus:ring-indigo-500 border-gray-300" checked>
                                    <span class="ml-3 block text-sm font-medium">
                                        Transfer Bank (Bank Account)
                                        <span class="block text-xs text-gray-500">Pembayaran melalui transfer ke nomor Bank (BCA).</span>
                                    </span>
                                </label>
                            </div>
                            <div>
                                <label for="payment_method_cod" class="flex items-center p-4 border rounded-lg cursor-pointer hover:bg-gray-50 transition-colors">
                                    <input type="radio" name="payment_method" id="payment_method_cod" value="cod" class="h-5 w-5 text-indigo-600 focus:ring-indigo-500 border-gray-300">
                                    <span class="ml-3 block text-sm font-medium">
                                        Bayar di Tempat (COD)
                                        <span class="block text-xs text-gray-500">Pembayaran dilakukan langsung kepada kurir saat pesanan tiba.</span>
                                    </span>
                                </label>
                            </div>
                            {{-- Tambahkan metode pembayaran lain jika ada (misalnya e-wallet, kartu kredit - memerlukan integrasi payment gateway) --}}
                        </div>
                        @error('payment_method')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror

                        <div class="mt-8 flex flex-col sm:flex-row justify-between items-center">
                            <a href="{{ route('checkout.shipping') }}" class="mb-4 sm:mb-0 text-indigo-600 hover:underline">
                                &larr; Kembali ke Detail Pengiriman
                            </a>
                            <button type="submit"
                                    class="w-full sm:w-auto inline-flex items-center justify-center px-8 py-3 bg-green-600 hover:bg-green-700 border border-transparent rounded-md font-bold text-base text-white uppercase tracking-widest focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 transition ease-in-out duration-150">
                                Bayar Sekarang
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
