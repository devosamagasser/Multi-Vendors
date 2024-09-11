<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Store>
 */
class StoreFactory extends Factory
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
            'cover' => $this->faker->imageUrl(300,300),
            'logo' => $this->faker->imageUrl(800,600),
            'user_id' => $this->faker->unique()->randomElement(User::pluck('id')->toArray()),
        ];
    }
}
