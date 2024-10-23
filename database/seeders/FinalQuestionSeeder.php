<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FinalQuestionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $questions = [
            [
                'question' => 'Kamu memiliki 25 ekor kuda dan hanya 5 lintasan balap. Kamu tidak memiliki alat pengukur waktu, tetapi dapat melakukan balapan untuk mengetahui urutan kuda dalam setiap perlombaan. Berapa jumlah minimum balapan yang diperlukan untuk menemukan 3 kuda tercepat?',
                'answer' => '7',
                'image' => null,
            ],
            [
                'question' => 'Ada 4 orang yang harus menyeberangi jembatan di malam hari. Mereka hanya memiliki satu senter dan jembatan hanya bisa menahan dua orang sekaligus. Setiap orang berjalan dengan kecepatan berbeda: 1 menit, 2 menit, 7 menit, dan 10 menit. Ketika dua orang menyeberang bersama, mereka bergerak dengan kecepatan yang lebih lambat. Bagaimana cara tercepat bagi semua orang untuk menyeberangi jembatan?',
                'answer' => '17',
                'image' => null,
            ],
            [
                'question' => 'Kamu memiliki 80 koin, di antaranya ada satu koin palsu yang lebih ringan dari koin lainnya. Kamu memiliki neraca tanpa bobot untuk melakukan penimbangan. Berapa jumlah minimum penimbangan yang diperlukan untuk menemukan koin palsu?',
                'answer' => '4',
                'image' => null,
            ],
        ];
    }
}
