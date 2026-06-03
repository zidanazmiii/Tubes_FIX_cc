<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product; // Import model Product

class ProductController extends Controller
{
    /**
     * Display the specified product.
     * Menampilkan detail produk yang spesifik.
     *
     * @param  \App\Models\Product  $product (Route Model Binding berdasarkan slug)
     * @return \Illuminate\View\View
     */
    public function show(Product $product)
    {
        // Laravel secara otomatis akan melakukan pencarian produk berdasarkan slug
        // karena kita menggunakan type-hinting Product $product dan di rute kita definisikan {product:slug}
        // Jika produk tidak ditemukan, Laravel akan otomatis menampilkan halaman 404.

        // Mengirim data produk yang ditemukan ke view 'products.show'
        return view('products.show', ['product' => $product]);
    }

    // Jika Anda juga ingin method index untuk menampilkan semua produk di sini (alternatif dari HomeController)
    // public function index()
    // {
    //     $products = Product::orderBy('created_at', 'desc')->paginate(8);
    //     return view('products.index', ['products' => $products]); // Anda perlu membuat view products.index
    // }
}
