<?php

namespace Database\Seeders;

use App\Models\ElimStatistics;
use App\Models\SemiStatistic;
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
            [
                'id_team' => Team::where('nama', 'Team D')->first()->id,
            ],
            [
                'id_team' => Team::where('nama', 'Team E')->first()->id,
            ],
            [
                'id_team' => Team::where('nama', 'Team F')->first()->id,
            ],
            [
                'id_team' => Team::where('nama', 'Team G')->first()->id,
            ],
            [
                'id_team' => Team::where('nama', 'Team H')->first()->id,
            ],
            [
                'id_team' => Team::where('nama', 'Team I')->first()->id,
            ],
            [
                'id_team' => Team::where('nama', 'Team J')->first()->id,
            ],
            [
                'id_team' => Team::where('nama', 'Team K')->first()->id,
            ],
            [
                'id_team' => Team::where('nama', 'Team L')->first()->id,
            ],
            [
                'id_team' => Team::where('nama', 'Team M')->first()->id,
            ],
            [
                'id_team' => Team::where('nama', 'Team N')->first()->id,
            ],
            [
                'id_team' => Team::where('nama', 'Team O')->first()->id,
            ],
            [
                'id_team' => Team::where('nama', 'Team P')->first()->id,
            ],
            [
                'id_team' => Team::where('nama', 'Team Q')->first()->id,
            ],
            [
                'id_team' => Team::where('nama', 'Team R')->first()->id,
            ],
            [
                'id_team' => Team::where('nama', 'Team S')->first()->id,
            ],
            [
                'id_team' => Team::where('nama', 'Team T')->first()->id,
            ],
            [
                'id_team' => Team::where('nama', 'Team U')->first()->id,
            ],
            [
                'id_team' => Team::where('nama', 'Team V')->first()->id,
            ],
            [
                'id_team' => Team::where('nama', 'Team W')->first()->id,
            ],
            [
                'id_team' => Team::where('nama', 'Team X')->first()->id,
            ],
            [
                'id_team' => Team::where('nama', 'Team Y')->first()->id,
            ],
            [
                'id_team' => Team::where('nama', 'Team Z')->first()->id,
            ],
        ];

        foreach($statistic as $stat){
            ElimStatistics::create($stat);
            SemiStatistic::create($stat);
        }
    }
}
