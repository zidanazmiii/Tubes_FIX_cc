@extends('layouts.admin')

@section('header_title', 'Manajemen Pesanan')

@section('content')
    <div class="container mx-auto">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-semibold text-gray-700 dark:text-gray-200">Daftar Semua Pesanan</h2>
            {{-- Tombol Tambah Pesanan Manual (jika diperlukan) bisa ditambahkan di sini --}}
        </div>

        <div class="bg-white dark:bg-gray-800 p-4 sm:p-6 rounded-lg shadow-md overflow-x-auto">
            @if($orders->isEmpty())
                <p class="text-gray-600 dark:text-gray-400">Belum ada pesanan yang masuk.</p>
            @else
                <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                    <thead class="bg-gray-50 dark:bg-gray-700">
                        <tr>
                            <th scope="col" class="px-4 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">No. Pesanan</th>
                            <th scope="col" class="px-4 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Pelanggan</th>
                            <th scope="col" class="px-4 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Tanggal</th>
                            <th scope="col" class="px-4 py-3 text-right text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Total</th>
                            <th scope="col" class="px-4 py-3 text-center text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Status Pesanan</th>
                            <th scope="col" class="px-4 py-3 text-center text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Status Bayar</th>
                            <th scope="col" class="px-4 py-3 text-center text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                        @foreach ($orders as $order)
                            <tr>
                                <td class="px-4 py-3 whitespace-nowrap">
                                    <a href="{{ route('admin.orders.show', $order->id) }}" class="text-sm font-medium text-indigo-600 hover:text-indigo-900 dark:text-indigo-400 dark:hover:text-indigo-200">
                                        {{ $order->order_number }}
                                    </a>
                                </td>
                                <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-500 dark:text-gray-300">
                                    {{ $order->user->name ?? ($order->recipient_name . ' (Guest)') }}
                                </td>
                                <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-500 dark:text-gray-300">
                                    {{ $order->created_at->format('d M Y, H:i') }}
                                </td>
                                <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-900 dark:text-gray-100 text-right">
                                    Rp {{ number_format($order->total_amount, 0, ',', '.') }}
                                </td>
                                <td class="px-4 py-3 whitespace-nowrap text-sm text-center">
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
                                <td class="px-4 py-3 whitespace-nowrap text-sm text-center">
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
                                <td class="px-4 py-3 whitespace-nowrap text-center text-sm font-medium">
                                    <a href="{{ route('admin.orders.show', $order->id) }}" class="text-indigo-600 hover:text-indigo-900 dark:text-indigo-400 dark:hover:text-indigo-200" title="Lihat Detail">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 inline" viewBox="0 0 20 20" fill="currentColor">
                                            <path d="M10 12a2 2 0 100-4 2 2 0 000 4z" />
                                            <path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.022 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd" />
                                        </svg>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="mt-6">
                    {{ $orders->links() }} {{-- Menampilkan link paginasi --}}
                </div>
            @endif
        </div>
    </div>
@endsection
