<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str; // Untuk membuat slug

class Product extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     * Atribut yang dapat diisi secara massal.
     *
     * @var array<string>
     */
    protected $fillable = [
        'name',
        'slug',
        'description',
        'price',
        'image',
    ];

    /**
     * Boot the model.
     * Menggunakan event 'creating' dan 'updating' untuk otomatis membuat atau memperbarui slug dari nama produk.
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($product) {
            if (empty($product->slug)) {
                $product->slug = Str::slug($product->name, '-');
            }
        });

        static::updating(function ($product) {
            // Hanya update slug jika nama berubah DAN (slug kosong ATAU slug lama adalah hasil slug dari nama lama)
            if ($product->isDirty('name')) {
                if (empty($product->slug) || $product->getOriginal('slug') === Str::slug($product->getOriginal('name'), '-')) {
                    $product->slug = Str::slug($product->name, '-');
                }
            }
        });
    }

    /**
     * Get the cart items that include this product.
     * Mendapatkan semua item keranjang yang mencakup produk ini.
     */
    public function carts()
    {
        // Jika Anda menamai model CartItem, ganti Cart::class dengan CartItem::class
        return $this->hasMany(Cart::class);
    }

    /**
     * Get the order items that include this product.
     * Mendapatkan semua item pesanan yang mencakup produk ini.
     */
    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }
}
