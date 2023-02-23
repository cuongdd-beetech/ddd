<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class ProductCartegoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = \App\Models\ProductCartegory::class;
    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            'parent_id' => $this->faker->numberBetween(0, 100),
        ];
    }
}
