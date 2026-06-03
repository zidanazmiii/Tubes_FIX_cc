<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product; // Import model Product untuk mengambil data kue

class HomeController extends Controller
{
    /**
     * Menampilkan halaman utama aplikasi.
     * Halaman ini akan menampilkan daftar produk (kue).
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        // Ambil query pencarian dari parameter 'q' (navbar & konten utama harus pakai 'q')
        $query = $request->input('q');
        // Jika tidak ada 'q', cek 'search' (untuk kompatibilitas lama)
        if (!$query) {
            $query = $request->input('search');
        }
        $productsQuery = Product::orderBy('created_at', 'desc');
        if ($query) {
            $productsQuery->where(function($q) use ($query) {
                $q->where('name', 'like', '%' . $query . '%')
                  ->orWhere('description', 'like', '%' . $query . '%');
            });
        }
        $products = $productsQuery->get();

        return view('home', [
            'products' => $products,
            'search' => $query,
        ]);
    }
}
