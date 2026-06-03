<x-guest-layout>
    {{-- Navbar Guest Custom --}}
    <nav class="bg-white/95 border-b border-gray-200 shadow-sm fixed w-full z-30 top-0 left-0 backdrop-blur" style="backdrop-filter: blur(6px);">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex justify-between items-center h-16">
            <div class="flex items-center">
                <a href="{{ route('home') }}">
                    <img src="{{ asset('Happycake.png') }}" alt="Happycake Logo" class="h-11 w-11 object-cover rounded-full border-2 border-[#a78bfa] bg-white shadow-sm" />
                </a>
                <span style="display:inline-block; width:22px;"></span>
                <a href="{{ route('home') }}" class="btn-beranda{{ request()->routeIs('home') ? ' active' : '' }}">
                    <i class="bi bi-house-door-fill" style="font-size: 1.15rem; margin-right: 6px; vertical-align: middle; line-height: 1;"></i>
                    <span style="font-size: 1rem; font-weight: 600;">Beranda</span>
                </a>
            </div>
            <div class="flex items-center space-x-2">
                <a href="{{ route('login') }}" class="guest-auth-btn{{ request()->routeIs('login') ? ' active' : '' }}">
                    Login
                </a>
                <a href="{{ route('register') }}" class="guest-auth-btn{{ request()->routeIs('register') ? ' active' : '' }}" style="opacity:0.8;">
                    Register
                </a>
            </div>
        </div>
    </nav>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <style>
        .btn-beranda {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 8px 20px;
            font-size: 1rem;
            font-weight: 600;
            color: white;
            background: linear-gradient(145deg, #a66cff, #914dff);
            border: none;
            border-radius: 9999px;
            cursor: pointer;
            box-shadow: 0 4px 10px rgba(145, 77, 255, 0.18);
            text-decoration: none;
            transition: transform 0.18s;
            min-height: 38px;
            min-width: 100px;
        }
        .btn-beranda:hover {
            transform: scale(1.04);
        }
        .btn-beranda .bi-house-door-fill {
            color: #fff;
            background: transparent;
            font-size: 1.15rem;
            margin-right: 6px;
        }
        body {
            background: url('/images/bg-cake.jpg') no-repeat center center fixed;
            background-size: cover;
            font-family: 'Poppins', 'Segoe UI', Arial, sans-serif;
        }
        .login-card {
            background: rgba(255, 255, 255, 0.95);
            border-radius: 18px;
            box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.18);
            max-width: 400px;
            margin: 48px auto;
            padding: 2.5rem 2rem 2rem 2rem;
            border: 1px solid #f3e8ff;
        }
        .login-title {
            font-family: 'Poppins', 'Segoe UI', Arial, sans-serif;
            color: #a78bfa;
            font-size: 1.7rem;
            font-weight: 700;
            text-align: center;
            margin-bottom: 1.5rem;
            letter-spacing: 0.5px;
        }
        .cake-divider {
            display: block;
            margin: 0 auto 1.5rem auto;
            width: 60px;
            height: 4px;
            border-radius: 2px;
            background: linear-gradient(90deg, #ede9fe 0%, #a78bfa 100%);
        }
        .login-btn {
            background: #a78bfa;
            color: #fff;
            font-weight: bold;
            border-radius: 8px;
            border: none;
            padding: 0.85rem 2.2rem;
            font-size: 1.08rem;
            transition: none;
            box-shadow: 0 2px 8px 0 rgba(167, 139, 250, 0.10);
            opacity: 1 !important;
        }
        .login-btn:hover,
        .bg-\[\#a78bfa\]:hover,
        .hover\:bg-\[\#a78bfa\]:hover {
            background: #a78bfa !important;
            color: #fff !important;
            opacity: 1 !important;
        }
        .login-link {
            color: #a78bfa;
            font-weight: 500;
        }
        .login-link:hover {
            color: #7c3aed;
        }
        .bg-\[\#a78bfa\] {
            background-color: #a78bfa !important;
            opacity: 1 !important;
        }
        .nav-main-btn {
            display: none !important;
        }
        .guest-auth-btn {
            background: #a78bfa;
            color: #fff !important;
            font-weight: 900;
            border-radius: 12px;
            border: 2px solid #a78bfa;
            box-shadow: 0 2px 8px 0 rgba(167,139,250,0.10);
            padding: 0.45rem 1.1rem;
            min-width: 90px;
            min-height: 40px;
            font-size: 1rem;
            margin-right: 0.2rem;
            transition: background 0.18s, color 0.18s, box-shadow 0.18s;
            text-decoration: none;
            opacity: 0.8;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .guest-auth-btn:hover, .guest-auth-btn:focus,
        .guest-auth-btn.active {
            background: #7c3aed;
            color: #fff !important;
            box-shadow: 0 4px 16px 0 rgba(167,139,250,0.18);
            text-decoration: none !important;
            opacity: 1 !important;
        }
        /* Responsive */
        @media (max-width: 500px) {
            .login-card {
                padding: 1.5rem 0.5rem;
            }
            nav img {
                height: 32px !important;
                width: 32px !important;
            }
            .btn-beranda, .guest-auth-btn {
                font-size: 0.93rem;
                padding: 0.32rem 0.65rem;
                min-width: 70px;
                min-height: 30px;
            }
            .btn-beranda .bi-house-door-fill {
                font-size: 1rem;
                margin-right: 5px;
            }
            nav .flex.items-center > span {
                width: 10px !important;
            }
        }
    </style>
    <link href="https://fonts.googleapis.com/css?family=Pacifico&display=swap" rel="stylesheet">

    <div class="login-card" style="margin-top: 100px;">
        <div class="login-title">
            Masuk Akun
        </div>
        <span class="cake-divider"></span>
        <x-auth-session-status class="mb-4" :status="session('status')" />
        <form method="POST" action="{{ route('login') }}">
            @csrf

            <!-- Email Address -->
            <div>
                <x-input-label for="email" :value="__('Email')" />
                <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-input-label for="password" :value="__('Password')" />
                <x-text-input id="password" class="block mt-1 w-full"
                                type="password"
                                name="password"
                                required autocomplete="current-password" />
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <!-- Remember Me & Forgot Password -->
            <div class="flex items-center justify-between mt-4">
                <label class="flex items-center">
                    <input type="checkbox" name="remember" class="rounded border-gray-300 text-purple-400 shadow-sm focus:ring-purple-400">
                    <span class="ml-2 text-sm text-gray-600">{{ __('Ingat Saya') }}</span>
                </label>
                @if (Route::has('password.request'))
                    <a class="login-link text-sm underline" href="{{ route('password.request') }}">
                        {{ __('Lupa password?') }}
                    </a>
                @endif
            </div>

            <div class="flex items-center justify-between mt-6">
                <a class="login-link text-sm underline" href="{{ route('register') }}">
                    {{ __('Belum punya akun? Daftar') }}
                </a>
                <button type="submit" class="login-btn" style="font-weight:900; box-shadow:0 4px 16px 0 rgba(167,139,250,0.18);">
                    {{ __('Masuk') }}
                </button>
            </div>
        </form>
    </div>
</x-guest-layout>
