<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade'); // Pengguna yang memesan
            $table->string('order_number')->unique(); // Nomor pesanan unik, bisa digenerate
            $table->string('recipient_name'); // Nama penerima
            $table->string('recipient_phone'); // Nomor telepon penerima
            $table->text('shipping_address'); // Alamat lengkap pengiriman
            $table->string('postal_code'); // Kode pos
            $table->string('delivery_option')->default('now'); // Opsi pengiriman
            $table->decimal('total_amount', 12, 2); // Total harga pesanan
            $table->string('payment_method')->nullable(); // Metode pembayaran yang dipilih
            $table->string('payment_status')->default('pending'); // Status pembayaran (pending, paid, failed)
            $table->string('order_status')->default('pending'); // Status pesanan (pending, processing, shipped, delivered, cancelled)
            $table->text('notes')->nullable(); // Catatan tambahan dari pelanggan
            $table->string('payment_proof')->nullable(); // Path bukti pembayaran
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
};
