<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            BusinessSeeder::class,
            AdSeeder::class,
        ]);
        $this->call([
            LeaseSeeder::class,
            ReviewSeeder::class,
            BidSeeder::class,
        ]);
    }
}
