<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class CountrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $countries = [
            ['name' => 'United States', 'code' => 'US'],
            ['name' => 'Canada', 'code' => 'CA'],
            ['name' => 'United Kingdom', 'code' => 'GB'],
            ['name' => 'Germany', 'code' => 'DE'],
            ['name' => 'France', 'code' => 'FR'],
            ['name' => 'Italy', 'code' => 'IT'],
            ['name' => 'Spain', 'code' => 'ES'],
            ['name' => 'Brazil', 'code' => 'BR'],
            ['name' => 'Egypt', 'code' => 'EG'],
            ['name' => 'South Africa', 'code' => 'ZA'],
            ['name' => 'Saudi Arabia', 'code' => 'SA'],
            ['name' => 'United Arab Emirates', 'code' => 'AE'],
            ['name' => 'India', 'code' => 'IN'],
            ['name' => 'China', 'code' => 'CN'],
        ];

        foreach ($countries as $country) {
            \App\Models\Country::create($country);
        }
    }
}
