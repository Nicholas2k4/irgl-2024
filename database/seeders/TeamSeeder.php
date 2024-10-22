<?php

namespace Database\Seeders;

use App\Models\Team;
use App\Models\SemiStatistic;
use App\Models\ElimStatistics;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class TeamSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Example teams data
        $teams = [
            // [
            //     'nama' => 'Team 1',
            //     'password' => Hash::make('password'), // Plain text password
            //     'link_bukti_tf' => 'https://example.com/bukti_tf_teamA.jpg',
            //     'is_validated' => true,
            //     'id_jadwal' => 61,
            //     'alasan_resched' => null,
            //     'link_bukti_resched' => null,
            // ],[
            //     'nama' => 'Team 2',
            //     'password' => Hash::make('password'), // Plain text password
            //     'link_bukti_tf' => 'https://example.com/bukti_tf_teamB.jpg',
            //     'is_validated' => true,
            //     'id_jadwal' => 61,
            //     'alasan_resched' => null,
            //     'link_bukti_resched' => null,
            // ],[
            //     'nama' => 'Team 3',
            //     'password' => Hash::make('password'), // Plain text password
            //     'link_bukti_tf' => 'https://example.com/bukti_tf_teamC.jpg',
            //     'is_validated' => true,
            //     'id_jadwal' => 61,
            //     'alasan_resched' => null,
            //     'link_bukti_resched' => null,
            // ],[
            //     'nama' => 'Team 4',
            //     'password' => Hash::make('password'), // Plain text password
            //     'link_bukti_tf' => 'https://example.com/bukti_tf_teamD.jpg',
            //     'is_validated' => true,
            //     'id_jadwal' => 61,
            //     'alasan_resched' => null,
            //     'link_bukti_resched' => null,
            // ],[
            //     'nama' => 'Team 5',
            //     'password' => Hash::make('password'), // Plain text password
            //     'link_bukti_tf' => 'https://example.com/bukti_tf_teamE.jpg',
            //     'is_validated' => true,
            //     'id_jadwal' => 61,
            //     'alasan_resched' => null,
            //     'link_bukti_resched' => null,
            // ],[
            //     'nama' => 'Team 6',
            //     'password' => Hash::make('password'), // Plain text password
            //     'link_bukti_tf' => 'https://example.com/bukti_tf_teamF.jpg',
            //     'is_validated' => true,
            //     'id_jadwal' => 61,
            //     'alasan_resched' => null,
            //     'link_bukti_resched' => null,
            // ],[
            //     'nama' => 'Team 7',
            //     'password' => Hash::make('password'), // Plain text password
            //     'link_bukti_tf' => 'https://example.com/bukti_tf_teamG.jpg',
            //     'is_validated' => true,
            //     'id_jadwal' => 61,
            //     'alasan_resched' => null,
            //     'link_bukti_resched' => null,
            // ],[
            //     'nama' => 'Team 8',
            //     'password' => Hash::make('password'), // Plain text password
            //     'link_bukti_tf' => 'https://example.com/bukti_tf_teamH.jpg',
            //     'is_validated' => true,
            //     'id_jadwal' => 61,
            //     'alasan_resched' => null,
            //     'link_bukti_resched' => null,
            // ],[
            //     'nama' => 'Team 9',
            //     'password' => Hash::make('password'), // Plain text password
            //     'link_bukti_tf' => 'https://example.com/bukti_tf_teamI.jpg',
            //     'is_validated' => true,
            //     'id_jadwal' => 61,
            //     'alasan_resched' => null,
            //     'link_bukti_resched' => null,
            // ],[
            //     'nama' => 'Team 10',
            //     'password' => Hash::make('password'), // Plain text password
            //     'link_bukti_tf' => 'https://example.com/bukti_tf_teamJ.jpg',
            //     'is_validated' => true,
            //     'id_jadwal' => 61,
            //     'alasan_resched' => null,
            //     'link_bukti_resched' => null,
            // ],
            [
                'nama' => 'Team 11',
                'password' => Hash::make('password'), // Plain text password
                'link_bukti_tf' => 'https://example.com/bukti_tf_teamJ.jpg',
                'is_validated' => true,
                'id_jadwal' => 61,
                'alasan_resched' => null,
                'link_bukti_resched' => null,
            ]
        ];

        foreach ($teams as $team) {

            // Team::create($team);
            $team = Team::create($team);

            ElimStatistics::create([
                'id_team' => $team->id,
            ]);

            SemiStatistic::create([
                'id_team' => $team->id,
            ]);
        }
    }
}
