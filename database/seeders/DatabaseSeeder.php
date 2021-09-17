<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Faker\Factory as Faker;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create('eur_EUR');

        DB::table('users')->insert([
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('123'),
        ]);
        $reservoirs = ['Caspian Sea', 'Superior', 'Victoria', 'Huron', 'Michigan', 'Tanganyika', 'Baikal'];
        $reservoirsCount = count($reservoirs);
        foreach(range(1, $reservoirsCount) as $_) {
    
            DB::table('reservoirs')->insert([
                'title' =>  $reservoirs[rand(0, count($reservoirs) - 1)],
                'area' => $faker->randomFloat($nbMaxDecimals = 2, $min = 0, $max =400),
                'about' => $faker->text($maxNbChars = 200),

            ]);
        }

         foreach(range(1, $reservoirsCount) as $_) {
            $experience = $faker->numberBetween($min = 1, $max = 15);
            DB::table('members')->insert([
                'name' =>  $faker->firstName(),
                'surname' => $faker->lastName(),
                'live' => $faker->city(),

                'experience' => $experience,
                'registered' => $faker->numberBetween($min = 1, $max = $experience),
                'reservoir_id' => rand(1, count($reservoirs)),
            ]);
        }
        
    }
}
