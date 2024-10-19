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
        // $this->call(AdminSeeder::class);
        // $this->call(JadwalSeeder::class);
        // $this->call(GameSeeder::class);

        $this->call(TeamSeeder::class);
        // $this->call(StatisticTeamSeeder::class);
        // $this->call(ElimQuestionSeeder::class);
    }
}
