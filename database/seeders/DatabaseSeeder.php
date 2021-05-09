<?php

namespace Database\Seeders;

use App\Models\NewsletterStatus;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UserSeeder::class);
        $this->call(RegionSeeder::class);
        $this->call(CitySeeder::class);
        $this->call(ContestSeeder::class);
        $this->call(AgeGroupSeeder::class);
        $this->call(ThemeSeeder::class);
        $this->call(ApplicationStatusSeeder::class);
        $this->call(NewsletterStatus::class);
    }
}
