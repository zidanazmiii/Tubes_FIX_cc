<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Facades\DB;
// use Illuminate\Support\Str; // Tidak lagi diperlukan jika order_number dihandle model

class CheckoutController extends Controller
{
    /**
     * Display the shipping address form.
     * Menampilkan form alamat pengiriman.
     *
     * @return \Illuminate\View\View|\Illuminate\Http\RedirectResponse
     */
    public function shipping() // PASTIKAN METHOD INI ADA
    {
        $user = Auth::user();
        $cartItemsCount = Cart::where('user_id', $user->id)->count();

        if ($cartItemsCount === 0) {
            return redirect()->route('cart.index')->with('error', 'Keranjang Anda kosong. Silakan tambahkan produk terlebih dahulu.');
        }

        return view('checkout.shipping');
    }

    /**
     * Store the shipping address and proceed to payment selection.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function storeShipping(Request $request)
    {
        $validatedData = $request->validate([
            'recipient_name' => 'required|string|max:255',
            'recipient_phone' => 'required|string|max:20',
            'shipping_address' => 'required|string|max:500',
            'postal_code' => 'required|string|max:10',
            'delivery_option' => 'sometimes|string', // 'sometimes' jika opsional atau default
        ]);

        // Ambil delivery_option atau set default jika tidak ada
        $validatedData['delivery_option'] = $request->input('delivery_option', 'now');


        session(['shipping_details' => $validatedData]);

        return redirect()->route('checkout.payment');
    }

    /**
     * Display the payment method selection page.
     *
     * @return \Illuminate\View\View|\Illuminate\Http\RedirectResponse
     */
    public function payment()
    {
        if (!session()->has('shipping_details')) {
            return redirect()->route('checkout.shipping')->with('error', 'Silakan isi detail pengiriman terlebih dahulu.');
        }

        $user = Auth::user();
        $cartItems = Cart::where('user_id', $user->id)->with('product')->get();
        $totalPrice = 0;
        foreach ($cartItems as $item) {
            $totalPrice += $item->product->price * $item->quantity;
        }

        if ($cartItems->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Keranjang Anda kosong.');
        }

        $shippingDetails = session('shipping_details');

        return view('checkout.payment', [
            'cartItems' => $cartItems,
            'totalPrice' => $totalPrice,
            'shippingDetails' => $shippingDetails
        ]);
    }

    /**
     * Process the payment and create the order.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function processPayment(Request $request)
    {
        $request->validate([
            'payment_method' => 'required|string|in:bank_transfer,cod',
        ]);

        $user = Auth::user();
        $shippingDetails = session('shipping_details');
        $cartItems = Cart::where('user_id', $user->id)->with('product')->get();

        if (!$shippingDetails) {
            return redirect()->route('checkout.shipping')->with('error', 'Detail pengiriman tidak ditemukan. Silakan isi kembali.');
        }
        if ($cartItems->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Keranjang Anda kosong.');
        }

        $totalAmount = 0;
        foreach ($cartItems as $item) {
            $totalAmount += $item->product->price * $item->quantity;
        }

        DB::beginTransaction();

        try {
            $order = Order::create([
                'user_id' => $user->id,
                'recipient_name' => $shippingDetails['recipient_name'],
                'recipient_phone' => $shippingDetails['recipient_phone'],
                'shipping_address' => $shippingDetails['shipping_address'],
                'postal_code' => $shippingDetails['postal_code'],
                'delivery_option' => $shippingDetails['delivery_option'] ?? 'now',
                'total_amount' => $totalAmount,
                'payment_method' => $request->input('payment_method'),
                'payment_status' => $request->input('payment_method') === 'cod' ? 'cod' : 'pending',
                'order_status' => 'pending',
            ]);

            foreach ($cartItems as $item) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $item->product_id,
                    'quantity' => $item->quantity,
                    'price_per_item' => $item->product->price,
                    'sub_total' => $item->product->price * $item->quantity,
                ]);
            }

            Cart::where('user_id', $user->id)->delete();
            session()->forget('shipping_details');

            DB::commit();

            if ($request->input('payment_method') === 'cod') {
                return redirect()->route('checkout.success', $order->id)->with('success_message', 'Pesanan Anda berhasil dibuat! Pembayaran akan dilakukan saat pesanan tiba.');
            }

            return redirect()->route('checkout.uploadProof', $order->id)->with('success_message', 'Pesanan Anda berhasil dibuat! Silakan unggah bukti pembayaran.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('checkout.payment')->with('error', 'Terjadi kesalahan saat memproses pesanan Anda. Silakan coba lagi.');
        }
    }

    /**
     * Display the order success page.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\View\View|\Illuminate\Http\RedirectResponse
     */
    public function success(Order $order)
    {
        if ($order->user_id !== Auth::id()) {
            return redirect()->route('home')->with('error', 'Pesanan tidak ditemukan.');
        }
        $successMessage = session('success_message');
        return view('checkout.success', [
            'order' => $order,
            'successMessage' => $successMessage
        ]);
    }

    /**
     * Display the specified order for the customer.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\View\View
     */
    public function showOrder(Order $order)
    {
        if ($order->user_id !== Auth::id()) {
            abort(404);
        }
        $order->load('items.product');
        return view('orders.show', ['order' => $order]);
    }

    public function uploadProof(Order $order)
    {
        if ($order->user_id !== Auth::id()) {
            return redirect()->route('home')->with('error', 'Pesanan tidak ditemukan.');
        }

        return view('checkout.upload-proof', ['order' => $order]);
    }

    public function storeProof(Request $request, Order $order)
    {
        if ($order->user_id !== Auth::id()) {
            return redirect()->route('home')->with('error', 'Pesanan tidak ditemukan.');
        }

        $request->validate([
            'payment_proof' => 'required|image|mimes:jpeg,png,jpg|max:5120', // Maksimal 5MB
        ]);

        if ($request->hasFile('payment_proof')) {
            $path = $request->file('payment_proof')->store('payment_proofs', 'public');
            $order->payment_proof = $path;
            $order->payment_status = 'paid'; // Ubah status pembayaran menjadi "paid"
            $order->save();
        }

        return redirect()->route('checkout.success', $order->id)->with('success_message', 'Bukti pembayaran berhasil diunggah. Pesanan Anda telah dibayar.');
    }
}
