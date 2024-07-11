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
        $elimQuestions=[
            [
                'question'=>'jawaban-A1 ?',
                'choice_1'=>'A',
                'choice_2'=>'B',
                'choice_3'=>'C',
                'choice_4'=>'D',
                'answer'=>'A'
            ],
            [
                'question'=>'jawaban-A2 ?',
                'choice_1'=>'A',
                'choice_2'=>'B',
                'choice_3'=>'C',
                'choice_4'=>'D',
                'answer'=>'A'
            ],
            [
                'question'=>'jawaban-A3 ?',
                'choice_1'=>'A',
                'choice_2'=>'B',
                'choice_3'=>'C',
                'choice_4'=>'D',
                'answer'=>'A'
            ],
            [
                'question'=>'jawaban-B1 ?',
                'choice_1'=>'A',
                'choice_2'=>'B',
                'choice_3'=>'C',
                'choice_4'=>'D',
                'answer'=>'B'
            ],
        ];
        foreach($elimQuestions as $elimQuestion){
            ElimQuestions::create($elimQuestion);
        }
    }
}
