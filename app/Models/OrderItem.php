<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     * Atribut yang dapat diisi secara massal.
     *
     * @var array<string>
     */
    protected $fillable = [
        'order_id',
        'product_id',
        'quantity',
        'price_per_item',
        'sub_total',
    ];

    /**
     * Get the order that owns the item.
     * Mendapatkan pesanan yang memiliki item ini.
     */
    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    /**
     * Get the product associated with the order item.
     * Mendapatkan produk yang terkait dengan item pesanan ini.
     */
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
