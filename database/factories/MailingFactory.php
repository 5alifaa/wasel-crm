<?php

namespace Database\Factories;

use App\MailingStatus;
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
            'domain' => $this->faker->randomElement([
                null,
                [['date_conversion', '>', now()->subDays(7)->format('Y-m-d H:i:s')]],
                [['date_conversion', '<', now()->addDays(7)->format('Y-m-d H:i:s')]],
            ]),
        ];
    }
}
