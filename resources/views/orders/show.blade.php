{{-- Menggunakan layout utama aplikasi --}}
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-[#a78bfa] leading-tight" style="font-family:'Poppins',Arial,sans-serif;">
            {{ __('Detail Pesanan: ') }} {{ $order->order_number }}
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
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 md:p-8 text-gray-900 dark:text-gray-100">

                    @if (session('error'))
                        <div class="mb-4 p-4 bg-red-100 dark:bg-red-700 border border-red-400 dark:border-red-600 text-red-700 dark:text-red-200 rounded">
                            {{ session('error') }}
                        </div>
                    @endif

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-6">
                        {{-- Informasi Pesanan --}}
                        <div>
                            <h4 class="text-lg font-semibold mb-2 text-gray-700 dark:text-gray-300">Informasi Pesanan</h4>
                            <p><strong>Nomor Pesanan:</strong> {{ $order->order_number }}</p>
                            <p><strong>Tanggal Pesan:</strong> {{ $order->created_at->format('d M Y, H:i') }}</p>
                            <p><strong>Status Pesanan:</strong> <span class="font-semibold capitalize">{{ $order->order_status }}</span></p>
                            <p><strong>Status Pembayaran:</strong> <span class="font-semibold capitalize">{{ $order->payment_status }}</span></p>
                            <p><strong>Metode Pembayaran:</strong> {{ Str::title(str_replace('_', ' ', $order->payment_method)) }}</p>
                        </div>

                        {{-- Informasi Pengiriman --}}
                        <div>
                            <h4 class="text-lg font-semibold mb-2 text-gray-700 dark:text-gray-300">Informasi Pengiriman</h4>
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

                    {{-- Detail Item Pesanan --}}
                    <div class="mb-6">
                        <h4 class="text-lg font-semibold mb-3 text-gray-700 dark:text-gray-300">Item yang Dipesan:</h4>
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
                                    @foreach ($order->items as $item)
                                        <tr>
                                            <td class="px-4 py-3 whitespace-nowrap">
                                                <div class="flex items-center">
                                                    @if($item->product && $item->product->image)
                                                        <img src="{{ asset('storage/' . $item->product->image) }}" alt="{{ $item->product->name }}" class="w-12 h-12 object-cover rounded mr-3">
                                                    @else
                                                        <div class="w-12 h-12 bg-gray-200 dark:bg-gray-700 rounded mr-3 flex items-center justify-center text-gray-400 dark:text-gray-500 text-xs">No Img</div>
                                                    @endif
                                                    <div>
                                                        <p class="text-sm font-medium text-gray-900 dark:text-gray-100">{{ $item->product->name ?? 'Produk Dihapus' }}</p>
                                                        {{-- Anda bisa tambahkan SKU atau varian jika ada --}}
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-500 dark:text-gray-300">Rp {{ number_format($item->price_per_item, 0, ',', '.') }}</td>
                                            <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-500 dark:text-gray-300 text-center">{{ $item->quantity }}</td>
                                            <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-500 dark:text-gray-300 text-right">Rp {{ number_format($item->sub_total, 0, ',', '.') }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>

                    {{-- Ringkasan Total --}}
                    <div class="flex justify-end mt-6">
                        <div class="w-full md:w-1/3">
                            {{-- Jika ada biaya tambahan seperti ongkir atau pajak yang dihitung, bisa ditampilkan di sini --}}
                            {{-- <div class="flex justify-between py-1">
                                <span class="text-gray-600 dark:text-gray-400">Subtotal Produk:</span>
                                <span class="text-gray-800 dark:text-gray-200">Rp {{ number_format($order->items->sum('sub_total'), 0, ',', '.') }}</span>
                            </div>
                            <div class="flex justify-between py-1">
                                <span class="text-gray-600 dark:text-gray-400">Biaya Pengiriman:</span>
                                <span class="text-gray-800 dark:text-gray-200">Rp [Hitung Biaya Kirim]</span>
                            </div> --}}
                            <div class="flex justify-between py-2 border-t-2 dark:border-gray-600 mt-2">
                                <span class="text-lg font-bold text-gray-900 dark:text-gray-100">Total Pembayaran:</span>
                                <span class="text-lg font-bold text-gray-900 dark:text-gray-100">Rp {{ number_format($order->total_amount, 0, ',', '.') }}</span>
                            </div>
                        </div>
                    </div>

                    {{-- Tombol Unggah Bukti Pembayaran --}}
                    @if($order->payment_status === 'pending')
                        <div class="mt-6 text-center">
                            <a href="{{ route('checkout.uploadProof', $order->id) }}" class="inline-flex items-center px-6 py-3 bg-indigo-600 hover:bg-indigo-700 border border-transparent rounded-md font-bold text-base text-white uppercase tracking-widest focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition ease-in-out duration-150">
                                Unggah Bukti Pembayaran
                            </a>
                        </div>
                    @elseif($order->payment_status === 'cod')
                        <div class="mt-6 text-center">
                            <p class="text-lg font-semibold text-gray-700 dark:text-gray-300">Pembayaran akan dilakukan saat pesanan tiba (COD).</p>
                        </div>
                    @endif

                    <div class="mt-8 text-center md:text-left">
                        <a href="{{ route('home') }}" class="text-indigo-600 dark:text-indigo-400 hover:underline">
                            &larr; Kembali ke Beranda
                        </a>
                        {{-- Tambahkan link ke daftar riwayat pesanan jika ada --}}
                        {{-- <a href="{{ route('orders.history') }}" class="ml-4 text-indigo-600 dark:text-indigo-400 hover:underline">
                            Lihat Semua Pesanan Saya
                        </a> --}}
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
