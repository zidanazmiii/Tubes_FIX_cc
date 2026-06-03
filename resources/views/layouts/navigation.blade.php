{{-- File: resources/views/layouts/partials/navbar.blade.php --}}
<style>
    /* Mengimpor Font yang Digunakan */
    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap');
    @import url('https://fonts.googleapis.com/css2?family=Dancing+Script:wght@700&display=swap');
    @import url("https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css");

    body {
        /* background: url('/images/bg-cake.jpg') no-repeat center center fixed; */ /* Dihapus dari sini, sebaiknya di body layout utama jika diperlukan */
        /* background-size: cover; */
        font-family: 'Poppins', 'Segoe UI', Arial, sans-serif;
    }

    /* Styling untuk nav utama (sticky, backdrop filter) */
    nav.main-navigation {
        background: rgba(255,255,255,0.97) !important; /* Lebih solid sedikit, mendekati putih */
        backdrop-filter: blur(8px);
        position: sticky;
        top: 0;
        z-index: 50; /* Pastikan di atas konten lain */
        box-shadow: 0 2px 4px rgba(0,0,0,0.05); /* Shadow lebih halus */
        border-bottom: 1px solid #f3f4f6; /* border-gray-100 */
    }

    .font-dancing-script {
        font-family: 'Dancing Script', cursive;
    }

    /* Logo Style */
    .navbar-logo-text {
        font-family: 'Dancing Script', cursive;
        font-size: 2.25rem; /* Ukuran teks logo, sekitar text-4xl */
        color: #8b5cf6; /* Warna ungu (purple-600) */
        transition: color 0.2s ease-in-out;
        line-height: 1; /* Menyesuaikan line-height untuk font script */
    }
    .navbar-logo-text:hover {
        color: #7c3aed; /* Warna ungu lebih gelap saat hover (purple-700) */
    }

    /* Search Form Style (v3 - Sesuai Gambar) */
    .navbar-search-form-v3 {
        display: flex;
        align-items: center;
    }
    .navbar-search-input-v3 {
        padding: 0.5rem 1rem; /* py-2 px-4 */
        border: 1px solid #d1d5db; /* border-gray-300 */
        border-right: none;
        border-radius: 0.5rem 0 0 0.5rem; /* rounded-lg di kiri */
        font-size: 0.875rem; /* text-sm */
        color: #374151; /* text-gray-700 */
        width: 220px; /* Lebar input pencarian */
        height: 38px;
        transition: border-color 0.2s, box-shadow 0.2s;
    }
    .navbar-search-input-v3::placeholder {
        color: #9ca3af; /* text-gray-400 */
    }
    .navbar-search-input-v3:focus {
        outline: none;
        border-color: #a78bfa; /* Warna ungu (purple-500) */
        box-shadow: 0 0 0 2px rgba(167, 139, 250, 0.3); /* ring-purple-500/30 */
    }
    .navbar-search-button-v3 {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        padding: 0 0.75rem; /* px-3 */
        background-color: #8b5cf6; /* purple-600 */
        color: white;
        border: 1px solid #8b5cf6;
        border-radius: 0 0.5rem 0.5rem 0; /* rounded-lg di kanan */
        height: 38px;
        transition: background-color 0.2s;
    }
    .navbar-search-button-v3:hover {
        background-color: #7c3aed; /* purple-700 */
    }
    .navbar-search-button-v3 .bi-search {
        font-size: 1rem; /* Ukuran ikon search */
    }

    /* Nav Links Style (v3 - Sesuai Gambar) */
    .navbar-link-v3 {
        font-size: 0.9375rem; /* Antara text-sm dan text-base */
        font-weight: 500; /* font-medium */
        color: #374151; /* text-gray-700 */
        padding: 0.5rem 0.25rem; /* Lebih sedikit padding horizontal untuk teks saja */
        margin: 0 0.5rem; /* Jarak antar link */
        border-bottom: 2px solid transparent;
        transition: color 0.2s ease-in-out, border-color 0.2s ease-in-out;
    }
    .navbar-link-v3:hover,
    .navbar-link-v3.active { /* Anda bisa menambahkan class 'active' dengan JS jika perlu */
        color: #8b5cf6; /* text-purple-600 */
        border-bottom-color: #8b5cf6;
    }

    /* Cart Icon Link Style (v3) */
    .navbar-cart-icon-link-v3 {
        color: #4b5563; /* text-gray-600 */
        padding: 0.5rem; /* p-2 */
        border-radius: 9999px; /* rounded-full */
        transition: color 0.2s ease-in-out, background-color 0.2s ease-in-out;
    }
    .navbar-cart-icon-link-v3:hover {
        color: #8b5cf6; /* text-purple-600 */
        background-color: #f5f3ff; /* purple-50 */
    }
    .navbar-cart-icon-link-v3 .bi-cart3 {
        font-size: 1.5rem; /* text-2xl */
        line-height: 1;
    }

    /* Login Button Style (v3 - Sesuai Gambar) */
    .navbar-login-btn-v3 {
        font-size: 0.875rem; /* text-sm */
        font-weight: 500; /* font-medium */
        color: #8b5cf6; /* purple-600 */
        padding: 0.45rem 1.25rem; /* py-1.5 px-5 (approx) */
        border: 1px solid #a78bfa; /* purple-400/500 */
        border-radius: 0.375rem; /* rounded-md */
        transition: color 0.2s, background-color 0.2s, border-color 0.2s;
        line-height: 1.5; /* Untuk tinggi tombol yang pas */
    }
    .navbar-login-btn-v3:hover {
        color: #7c3aed; /* purple-700 */
        background-color: #f5f3ff; /* purple-50 */
        border-color: #8b5cf6;
    }

    /* Register Button Style (v3 - Sesuai Gambar) */
    .navbar-register-btn-v3 {
        font-size: 0.875rem; /* text-sm */
        font-weight: 500; /* font-medium */
        color: white;
        background-color: #8b5cf6; /* purple-600 */
        padding: 0.5rem 1.25rem; /* py-2 px-5 (approx) */
        border-radius: 0.375rem; /* rounded-md */
        transition: background-color 0.2s;
        line-height: 1.5; /* Untuk tinggi tombol yang pas */
    }
    .navbar-register-btn-v3:hover {
        background-color: #7c3aed; /* purple-700 */
    }

    /* Profile Avatar Style (v3 - Sesuai Gambar) */
    .profile-avatar-v3 {
        width: 32px; /* h-8 w-8 */
        height: 32px;
        border-radius: 9999px; /* rounded-full */
        object-fit: cover;
        border: 1px solid #ddd; /* Optional: border abu-abu muda tipis */
    }
    /* Tombol trigger dropdown profil */
    .profile-trigger-button {
        display: inline-flex;
        align-items: center;
        padding: 0.25rem; /* p-1 */
        border: 1px solid transparent; /* Initial transparent border */
        border-radius: 9999px; /* rounded-full */
        transition: background-color 0.2s, border-color 0.2s;
    }
    .profile-trigger-button:hover, .profile-trigger-button:focus {
        background-color: #f9fafb; /* gray-50 */
        border-color: #e5e7eb; /* gray-200 */
        outline: none;
    }
    .profile-trigger-button .user-name-nav {
        font-size: 0.875rem;
        font-weight: 500;
        color: #374151; /* text-gray-700 */
        margin-left: 0.5rem; /* ml-2 */
        margin-right: 0.25rem; /* mr-1 */
    }

    /* Logout link di dropdown */
    .logout-link-v3:hover, .logout-link-v3:focus {
        background-color: #fee2e2 !important; /* red-100 */
        color: #ef4444 !important; /* red-500 */
    }
    /* Mobile menu dropdown background */
    .main-navigation-mobile-dropdown {
        border-top: 1px solid #e5e7eb; /* border-gray-200 */
        background-color: rgba(255,255,255,0.98);
        backdrop-filter: blur(8px);
    }

    /* Hapus style lama yang tidak terpakai jika masih ada */
    .nav-main-btn, .cart-link, .pesanan-link, .guest-beranda-btn, .guest-auth-btn,
    .navbar-search-form-v2, .navbar-search-input-v2, .navbar-search-button-v2,
    .navbar-link-v2, .navbar-icon-link, .navbar-login-btn-v2, .navbar-register-btn-v2,
    .profile-avatar-v2, .logout-link-v2 {
        /* Dikosongkan atau dihapus jika tidak ada elemen lain yang masih menggunakannya */
        /* Untuk contoh ini, saya akan menganggap class lama tidak lagi digunakan di navbar ini */
    }

