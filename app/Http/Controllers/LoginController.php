<?php

namespace App\Http\Controllers;

use App\Models\Team;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('login-form');
    }

    public function login(Request $request)
    {
        $request->validate([
            'nama' => 'required|string',
            'password' => 'required|string|min:8',
        ]);

        $team = Team::where('nama', $request->nama)->first();

        if ($team && Hash::check($request->password, $team->password)) {
            Session::put('team_id', $team->id);
            Auth::loginUsingId($team->id);

            session()->flash('message', 'Login successful!');
            return redirect()->intended('/'); // Adjust the route as needed
        } else {
            return redirect()->back()->withErrors(['message' => 'The provided credentials do not match our records.']);
        }
    }
}