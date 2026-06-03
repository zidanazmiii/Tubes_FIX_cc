@extends('layouts.admin')

@section('header_title', 'Dashboard Admin')

@section('content')
<style>
    .admin-dashboard-bg {
        /* LAMA: background: linear-gradient(135deg, #ede9fe 0%, #c4b5fd 50%, #a78bfa 100%); */
        /* BARU: Gradien yang lebih kaya dan dinamis */
        background: linear-gradient(135deg, #6d28d9 0%, #c026d3 60%, #db2777 100%); /* Deep Purple -> Fuchsia -> Pink */
        color: #ffffff; /* Warna teks utama menjadi putih agar kontras */
        padding: 2.5rem 2rem; /* Sedikit padding lebih banyak */
        border-radius: 20px; /* Border radius sedikit lebih besar */
        text-align: center;
        margin-bottom: 2.5rem; /* Margin bawah sedikit lebih besar */
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1), 0 6px 15px rgba(109, 40, 217, 0.2); /* Shadow lebih menarik */
        position: relative; /* Untuk elemen pseudo jika diperlukan nanti */
        overflow: hidden; /* Untuk elemen pseudo jika keluar batas */
    }

    .admin-dashboard-bg::before { /* Elemen pseudo untuk efek tambahan */
        content: "";
        position: absolute;
        top: -50%;
        left: -50%;
        width: 200%;
        height: 200%;
        background: radial-gradient(circle, rgba(255,255,255,0.1) 0%, rgba(255,255,255,0) 60%);
        transform: rotate(30deg);
        opacity: 0.7;
        pointer-events: none; /* Agar tidak mengganggu interaksi */
    }

    .admin-dashboard-bg h2 {
        font-size: 2.25rem; /* Ukuran font judul lebih besar */
        font-weight: 700; /* Tailwind: font-bold */
        text-shadow: 1px 1px 3px rgba(0,0,0,0.2); /* Shadow pada teks judul */
        margin-bottom: 0.75rem;
    }

    .admin-dashboard-bg p {
        font-size: 1.125rem; /* Ukuran font sub-judul */
        text-shadow: 1px 1px 2px rgba(0,0,0,0.15);
        opacity: 0.9; /* Sedikit transparansi pada sub-judul */
    }

    .dashboard-stats {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(220px, 1fr)); /* Sedikit lebih lebar untuk stat card */
        gap: 1.75rem; /* Gap sedikit lebih besar */
    }
    .stat-card {
        background: rgba(255, 255, 255, 0.98); /* Background lebih solid sedikit */
        border-radius: 16px; /* Border radius konsisten */
        padding: 1.75rem 1.5rem;
        box-shadow: 0 6px 20px rgba(31, 38, 135, 0.15);
        text-align: center;
        transition: transform 0.2s ease-out, box-shadow 0.2s ease-out;
    }
    .stat-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 10px 25px rgba(31, 38, 135, 0.2);
    }
    .stat-card h3 {
        font-size: 2rem; /* Angka statistik lebih besar */
        /* color: #6d28d9; LAMA */
        color: #8b5cf6; /* BARU: Warna ungu yang lebih cerah untuk angka */
        margin-bottom: 0.5rem;
        font-weight: 700;
    }
    .stat-card p {
        font-size: 0.95rem; /* Teks deskripsi statistik sedikit lebih kecil */
        color: #4b5563;
    }

    .admin-card {
        background: linear-gradient(135deg, #a78bfa 0%, #8b5cf6 60%, #7c3aed 100%);
        border-radius: 18px;
        padding: 1.5rem;
        box-shadow: 0 8px 32px rgba(91, 46, 182, 0.22);
        display: flex;
        align-items: center;
        text-decoration: none;
        color: #ffffff;
        transition: transform 0.2s ease-out, box-shadow 0.2s ease-out;
    }
    .admin-card:hover {
        transform: translateY(-5px) scale(1.02);
        box-shadow: 0 14px 40px rgba(91, 46, 182, 0.3);
        text-decoration: none;
    }
    .admin-card .icon {
        font-size: 2.5rem;
        margin-right: 1.25rem;
        color: #fff;
    }
    .admin-card .font-semibold {
        color: #ffffff;
        font-size: 1.125rem;
        margin-bottom: 0.25rem;
    }
    .admin-card .text-sm {
        color: rgba(255, 255, 255, 0.85);
        line-height: 1.4;
    }
</style>

<div class="admin-dashboard-bg">
    {{-- Judul dan sub-judul sudah di-style melalui CSS di atas untuk h2 dan p di dalam .admin-dashboard-bg --}}
    <h2>Selamat Datang di Dashboard Admin!</h2>
    <p>Kelola produk, pesanan, dan pelanggan dengan mudah.</p>
</div>

<div class="dashboard-stats">
    <div class="stat-card">
        <h3>{{ $totalProducts }}</h3>
        <p>Total Produk</p>
    </div>
    <div class="stat-card">
        <h3>{{ $totalOrders }}</h3>
        <p>Total Pesanan</p>
    </div>
    {{-- Tambahkan stat-card lain jika ada --}}
</div>

<div class="mt-8 grid grid-cols-1 md:grid-cols-2 gap-6">
    <a href="{{ route('admin.products.index') }}" class="admin-card">
        <i class="bi bi-box-seam-fill icon"></i>
        <div>
            <div class="font-semibold">Manajemen Produk</div>
            <div class="text-sm">Kelola produk Anda dengan mudah dan cepat.</div>
        </div>
    </a>
    <a href="{{ route('admin.orders.index') }}" class="admin-card">
        <i class="bi bi-receipt-cutoff icon"></i>
        <div>
            <div class="font-semibold">Manajemen Pesanan</div>
            <div class="text-sm">Pantau dan proses pesanan pelanggan secara efisien.</div>
        </div>
    </a>
    {{-- Tambahkan admin-card lain jika ada --}}
</div>

{{-- Pastikan Bootstrap Icons sudah di-link jika belum ada di layout utama --}}
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
@endsection
