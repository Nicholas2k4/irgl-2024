<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MarketController extends Controller
{
    public function index()
    {
        return view('admin.market', ['title' => 'Market']);
    }

    public function store(Request $request)
    {
        if ($request['email-qty'] == null) $request['email-qty'] = 0;
        if ($request['encrypt-qty'] == null) $request['encrypt-qty'] = 0;
        if ($request['traffic-qty'] == null) $request['traffic-qty'] = 0;
        if ($request['antivirus-qty'] == null) $request['antivirus-qty'] = 0;
        if ($request['input-qty'] == null) $request['input-qty'] = 0;

        // dd($request);
        $request->validate([
            'team-name' => 'required|string',
            'email-qty' => 'required|integer|min:0',
            'encrypt-qty' => 'required|integer|min:0',
            'traffic-qty' => 'required|integer|min:0',
            'antivirus-qty' => 'required|integer|min:0',
            'input-qty' => 'required|integer|min:0',
        ]);

        return redirect()->route('admin.market')->with('success', 'Team ' . $request['team-name'] . " transactions completed");
    }
}
