<?php

namespace App\Livewire;

use Illuminate\Http\Request;
use Livewire\Component;

class RegisterForm extends Component
{
    public $step = 1;
    public $formData = [];

    public function render()
    {
        return view('livewire.register-form');
    }

    public function nextStep()
    {
        $this->step++;
    }

    public function submit(Request $request)
    {
        $request->validate([
            'file-team-name' => 'required|image',
            'nama-team-name' => 'required|string|max:255',
            'password-name' => 'required|string|min:8|confirmed',
        ]);
    }
}
