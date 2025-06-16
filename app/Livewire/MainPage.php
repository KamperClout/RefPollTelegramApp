<?php

namespace App\Livewire;

use App\Models\Agent;
use App\Models\Invite;
use App\Models\Transaction;
use App\Models\Wallet;
use Livewire\Component;

class MainPage extends Component
{
    public $id;
    public $tgid;
    public $test;
    public $agent;
    public $wallet;
    public $progress;
    public $invitedAgents;
    public $balance;
    public $fromFriends;

    public function clear()
    {
        session()->flush();
    }

    public function addInvites()
    {
        for($i = 6;$i <= 8; $i++)
        {
            $invite = new Invite();
            $invite->inviter_id = 2;
            $invite->invited_id = $i;
            $invite->save();
        }
    }

    public function createWallet()
    {
        $wallet = new Wallet();
        $wallet->agent_id = 10;
        $wallet->save();
    }

    public function deposit()
    {
        $this->wallet->deposit(500, "Тестовое пополнение");
    }

    public function withdraw()
    {
        $this->wallet->withdraw(500, "Тестовое списание");
    }


    public function mount()
    {
        $this->id = session()->get('agent_id');
        session(['agent_id'=>$this->id]);
        $this->tgid = session()->get('tg_id');
        $this->agent = Agent::where("id", $this->id)->first();
        // Проверяем, заблокирован ли агент
        if ($this->agent && $this->agent->is_banned) {
            return redirect()->route('blocked-user');
        }

        $wallet = Wallet::where("agent_id", $this->id)->first();
        if($wallet == null)
        {
            $this->agent->wallet()->create([
                'balance' => 0
            ]);
        }
        $this->progress = $this->agent->answeredCount();
        $this->wallet = $this->agent->wallet;
        $this->fromFriends = $this->wallet->getEarningsFromFriends();

        $this->balance = $this->wallet->balance;
        //$this->invitedAgents = $this->agent->deepInvitedAgents(); //Дебаг
    }

    public function render()
    {
        return view('livewire.main-page');
    }
}
