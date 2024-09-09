<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Store;
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
        $name = $this->faker->unique()->word(2,true);
        return [
            'name' => $name,
            'slug' => $name,
            'description' => $this->faker->sentence(20),
            'image' => $this->faker->imageUrl(),
            'price' => $this->faker->randomFloat(1,2,499),
            'compare_price' => $this->faker->randomFloat(1,500,999),
            'category_id' => Category::inRandomOrder()->first()->id,
            'featured' => rand(0,1),
            'stock' => rand(0,100),
            'store_id' => Store::inRandomOrder()->first()->id,
        ];
    }
}
