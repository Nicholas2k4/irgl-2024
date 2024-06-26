<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Jadwal;
use Illuminate\Database\Seeder;

class JadwalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $jadwal = [
            [
                'tanggal' => '2024-06-25',
                'start_time' => '09:00:00',
                'end_time' => '11:00:00',
            ],
            [
                'tanggal' => '2024-06-26',
                'start_time' => '13:00:00',
                'end_time' => '15:00:00',
            ],
            [
                'tanggal' => '2024-06-27',
                'start_time' => '10:00:00',
                'end_time' => '12:00:00',
            ],
            [
                'tanggal' => '2024-06-28',
                'start_time' => '14:00:00',
                'end_time' => '16:00:00',
            ],
            [
                'tanggal' => '2024-06-29',
                'start_time' => '09:00:00',
                'end_time' => '11:00:00',
            ],
            [
                'tanggal' => '2024-06-30',
                'start_time' => '13:00:00',
                'end_time' => '15:00:00',
            ],
            [
                'tanggal' => '2024-07-01',
                'start_time' => '10:00:00',
                'end_time' => '12:00:00',
            ],
            [
                'tanggal' => '2024-07-02',
                'start_time' => '14:00:00',
                'end_time' => '16:00:00',
            ],
        ];

        foreach ($jadwal as $data) {
            Jadwal::create($data);
        }
    }
}
