<?php

namespace Database\Seeders;

use App\Models\Sensor;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SensorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = \Faker\Factory::create('id_ID');
        for($i=0; $i < 2; $i++){
            Sensor::create([
                'suhu' => $faker->randomFloat(2, -20, 40), // Random float between -20 and 40 for temperature
                'kelembapan' => $faker->randomFloat(2, 0, 100), // Random float between 0 and 100 for humidity
                'api' => $faker->randomLetter(), // Random boolean for flame sensor
                'asap' => $faker->randomDigitNotNull(), // Random boolean for smoke sensor
                'motion' => $faker->randomLetter(), // Random boolean for motion sensor
                'pintu' => $faker->randomLetter(), // Random boolean for door sensor
                'buzzer' => $faker->randomLetter(), // Random boolean for buzzer status
            ]);
        }
    }
}