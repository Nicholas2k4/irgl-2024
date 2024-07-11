<?php

namespace Database\Seeders;

use App\Models\ElimGames;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GameSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $games = [
            [
                'game_name' => 'Picopark?',
                'game_link' => 'park',
            ],
            [
                'game_name' => 'Hackersweeper',
                'game_link' => 'sweep',
            ],
            [
                'game_name' => 'Icefire?',
                'game_link' => 'icefire',
            ],
            [
                'game_name' => 'Sudoku',
                'game_link' => 'sudoku',
            ],
            [
                'game_name' => 'Nonogram?',
                'game_link' => 'nonogram',
            ],
            [
                'game_name' => 'Crossy?',
                'game_link' => 'crossy',
            ],
            [
                'game_name' => 'Sacred Data',
                'game_link' => 'sacred',
            ],
            [
                'game_name' => 'Gravity?',
                'game_link' => 'gravity',
            ],
            [
                'game_name' => 'Cyber Slime',
                'game_link' => 'slime',
            ],
            [
                'game_name' => 'Cyber Run',
                'game_link' => 'run',
            ],
            [
                'game_name' => 'Firewalle',
                'game_link' => 'firewalle',
            ],
            [
                'game_name' => 'Right Color?',
                'game_link' => 'right',
            ],
            [
                'game_name' => 'Memory Game?',
                'game_link' => 'memory',
            ],
            [
                'game_name' => 'Fifteen',
                'game_link' => 'fifteen',
            ],
            [
                'game_name' => 'Tavern Fight?',
                'game_link' => 'fight',
            ],
        ];
        
        foreach($games as $game){
            ElimGames::create($game);
        }
    }
}
