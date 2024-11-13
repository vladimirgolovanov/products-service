<?php

namespace Database\Factories;

use App\Models\Status;
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
        return [
            'name' => $this->faker->name,
            'description' => $this->faker->text,
            'category_id' => \App\Models\Category::factory(),
            'status_id' => Status::APPROVED,
            'country_id' => \App\Models\Country::factory(),
            'user_id' => \App\Models\User::factory(),
        ];
    }
}
