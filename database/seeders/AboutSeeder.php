<?php

namespace Database\Seeders;

use App\Models\About;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AboutSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        About::create([
            'name' => 'This is about Heading',
            'content' => "Welcome our ecommerce website",
            'text_1' => 'Free Cargo',
            'text_1_content' => 'In our company gives you free cargo',
            'text_2' => 'Free Returns',
            'text_2_content' => 'In our company gives you free returns',
            'text_3' => 'Free Support',
            'text_3_content' => 'In our company gives you free support',
        ]);
    }
}
