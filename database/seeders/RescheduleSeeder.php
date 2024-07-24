<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Reschedule;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class RescheduleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $teamId = DB::table('teams')->first()->id;
        $log = [
            [
                'id_kelompok' => $teamId, 
                'id_jadwal_awal' => 1,
                'id_jadwal_resched' => 3,
                'alasan' => 'Need more preparation time',
                'bukti' => 'https://example.com/bukti_tf_teamB.jpg',
                'approval' => true,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'id_kelompok' => $teamId,
                'id_jadwal_awal' => 5,
                'id_jadwal_resched' => 2,
                'alasan' => 'Need more preparation time',
                'bukti' => 'https://example.com/bukti_tf_teamA.jpg',
                'approval' => false,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]
        ];

        foreach ($log as $data) {
            Reschedule::create($data);
        }    
    }
}
