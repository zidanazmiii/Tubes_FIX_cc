<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
// Anda bisa import model lain jika perlu menampilkan data di dashboard
use App\Models\Order;
use App\Models\Product;
// use App\Models\User;

class DashboardController extends Controller
{
    /**
     * Display the admin dashboard.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Tambahkan data statistik
        $totalProducts = Product::count();
        $totalOrders = Order::count();

        return view('admin.dashboard', compact('totalProducts', 'totalOrders'));
    }
}
