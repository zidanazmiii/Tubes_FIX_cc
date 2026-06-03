<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // Untuk mendapatkan user yang login
use App\Models\Order; // Untuk mengambil data pesanan

class CustomerOrderController extends Controller
{
    /**
     * Display a listing of the customer's orders.
     * Menampilkan daftar pesanan milik pelanggan yang sedang login.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $user = Auth::user();

        // Ambil semua pesanan milik pengguna yang sedang login,
        // diurutkan berdasarkan tanggal terbaru
        $orders = Order::where('user_id', $user->id)
                       ->orderBy('created_at', 'desc')
                       ->paginate(10); // Paginasi 10 pesanan per halaman

        return view('orders.customer-index', compact('orders'));
        // Kita akan menggunakan nama view 'customer-index.blade.php'
        // di dalam folder 'resources/views/orders/'
    }
}
