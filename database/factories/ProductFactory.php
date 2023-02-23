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
    protected $model = \App\Models\Product::class;
    public function definition()
    {
        return [
            'sku' => $this->faker->unique()->currencyCode(),
            'name' => $this->faker->name(),
            'stock' => $this->faker->numberBetween(1, 100),
            'avatar' => $this->faker->imageUrl(),
            'expired_at' => $this->faker->date(),
            'category_id' => $this->faker->numberBetween(0, 100),
            'flag_delete' => $this->faker->numberBetween(0, 1),
        ];
    }
}
