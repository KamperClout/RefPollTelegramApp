<?php

namespace App\Livewire;

use App\Models\Agent;
use App\Models\Invite;
use Livewire\Component;

class MyFriends extends Component
{
    public $invited;
    public $id;
    public $agent;
    public $search = '';

    public function mount()
    {
        $this->id = session()->get('agent_id');
        session(['agent_id'=>$this->id]);
        $agent = Agent::find($this->id);
        $this->agent = $agent;
        $this->invited = $agent->invitedAgents();
    }

    public function getReferralLink()
    {
        return "https://t.me/TgAppCreatrixBot/TgAppCreatrix?startapp=inv=" . $this->id;
    }

    public function shareTelegram()
    {
        $link = $this->getReferralLink();
        $message = "Привет! Присоединяйся ко мне в приложении. Вот моя реферальная ссылка: " . $link;
        return "https://t.me/share/url?url=" . urlencode($link) . "&text=" . urlencode($message);
    }

    public function render()
    {
        $invited = $this->agent->invitedAgents();
        if ($this->search) {
            $invited = collect($invited)->filter(function($agent) {
                return str_contains(strtolower($agent->name), strtolower($this->search)) ||
                       str_contains(strtolower($agent->phone), strtolower($this->search));
            });
        }
        $this->invited = $invited;


        return view('livewire.my-friends', [
            'invited' => $invited
        ]);
    }
}
