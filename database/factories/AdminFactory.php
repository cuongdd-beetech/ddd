<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Admin>
 */
class AdminFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = \App\Models\Admin::class;
    public function definition()
    {
        return [
            'email' => $this->faker->unique()->safeEmail(),
            'user_name' => $this->faker->userName(),
            'birthday' => $this->faker->date(),
            'first_name' => $this->faker->name(),
            'last_name' => $this->faker->name(),
            'status' => $this->faker->numberBetween(0,1),
            'flag_delete' => $this->faker->numberBetween(0,1),
            // 'password'=>'$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',  
            'password' => password_hash("dinhcuong", PASSWORD_DEFAULT)
        ];
    }
}
