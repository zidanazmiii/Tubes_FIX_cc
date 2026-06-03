<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order; // Import model Order
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     * Menampilkan daftar semua pesanan.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Mengambil semua pesanan, diurutkan berdasarkan yang terbaru, dengan data pengguna terkait
        // Menggunakan eager loading 'user' untuk menghindari N+1 query
        $orders = Order::with('user')
                       ->orderBy('created_at', 'desc')
                       ->paginate(15); // 15 pesanan per halaman

        return view('admin.orders.index', compact('orders'));
    }

    /**
     * Display the specified resource.
     * Menampilkan detail pesanan spesifik.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\View\View
     */
    public function show(Order $order)
    {
        // Eager load relasi items beserta produk di dalam setiap item, dan juga user
        $order->load(['items.product', 'user']);

        return view('admin.orders.show', compact('order'));
    }

    /**
     * Update the status of the specified order.
     * Memperbarui status pesanan (order_status dan payment_status).
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateStatus(Request $request, Order $order)
    {
        $request->validate([
            'order_status' => 'required|string|in:pending,processing,shipped,delivered,cancelled', // Sesuaikan dengan status Anda
            'payment_status' => 'required|string|in:pending,paid,failed,refunded', // Sesuaikan dengan status Anda
        ]);

        $order->order_status = $request->input('order_status');
        $order->payment_status = $request->input('payment_status');
        $order->save();

        return redirect()->route('admin.orders.show', $order->id)->with('success', 'Status pesanan berhasil diperbarui.');
    }
}
