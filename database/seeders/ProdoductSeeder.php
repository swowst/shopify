<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProdoductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Product::create([
            'name' => 'Product test',
            'image' => 'images/cloth_1.jpg',
            'category_id' => 1,
            'short_text' => 'qisa melumat',
            'price' => 90,
            'size' => 'Small',
            'color' => 'white',
            'qty' => 10,
            'status' => '1',
            'content' => 'perfect product'
        ]);

        Product::create([
            'name' => 'Product test 2',
            'image' => 'images/cloth_2.jpg',
            'category_id' => 1,
            'short_text' => 'qisa melumat',
            'price' => 100,
            'size' => 'Large',
            'color' => 'Red',
            'qty' => 3,
            'status' => '1',
            'content' => 'perfect product'
        ]);

        Product::create([
            'name' => 'Product test 3',
            'image' => 'images/cloth_3.jpg',
            'category_id' => 4,
            'short_text' => 'qisa melumat 3',
            'price' => 20,
            'size' => 'Medium',
            'color' => 'Black',
            'qty' => 10,
            'status' => '1',
            'content' => 'perfect product3'
        ]);

        Product::create([
            'name' => 'Product test 4',
            'image' => 'images/shoe_1.jpg',
            'category_id' => 7,
            'short_text' => 'qisa melumat 4',
            'price' => 94,
            'size' => 'XXLarge',
            'color' => 'Blue',
            'qty' => 5,
            'status' => '1',
            'content' => 'perfect product 5'
        ]);
    }
}
