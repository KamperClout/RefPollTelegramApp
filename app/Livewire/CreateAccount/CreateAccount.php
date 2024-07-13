<?php

namespace App\Livewire\CreateAccount;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\Attributes\Rule;
use Livewire\Component;

class CreateAccount extends Component
{
    #[Rule('required')]
    public $fio;
    #[Rule('required')]
    public $region;
    #[Rule('required|string|unique:users,phone')]
    public $phone;
    #[Rule('required|string|min:8|confirmed')]
    public $password;
    public $password_confirmation;
    #[Rule('nullable')]
    public $is_leave;

    public function store()
    {
        $this->validate();

        $parts = explode(' ', $this->fio, 3);
        $this->surname = $parts[0] ?? '';
        $this->name = $parts[1] ?? '';
        $this->patronymic = $parts[2] ?? '';

        try {
            User::create([
                'name' => $this->name,
                'surname' => $this->surname,
                'patronymic' => $this->patronymic,
                'region' => $this->region,
                'phone' => $this->phone,
                'password' => Hash::make($this->password),
            ]);

            session()->flash('success', 'Пользователь успешно создан.');

            $this->reset('fio', 'region', 'phone', 'password', 'password_confirmation');
        } catch (\Exception $e) {
            session()->flash('error', 'Ошибка при создании пользователя: ' . $e->getMessage());
        }
    }

    public function render()
    {
        return view('livewire.create-account.create-account');
    }
}
