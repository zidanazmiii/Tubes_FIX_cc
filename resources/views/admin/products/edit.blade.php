@extends('layouts.admin')

@section('header_title', 'Edit Produk: ' . $product->name)

@section('content')
    <div class="container mx-auto">
        <div class="max-w-3xl mx-auto bg-white dark:bg-gray-800 p-6 md:p-8 rounded-lg shadow-md">
            <h2 class="text-2xl font-semibold text-gray-700 dark:text-gray-200 mb-6">Form Edit Produk</h2>

            {{-- Menampilkan error validasi global jika ada --}}
            @if ($errors->any())
                <div class="mb-4 p-4 bg-red-100 dark:bg-red-700 border border-red-400 dark:border-red-600 text-red-700 dark:text-red-200 rounded">
                    <strong class="font-bold">Oops! Ada beberapa masalah dengan input Anda:</strong>
                    <ul class="mt-1 list-disc list-inside text-sm">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('admin.products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT') {{-- Atau PATCH, PUT biasanya untuk mengganti seluruh resource --}}

                {{-- Nama Produk --}}
                <div class="mb-4">
                    <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Nama Produk <span class="text-red-500">*</span></label>
                    <input type="text" name="name" id="name"
                           class="mt-1 block w-full border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm"
                           value="{{ old('name', $product->name) }}" required>
                    @error('name')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Deskripsi Produk --}}
                <div class="mb-4">
                    <label for="description" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Deskripsi <span class="text-red-500">*</span></label>
                    <textarea name="description" id="description" rows="5"
                              class="mt-1 block w-full border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm"
                              required>{{ old('description', $product->description) }}</textarea>
                    @error('description')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Harga Produk --}}
                <div class="mb-4">
                    <label for="price" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Harga (Rp) <span class="text-red-500">*</span></label>
                    <input type="number" name="price" id="price" min="0" step="1000"
                           class="mt-1 block w-full border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm"
                           value="{{ old('price', $product->price) }}" required placeholder="Contoh: 50000">
                    @error('price')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Gambar Produk Saat Ini --}}
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Gambar Saat Ini</label>
                    @if($product->image)
                        <img src="{{ asset('storage/' . $product->image) }}" alt="Gambar {{ $product->name }}" class="mt-1 w-32 h-32 object-cover rounded-md shadow-sm">
                    @else
                        <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Tidak ada gambar.</p>
                    @endif
                </div>

                {{-- Upload Gambar Produk Baru --}}
                <div class="mb-6">
                    <label for="image" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Ganti Gambar Produk (Opsional)</label>
                    <input type="file" name="image" id="image"
                           class="mt-1 block w-full text-sm text-gray-500 dark:text-gray-400
                                  file:mr-4 file:py-2 file:px-4
                                  file:rounded-md file:border-0
                                  file:text-sm file:font-semibold
                                  file:bg-indigo-50 dark:file:bg-indigo-800 file:text-indigo-700 dark:file:text-indigo-200
                                  hover:file:bg-indigo-100 dark:hover:file:bg-indigo-700
                                  focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800">
                    <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">Biarkan kosong jika tidak ingin mengganti gambar. Format: JPG, PNG, GIF, SVG, WEBP. Maks: 2MB.</p>
                    @error('image')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex items-center justify-end mt-8">
                    <a href="{{ route('admin.products.index') }}" class="mr-4 inline-flex items-center px-4 py-2 bg-gray-200 dark:bg-gray-600 border border-transparent rounded-md font-semibold text-xs text-gray-700 dark:text-gray-200 uppercase tracking-widest hover:bg-gray-300 dark:hover:bg-gray-500 focus:outline-none focus:border-gray-400 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">
                        Batal
                    </a>
                    <button type="submit"
                            class="inline-flex items-center px-6 py-3 bg-indigo-600 hover:bg-indigo-700 border border-transparent rounded-md font-bold text-base text-white uppercase tracking-widest focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition ease-in-out duration-150">
                        Update Produk
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
