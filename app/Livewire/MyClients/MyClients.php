<?php

namespace App\Livewire\MyClients;

use App\Models\Client;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class MyClients extends Component
{
    use WithPagination;
    public $search = '';

    public function render()
    {
        $user = Auth::user();
        $clients = Client::where('user_id', $user->id)
            ->where(function ($query) {
                $query->where('name', 'like', '%'.$this->search.'%')
                    ->orWhere('surname', 'like', '%'.$this->search.'%')
                    ->orWhere('patronymic', 'like', '%'.$this->search.'%')
                    ->orWhere('phone', 'like', '%'.$this->search.'%');
            })
            ->paginate(10);
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
