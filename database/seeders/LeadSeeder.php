<?php

namespace Database\Seeders;

use App\Models\Lead;
use App\Models\LeadGroup;
use Illuminate\Database\Seeder;

class LeadSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Lead::factory(1000)->create();
        LeadGroup::factory(1000)->create();

    }
}
