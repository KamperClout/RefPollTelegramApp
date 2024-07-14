<?php

namespace App\Livewire\EntranceAccount;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Rule;
use Livewire\Component;

class EntranceAccount extends Component
{
    #[Rule('required|string')]
    public $phone;
    #[Rule('required|string|min:8')]
    public $password;
    #[Rule('required')]
    public $remember = false;

    public function login()
    {
        $this->validate();

        try {
            return $this->findPhoneAndLogin($this->phone);
        } catch (\Exception $e) {
            session()->flash('error', 'Ошибка при входе в аккаунт: ' . $e->getMessage());
        }
    }

    public function findPhoneAndLogin($phone)
    {
        $user = User::where('phone', $phone)->first();
        if (!$this->remember){
            session()->flash('error', 'Вы не согласились остаться в системе');

            $this->reset('phone', 'password', 'remember');
        }
        else if ($user) {
            Auth::login($user);
            return redirect()->intended('/');
        }
        else {
            session()->flash('error', 'Вы ввели неверный номер телефона или пароль');

            $this->reset('phone', 'password', 'remember');
        }
    }

    public function render()
    {
        return view('livewire.entrance-account.entrance-account');
    }
}
