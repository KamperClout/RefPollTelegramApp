<?php

namespace App\Livewire\MyClients;

use App\Models\Client;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class MyClients extends Component
{
    public $search = '';

    public function render()
    {
        $user = Auth::user();
        $query = Client::where('user_id', $user->id);

        if (!empty($this->search)) {
            $query->where(function($q) {
                $q->where('phone', 'like', '%' . $this->search . '%');
            });
        }

        $clients = $query->get();
        $paidCount = Client::where('user_id', $user->id)->where('is_payment', true)->count();
        $unpaidCount = Client::where('user_id', $user->id)->where('is_payment', false)->count();
        return view('livewire.my-clients.my-clients', [
            'clients' => $clients,
            'paidCount' => $paidCount,
            'unpaidCount' => $unpaidCount,
            'userId' => $user->id,]);
    }

    public function search()
    {
        $this->resetPage();
    }
}
