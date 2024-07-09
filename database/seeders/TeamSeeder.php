<?php

namespace Database\Seeders;

use App\Models\Team;
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
                'nama' => 'Team A',
                'password' => Hash::make('password'), // Plain text password
                'link_bukti_tf' => 'https://example.com/bukti_tf_teamA.jpg',
                'is_validated' => true,
                'id_jadwal' => 1,
                'alasan_resched' => null,
                'link_bukti_resched' => null
            ],
            [
                'nama' => 'Team B',
                'password' => Hash::make('password'), // Plain text password
                'link_bukti_tf' => 'https://example.com/bukti_tf_teamB.jpg',
                'is_validated' => false,
                'id_jadwal' => null,
                'alasan_resched' => null,
                'link_bukti_resched' => null
            ],
            [
                'nama' => 'Team C',
                'password' => Hash::make('password'), // Plain text password
                'link_bukti_tf' => 'https://example.com/bukti_tf_teamC.jpg',
                'is_validated' => true,
                'id_jadwal' => 2,
                'alasan_resched' => null,
                'link_bukti_resched' => null
            ],
            [
                'nama' => 'Team D',
                'password' => Hash::make('password'), // Plain text password
                'link_bukti_tf' => 'https://example.com/bukti_tf_teamD.jpg',
                'is_validated' => false,
                'id_jadwal' => 3,
                'alasan_resched' => null,
                'link_bukti_resched' => null
            ],
            [
                'nama' => 'Team E',
                'password' => Hash::make('password'), // Plain text password
                'link_bukti_tf' => 'https://example.com/bukti_tf_teamE.jpg',
                'is_validated' => true,
                'id_jadwal' => null,
                'alasan_resched' => null,
                'link_bukti_resched' => null
            ],
            [
                'nama' => 'Team F',
                'password' => Hash::make('password'), // Plain text password
                'link_bukti_tf' => 'https://example.com/bukti_tf_teamF.jpg',
                'is_validated' => true,
                'id_jadwal' => 4,
                'alasan_resched' => null,
                'link_bukti_resched' => null
            ],
            [
                'nama' => 'Team G',
                'password' => Hash::make('password'), // Plain text password
                'link_bukti_tf' => 'https://example.com/bukti_tf_teamG.jpg',
                'is_validated' => false,
                'id_jadwal' => 5,
                'alasan_resched' => null,
                'link_bukti_resched' => null
            ],
            [
                'nama' => 'Team H',
                'password' => Hash::make('password'), // Plain text password
                'link_bukti_tf' => 'https://example.com/bukti_tf_teamH.jpg',
                'is_validated' => true,
                'id_jadwal' => 6,
                'alasan_resched' => null,
                'link_bukti_resched' => null
            ],
        ];

        foreach ($teams as $team) {
            Team::create($team);
        }
    }
}
