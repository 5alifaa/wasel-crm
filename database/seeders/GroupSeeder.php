<?php

namespace Database\Seeders;

use App\Models\Group;
use Illuminate\Database\Seeder;

class GroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $groups = [
            // Lead Groups
            ['name' => 'New Leads'],
            ['name' => 'Contacted Leads'],
            ['name' => 'Qualified Leads'],
            ['name' => 'Unqualified Leads'],
            ['name' => 'Converted Leads'],
            ['name' => 'Lost Leads'],
        ];

        foreach ($groups as $group) {
            Group::create($group);
        }
    }
}
