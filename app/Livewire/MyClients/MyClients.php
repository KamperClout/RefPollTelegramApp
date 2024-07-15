<?php

namespace App\Livewire\MyClients;

use App\Livewire\Forms\ClientForm;
use App\Models\Client;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class MyClients extends Component
{
    public ClientForm $form;
    public $search = '';
    public $clients;
    public $paidCount = 0;
    public $unpaidCount = 0;
    public $showForm = false;

    public function addClient()
    {
        $user = Auth::user();
        $this->form->addClient($user->id);
        $query = Client::where('user_id', $user->id);
        $this->clients = $query->get();
        $this->paidCount = Client::where('user_id', $user->id)->where('is_payment', true)->count();
        $this->unpaidCount = Client::where('user_id', $user->id)->where('is_payment', false)->count();
        $this->showForm = false;
    }

    public function openForm()
    {
        $this->showForm = true;
    }

    public function closeForm()
    {
        $this->showForm = false;
    }

    public function render()
    {
        $user = Auth::user();
        $query = Client::where('user_id', $user->id);

        if (!empty($this->search)) {
            $query->where(function($q) {
                $q->where('phone', 'like', '%' . $this->search . '%');
            });
        }

        $this->clients = $query->get();
        $this->paidCount = Client::where('user_id', $user->id)->where('is_payment', true)->count();
        $this->unpaidCount = Client::where('user_id', $user->id)->where('is_payment', false)->count();
        return view('livewire.my-clients.my-clients', [
            'clients' => $this->clients,
            'paidCount' => $this->paidCount,
            'unpaidCount' => $this->unpaidCount,
            'userId' => $user->id,]);
    }
}
