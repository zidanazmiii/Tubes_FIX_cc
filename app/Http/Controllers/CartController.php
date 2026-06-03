<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product; // Import model Product
use App\Models\Cart;    // Import model Cart
use Illuminate\Support\Facades\Auth; // Import Auth facade

class CartController extends Controller
{
    /**
     * Display a listing of the items in the cart.
     * Menampilkan daftar item di keranjang belanja.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Pastikan pengguna sudah login (rute ini sudah dilindungi middleware 'auth')
        $user = Auth::user();

        // Mengambil item keranjang milik pengguna yang sedang login, beserta data produk terkait
        // Menggunakan eager loading 'product' untuk menghindari N+1 query problem
        $cartItems = Cart::where('user_id', $user->id)->with('product')->get();

        // Menghitung total harga
        $totalPrice = 0;
        foreach ($cartItems as $item) {
            $totalPrice += $item->product->price * $item->quantity;
        }

        return view('cart.index', [
            'cartItems' => $cartItems,
            'totalPrice' => $totalPrice,
        ]);
    }

    /**
     * Add a product to the cart.
     * Menambahkan produk ke keranjang belanja.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\RedirectResponse
     */
    public function add(Request $request, Product $product)
    {
        // Pastikan pengguna sudah login (rute ini sudah dilindungi middleware 'auth')
        $user = Auth::user();

        // Validasi input quantity
        $request->validate([
            'quantity' => 'required|integer|min:1',
        ]);

        $quantity = $request->input('quantity');

        // Cek apakah produk ini sudah ada di keranjang pengguna
        $cartItem = Cart::where('user_id', $user->id)
                        ->where('product_id', $product->id)
                        ->first();

        if ($cartItem) {
            // Jika sudah ada, update quantity-nya
            $cartItem->quantity += $quantity;
            $cartItem->save();
        } else {
            // Jika belum ada, buat entri baru di keranjang
            Cart::create([
                'user_id' => $user->id,
                'product_id' => $product->id,
                'quantity' => $quantity,
            ]);
        }

        return redirect()->route('cart.index')->with('success', 'Produk berhasil ditambahkan ke keranjang!');
        // Atau bisa juga redirect()->back() jika ingin kembali ke halaman produk sebelumnya
        // return redirect()->back()->with('success', 'Produk berhasil ditambahkan ke keranjang!');
    }

    /**
     * Update the specified item quantity in the cart.
     * (Akan kita implementasikan nanti)
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Cart  $cart
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Cart $cart)
    {
        // Logika untuk update quantity
        // Pastikan $cart item ini milik user yang sedang login
        if ($cart->user_id !== Auth::id()) {
            return redirect()->route('cart.index')->with('error', 'Aksi tidak diizinkan.');
        }

        $request->validate([
            'quantity' => 'required|integer|min:1',
        ]);

        $cart->quantity = $request->input('quantity');
        $cart->save();

        return redirect()->route('cart.index')->with('success', 'Jumlah produk di keranjang berhasil diperbarui.');
    }

    /**
     * Remove the specified item from the cart.
     * (Akan kita implementasikan nanti)
     *
     * @param  \App\Models\Cart  $cart
     * @return \Illuminate\Http\RedirectResponse
     */
    public function remove(Cart $cart)
    {
        // Logika untuk menghapus item dari keranjang
        // Pastikan $cart item ini milik user yang sedang login
        if ($cart->user_id !== Auth::id()) {
            return redirect()->route('cart.index')->with('error', 'Aksi tidak diizinkan.');
        }

        $cart->delete();

        return redirect()->route('cart.index')->with('success', 'Produk berhasil dihapus dari keranjang.');
    }

    /**
     * Clear all items from the cart.
     * (Akan kita implementasikan nanti)
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function clear()
    {
        // Logika untuk mengosongkan semua item keranjang milik user
        Cart::where('user_id', Auth::id())->delete();

        return redirect()->route('cart.index')->with('success', 'Keranjang berhasil dikosongkan.');
    }
}
