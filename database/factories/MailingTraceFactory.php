<?php

namespace Database\Factories;

use App\MailingTraceStatus;
use App\Models\Lead;
use App\Models\Mailing;
use App\Models\MailingTrace;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<MailingTrace>
 */
class MailingTraceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $status = $this->faker->randomElement(MailingTraceStatus::cases());

        return [
            'mailing_id' => Mailing::factory(),
            'lead_id' => Lead::factory(),
            'status' => $status->value,
            'sent_at' => $status === MailingTraceStatus::SENT ? $this->faker->dateTime() : null,
            'error_at' => $status === MailingTraceStatus::ERROR ? $this->faker->dateTime() : null,
        ];
    }
}
