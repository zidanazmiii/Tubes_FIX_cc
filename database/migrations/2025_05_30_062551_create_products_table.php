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
        Schema::create('products', function (Blueprint $table) {
            $table->id(); // Primary key, auto-increment
            $table->string('name'); // Nama kue
            $table->string('slug')->unique(); // Untuk URL yang ramah SEO
            $table->text('description'); // Deskripsi lengkap kue
            $table->decimal('price', 10, 2); // Harga kue, misal 10 digit total, 2 digit desimal
            $table->string('image')->nullable(); // Path atau URL ke gambar kue
            $table->timestamps(); // Kolom created_at dan updated_at
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
};
