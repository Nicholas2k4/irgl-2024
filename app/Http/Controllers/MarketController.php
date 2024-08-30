<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MarketController extends Controller
{
    public function index(){
        return view('admin.market', ['title' => 'Market']);
    }

    
}