</style>

<nav x-data="{ open: false }" class="main-navigation">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-20">
            {{-- Bagian Kiri: Logo --}}
            <div class="flex items-center">
                <div class="shrink-0">
                    <a href="{{ route('home') }}" class="navbar-logo-text">
                        HappyCake
                    </a>
                </div>
            </div>

            {{-- Bagian Tengah: Search & Nav Links (Desktop) --}}
            <div class="hidden sm:flex flex-grow items-center justify-center space-x-8 px-4">
                {{-- Tombol Cari Produk --}}
                <form action="{{ route('home') }}" method="GET" class="navbar-search-form-v3">
                    <input type="search" name="q" value="{{ request('q') }}" placeholder="Cari produk..." aria-label="Cari produk"
                           class="navbar-search-input-v3">
                    <button type="submit" class="navbar-search-button-v3">
                        <i class="bi bi-search"></i>
                    </button>
                </form>

                {{-- Link Navigasi Utama --}}
                <div class="flex space-x-5 items-center">
                    <a href="{{ route('home') }}#produk-kami" class="navbar-link-v3">Produk</a>
                    <a href="{{ route('home') }}#tentang-kami" class="navbar-link-v3">Tentang Kami</a>
                    <a href="{{ route('home') }}#kontak" class="navbar-link-v3">Kontak</a>
                </div>
            </div>

            {{-- Bagian Kanan: Cart, Auth Buttons / Profile (Desktop) --}}
            <div class="hidden sm:flex sm:items-center space-x-3">
                <a href="{{ route('cart.index') }}" class="navbar-cart-icon-link-v3" title="Keranjang">
                    <i class="bi bi-cart3"></i>
                </a>

                @auth
                    {{-- <a href="{{ route('my-orders.index') }}" class="navbar-link-v3 text-sm" title="Pesanan Saya">
                       <i class="bi bi-receipt-cutoff mr-1"></i> Pesanan
                    </a> --}} {{-- Tombol Pesanan bisa diintegrasikan ke dropdown profil jika terlalu ramai --}}
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <button class="profile-trigger-button">
                                @php
                                    $user = Auth::user();
                                    $avatar = $user->profile_photo_url ?? null;
                                @endphp
                                @if($avatar)
                                    <img src="{{ $avatar }}" alt="Avatar" class="profile-avatar-v3">
                                @else
                                    <img src="https://ui-avatars.com/api/?name={{ urlencode($user->name) }}&background=8b5cf6&color=fff&size=32&font-size=0.45&rounded=true" alt="Avatar" class="profile-avatar-v3">
                                @endif
                                <span class="user-name-nav hidden lg:inline">{{ $user->name }}</span>
                                <svg class="fill-current h-4 w-4 ml-1 text-gray-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </button>
                        </x-slot>
                        <x-slot name="content">
                            <div class="px-4 py-3 border-b border-gray-200 dark:border-gray-700">
                                <p class="text-sm font-medium text-gray-900 dark:text-gray-200 truncate">{{ $user->name }}</p>
                                <p class="text-xs text-gray-500 dark:text-gray-400 truncate">{{ $user->email }}</p>
                            </div>
                            <x-dropdown-link :href="route('dashboard')">
                                {{ __('Dashboard') }}
                            </x-dropdown-link>
                             <x-dropdown-link :href="route('my-orders.index')">
                                {{ __('Pesanan Saya') }}
                            </x-dropdown-link>
                            <x-dropdown-link :href="route('profile.edit')">
                                {{ __('Profile') }}
                            </x-dropdown-link>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <x-dropdown-link :href="route('logout')" class="logout-link-v3"
                                        onclick="event.preventDefault(); this.closest('form').submit();">
                                    {{ __('Log Out') }}
                                </x-dropdown-link>
                            </form>
                        </x-slot>
                    </x-dropdown>
                @else
                    <a href="{{ route('login') }}" class="navbar-login-btn-v3">
                        Login
                    </a>
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="navbar-register-btn-v3">
                            Daftar
                        </a>
                    @endif
                @endauth
            </div>

            {{-- Tombol Hamburger untuk Mobile --}}
            <div class="-me-2 flex items-center sm:hidden">
                <a href="{{ route('cart.index') }}" class="navbar-cart-icon-link-v3 mr-2" title="Keranjang">
                    <i class="bi bi-cart3"></i>
                </a>
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-500 hover:text-purple-600 hover:bg-purple-50 focus:outline-none focus:bg-purple-50 focus:text-purple-600 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    {{-- Menu Dropdown Mobile --}}
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden main-navigation-mobile-dropdown">
        <div class="pt-2 pb-3 space-y-1">
            <div class="px-4 pt-2 pb-3">
                <form action="{{ route('home') }}" method="GET" class="navbar-search-form-v3 flex">
                     <input type="search" name="q" value="{{ request('q') }}" placeholder="Cari produk..." aria-label="Cari produk"
                           class="navbar-search-input-v3 flex-grow">
                    <button type="submit" class="navbar-search-button-v3">
                        <i class="bi bi-search"></i>
                    </button>
                </form>
            </div>

            <x-responsive-nav-link :href="route('home')" :active="request()->routeIs('home')">
                {{ __('Beranda') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link href="{{ route('home') }}#produk-kami" :active="false">Produk</x-responsive-nav-link>
            <x-responsive-nav-link href="{{ route('home') }}#tentang-kami" :active="false">Tentang Kami</x-responsive-nav-link>
            <x-responsive-nav-link href="{{ route('home') }}#kontak" :active="false">Kontak</x-responsive-nav-link>

            @auth
                <x-responsive-nav-link :href="route('my-orders.index')" :active="request()->routeIs('my-orders.index')">
                    Pesanan Saya
                </x-responsive-nav-link>
            @endauth
        </div>

        @auth
        <div class="pt-4 pb-3 border-t border-gray-200 dark:border-gray-600">
            <div class="px-4 flex items-center">
                @php $user = Auth::user(); $avatar = $user->profile_photo_url ?? null; @endphp
                @if($avatar)
                    <img src="{{ $avatar }}" alt="Avatar" class="profile-avatar-v3 h-10 w-10">
                @else
                    <img src="https://ui-avatars.com/api/?name={{ urlencode($user->name) }}&background=8b5cf6&color=fff&size=40&font-size=0.45&rounded=true" alt="Avatar" class="profile-avatar-v3 h-10 w-10">
                @endif
                <div class="ml-3">
                    <div class="font-medium text-base text-gray-800 dark:text-gray-200">{{ $user->name }}</div>
                    <div class="font-medium text-sm text-gray-500">{{ $user->email }}</div>
                </div>
            </div>
            <div class="mt-3 space-y-1">
                <x-responsive-nav-link :href="route('dashboard')">
                    {{ __('Dashboard') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('profile.edit')">
                    {{ __('Profile') }}
                </x-responsive-nav-link>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <x-responsive-nav-link :href="route('logout')" class="logout-link-v3"
                            onclick="event.preventDefault(); this.closest('form').submit();">
                        {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
        @else
        <div class="pt-4 pb-3 border-t border-gray-200 dark:border-gray-600">
            <div class="space-y-1">
                <x-responsive-nav-link :href="route('login')">
                    {{ __('Log In') }}
                </x-responsive-nav-link>
                @if (Route::has('register'))
                    <x-responsive-nav-link :href="route('register')">
                        {{ __('Register') }}
                    </x-responsive-nav-link>
                @endif
            </div>
        </div>
        @endauth
    </div>
</nav>
