<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str; // Untuk generate order number

class Order extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     * Atribut yang dapat diisi secara massal.
     *
     * @var array<string>
     */
    protected $fillable = [
        'user_id',
        'order_number',
        'recipient_name',
        'recipient_phone',
        'shipping_address',
        'postal_code',
        'delivery_option',
        'total_amount',
        'payment_method',
        'payment_status',
        'order_status',
        'notes',
    ];

    /**
     * Boot the model.
     * Menggunakan event 'creating' untuk otomatis membuat order_number.
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($order) {
            if (empty($order->order_number)) {
                // Membuat nomor order unik, contoh: INV-YYYYMMDD-USERID-RANDOMSTRING
                $userIdPart = $order->user_id ? 'U' . $order->user_id : 'GUEST'; // 'U' untuk User ID
                $order->order_number = 'INV-' . now()->format('Ymd') . '-' . $userIdPart . '-' . strtoupper(Str::random(6));
            }
        });
    }

    /**
     * Get the user that placed the order.
     * Mendapatkan pengguna yang melakukan pesanan ini.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the items for the order.
     * Mendapatkan semua item untuk pesanan ini.
     */
    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }

    /**
     * Alias for items() for consistency if preferred.
     * Alias untuk items() untuk konsistensi jika lebih disukai.
     */
    public function orderItems()
    {
        return $this->items();
    }
}
