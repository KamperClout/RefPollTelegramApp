<?php

namespace App\Livewire\Forms;

use App\Models\Client;
use Livewire\Attributes\Rule;
use Livewire\Form;

class ClientForm extends Form
{
    #[Rule('required')]
    public $fio;
    #[Rule('required|string|unique:users,phone')]
    public $phone;
    #[Rule('required')]
    public $region;
    #[Rule('required')]
    public $deposit;
    #[Rule('required')]
    public $debt_amount;

    public function addClient($user_id)
    {
        $this->validate();

        $parts = explode(' ', $this->fio, 3);
        $this->surname = $parts[0] ?? '';
        $this->name = $parts[1] ?? '';
        $this->patronymic = $parts[2] ?? '';

        Client::create(['name' => $this->name,
                'surname' => $this->surname,
                'patronymic' => $this->patronymic,
                'phone' => $this->phone,
                'region' => $this->region,
                'deposit' => $this->deposit,
                'debt_amount' => $this->debt_amount,
                'user_id' => $user_id]);

        $this->reset('fio', 'phone', 'region', 'deposit', 'debt_amount');
    }
}
