<?php

namespace App\Livewire;

use App\Models\Team;
use Livewire\Component;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;

class LoginForm extends Component
{
    public $nama;
    public $password;

    public function render()
    {
        return view('livewire.login-form');
    }

    public function login()
    {
        $this->validate([
            'nama' => 'required|string',
            'password' => 'required|string|min:8',
        ]);

        $team = Team::where('nama', $this->nama)->first();

        if ($team && $team->password === $this->password) {
            Session::put('team_id', $team->id);
            Auth::loginUsingId($team->id); // Use Laravel's auth system

            session()->flash('message', 'Login successful!');
            return redirect()->intended('/'); // Adjust the route as needed
        } else {    
            session()->flash('message', 'The provided credentials do not match our records.');
        }
    }
}
