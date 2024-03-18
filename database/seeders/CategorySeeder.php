<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Slider;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
       $men = Category::create([
            'image' => null,
            'name' => 'Kisi',
            'content' => 'Kisi geyimleri',
            'thumbnail' => null,
            'status' => '1',
            'category_up' => null,
            'slug' => null,
        ]);

         Category::create([
            'image' => null,
            'name' => 'Kisi ayaqqabilari',
            'content' => 'Kisi ayaqqabilari sport ve klassik terzde',
            'thumbnail' => null,
            'status' => '1',
            'category_up' => $men->id,
            'slug' => null,
        ]);

        Category::create([
            'image' => null,
            'name' => 'Kisi salvarlari',
            'content' => 'Kisi salvarlari sport ve klassik terzde',
            'thumbnail' => null,
            'status' => '1',
            'category_up' => $men->id,
            'slug' => null,
        ]);

       $women = Category::create([
            'image' => null,
            'name' => 'Qadin',
            'content' => 'Qadin geyimleri',
            'thumbnail' => null,
            'status' => '1',
            'category_up' => null,
            'slug' => null,
        ]);

        Category::create([
            'image' => null,
            'name' => 'Qadin elbiseleri',
            'content' => 'Qadin elbiseleri istenilen terzde',
            'thumbnail' => null,
            'status' => '1',
            'category_up' => $women->id,
            'slug' => null,
        ]);

        Category::create([
            'image' => null,
            'name' => 'Qadin donlari',
            'content' => 'Qadin donlari istenilen terzde',
            'thumbnail' => null,
            'status' => '1',
            'category_up' => $women->id,
            'slug' => null,
        ]);

       $children =  Category::create([
            'image' => null,
            'name' => 'Usaq ',
            'content' => 'Usaq geyimleri',
            'thumbnail' => null,
            'status' => '1',
            'category_up' => null,
            'slug' => null,
        ]);

        Category::create([
            'image' => null,
            'name' => 'Usaq geyimleri',
            'content' => 'Usaq geyimleri 0-5 yas ucun',
            'thumbnail' => null,
            'status' => '1',
            'category_up' => $children->id,
            'slug' => null,
        ]);

        Category::create([
            'image' => null,
            'name' => 'Usaq ucun salvarlar',
            'content' => 'Usaq ucun salvarlar 0-5 yas ucun',
            'thumbnail' => null,
            'status' => '1',
            'category_up' => $children->id,
            'slug' => null,
        ]);
    }
}
