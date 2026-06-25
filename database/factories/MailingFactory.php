<?php

namespace Database\Factories;

use App\MailingStatus;
use App\Models\Lead;
use App\Models\Mailing;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Mailing>
 */
class MailingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        return [
            'subject' => $this->faker->sentence(),
            'body' => $this->faker->paragraph(),
            'status' => $this->faker->randomElement(MailingStatus::cases()),
            'email_from' => $this->faker->email(),
            // 1000 recipients
            'recipients' => $this->faker->randomElements([Lead::factory()->create()->id, Lead::factory()->create()->id, Lead::factory()->create()->id], 3),
        ];
    }
}
