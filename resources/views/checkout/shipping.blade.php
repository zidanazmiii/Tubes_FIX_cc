{{-- Menggunakan layout utama aplikasi --}}
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-[#a78bfa] leading-tight" style="font-family:'Poppins',Arial,sans-serif;">
            {{ __('Detail Pengiriman') }}
        </h2>
    </x-slot>
    <style>
        body {
            background: url('/images/bg-cake.jpg') no-repeat center center fixed;
            background-size: cover;
            font-family: 'Poppins', 'Segoe UI', Arial, sans-serif;
        }
        .bg-white, .dark\:bg-gray-800 {
            background: rgba(255,255,255,0.95) !important;
            border-radius: 18px;
            box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.18);
        }
        .text-indigo-600, .dark\:text-indigo-400, .text-pink-600, .dark\:text-pink-400 {
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
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 md:p-8 text-gray-900 dark:text-gray-100">
                    <h3 class="text-2xl font-semibold mb-6">Isi Alamat Pengiriman</h3>

                    @if (session('error'))
                        <div class="mb-4 p-4 bg-red-100 dark:bg-red-700 border border-red-400 dark:border-red-600 text-red-700 dark:text-red-200 rounded">
                            {{ session('error') }}
                        </div>
                    @endif

                    <form action="{{ route('checkout.storeShipping') }}" method="POST">
                        @csrf

                        {{-- Data Penerima --}}
                        <div class="mb-4">
                            <label for="recipient_name" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Nama Penerima <span class="text-red-500">*</span></label>
                            <input type="text" name="recipient_name" id="recipient_name"
                                   class="mt-1 block w-full border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm"
                                   value="{{ old('recipient_name', Auth::user()->name ?? '') }}" required> {{-- Ditambahkan ?? '' untuk guest --}}
                            @error('recipient_name')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="recipient_phone" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Nomor Telepon Penerima <span class="text-red-500">*</span></label>
                            <input type="tel" name="recipient_phone" id="recipient_phone"
                                   class="mt-1 block w-full border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm"
                                   value="{{ old('recipient_phone') }}" required placeholder="Contoh: 08123456789">
                            @error('recipient_phone')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Detail Alamat --}}
                        <div class="mb-4">
                            <label for="shipping_address" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Alamat Lengkap <span class="text-red-500">*</span></label>
                            <textarea name="shipping_address" id="shipping_address" rows="4"
                                      class="mt-1 block w-full border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm"
                                      required placeholder="Nama Jalan, Nomor Rumah, RT/RW, Kelurahan, Kecamatan, Kota/Kabupaten, Provinsi">{{ old('shipping_address') }}</textarea>
                            @error('shipping_address')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-6">
                            <label for="postal_code" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Kode Pos <span class="text-red-500">*</span></label>
                            <input type="text" name="postal_code" id="postal_code"
                                   class="mt-1 block w-full md:w-1/2 border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm"
                                   value="{{ old('postal_code') }}" required>
                            @error('postal_code')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <input type="hidden" name="delivery_option" value="now">


                        <div class="mt-8 flex justify-end">
                            <a href="{{ route('cart.index') }}" class="mr-4 inline-flex items-center px-4 py-2 bg-gray-200 dark:bg-gray-600 border border-transparent rounded-md font-semibold text-xs text-gray-700 dark:text-gray-200 uppercase tracking-widest hover:bg-gray-300 dark:hover:bg-gray-500 focus:outline-none focus:border-gray-400 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">
                                Kembali ke Keranjang
                            </a>
                            <button type="submit"
                                    class="inline-flex items-center px-6 py-3 bg-indigo-600 hover:bg-indigo-700 border border-transparent rounded-md font-bold text-base text-white uppercase tracking-widest focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition ease-in-out duration-150">
                                Lanjut ke Pembayaran
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
