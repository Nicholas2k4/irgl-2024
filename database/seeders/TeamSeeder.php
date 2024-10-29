<?php

namespace Database\Seeders;

use App\Models\Team;
use App\Models\SemiStatistic;
use App\Models\ElimStatistics;
use App\Models\FinalStatistic;
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
            [
                'nama' => 'Team 1',
                'password' => Hash::make('password'), // Plain text password
                'link_bukti_tf' => 'https://example.com/bukti_tf_teamA.jpg',
                'is_validated' => true,
                'id_jadwal' => null,
                'alasan_resched' => null,
                'link_bukti_resched' => null,
            ],
            [
                'nama' => 'Team 2',
                'password' => Hash::make('password'), // Plain text password
                'link_bukti_tf' => 'https://example.com/bukti_tf_teamB.jpg',
                'is_validated' => true,
                'id_jadwal' => null,
                'alasan_resched' => null,
                'link_bukti_resched' => null,
            ],
            [
                'nama' => 'Team 3',
                'password' => Hash::make('password'), // Plain text password
                'link_bukti_tf' => 'https://example.com/bukti_tf_teamC.jpg',
                'is_validated' => true,
                'id_jadwal' => null,
                'alasan_resched' => null,
                'link_bukti_resched' => null,
            ],
            [
                'nama' => 'Team 4',
                'password' => Hash::make('password'), // Plain text password
                'link_bukti_tf' => 'https://example.com/bukti_tf_teamD.jpg',
                'is_validated' => true,
                'id_jadwal' => null,
                'alasan_resched' => null,
                'link_bukti_resched' => null,
            ],
            [
                'nama' => 'Team 5',
                'password' => Hash::make('password'), // Plain text password
                'link_bukti_tf' => 'https://example.com/bukti_tf_teamE.jpg',
                'is_validated' => true,
                'id_jadwal' => null,
                'alasan_resched' => null,
                'link_bukti_resched' => null,
            ],
            [
                'nama' => 'Team 6',
                'password' => Hash::make('password'), // Plain text password
                'link_bukti_tf' => 'https://example.com/bukti_tf_teamE.jpg',
                'is_validated' => true,
                'id_jadwal' => null,
                'alasan_resched' => null,
                'link_bukti_resched' => null,
            ],
            [
                'nama' => 'Team 7',
                'password' => Hash::make('password'), // Plain text password
                'link_bukti_tf' => 'https://example.com/bukti_tf_teamE.jpg',
                'is_validated' => true,
                'id_jadwal' => null,
                'alasan_resched' => null,
                'link_bukti_resched' => null,
            ],
            [
                'nama' => 'Team 8',
                'password' => Hash::make('password'), // Plain text password
                'link_bukti_tf' => 'https://example.com/bukti_tf_teamE.jpg',
                'is_validated' => true,
                'id_jadwal' => null,
                'alasan_resched' => null,
                'link_bukti_resched' => null,
            ]
            ,[
                'nama' => 'Team 9',
                'password' => Hash::make('password'), // Plain text password
                'link_bukti_tf' => 'https://example.com/bukti_tf_teamE.jpg',
                'is_validated' => true,
                'id_jadwal' => null,
                'alasan_resched' => null,
                'link_bukti_resched' => null,
            ],
            [
                'nama' => 'Team 10',
                'password' => Hash::make('password'), // Plain text password
                'link_bukti_tf' => 'https://example.com/bukti_tf_teamE.jpg',
                'is_validated' => true,
                'id_jadwal' => null,
                'alasan_resched' => null,
                'link_bukti_resched' => null,
            ]

            // ,[
            //     'nama' => 'Team null',
            //     'password' => Hash::make('password'), // Plain text password
            //     'link_bukti_tf' => 'https://example.com/bukti_tf_teamE.jpg',
            //     'is_validated' => true,
            //     'id_jadwal' => null,
            //     'alasan_resched' => null,
            //     'link_bukti_resched' => null,
            // ]
            // ,[
            //     'nama' => 'Team 12',
            //     'password' => Hash::make('password'), // Plain text password
            //     'link_bukti_tf' => 'https://example.com/bukti_tf_teamE.jpg',
            //     'is_validated' => true,
            //     'id_jadwal' => 1,
            //     'alasan_resched' => null,
            //     'link_bukti_resched' => null,
            // ]
            // ,[
            //     'nama' => 'Team 13',
            //     'password' => Hash::make('password'), // Plain text password
            //     'link_bukti_tf' => 'https://example.com/bukti_tf_teamE.jpg',
            //     'is_validated' => true,
            //     'id_jadwal' => 1,
            //     'alasan_resched' => null,
            //     'link_bukti_resched' => null,
            // ]
            // ,[
            //     'nama' => 'Team 14',
            //     'password' => Hash::make('password'), // Plain text password
            //     'link_bukti_tf' => 'https://example.com/bukti_tf_teamE.jpg',
            //     'is_validated' => true,
            //     'id_jadwal' => 1,
            //     'alasan_resched' => null,
            //     'link_bukti_resched' => null,
            // ]
            // ,[
            //     'nama' => 'Team 15',
            //     'password' => Hash::make('password'), // Plain text password
            //     'link_bukti_tf' => 'https://example.com/bukti_tf_teamE.jpg',
            //     'is_validated' => true,
            //     'id_jadwal' => 1,
            //     'alasan_resched' => null,
            //     'link_bukti_resched' => null,
            // ]
            // ,[
            //     'nama' => 'Team 16',
            //     'password' => Hash::make('password'), // Plain text password
            //     'link_bukti_tf' => 'https://example.com/bukti_tf_teamE.jpg',
            //     'is_validated' => true,
            //     'id_jadwal' => 1,
            //     'alasan_resched' => null,
            //     'link_bukti_resched' => null,
            // ]
            // ,[
            //     'nama' => 'Team 17',
            //     'password' => Hash::make('password'), // Plain text password
            //     'link_bukti_tf' => 'https://example.com/bukti_tf_teamE.jpg',
            //     'is_validated' => true,
            //     'id_jadwal' => 1,
            //     'alasan_resched' => null,
            //     'link_bukti_resched' => null,
            // ]
            // ,[
            //     'nama' => 'Team 18',
            //     'password' => Hash::make('password'), // Plain text password
            //     'link_bukti_tf' => 'https://example.com/bukti_tf_teamE.jpg',
            //     'is_validated' => true,
            //     'id_jadwal' => 1,
            //     'alasan_resched' => null,
            //     'link_bukti_resched' => null,
            // ]
            // ,[
            //     'nama' => 'Team 19',
            //     'password' => Hash::make('password'), // Plain text password
            //     'link_bukti_tf' => 'https://example.com/bukti_tf_teamE.jpg',
            //     'is_validated' => true,
            //     'id_jadwal' => 1,
            //     'alasan_resched' => null,
            //     'link_bukti_resched' => null,
            // ]
            // ,[
            //     'nama' => 'Team 20',
            //     'password' => Hash::make('password'), // Plain text password
            //     'link_bukti_tf' => 'https://example.com/bukti_tf_teamE.jpg',
            //     'is_validated' => true,
            //     'id_jadwal' => 1,
            //     'alasan_resched' => null,
            //     'link_bukti_resched' => null,
            // ]
            ,[
                'nama' => 'Team IT',
                'password' => Hash::make('password'), // Plain text password
                'link_bukti_tf' => 'https://example.com/bukti_tf_teamE.jpg',
                'is_validated' => true,
                'id_jadwal' => 1,
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

            FinalStatistic::create([
                'team_id' => $team->id,
            ]);
        }
    }
}
