{{-- Menggunakan layout utama aplikasi --}}
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-[#a78bfa] leading-tight" style="font-family:'Poppins',Arial,sans-serif;">
            {{ __('Pesanan Berhasil Dibuat!') }}
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
                <div class="p-6 md:p-8 text-gray-900 dark:text-gray-100 text-center">

                    @if ($successMessage)
                        <div class="mb-6 p-4 bg-green-100 dark:bg-green-800 border border-green-400 dark:border-green-600 text-green-700 dark:text-green-100 rounded-lg">
                            {{ $successMessage }}
                        </div>
                    @endif

                    <svg xmlns="http://www.w3.org/2000/svg" class="mx-auto h-20 w-20 text-green-500 mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>

                    <h3 class="text-2xl font-semibold mb-3">Terima Kasih Atas Pesanan Anda!</h3>

                    <p class="text-gray-600 dark:text-gray-400 mb-1">Nomor Pesanan Anda adalah:
                        <strong class="text-gray-800 dark:text-gray-200">{{ $order->order_number }}</strong>
                    </p>
                    <p class="text-gray-600 dark:text-gray-400 mb-4">
                        Total pembayaran: <strong class="text-gray-800 dark:text-gray-200">Rp {{ number_format($order->total_amount, 0, ',', '.') }}</strong>
                    </p>

                    <div class="mt-8">
                        <a href="{{ route('home') }}"
                           class="inline-flex items-center px-6 py-3 bg-indigo-600 hover:bg-indigo-700 text-white font-semibold rounded-md shadow-md transition duration-150 ease-in-out mr-2">
                            Kembali ke Beranda
                        </a>
                        <a href="{{ route('orders.show', $order->id) }}"
                           class="inline-flex items-center px-6 py-3 bg-gray-200 dark:bg-gray-700 hover:bg-gray-300 dark:hover:bg-gray-600 text-gray-800 dark:text-gray-200 font-semibold rounded-md shadow-md transition duration-150 ease-in-out">
                            Lihat Detail Pesanan
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
