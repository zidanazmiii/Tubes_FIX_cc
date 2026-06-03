<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }} - Admin</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    {{-- Poppins font jika masih digunakan, atau bisa diganti Figtree sepenuhnya --}}
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">


    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    {{-- @livewireStyles --}} {{-- Hapus baris ini jika tidak pakai Livewire --}}
    <style>
        body {
            /* Ganti background body jika diinginkan, atau biarkan default dari app.css */
            /* font-family: 'Poppins', 'Segoe UI', Arial, sans-serif; */ /* Atau gunakan Figtree dari Vite */
        }
        /* Anda bisa memindahkan style lain ke app.css jika sudah menggunakan Vite */
        .admin-dashboard-bg { /* Style ini mungkin lebih cocok di file Blade spesifik dashboard */
            background: rgba(255,255,255,0.95);
            border-radius: 18px;
            box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.18);
        }
        /* Style untuk fallback inisial jika tidak ada foto profil */
        .initials-avatar {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-weight: 500; /* Tailwind class: font-medium */
            line-height: 1;
            /* text-transform: uppercase; */ /* Dihapus agar bisa menampilkan "Ad" bukan "AD" */
        }
    </style>
</head>
<body class="font-figtree antialiased bg-slate-100 dark:bg-slate-900"> {{-- Menggunakan Figtree dan palet slate --}}
    <div class="min-h-screen flex">
        {{-- Sidebar --}}
        <aside class="w-64 bg-slate-800 text-slate-300 flex-shrink-0 flex flex-col transition-all duration-300 ease-in-out shadow-lg">
            {{-- Logo / Branding Area --}}
            <div class="h-20 flex items-center justify-center px-4 border-b border-slate-700">
                <a href="{{ route('admin.dashboard') }}" class="flex items-center space-x-2 text-xl font-semibold text-white hover:text-slate-200 transition-colors">
                    {{-- Opsional: Ikon Logo Anda di sini --}}
                    <svg class="h-8 w-8 text-purple-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"> {{-- Contoh ikon, ganti dengan logo Anda --}}
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"/>
                    </svg>
                    <span>Happy cake admin</span>
                </a>
            </div>

            {{-- Navigasi Utama --}}
            <nav class="mt-6 flex-1 px-3 space-y-2">
                <a href="{{ route('admin.dashboard') }}"
                   class="flex items-center py-2.5 px-4 rounded-lg transition-all duration-200 ease-in-out
                          {{ request()->routeIs('admin.dashboard')
                                ? 'bg-slate-700 text-white shadow-sm' /* Warna aktif lebih kalem */
                                : 'hover:bg-slate-700 hover:text-white focus:bg-slate-700 focus:text-white' }}">
                    {{-- Ikon Dashboard --}}
                    <svg class="h-5 w-5 mr-3" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                    </svg>
                    <span>Dashboard</span>
                </a>

                <a href="{{ route('admin.products.index') }}"
                   class="flex items-center py-2.5 px-4 rounded-lg transition-all duration-200 ease-in-out
                          {{ request()->routeIs('admin.products.*')
                                ? 'bg-slate-700 text-white shadow-sm' /* Warna aktif lebih kalem */
                                : 'hover:bg-slate-700 hover:text-white focus:bg-slate-700 focus:text-white' }}">
                    {{-- Ikon Produk --}}
                    <svg class="h-5 w-5 mr-3" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                    </svg>
                    <span>Manajemen Produk</span>
                </a>

                <a href="{{ route('admin.orders.index') }}"
                   class="flex items-center py-2.5 px-4 rounded-lg transition-all duration-200 ease-in-out
                          {{ request()->routeIs('admin.orders.*')
                                ? 'bg-slate-700 text-white shadow-sm' /* Warna aktif lebih kalem */
                                : 'hover:bg-slate-700 hover:text-white focus:bg-slate-700 focus:text-white' }}">
                    {{-- Ikon Pesanan --}}
                    <svg class="h-5 w-5 mr-3" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" />
                    </svg>
                    <span>Manajemen Pesanan</span>
                </a>
            </nav>

            {{-- Area Logout di Bawah --}}
            <div class="mt-auto p-3 border-t border-slate-700">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <a href="{{ route('logout') }}"
                       onclick="event.preventDefault(); this.closest('form').submit();"
                       class="flex items-center py-2.5 px-4 rounded-lg text-slate-300 hover:bg-red-600 hover:text-white group transition-all duration-200 ease-in-out focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-opacity-50">
                        {{-- Ikon Logout --}}
                        <svg class="h-5 w-5 mr-3 text-slate-400 group-hover:text-white transition-colors" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                        </svg>
                        <span>Log Out</span>
                    </a>
                </form>
            </div>
        </aside>

        {{-- Konten Utama --}}
        <div class="flex-1 flex flex-col overflow-hidden">
            {{-- Header Utama Konten (DIBUAT STICKY) --}}
            <header class="bg-white dark:bg-slate-800 shadow sticky top-0 z-40"> {{-- Tambah: sticky top-0 z-40 --}}
                <div class="max-w-full mx-auto py-3 px-4 sm:px-6 lg:px-8 flex justify-between items-center">
                    <h1 class="text-xl font-semibold text-slate-800 dark:text-slate-200">
                        @yield('header_title', 'Admin Panel')
                    </h1>
                    @auth
                    <div class="relative" x-data="{ open: false }">
                        {{-- Tombol Dropdown dengan Foto Profil --}}
                        <button @click="open = !open" class="inline-flex items-center ps-2 pe-3 py-1.5 border border-transparent text-sm leading-4 font-medium rounded-md text-slate-600 dark:text-slate-300 bg-slate-100 dark:bg-slate-700 hover:bg-slate-200 dark:hover:bg-slate-600 hover:text-slate-800 dark:hover:text-slate-200 focus:outline-none transition ease-in-out duration-150">
                            {{-- Foto Profil atau Inisial --}}
                            @if (Auth::user()->profile_photo_url) {{-- Ganti 'profile_photo_url' jika nama field berbeda --}}
                                <img class="h-8 w-8 rounded-full object-cover me-2" src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}">
                            @else
                                @php
                                    $name = Auth::user()->name;
                                    $words = explode(' ', $name);
                                    $initials = '';
                                    if (count($words) > 0 && !empty($words[0])) {
                                        $initials .= strtoupper(substr($words[0], 0, 1));
                                    }
                                    if (count($words) > 1 && !empty(end($words))) {
                                        $initials .= strtoupper(substr(end($words), 0, 1));
                                    } elseif (strlen($name) > 1) { // Jika hanya satu kata, ambil dua huruf pertama
                                        $initials = strtoupper(substr($name, 0, 2));
                                    }
                                    if (empty(trim($initials))) $initials = '--'; // Fallback jika nama kosong
                                @endphp
                                <span class="initials-avatar inline-flex items-center justify-center h-8 w-8 rounded-full bg-slate-500 dark:bg-slate-600 text-white text-xs font-medium me-2">
                                    {{ $initials }}
                                </span>
                            @endif

                            {{-- Nama Pengguna --}}
                            <div class="truncate max-w-[150px]">{{ Auth::user()->name }}</div> {{-- Nama "Admin Toko Kue" akan muncul di sini --}}

                            {{-- Ikon Panah Dropdown --}}
                            <div class="ms-1">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                        {{-- Menu Dropdown --}}
                        <div x-show="open" @click.away="open = false"
                             x-transition:enter="transition ease-out duration-200"
                             x-transition:enter-start="opacity-0 scale-95"
                             x-transition:enter-end="opacity-100 scale-100"
                             x-transition:leave="transition ease-in duration-75"
                             x-transition:leave-start="opacity-100 scale-100"
                             x-transition:leave-end="opacity-0 scale-95"
                             class="absolute z-50 mt-2 w-48 rounded-md shadow-lg origin-top-right right-0"
                             style="display: none;">
                            <div class="rounded-md ring-1 ring-black ring-opacity-5 py-1 bg-white dark:bg-slate-700">
                                {{-- Opsional: Link ke Halaman Profil Pengguna --}}
                                {{-- <a href="{{ route('profile.show') }}" class="block px-4 py-2 text-sm text-slate-700 dark:text-slate-200 hover:bg-slate-100 dark:hover:bg-slate-600">Profil Saya</a> --}}

                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <a href="{{ route('logout') }}"
                                       onclick="event.preventDefault(); this.closest('form').submit();"
                                       class="block w-full text-left px-4 py-2 text-sm text-slate-700 dark:text-slate-200 hover:bg-slate-100 dark:hover:bg-slate-600">
                                        {{ __('Log Out') }}
                                    </a>
                                </form>
                            </div>
                        </div>
                    </div>
                    @endauth
                </div>
            </header>

            {{-- Konten Halaman Dinamis --}}
            <main class="flex-1 overflow-x-hidden overflow-y-auto bg-slate-200 dark:bg-slate-700 p-6">
                @if (session('success'))
                    <div class="mb-4 p-4 bg-green-100 dark:bg-green-800 border border-green-400 dark:border-green-600 text-green-700 dark:text-green-100 rounded-md">
                        {{ session('success') }}
                    </div>
                @endif
                @if (session('error'))
                    <div class="mb-4 p-4 bg-red-100 dark:bg-red-800 border border-red-400 dark:border-red-600 text-red-700 dark:text-red-100 rounded-md">
                        {{ session('error') }}
                    </div>
                @endif

                @yield('content')
            </main>
        </div>
    </div>
    {{-- @livewireScripts --}}
</body>
</html>
