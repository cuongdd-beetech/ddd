<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\odel=Customer>
 */
class CustomerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = \App\Models\Customer::class;
    public function definition()
    {
        return [
            'email' => $this->faker->email(),
            'phone' => $this->faker->phoneNumber(11),
            'birthday' => $this->faker->date(),
            'full_name' => $this->faker->name(),
            'password' => password_hash("dinhcuong", PASSWORD_DEFAULT),
            'reset_password' => password_hash("dinhcuong", PASSWORD_DEFAULT),
            'address' => $this->faker->address(),
            'province_id' => $this->faker->numberBetween(1,96),
            'status'=> $this->faker->numberBetween(0, 1),
            'flag_delete' => $this->faker->numberBetween(0, 1),
        ];
    }
}
