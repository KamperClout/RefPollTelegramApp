<?php

namespace App\Livewire\Dashboard;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Dashboard extends Component
{
    public function render()
    {
        Auth::logout();
        return view('livewire.dashboard.dashboard');
    }
}
