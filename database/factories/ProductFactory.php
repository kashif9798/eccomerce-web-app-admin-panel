<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Product::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name'          => $this->faker->word,
            'price'         => $this->faker->numberBetween(10,100),
            'img_1'         => $this->faker->randomElement(['1.jpg', '2.jpg', '3.jpg']),
            'img_2'         => $this->faker->randomElement(['1.jpg', '2.jpg', '3.jpg']),
            'img_3'         => $this->faker->randomElement(['1.jpg', '2.jpg', '3.jpg']),
        ];
    }
}
