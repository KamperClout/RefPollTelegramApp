<?php

namespace App\Livewire\MyClients;

use App\Livewire\Forms\ClientForm;
use App\Models\AnsweredAnketa;
use App\Models\Client;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class MyClients extends Component
{
    use WithPagination;

    public ClientForm $form;
    public $search = '';
    public $clients;
    public $paidCount = 0;
    public $unpaidCount = 0;
    public $showForm = false;

    public $id;


    public function addClient()
    {
        // $user = Auth::user();
        // $this->form->addClient($user->id);
        // $query = Client::where('user_id', $user->id);
        // $this->clients = $query->get();
        // $this->paidCount = Client::where('user_id', $user->id)->where('is_payment', true)->count();
//$this->unpaidCount = Client::where('user_id', $user->id)->where('is_payment', false)->count();
    }

    public function openForm()
    {
        $this->showForm = true;
    }

    public function closeForm()
    {
        $this->form->resetFields();
        $this->showForm = false;
    }

    public function mount()
    {
        $this->id = session()->get('agent_id');

    }

    public function render()
    {
        $answeredAnketas = AnsweredAnketa::where("agent_id", $this->id)
            ->orderByDesc('created_at')
            ->paginate(10);

        return view('livewire.my-clients.my-clients', [
            'answeredAnketas' => $answeredAnketas
        ]);
    }

    // $this->clients = $query->get();
    // $this->paidCount = Client::where('user_id', $user->id)->where('is_payment', true)->count();
    // $this->unpaidCount = Client::where('user_id', $user->id)->where('is_payment', false)->count();
    //  return view('livewire.my-clients.my-clients', [
    //     'clients' => $this->clients,
//            'unpaidCount' => $this->unpaidCount,
    //   'userId' => $user->id,]);

}
