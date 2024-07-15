<?php

namespace App\Livewire\Forms;

use App\Models\Client;
use Livewire\Attributes\Rule;
use Livewire\Form;

class ClientForm extends Form
{
    #[Rule('required')]
    public $fio;
    #[Rule(['required', 'string', 'regex:/^\+7\d{10}$/'])]
    public $phone;
    #[Rule('required')]
    public $region;
    #[Rule('required')]
    public $deposit = false;
    #[Rule('required')]
    public $debt_amount;

    public function addClient($user_id)
    {
        $this->validate();

        $parts = explode(' ', $this->fio);
        $parts = array_slice($parts, 0, 3);
        $this->fio = implode(' ', $parts);
        $parts = explode(' ', $this->fio, 3);

        $this->surname = $parts[0] ?? '';
        $this->name = $parts[1] ?? '';
        $this->patronymic = $parts[2] ?? '';

        if ($this->surname=='' || $this->name==''){
            $this->reset('fio', 'phone', 'region', 'deposit', 'debt_amount');
            session()->flash('error', 'Ошибка при создании клиента.');
        }

        try {
            Client::create(['name' => $this->name,
                'surname' => $this->surname,
                'patronymic' => $this->patronymic,
                'phone' => $this->phone,
                'region' => $this->region,
                'deposit' => $this->deposit,
                'debt_amount' => $this->debt_amount,
                'user_id' => $user_id]);

            session()->flash('success', 'Клиент успешно создан.');

            $this->reset('fio', 'phone', 'region', 'deposit', 'debt_amount');
        } catch (\Exception $e) {
            session()->flash('error', 'Ошибка при создании клиента.');
        }
    }

    public function resetFields()
    {
        $this->reset('fio', 'phone', 'region', 'deposit', 'debt_amount');
    }
}
