<?php

namespace Database\Factories;

use App\LeadSource;
use App\LeadStatus;
use App\Models\Country;
use App\Models\Lead;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Lead>
 */
class LeadFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $countryCount = Country::count();
        return [
            'name' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
            'phone' => $this->faker->unique()->phoneNumber(),
            'country_id' => $this->faker->numberBetween(1, $countryCount),
            'birth_date' => $this->faker->date(),
            'source' => $this->faker->randomElement(LeadSource::cases()),
            'status' => $this->faker->randomElement(LeadStatus::cases()),
        ];
    }
}
