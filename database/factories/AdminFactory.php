<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class AdminFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name,
            'email'=> $this->faker->unique()->email,
            'username' => $this->faker->unique()->userName,
            'phone' => $this->faker->phoneNumber,
            'password' => Hash::make('password'),
            'super_admin' => $this->faker->boolean,
        ];
    }
}
