<?php

namespace Database\Factories;

use App\Models\LeadGroup;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<LeadGroup>
 */
class LeadGroupFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'lead_id' => \App\Models\Lead::factory(),
            'group_id' => \App\Models\Group::factory(),
        ];
    }
}
