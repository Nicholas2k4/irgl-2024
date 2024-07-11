<?php

namespace Database\Seeders;

use App\Models\ElimStatistics;
use App\Models\Team;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class StatisticTeamSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $statistic =[
            [
                'id_team' => Team::where('nama', 'Team A')->first()->id,
            ],
            [
                'id_team' => Team::where('nama', 'Team B')->first()->id,
            ],
            [
                'id_team' => Team::where('nama', 'Team C')->first()->id,
            ],
        ];

        foreach($statistic as $stat){
            ElimStatistics::create($stat);
        }
    }
}
