<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Voter;
use Faker\Factory as Faker;

class VoterSeeder extends Seeder
{
    public function run(): void
    {
        // Generate 20 fake voter records
        // Voter::factory()->count(20)->create();
        $faker = Faker::create('en_IN'); // Set locale to India

        // Define real Indian states, districts, and taluks
        $locations = [
            'Karnataka' => [
                'Bangalore' => ['Yelahanka', 'Electronic City', 'Malleshwaram'],
                'Mysore' => ['Nanjangud', 'Hunsur', 'T. Narasipura'],
            ],
            'Maharashtra' => [
                'Mumbai' => ['Andheri', 'Bandra', 'Dadar'],
                'Pune' => ['Hinjewadi', 'Shivaji Nagar', 'Kothrud'],
            ],
            'Tamil Nadu' => [
                'Chennai' => ['T. Nagar', 'Adyar', 'Velachery'],
                'Coimbatore' => ['Gandhipuram', 'Peelamedu', 'Singanallur'],
            ],
            'Uttar Pradesh' => [
                'Lucknow' => ['Alambagh', 'Chowk', 'Aminabad'],
                'Kanpur' => ['Kidwai Nagar', 'Swaroop Nagar', 'Arya Nagar'],
            ],
            'West Bengal' => [
                'Kolkata' => ['Salt Lake', 'Dum Dum', 'Howrah'],
                'Durgapur' => ['Bidhannagar', 'Benachity', 'City Centre'],
            ],
            'Gujarat' => [
                'Ahmedabad' => ['Navrangpura', 'Bopal', 'Gota'],
                'Surat' => ['Varachha', 'Adajan', 'Athwalines'],
            ]
        ];

        for ($i = 0; $i < 20; $i++) {
            $state = array_rand($locations); // Pick a random state
            $district = array_rand($locations[$state]); // Pick a random district
            $taluk = $locations[$state][$district][array_rand($locations[$state][$district])]; // Pick a taluk

            Voter::create([
                'first_name' => $faker->firstName,
                'last_name' => $faker->lastName,
                'dob' => $faker->date('Y-m-d', '2002-12-31'),
                'mobile' => $faker->unique()->numerify('##########'),
                'email' => $faker->unique()->safeEmail,
                'address' => $faker->streetAddress . ', ' . $taluk . ', ' . $district . ', ' . $state,
                'taluk' => $taluk,
                'district' => $district,
                'state' => $state,
                'registration_id' => $faker->uuid
            ]);
        }
    }
}
