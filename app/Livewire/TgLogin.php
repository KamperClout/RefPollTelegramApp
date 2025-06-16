<?php

namespace App\Livewire;


use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Livewire\Component;


class TgLogin extends Component
{

    public $data = "empty";


    public function mount()
    {
        $this->data = session()->get('tgUsername');
    }

    public function clearSession()
    {
        session()->flush();
    }

    public function render()
    {

        return view('livewire.tg-login');
    }

}
