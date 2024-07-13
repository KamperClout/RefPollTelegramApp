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
    #[Rule('required')]
    public $phone;
    #[Rule('required')]
    public $password;
    #[Rule('required')]
    public $password_confirmation;

    public function store()
    {
        $this->validate();
        User::create([
            'name' => $this->fio,
            'surname' => $this->fio,
            'patronymic' => $this->fio,
            'region' => $this->region,
            'phone' => $this->phone,
            'password' => Hash::make($this->password),
        ]);
        session()->flash('success', 'Post created successfully.');

        $this->reset('fio','region','phone','password','password_confirmation');
    }

    public function render()
    {
        return view('livewire.create-account.create-account');
    }
}
