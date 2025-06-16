<?php

namespace App\Livewire;

use App\Models\Agent;
use App\Models\Anketa;
use App\Models\AnsweredAnketa;
use Livewire\Component;

class MyEarnings extends Component
{
    public $progress = 0;
    public $activeTab = 'all'; // Идентификатор активной вкладки
    public $balance;
    public $id;
    public $agent;
    public $level = 1;
    public $anketas;

    public function setActiveTab($tab)
    {
        $this->activeTab = $tab; // Устанавливаем активную вкладку
    }

    public function updateProgress($newProgress)
    {
        $this->progress = $newProgress;
    }
    public function getFilteredAnketasProperty()
    {
        if ($this->activeTab === 'new') {
            $date = now()->subDays(5);
            return $this->anketas->filter(function($anketa) use ($date) {
                return $anketa->created_at >= $date;
            });
        }
        if ($this->activeTab === 'completed') {
            $answeredIds = \App\Models\AnsweredAnketa::where('agent_id', $this->id)->where('is_referral', false)->where('status', 'Рассмотрение')->pluck('anketa_id')->toArray();
            return $this->anketas->filter(function($anketa) use ($answeredIds) {
                return in_array($anketa->id, $answeredIds);
            });
        }
        return $this->anketas;
    }

    public function mount()
    {
        $this->id = session()->get('agent_id');
        session(['agent_id'=>$this->id]);
        $this->agent = Agent::find($this->id);
        $this->balance = $this->agent->getBalance();
        $this->progress = 100 * (($this->agent->answeredCount()%10)/10);
        $this->level = intdiv($this->agent->answeredCount(),10)+1;
        $this->anketas = Anketa::all()->where('is_closed', 0);
    }

    public function render()
    {
        return view('livewire.my-earnings');
    }
}
