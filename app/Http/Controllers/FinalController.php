<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FinalController extends Controller
{
    public function index()
    {
        $data['title'] = "Final";
        $data['words'] = env('SECRET_WORDS');
        return view('final', $data);
    }
}
