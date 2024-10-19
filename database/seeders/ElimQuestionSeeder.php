<?php

namespace Database\Seeders;

use App\Models\ElimQuestions;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ElimQuestionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $elimQuestions = [
            [
                'question' => 'Seorang anak kecil berhitung dari 1 sampai 500 menggunakan jari. Di jari mana ia berhenti?',
                'choice_1' => 'Ibu jari',
                'choice_2' => 'Telunjuk',
                'choice_3' => 'Jari tengah',
                'choice_4' => 'Jari manis',
                'answer' => 'Jari manis'
            ],
            [
                'question' => 'Berapa jumlah penimbangan tersedikit yang perlu dilakukan untuk mencari tahu kantong koin palsu?',
                'choice_1' => '1',
                'choice_2' => '2',
                'choice_3' => '3',
                'choice_4' => '4',
                'answer' => '3'
            ],
            [
                'question' => 'Berapa banyak jawaban benar yang berhasil dijawab si anak jika ia tidak mendapat uang sepeser pun?',
                'choice_1' => '8',
                'choice_2' => '10',
                'choice_3' => '12',
                'choice_4' => '14',
                'answer' => '10'
            ],
            [
                'question' => 'Jam berapakah Jerome masuk sekolah?',
                'choice_1' => '07:15',
                'choice_2' => '07:20',
                'choice_3' => '07:25',
                'choice_4' => '07:30',
                'answer' => '07:20'
            ],
            [
                'question' => 'Orang ke berapa yang terakhir berdiri dalam lingkaran 100 orang?',
                'choice_1' => '67',
                'choice_2' => '73',
                'choice_3' => '85',
                'choice_4' => '99',
                'answer' => '73'
            ],
            [
                'question' => 'Berapa digit terakhir dari 22024?',
                'choice_1' => '2',
                'choice_2' => '4',
                'choice_3' => '6',
                'choice_4' => '8',
                'answer' => '6'
            ],
            [
                'question' => 'Hari apakah sekarang berdasarkan percakapan singa dan unicorn?',
                'choice_1' => 'Rabu',
                'choice_2' => 'Kamis',
                'choice_3' => 'Jumat',
                'choice_4' => 'Sabtu',
                'answer' => 'Kamis'
            ],
            [
                'question' => 'Pada tanggal berapa Ken dan Liz bertemu di gym?',
                'choice_1' => '15',
                'choice_2' => '17',
                'choice_3' => '19',
                'choice_4' => '21',
                'answer' => '17'
            ]
        ];

        foreach ($elimQuestions as $elimQuestion) {
            ElimQuestions::create($elimQuestion);
        }
    }
}
