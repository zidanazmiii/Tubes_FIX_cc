@extends('layouts.admin')

@section('header_title', 'Detail Pesanan: ' . $order->order_number)

@section('content')
    <div class="container mx-auto">
        <div class="mb-6">
            <a href="{{ route('admin.orders.index') }}" class="text-indigo-600 dark:text-indigo-400 hover:underline">
                &larr; Kembali ke Daftar Pesanan
            </a>
        </div>

        <div class="bg-white dark:bg-gray-800 p-6 md:p-8 rounded-lg shadow-md">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                {{-- Kolom Info Pesanan & Pelanggan --}}
                <div class="md:col-span-1">
                    <h3 class="text-xl font-semibold text-gray-700 dark:text-gray-200 mb-3">Informasi Pesanan</h3>
                    <div class="space-y-2 text-sm text-gray-600 dark:text-gray-400">
                        <p><strong>No. Pesanan:</strong> {{ $order->order_number }}</p>
                        <p><strong>Tanggal Pesan:</strong> {{ $order->created_at->format('d M Y, H:i') }}</p>
                        <p><strong>Pelanggan:</strong> {{ $order->user->name ?? ($order->recipient_name . ' (Guest)') }}</p>
                        <p><strong>Email Pelanggan:</strong> {{ $order->user->email ?? 'N/A' }}</p>
                        <p><strong>Metode Pembayaran:</strong> {{ Str::title(str_replace('_', ' ', $order->payment_method)) }}</p>
                    </div>
                </div>

                {{-- Kolom Info Pengiriman --}}
                <div class="md:col-span-1">
                    <h3 class="text-xl font-semibold text-gray-700 dark:text-gray-200 mb-3">Informasi Pengiriman</h3>
                    <div class="space-y-2 text-sm text-gray-600 dark:text-gray-400">
                        <p><strong>Nama Penerima:</strong> {{ $order->recipient_name }}</p>
                        <p><strong>No. Telepon:</strong> {{ $order->recipient_phone }}</p>
                        <p><strong>Alamat:</strong></p>
                        <address class="not-italic">
                            {{ $order->shipping_address }}<br>
                            Kode Pos: {{ $order->postal_code }}
                        </address>
                        <p><strong>Opsi Pengiriman:</strong> {{ Str::title($order->delivery_option) }}</p>
                    </div>
                </div>

                {{-- Kolom Update Status --}}
                <div class="md:col-span-1">
                    <h3 class="text-xl font-semibold text-gray-700 dark:text-gray-200 mb-3">Update Status</h3>
                    <form action="{{ route('admin.orders.updateStatus', $order->id) }}" method="POST">
                        @csrf
                        @method('PATCH')

                        <div class="mb-4">
                            <label for="order_status" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Status Pesanan</label>
                            <select name="order_status" id="order_status" class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md">
                                <option value="pending" {{ $order->order_status == 'pending' ? 'selected' : '' }}>Pending</option>
                                <option value="processing" {{ $order->order_status == 'processing' ? 'selected' : '' }}>Processing</option>
                                <option value="shipped" {{ $order->order_status == 'shipped' ? 'selected' : '' }}>Shipped</option>
                                <option value="delivered" {{ $order->order_status == 'delivered' ? 'selected' : '' }}>Delivered</option>
                                <option value="cancelled" {{ $order->order_status == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                            </select>
                        </div>

                        <div class="mb-4">
                            <label for="payment_status" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Status Pembayaran</label>
                            <select name="payment_status" id="payment_status" class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md">
                                <option value="pending" {{ $order->payment_status == 'pending' ? 'selected' : '' }}>Pending</option>
                                <option value="paid" {{ $order->payment_status == 'paid' ? 'selected' : '' }}>Paid</option>
                                <option value="failed" {{ $order->payment_status == 'failed' ? 'selected' : '' }}>Failed</option>
                                <option value="refunded" {{ $order->payment_status == 'refunded' ? 'selected' : '' }}>Refunded</option>
                            </select>
                        </div>
                        <button type="submit" class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-semibold py-2 px-4 rounded-md transition duration-150 ease-in-out">
                            Update Status
                        </button>
                    </form>
                </div>
            </div>

            {{-- Detail Item Pesanan --}}
            <div>
                <h3 class="text-xl font-semibold text-gray-700 dark:text-gray-200 mb-4">Item yang Dipesan</h3>
                <div class="overflow-x-auto border dark:border-gray-700 rounded-lg">
                    <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                        <thead class="bg-gray-50 dark:bg-gray-700">
                            <tr>
                                <th scope="col" class="px-4 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Produk</th>
                                <th scope="col" class="px-4 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Harga Satuan</th>
                                <th scope="col" class="px-4 py-3 text-center text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Jumlah</th>
                                <th scope="col" class="px-4 py-3 text-right text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Subtotal</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                            @forelse ($order->items as $item)
                                <tr>
                                    <td class="px-4 py-3 whitespace-nowrap">
                                        <div class="flex items-center">
                                            @if($item->product && $item->product->image)
                                                <img src="{{ asset('storage/' . $item->product->image) }}" alt="{{ $item->product->name ?? '' }}" class="w-12 h-12 object-cover rounded mr-3">
                                            @else
                                                <div class="w-12 h-12 bg-gray-200 dark:bg-gray-700 rounded mr-3 flex items-center justify-center text-gray-400 dark:text-gray-500 text-xs">No Img</div>
                                            @endif
                                            <div>
                                                <p class="text-sm font-medium text-gray-900 dark:text-gray-100">{{ $item->product->name ?? 'Produk Telah Dihapus' }}</p>
                                                {{-- SKU: {{ $item->product->sku ?? 'N/A' }} --}}
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-500 dark:text-gray-300">Rp {{ number_format($item->price_per_item, 0, ',', '.') }}</td>
                                    <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-500 dark:text-gray-300 text-center">{{ $item->quantity }}</td>
                                    <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-500 dark:text-gray-300 text-right">Rp {{ number_format($item->sub_total, 0, ',', '.') }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="px-4 py-3 text-center text-sm text-gray-500 dark:text-gray-400">Tidak ada item dalam pesanan ini.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            {{-- Ringkasan Total --}}
            <div class="flex justify-end mt-6">
                <div class="w-full md:w-1/3">
                    <div class="flex justify-between py-2 border-t-2 dark:border-gray-600 mt-2">
                        <span class="text-lg font-bold text-gray-900 dark:text-gray-100">Total Pesanan:</span>
                        <span class="text-lg font-bold text-gray-900 dark:text-gray-100">Rp {{ number_format($order->total_amount, 0, ',', '.') }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
