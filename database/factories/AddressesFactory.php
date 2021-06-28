<?php

namespace Database\Factories;

use App\Models\Addresses;
use App\Models\User;
use Faker\Generator;
use Faker\Provider\id_ID\Address;
use Illuminate\Database\Eloquent\Factories\Factory;

class AddressesFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Addresses::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $fakerPHP = new Generator();
        $fakerPHP->addProvider(new Address($fakerPHP));

        return [
            'city' => $fakerPHP->city,
            'state' => $fakerPHP->state,
            'postalcode' => $fakerPHP->postcode,
            'address' => $fakerPHP->address,
            'user_id' => User::factory()
        ];
    }
}
