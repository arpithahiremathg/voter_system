<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Voter>
 */
class VoterFactory extends Factory
{
    public function definition(): array
    {
        return [
            'first_name' => $this->faker->firstName,
            'last_name' => $this->faker->lastName,
            'dob' => $this->faker->date(),
            'mobile' => $this->faker->unique()->phoneNumber,
            'email' => $this->faker->unique()->safeEmail,
            'address' => $this->faker->address,
            'taluk' => $this->faker->city,
            'district' => $this->faker->city,
            'state' => $this->faker->state,
            'registration_id' => Str::uuid(),
        ];
    }
}
