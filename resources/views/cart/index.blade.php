{{-- Menggunakan layout utama aplikasi --}}
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-[#a78bfa] leading-tight" style="font-family:'Poppins',Arial,sans-serif;">
            {{ __('Keranjang Belanja Anda') }}
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
        /* Tombol Kosongkan Keranjang Custom */
        .btn-kosongkan {
            background: #fee2e2;
            color: #b91c1c;
            font-weight: bold;
            border-radius: 8px;
            padding: 0.5rem 1.2rem;
            border: 1.5px solid #fca5a5;
            transition: background 0.18s, color 0.18s, box-shadow 0.18s;
            box-shadow: 0 2px 8px 0 rgba(239,68,68,0.08);
            cursor: pointer;
            text-decoration: none;
            display: inline-block;
        }
        .btn-kosongkan:hover, .btn-kosongkan:focus {
            background: #ef4444;
            color: #fff;
            border-color: #b91c1c;
            box-shadow: 0 4px 16px 0 rgba(239,68,68,0.18);
            text-decoration: none;
        }
    </style>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                    @if (session('success'))
                        <div class="mb-4 p-4 bg-green-100 dark:bg-green-700 border border-green-400 dark:border-green-600 text-green-700 dark:text-green-200 rounded">
                            {{ session('success') }}
                        </div>
                    @endif
                    @if (session('error'))
                        <div class="mb-4 p-4 bg-red-100 dark:bg-red-700 border border-red-400 dark:border-red-600 text-red-700 dark:text-red-200 rounded">
                            {{ session('error') }}
                        </div>
                    @endif

                    @if($cartItems->isEmpty())
                        <div class="text-center py-10">
                            <svg xmlns="http://www.w3.org/2000/svg" class="mx-auto h-16 w-16 text-gray-400 dark:text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                            </svg>
                            <p class="mt-4 text-lg text-gray-600 dark:text-gray-400">Keranjang belanja Anda masih kosong.</p>
                            <a href="{{ route('home') }}" class="mt-6 inline-block bg-indigo-600 hover:bg-indigo-700 text-white font-semibold py-2 px-4 rounded-md transition duration-150 ease-in-out">
                                Mulai Belanja
                            </a>
                        </div>
                    @else
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                                <thead class="bg-gray-50 dark:bg-gray-700">
                                    <tr>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                            Produk
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                            Harga
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                            Jumlah
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                            Subtotal
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                            Aksi
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                                    @foreach ($cartItems as $item)
                                        <tr>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="flex items-center">
                                                    <div class="flex-shrink-0 h-16 w-16">
                                                        @if($item->product->image)
                                                            <img class="h-16 w-16 rounded-md object-cover" src="{{ asset('storage/' . $item->product->image) }}" alt="{{ $item->product->name }}">
                                                            {{-- <img class="h-16 w-16 rounded-md object-cover" src="{{ asset('images/products/' . $item->product->image) }}" alt="{{ $item->product->name }}"> --}}
                                                        @else
                                                            <img class="h-16 w-16 rounded-md object-cover" src="https://placehold.co/100x100/E2E8F0/AAAAAA?text=Kue" alt="{{ $item->product->name }}">
                                                        @endif
                                                    </div>
                                                    <div class="ml-4">
                                                        <div class="text-sm font-medium text-gray-900 dark:text-gray-100">
                                                            <a href="{{ route('products.show', $item->product->slug) }}" class="hover:text-indigo-600 dark:hover:text-indigo-400">
                                                                {{ $item->product->name }}
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="text-sm text-gray-900 dark:text-gray-100">Rp {{ number_format($item->product->price, 0, ',', '.') }}</div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <form action="{{ route('cart.update', $item->id) }}" method="POST" class="flex items-center">
                                                    @csrf
                                                    @method('PATCH')
                                                    <input type="number" name="quantity" value="{{ $item->quantity }}" min="1"
                                                           class="w-16 border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm text-sm p-2">
                                                    <button type="submit" class="ml-2 p-1 text-indigo-600 hover:text-indigo-900 dark:text-indigo-400 dark:hover:text-indigo-200" title="Update jumlah">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                                            <path fill-rule="evenodd" d="M4 2a1 1 0 011 1v2.101a7.002 7.002 0 0111.601 2.566 1 1 0 11-1.885.666A5.002 5.002 0 005.999 7H9a1 1 0 010 2H4a1 1 0 01-1-1V3a1 1 0 011-1zm.008 9.057a1 1 0 011.276.61A5.002 5.002 0 0014.001 13H11a1 1 0 110-2h5a1 1 0 011 1v5a1 1 0 11-2 0v-2.101a7.002 7.002 0 01-11.601-2.566 1 1 0 01.61-1.276z" clip-rule="evenodd" />
                                                        </svg>
                                                    </button>
                                                </form>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="text-sm text-gray-900 dark:text-gray-100">Rp {{ number_format($item->product->price * $item->quantity, 0, ',', '.') }}</div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                                <form action="{{ route('cart.remove', $item->id) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="text-red-600 hover:text-red-900 dark:text-red-400 dark:hover:text-red-200" title="Hapus item">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                                            <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd" />
                                                        </svg>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <div class="mt-8 flex flex-col md:flex-row justify-between items-start md:items-center">
                            <div class="mb-4 md:mb-0">
                                <div x-data="{ showModal: false }">
                                    <button type="button" class="btn-kosongkan" @click="showModal = true">
                                        <i class="bi bi-trash3-fill" style="margin-right:6px;"></i>
                                        Kosongkan Keranjang
                                    </button>
                                    <!-- Modal Konfirmasi -->
                                    <template x-if="showModal">
                                        <div class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 z-50">
                                            <div class="bg-white rounded-lg p-6 w-80 text-center shadow-lg">
                                                <h2 class="text-lg font-semibold mb-4 text-gray-800">Konfirmasi</h2>
                                                <p class="mb-6 text-gray-700">Apakah Anda yakin ingin mengosongkan keranjang?</p>
                                                <div class="flex justify-center gap-4">
                                                    <button @click="showModal = false" type="button" class="px-4 py-2 bg-gray-300 rounded hover:bg-gray-400">Batal</button>
                                                    <form action="{{ route('cart.clear') }}" method="POST">
                                                        @csrf
                                                        <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700">Ya, Kosongkan</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </template>
                                </div>
                            </div>
                            <div class="text-right">
                                <p class="text-lg text-gray-700 dark:text-gray-300">Subtotal:</p>
                                <p class="text-2xl font-bold text-gray-900 dark:text-gray-100">Rp {{ number_format($totalPrice, 0, ',', '.') }}</p>
                                <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">Pajak dan biaya pengiriman akan dihitung saat checkout.</p>
                                @if($cartItems->isNotEmpty())
                                <a href="{{ route('checkout.shipping') }}"
                                   class="mt-4 inline-block w-full md:w-auto bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-3 px-6 rounded-lg text-lg transition duration-150 ease-in-out text-center">
                                    Lanjut ke Pengiriman
                                </a>
                                @endif
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
