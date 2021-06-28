<?php

namespace Database\Seeders;

use App\Models\Addresses;
use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::factory()
            ->has(Addresses::factory())
            ->count(5)
            ->create();
//        $user = User::factory(5)->create();
//        Addresses::factory()->count(5)->for($user)->create();
    }
}
