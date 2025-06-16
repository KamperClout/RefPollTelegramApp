<?php

namespace App\Livewire\MyProfile;

use App\Models\Agent;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class MyProfile extends Component
{
    public $id;
    public $agent;

    public function mount()
    {
        $this->id = session()->get('agent_id');
        session(['agent_id'=>$this->id]);
        $agent = Agent::find($this->id); 
        $this->agent = $agent;
    }

    public function render()
    {
        return view('livewire.my-profile.my-profile');
    }
}
