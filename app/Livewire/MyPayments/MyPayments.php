<?php

namespace App\Livewire\MyPayments;

use App\Models\Agent;
use League\Csv\Exception;
use Livewire\Attributes\Validate;
use Livewire\Component;

class MyPayments extends Component
{
    public $balance;
    public $id;
    public $agent;
    public $transactions;

    public $showPopup = false;


    public function mount()
    {
        $this->id = session()->get('agent_id');
        session(['agent_id'=>$this->id]);
        $this->agent = Agent::find($this->id);
        $this->balance = $this->agent->getBalance();
        $this->transactions = $this->agent->wallet->transactions;
    }

    #[Validate(
        'required|string|min:13|max:19',
        message: 'Введите корректный номер карты (13-19 цифр)'
    )]
    public string $cardNumber = '';

    #[Validate('required|numeric|min:100', message: 'Минимальная сумма 100')]
    public $amount = '';

    public $showModal = false;

    public function openModal()
    {
        $this->showModal = true;
    }

    public function closeModal()
    {
        $this->showModal = false;
        $this->reset(['cardNumber', 'amount']);
    }

    public function withdraw()
    {
        $this->validate();

        try{
            $this->agent->wallet->withdraw($this->amount,'Вывод средств');
        }catch (\Exception $exception)
        {
            session()->flash('message', 'Недостаточно средств!');
            return;
        }
        $this->redirect(request()->header('Referer'));
        session()->flash('message', 'Средства успешно выведены!');
        $this->closePopup();
    }

    public function openPopup()
    {
        $this->showPopup = true;
    }

    public function closePopup()
    {
        $this->showPopup = false;
    }
    public function showPopup()
    {
        $this->showPopup = true;
    }

    public function render()
    {
        return view('livewire.my-payments.my-payments');
    }
}
