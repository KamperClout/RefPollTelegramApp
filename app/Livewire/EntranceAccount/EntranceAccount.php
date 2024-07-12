<?php

namespace App\Livewire\EntranceAccount;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class EntranceAccount extends Component
{
    public $phone;
    public $password;
    public $remember = false;

    protected $rules = [
        'phone' => 'required|string|min:10|max:15',
        'password' => 'required|string|min:6',
    ];

    public function login()
    {
        $this->validate();

        if (Auth::attempt(['phone' => $this->phone, 'password' => $this->password], $this->remember)) {
            return redirect()->intended('dashboard');
        } else {
            session()->flash('error', 'Invalid phone or password');
        }
    }

    public function render()
    {
        return view('livewire.entrance-account.entrance-account');
    }
}
