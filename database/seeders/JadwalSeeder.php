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
            // 21 Okt 2024
            [
                'tanggal' => '2024-10-21',
                'start_time' => '07:00:00',
                'end_time' => '09:00:00',
            ],
            [
                'tanggal' => '2024-10-21',
                'start_time' => '08:00:00',
                'end_time' => '10:00:00',
            ],
            [
                'tanggal' => '2024-10-21',
                'start_time' => '09:00:00',
                'end_time' => '11:00:00',
            ],
            [
                'tanggal' => '2024-10-21',
                'start_time' => '10:00:00',
                'end_time' => '12:00:00',
            ],
            [
                'tanggal' => '2024-10-21',
                'start_time' => '11:00:00',
                'end_time' => '13:00:00',
            ],
            [
                'tanggal' => '2024-10-21',
                'start_time' => '12:00:00',
                'end_time' => '14:00:00',
            ],
            [
                'tanggal' => '2024-10-21',
                'start_time' => '13:00:00',
                'end_time' => '15:00:00',
            ],
            [
                'tanggal' => '2024-10-21',
                'start_time' => '14:00:00',
                'end_time' => '16:00:00',
            ],
            [
                'tanggal' => '2024-10-21',
                'start_time' => '15:00:00',
                'end_time' => '17:00:00',
            ],
            [
                'tanggal' => '2024-10-21',
                'start_time' => '16:00:00',
                'end_time' => '18:00:00',
            ],
            [
                'tanggal' => '2024-10-21',
                'start_time' => '17:00:00',
                'end_time' => '19:00:00',
            ],
            [
                'tanggal' => '2024-10-21',
                'start_time' => '18:00:00',
                'end_time' => '20:00:00',
            ],

            // 22 Okt 2024
            [
                'tanggal' => '2024-10-22',
                'start_time' => '07:00:00',
                'end_time' => '09:00:00',
            ],
            [
                'tanggal' => '2024-10-22',
                'start_time' => '08:00:00',
                'end_time' => '10:00:00',
            ],
            [
                'tanggal' => '2024-10-22',
                'start_time' => '09:00:00',
                'end_time' => '11:00:00',
            ],
            [
                'tanggal' => '2024-10-22',
                'start_time' => '10:00:00',
                'end_time' => '12:00:00',
            ],
            [
                'tanggal' => '2024-10-22',
                'start_time' => '11:00:00',
                'end_time' => '13:00:00',
            ],
            [
                'tanggal' => '2024-10-22',
                'start_time' => '12:00:00',
                'end_time' => '14:00:00',
            ],
            [
                'tanggal' => '2024-10-22',
                'start_time' => '13:00:00',
                'end_time' => '15:00:00',
            ],
            [
                'tanggal' => '2024-10-22',
                'start_time' => '14:00:00',
                'end_time' => '16:00:00',
            ],
            [
                'tanggal' => '2024-10-22',
                'start_time' => '15:00:00',
                'end_time' => '17:00:00',
            ],
            [
                'tanggal' => '2024-10-22',
                'start_time' => '16:00:00',
                'end_time' => '18:00:00',
            ],
            [
                'tanggal' => '2024-10-22',
                'start_time' => '17:00:00',
                'end_time' => '19:00:00',
            ],
            [
                'tanggal' => '2024-10-22',
                'start_time' => '18:00:00',
                'end_time' => '20:00:00',
            ],

            // 23 Okt 2024
            [
                'tanggal' => '2024-10-23',
                'start_time' => '07:00:00',
                'end_time' => '09:00:00',
            ],
            [
                'tanggal' => '2024-10-23',
                'start_time' => '08:00:00',
                'end_time' => '10:00:00',
            ],
            [
                'tanggal' => '2024-10-23',
                'start_time' => '09:00:00',
                'end_time' => '11:00:00',
            ],
            [
                'tanggal' => '2024-10-23',
                'start_time' => '10:00:00',
                'end_time' => '12:00:00',
            ],
            [
                'tanggal' => '2024-10-23',
                'start_time' => '11:00:00',
                'end_time' => '13:00:00',
            ],
            [
                'tanggal' => '2024-10-23',
                'start_time' => '12:00:00',
                'end_time' => '14:00:00',
            ],
            [
                'tanggal' => '2024-10-23',
                'start_time' => '13:00:00',
                'end_time' => '15:00:00',
            ],
            [
                'tanggal' => '2024-10-23',
                'start_time' => '14:00:00',
                'end_time' => '16:00:00',
            ],
            [
                'tanggal' => '2024-10-23',
                'start_time' => '15:00:00',
                'end_time' => '17:00:00',
            ],
            [
                'tanggal' => '2024-10-23',
                'start_time' => '16:00:00',
                'end_time' => '18:00:00',
            ],
            [
                'tanggal' => '2024-10-23',
                'start_time' => '17:00:00',
                'end_time' => '19:00:00',
            ],
            [
                'tanggal' => '2024-10-23',
                'start_time' => '18:00:00',
                'end_time' => '20:00:00',
            ],
        ];

        foreach ($jadwal as $data) {
            Jadwal::create($data);
        }
    }
}
