<?php

namespace App\Livewire;

use Livewire\Component;

class ChooseLogin extends Component
{

    public $data = "empty";

    public function render()
    {
        return view('livewire.choose-login')->layout("components.layouts.app");
    }

    public function goToTg()
    {
        redirect()->route('tg-login');
    }
}
