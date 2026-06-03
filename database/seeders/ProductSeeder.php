<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product; // Import model Product
use Illuminate\Support\Str; // Untuk membuat slug

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $products = [
            [
                'name' => 'Angel Hair Chocolate',
                'description' => 'A unique twist on chocolate inspired by Indonesian sweet nostalgia. This premium Callebaut Ruby Chocolate bar is filled with airy spun sugar also known as angel hair and mixed with crunchy yogurt flavored wheat cereal. Every bite brings a fun surprising texture that melts sweetly in your mouth.',
                'price' => 138000,
                'image' => 'images/products/angel_hair_chocolate.jpg', // Contoh path gambar
            ],
            [
                'name' => 'Red Velvet Cake',
                'description' => 'Classic red velvet cake with a rich cream cheese frosting. Soft, moist, and perfectly balanced sweetness.',
                'price' => 250000,
                'image' => 'images/products/red_velvet_cake.jpg',
            ],
            [
                'name' => 'Blueberry Cheesecake',
                'description' => 'Creamy and smooth cheesecake topped with a generous layer of blueberry compote. A delightful treat for cheesecake lovers.',
                'price' => 185000,
                'image' => 'images/products/blueberry_cheesecake.jpg',
            ],
            [
                'name' => 'Dark Chocolate Truffle',
                'description' => 'Intensely rich dark chocolate truffle cake, perfect for the ultimate chocolate connoisseur. Decadent and satisfying.',
                'price' => 220000,
                'image' => 'images/products/dark_chocolate_truffle.jpg',
            ],
            [
                'name' => 'Strawberry Shortcake',
                'description' => 'Light and airy sponge cake layered with fresh strawberries and whipped cream. A refreshing classic.',
                'price' => 195000,
                'image' => 'images/products/strawberry_shortcake.jpg',
            ],
            [
                'name' => 'Matcha Mille Crepe',
                'description' => 'Delicate layers of crepes infused with premium matcha green tea and light pastry cream. A subtle and elegant dessert.',
                'price' => 210000,
                'image' => 'images/products/matcha_mille_crepe.jpg',
            ],
            [
                'name' => 'Carrot Cake with Walnuts',
                'description' => 'Moist carrot cake packed with freshly grated carrots, crunchy walnuts, and a hint of spice, topped with cream cheese frosting.',
                'price' => 175000,
                'image' => 'images/products/carrot_cake.jpg',
            ],
            [
                'name' => 'Lemon Meringue Tart',
                'description' => 'Tangy lemon curd filling in a buttery shortcrust pastry, topped with fluffy toasted meringue. A perfect balance of sweet and sour.',
                'price' => 160000,
                'image' => 'images/products/lemon_meringue_tart.jpg',
            ],
        ];

        foreach ($products as $productData) {
            Product::create([
                'name' => $productData['name'],
                'slug' => Str::slug($productData['name'], '-'), // Membuat slug otomatis
                'description' => $productData['description'],
                'price' => $productData['price'],
                'image' => $productData['image'], // Pastikan path gambar ini sesuai
            ]);
        }
    }
}
