{{-- Menggunakan layout utama aplikasi --}}
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-[#a78bfa] leading-tight" style="font-family:'Poppins',Arial,sans-serif;">
            {{ __('Riwayat Pesanan Saya') }}
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
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h3 class="text-2xl font-semibold mb-6">Daftar Pesanan Anda</h3>

                    @if($orders->isEmpty())
                        <div class="text-center py-10">
                            <svg xmlns="http://www.w3.org/2000/svg" class="mx-auto h-12 w-12 text-gray-400 dark:text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 21h16.5M3.75 12h16.5m-16.5-9h16.5" />
                                <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 7.5V6m0 1.5V6m0 1.5v-1.5m0 1.5v1.5m0-1.5V6m0 1.5v1.5m0-1.5V6m0 1.5v1.5m0-1.5V6m0 1.5v1.5m0-1.5V6m0 1.5v1.5m0-1.5V6m0 1.5v1.5m0-1.5V6m0 1.5v1.5m0-1.5V6m0 1.5v1.5m0-1.5V6m0 1.5v1.5m0-1.5V6M3.75 6A2.25 2.25 0 016 3.75h12A2.25 2.25 0 0120.25 6v12A2.25 2.25 0 0118 20.25H6A2.25 2.25 0 013.75 18V6z" />
                            </svg>
                            <p class="mt-4 text-lg text-gray-600 dark:text-gray-400">Anda belum memiliki riwayat pesanan.</p>
                            <a href="{{ route('home') }}" class="mt-6 inline-block bg-indigo-600 hover:bg-indigo-700 text-white font-semibold py-2 px-4 rounded-md transition duration-150 ease-in-out">
                                Mulai Belanja Sekarang
                            </a>
                        </div>
                    @else
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                                <thead class="bg-gray-50 dark:bg-gray-700">
                                    <tr>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">No. Pesanan</th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Tanggal</th>
                                        <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Total</th>
                                        <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Status Pesanan</th>
                                        <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Status Pembayaran</th>
                                        <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                                    @foreach ($orders as $order)
                                        <tr>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="text-sm font-medium text-indigo-600 dark:text-indigo-400 hover:underline">
                                                    <a href="{{ route('orders.show', $order->id) }}">
                                                        {{ $order->order_number }}
                                                    </a>
                                                </div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-300">
                                                {{ $order->created_at->format('d M Y, H:i') }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-100 text-right">
                                                Rp {{ number_format($order->total_amount, 0, ',', '.') }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-center">
                                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full
                                                    @if($order->order_status == 'pending') bg-yellow-100 text-yellow-800 dark:bg-yellow-700 dark:text-yellow-100
                                                    @elseif($order->order_status == 'processing') bg-blue-100 text-blue-800 dark:bg-blue-700 dark:text-blue-100
                                                    @elseif($order->order_status == 'shipped') bg-purple-100 text-purple-800 dark:bg-purple-700 dark:text-purple-100
                                                    @elseif($order->order_status == 'delivered') bg-green-100 text-green-800 dark:bg-green-700 dark:text-green-100
                                                    @elseif($order->order_status == 'cancelled') bg-red-100 text-red-800 dark:bg-red-700 dark:text-red-100
                                                    @endif
                                                    capitalize">
                                                    {{ $order->order_status }}
                                                </span>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-center">
                                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full
                                                    @if($order->payment_status == 'pending') bg-yellow-100 text-yellow-800 dark:bg-yellow-700 dark:text-yellow-100
                                                    @elseif($order->payment_status == 'paid') bg-green-100 text-green-800 dark:bg-green-700 dark:text-green-100
                                                    @elseif($order->payment_status == 'failed') bg-red-100 text-red-800 dark:bg-red-700 dark:text-red-100
                                                    @elseif($order->payment_status == 'refunded') bg-gray-100 text-gray-800 dark:bg-gray-600 dark:text-gray-100
                                                    @endif
                                                    capitalize">
                                                    {{ $order->payment_status }}
                                                </span>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-center text-sm font-medium">
                                                <a href="{{ route('orders.show', $order->id) }}" class="text-indigo-600 hover:text-indigo-900 dark:text-indigo-400 dark:hover:text-indigo-200" title="Lihat Detail Pesanan">
                                                    Lihat Detail
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <div class="mt-8">
                            {{ $orders->links() }} {{-- Menampilkan link paginasi --}}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
