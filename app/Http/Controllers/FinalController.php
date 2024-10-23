<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FinalController extends Controller
{

    public function game1()
    {
        $data['title'] = "Final Game 1";
        return view('final.game1', $data);
    }
    public function game2()
    {
        $data['title'] = "Final Game 2";
        $data['words'] = env('SECRET_WORDS');
        return view('final.game2', $data);
    }
}
