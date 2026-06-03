{{-- Menggunakan layout utama aplikasi --}}
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-purple-600 dark:text-purple-400 leading-tight" style="font-family:'Poppins',Arial,sans-serif;">
            {{ __('Manjakan Diri dengan Kelezatan Kue Kami!') }}
        </h2>
    </x-slot>

    {{-- Tambahan font untuk homepage kreatif --}}
    <link href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">


    <style>
        /* Gaya dasar untuk body homepage */
        body.homepage-body {
            background: url('/images/bg-cake.jpg') no-repeat center center fixed; /* Pastikan path ini benar */
            background-size: cover;
            font-family: 'Poppins', 'Figtree', sans-serif;
        }
        .content-wrapper-homepage { /* Wrapper untuk konten utama dengan background semi-transparan */
            background: rgba(255,255,255,0.97);
            border-radius: 18px;
            box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.18);
        }

        /* Gaya spesifik untuk elemen homepage */
        .font-dancing-script {
            font-family: 'Dancing Script', cursive;
        }
        .product-card-homepage {
            transition: transform 0.3s ease-in-out, box-shadow 0.3s ease-in-out;
            background-color: #fff;
        }
        .product-card-homepage:hover {
            transform: translateY(-8px);
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.12);
        }
        .btn-primary-cake {
            background-color: #c084fc; /* Warna ungu pastel primer */
            color: white;
            transition: background-color 0.3s ease;
        }
        .btn-primary-cake:hover {
            background-color: #a855f7; /* Warna ungu lebih gelap saat hover */
        }
        .footer-bg-cake {
            background: linear-gradient(135deg, #a78bfa 0%, #c4b5fd 100%);
        }
        .harga-produk-display {
            color: #222 !important;
            font-weight: bold;
        }
        .btn-lihat-detail {
            background: linear-gradient(90deg, #c4b5fd 0%, #a78bfa 100%);
            color: #fff !important;
            font-weight: bold;
            border-radius: 12px;
            transition: background 0.2s, box-shadow 0.2s;
            box-shadow: 0 2px 8px 0 rgba(167, 139, 250, 0.10);
        }
        .btn-lihat-detail:hover, .btn-lihat-detail:focus {
            background: linear-gradient(90deg, #a78bfa 0%, #7c3aed 100%);
            color: #fff !important;
            opacity: 1 !important;
        }
        .search-info-homepage {
            text-align: center;
            margin-bottom: 1.5rem;
            color: #a78bfa;
            font-weight: 500;
            font-size: 1.1rem;
            padding: 0.75rem;
            background-color: rgba(255,255,255,0.9);
            border-radius: 12px;
            display: inline-block;
        }
        .initials-avatar-homepage { /* Tetap ada jika digunakan di tempat lain, misal komentar user */
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-weight: 500;
            line-height: 1;
        }
        /* CSS untuk navbar yang spesifik di homepage ini telah dihapus */
        /* Pastikan style untuk navbar utama Anda (dari navigation.blade.php) sudah ada di app.css atau di navigation.blade.php itu sendiri */

    </style>

    {{-- Tambahkan class khusus ke body jika ini adalah halaman homepage --}}
    @push('scripts')
    <script>
        // Pastikan script ini tidak menyebabkan error jika body sudah memiliki class tersebut dari layout lain
        if (!document.body.classList.contains('homepage-body')) {
            document.body.classList.add('homepage-body');
        }
    </script>
    @endpush

    {{-- Navigasi utama sekarang akan diambil dari <x-app-layout> yang kemungkinan meng-include navigation.blade.php Anda --}}
    {{-- Blok <header class="bg-white shadow-md sticky top-0 z-50 homepage-header"> ... </header> TELAH DIHAPUS DARI SINI --}}

    <div class="py-12"> {{-- py-12 dari kode Anda sebelumnya --}}
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8"> {{-- max-w-7xl dari kode Anda sebelumnya --}}

            {{-- Hero Section dengan Image Slider (Alpine.js) --}}
            <section x-data="{
                currentSlide: 1,
                slides: [ /* Ganti dengan gambar dan teks Anda yang sebenarnya */
                    { image: 'https://placehold.co/1920x700/DBA8C3/FFFFFF?text=Kue+Cokelat+Istimewa+Kami', title: 'Kelezatan Cokelat Premium', subtitle: 'Nikmati setiap gigitan kue cokelat mewah kami, dibuat dengan cinta.', buttonText: 'Lihat Varian', buttonLink: '#produk-kami' },
                    { image: 'https://placehold.co/1920x700/A7C7E7/FFFFFF?text=Aneka+Pastry+Segar+Setiap+Hari', title: 'Pastry Renyah Setiap Hari', subtitle: 'Pilihan pastry terbaik untuk menemani harimu.', buttonText: 'Jelajahi Pastry', buttonLink: '#produk-kami' },
                    { image: 'https://placehold.co/1920x700/F3E0B5/333333?text=Kue+Ulang+Tahun+Impianmu', title: 'Rayakan Momen Spesial', subtitle: 'Pesan kue ulang tahun keinginanmu.', buttonText: 'Pesan Sekarang', buttonLink: '#produk-kami' }
                ],
                totalSlides: 3,
                interval: null, autoplaySpeed: 5000,
                nextSlide() { this.currentSlide = (this.currentSlide % this.totalSlides) + 1; },
                prevSlide() { this.currentSlide = (this.currentSlide - 2 + this.totalSlides + this.totalSlides) % this.totalSlides + 1; },
                goToSlide(slideNumber) { this.currentSlide = slideNumber; this.resetAutoplay(); },
                startAutoplay() { if(this.totalSlides > 1) { this.interval = setInterval(() => { this.nextSlide(); }, this.autoplaySpeed); }},
                stopAutoplay() { clearInterval(this.interval); this.interval = null; },
                resetAutoplay() { this.stopAutoplay(); this.startAutoplay(); }
            }"
            x-init="startAutoplay()" @mouseenter="stopAutoplay()" @mouseleave="startAutoplay()"
            class="relative w-full h-[45vh] md:h-[65vh] overflow-hidden rounded-xl shadow-xl mb-12">
                <template x-for="(slide, index) in slides" :key="index">
                    <div x-show="currentSlide === index + 1" class="absolute inset-0 transition-opacity duration-1000 ease-in-out" x-transition:enter="opacity-0" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="opacity-100" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0">
                        <img :src="slide.image" :alt="slide.title" class="w-full h-full object-cover">
                        <div class="absolute inset-0 bg-black bg-opacity-40 flex flex-col items-center justify-center text-center p-4">
                            <h2 class="font-dancing-script text-3xl sm:text-4xl md:text-6xl text-white mb-3" x-text="slide.title"></h2>
                            <p class="text-md sm:text-lg md:text-xl text-gray-200 mb-6 max-w-xl" x-text="slide.subtitle"></p>
                            <a :href="slide.buttonLink" class="btn-primary-cake text-base sm:text-lg font-semibold px-8 py-3 rounded-full shadow-lg hover:shadow-xl transition-all duration-300 transform hover:scale-105" x-text="slide.buttonText"></a>
                        </div>
                    </div>
                </template>
                <button @click="prevSlide(); resetAutoplay();" class="absolute left-0 top-1/2 transform -translate-y-1/2 bg-black bg-opacity-30 hover:bg-opacity-50 text-white p-3 rounded-full ml-3 z-10 transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
                </button>
                <button @click="nextSlide(); resetAutoplay();" class="absolute right-0 top-1/2 transform -translate-y-1/2 bg-black bg-opacity-30 hover:bg-opacity-50 text-white p-3 rounded-full mr-3 z-10 transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                </button>
                <div class="absolute bottom-4 left-1/2 transform -translate-x-1/2 flex space-x-2 z-10">
                    <template x-for="i in totalSlides" :key="i">
                        <button @click="goToSlide(i)" :class="{'bg-purple-500': currentSlide === i, 'bg-gray-300 hover:bg-gray-400': currentSlide !== i}" class="w-2.5 h-2.5 rounded-full transition-colors"></button>
                    </template>
                </div>
            </section>

            {{-- Fitur Pencarian di Konten Utama (jika berbeda dari navbar) --}}
            <section class="mb-12 px-4">
                <form action="{{ route('home') }}" method="GET" class="max-w-2xl mx-auto">
                    <div class="relative">
                        <input type="search" name="q" placeholder="Cari kue favoritmu di sini..."
                               value="{{ request('q') }}"
                               class="w-full py-3 px-5 text-gray-700 bg-white border border-gray-300 rounded-full shadow-sm focus:outline-none focus:ring-2 focus:ring-purple-400 focus:border-transparent transition-shadow">
                        <button type="submit" class="absolute right-0 top-0 bottom-0 bg-purple-500 hover:bg-purple-600 text-white font-semibold px-6 rounded-r-full transition-colors">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                        </button>
                    </div>
                </form>
            </section>

            @if(isset($search) && !empty($search))
                <div class="text-center mb-6">
                    <div class="search-info-homepage">
                        Menampilkan hasil pencarian untuk: <span class="font-bold">"{{ $search }}"</span>
                    </div>
                </div>
            @endif

            <div class="content-wrapper-homepage overflow-hidden shadow-xl sm:rounded-lg" id="produk-kami">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="text-center mb-12">
                        <h2 class="font-dancing-script text-5xl text-purple-700 mb-4">Pilihan Kue Terbaik Kami</h2>
                        <p class="text-lg text-gray-600 max-w-2xl mx-auto">Setiap kue kami dibuat dengan bahan-bahan berkualitas terbaik dan sentuhan cinta dari para baker profesional kami.</p>
                    </div>

                    @if(isset($products) && $products->isNotEmpty())
                        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-x-6 gap-y-10">
                            @foreach ($products as $product)
                                <div class="product-card-homepage rounded-xl shadow-lg overflow-hidden flex flex-col">
                                    <a href="{{ route('products.show', $product->slug) }}" class="block">
                                        @if($product->image)
                                            <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="w-full h-56 object-cover group-hover:opacity-90 transition-opacity">
                                        @else
                                            <img src="https://placehold.co/400x300/F3E8FF/A78BFA?text={{ urlencode($product->name) }}" alt="{{ $product->name }}" class="w-full h-56 object-cover">
                                        @endif
                                    </a>
                                    <div class="p-5 flex flex-col flex-grow">
                                        <h4 class="text-xl font-semibold text-gray-800 mb-2">
                                            <a href="{{ route('products.show', $product->slug) }}" class="hover:text-purple-600 transition-colors">
                                                {{ $product->name }}
                                            </a>
                                        </h4>
                                        <p class="text-sm text-gray-600 mb-3 flex-grow">{{ Str::limit($product->description, 70) }}</p>
                                        <p class="text-2xl harga-produk-display mb-4 mt-auto">
                                            Rp {{ number_format($product->price, 0, ',', '.') }}
                                        </p>
                                        <a href="{{ route('products.show', $product->slug) }}"
                                           class="block w-full text-center btn-lihat-detail py-2.5 px-4 shadow-md hover:shadow-lg transition-all duration-300 ease-in-out focus:outline-none focus:ring-2 focus:ring-purple-400 focus:ring-opacity-50 mb-2">
                                            Lihat Detail
                                        </a>
                                        <form action="{{ route('cart.add', $product->id) }}" method="POST">
                                            @csrf
                                           
                                        </form>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        @if ($products instanceof \Illuminate\Pagination\LengthAwarePaginator)
                            <div class="mt-10">
                                {{ $products->links() }}
                            </div>
                        @endif
                    @else
                        <p class="text-center text-gray-500 text-lg py-10">Saat ini belum ada produk kue yang tersedia. Nantikan koleksi terbaru kami!</p>
                    @endif
                </div>
            </div>

            <section id="tentang-kami" class="py-16 lg:py-24 bg-white mt-12 rounded-xl shadow-lg">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="lg:grid lg:grid-cols-2 lg:gap-12 lg:items-center">
                        <div>
                            <h2 class="font-dancing-script text-5xl text-purple-700 mb-6">Cerita Kami di HappyCake</h2>
                            <p class="text-gray-600 text-lg mb-4">
                                Selamat datang di HappyCake, tempat di mana setiap gigitan adalah perayaan! Kami percaya bahwa kue bukan hanya sekadar makanan penutup, tetapi juga cara untuk berbagi kebahagiaan dan menciptakan kenangan manis.
                            </p>
                            <p class="text-gray-600 text-lg mb-6">
                                Dimulai dari dapur rumahan dengan resep warisan keluarga, HappyCake tumbuh dari kecintaan akan seni membuat kue dan keinginan untuk menghadirkan senyuman melalui kreasi kami. Setiap produk dibuat dengan bahan-bahan segar pilihan dan perhatian penuh terhadap detail.
                            </p>
                        </div>
                        <div class="mt-10 lg:mt-0">
                            <img class="rounded-xl shadow-2xl w-full object-cover h-96" src="https://placehold.co/600x400/FADADD/333333?text=Tim+HappyCake" alt="Tentang HappyCake">
                        </div>
                    </div>
                </div>
            </section>

        </div>
    </div>

    <footer id="kontak" class="footer-bg-cake text-white pt-16 pb-8 mt-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-10 mb-12">
                <div>
                    <h5 class="font-dancing-script text-3xl mb-4">HappyCake</h5>
                    <p class="text-sm text-purple-100 leading-relaxed">Menghadirkan kelezatan dan kebahagiaan dalam setiap potongan kue. Dibuat dengan cinta dan bahan berkualitas.</p>
                </div>
                <div>
                    <h5 class="text-xl font-semibold mb-4">Link Cepat</h5>
                    <ul class="space-y-2">
                        <li><a href="#produk-kami" class="text-purple-100 hover:text-white transition-colors">Produk Kami</a></li>
                        <li><a href="#tentang-kami" class="text-purple-100 hover:text-white transition-colors">Tentang Kami</a></li>
                        <li><a href="#" class="text-purple-100 hover:text-white transition-colors">FAQ</a></li>
                        <li><a href="#" class="text-purple-100 hover:text-white transition-colors">Kebijakan Privasi</a></li>
                    </ul>
                </div>
                <div>
                    <h5 class="text-xl font-semibold mb-4">Hubungi Kami</h5>
                    <ul class="space-y-3 text-sm">
                        <li class="flex items-start"><svg class="w-5 h-5 mr-2 mt-0.5 text-purple-300 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20"><path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z"></path><path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z"></path></svg><span class="text-purple-100">info@happycake.com</span></li>
                        <li class="flex items-start"><svg class="w-5 h-5 mr-2 mt-0.5 text-purple-300 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20"><path d="M2 3a1 1 0 011-1h2.153a1 1 0 01.986.836l.74 4.435a1 1 0 01-.54 1.06l-1.548.773a11.037 11.037 0 006.105 6.105l.774-1.548a1 1 0 011.059-.54l4.435.74a1 1 0 01.836.986V17a1 1 0 01-1 1h-2C7.82 18 2 12.18 2 5V3z"></path></svg><span class="text-purple-100">(021) 123-4567</span></li>
                        <li class="flex items-start"><svg class="w-5 h-5 mr-2 mt-0.5 text-purple-300 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"></path></svg><span class="text-purple-100">Jl. Menteng No. 123, Jakarta Pusat</span></li>
                    </ul>
                </div>
                <div>
                    <h5 class="text-xl font-semibold mb-4">Ikuti Kami</h5>
                    <div class="flex space-x-4 mb-6">
                        <a href="#" class="text-purple-200 hover:text-white transition-colors"><svg class="w-7 h-7" fill="currentColor" viewBox="0 0 24 24"><path fill-rule="evenodd" d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z" clip-rule="evenodd" /></svg></a>
                        <a href="#" class="text-purple-200 hover:text-white transition-colors"><svg class="w-7 h-7" fill="currentColor" viewBox="0 0 24 24"><path fill-rule="evenodd" d="M12.315 2c2.43
                        <a href="#" class="text-purple-200 hover:text-white transition-colors"><svg class="w-7 h-7" fill="currentColor" viewBox="0 0 24 24"><path fill-rule="evenodd" d="M12.315 2c2.43 ..."></path></svg></a> {{-- Shortened for brevity --}}
                        <a href="#" class="text-purple-200 hover:text-white transition-colors"><svg class="w-7 h-7" fill="currentColor" viewBox="0 0 24 24"><path d="M8.29 20.251c7.547 ..."></path></svg></a> {{-- Shortened for brevity --}}
                    </div>
                    
                    
                </div>
            </div>
            <div class="mt-12 border-t border-purple-500 pt-8 text-center">
                <p class="text-sm text-purple-200">&copy; {{ date('Y') }} HappyCake. Semua Hak Dilindungi.</p>
            </div>
        </div>
    </footer>
</x-app-layout>
