<?php

namespace Database\Factories;

use App\Models\Item;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ItemFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Item::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->unique()->randomElement(['RTX 3090', 'RTX 3080', 'RX 5600 XT']),
            'description' => $this->faker->paragraph(),
            'price' => $this->faker->randomElement([1000000, 1500000, 3000000, 4000000, 8000000]),
            'stok' => 1,
            'thumbnail' => $this->faker->randomElement([
                'storage/Gigabyte-RX5600XT.png',
                'storage/Gigabyte-RTX3080.png',
                'storage/MSI-RTX3090.png',
                'storage/ROG-RTX3090.png',
                'storage/SapphirePulse-RX5600XT.png'
            ])
        ];
    }
}
