<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $categoryId = [1,2,3,4,5,6,7,8,9];
        $sizeList = ['Small', 'Large', 'Medium', 'XXLarge'];
        $colorList = ['White', 'Red', 'Black', 'Blue', 'Green', 'Yellow', 'Gray', 'Darkblue'];


        return [
            'name' => fake()->name(),
            'category_id' => $categoryId[random_int(1,8)],
            'short_text' => $categoryId[random_int(1,8)]. ' id-ye sahib olan mehsul',
            'price' => random_int(10,500),
            'size' => $sizeList[random_int(0,3)],
            'color' => $colorList[random_int(0,7)],
            'qty' => 5,
            'status' => '1',
            'content' => 'Yazilar ',
        ];
    }
}
