<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product; // Import model Product
use Illuminate\Http\Request;
// Jika Anda akan menggunakan Form Request untuk validasi:
// use App\Http\Requests\Admin\ProductRequest;
use Illuminate\Support\Facades\Storage; // Untuk menghapus gambar lama saat update/delete
use Illuminate\Support\Str; // Untuk slug jika diperlukan manual

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     * Menampilkan daftar produk.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Mengambil semua produk, bisa dengan paginasi
        $products = Product::orderBy('created_at', 'desc')->paginate(10); // 10 produk per halaman

        return view('admin.products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     * Menampilkan form untuk membuat produk baru.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('admin.products.create');
    }

    /**
     * Store a newly created resource in storage.
     * Menyimpan produk baru ke database.
     *
     * @param  \Illuminate\Http\Request  $request // Ganti dengan ProductRequest jika menggunakan Form Request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request) // Ganti Request dengan ProductRequest jika ada
    {
        // Validasi dasar (lebih baik menggunakan Form Request terpisah)
        $validatedData = $request->validate([
            'name' => 'required|string|max:255|unique:products,name',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:5120', // Maksimal 5MB
        ]);

        $product = new Product();
        $product->name = $validatedData['name'];
        $product->slug = Str::slug($validatedData['name'], '-'); // Buat slug otomatis
        $product->description = $validatedData['description'];
        $product->price = $validatedData['price'];

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('images/products', 'public'); // Simpan di storage/app/public/images/products
            $product->image = $imagePath;
        }

        $product->save();

        return redirect()->route('admin.products.index')->with('success', 'Produk berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     * Menampilkan detail produk spesifik (opsional untuk admin, bisa diskip atau sederhana).
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\View\View
     */
    public function show(Product $product)
    {
        // Biasanya admin tidak butuh halaman show terpisah, bisa langsung edit.
        // Tapi jika dibutuhkan:
        return view('admin.products.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     * Menampilkan form untuk mengedit produk.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\View\View
     */
    public function edit(Product $product)
    {
        return view('admin.products.edit', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     * Memperbarui produk di database.
     *
     * @param  \Illuminate\Http\Request  $request // Ganti dengan ProductRequest jika ada
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Product $product) // Ganti Request dengan ProductRequest
    {
        // Validasi dasar (lebih baik menggunakan Form Request terpisah)
        $validatedData = $request->validate([
            'name' => 'required|string|max:255|unique:products,name,' . $product->id, // Abaikan unique untuk produk ini sendiri
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:5120', // Maksimal 5MB
        ]);

        $product->name = $validatedData['name'];
        // Hanya update slug jika nama berubah DAN (slug kosong ATAU slug lama adalah hasil slug dari nama lama)
        if ($product->isDirty('name')) {
            if (empty($product->slug) || $product->getOriginal('slug') === Str::slug($product->getOriginal('name'), '-')) {
                $product->slug = Str::slug($validatedData['name'], '-');
            }
        }
        $product->description = $validatedData['description'];
        $product->price = $validatedData['price'];

        if ($request->hasFile('image')) {
            // Hapus gambar lama jika ada
            if ($product->image) {
                Storage::disk('public')->delete($product->image);
            }
            // Upload gambar baru
            $imagePath = $request->file('image')->store('images/products', 'public');
            $product->image = $imagePath;
        }

        $product->save();

        return redirect()->route('admin.products.index')->with('success', 'Produk berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     * Menghapus produk dari database.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Product $product)
    {
        // Hapus gambar terkait jika ada
        if ($product->image) {
            Storage::disk('public')->delete($product->image);
        }

        $product->delete();

        return redirect()->route('admin.products.index')->with('success', 'Produk berhasil dihapus.');
    }
}
