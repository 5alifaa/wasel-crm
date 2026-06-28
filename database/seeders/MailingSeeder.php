<?php

namespace Database\Seeders;

use App\Models\Mailing;
use Illuminate\Database\Seeder;

class MailingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Mailing::factory(3)->create();
        Mailing::factory(100)->create();
    }
}
