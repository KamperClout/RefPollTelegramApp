<?php

namespace App\Livewire\EntranceAccount;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Rule;
use Livewire\Component;

class EntranceAccount extends Component
{
    #[Rule(['required', 'string', 'regex:/^\+7\d{10}$/'])]
    public $phone;
    #[Rule('required|string|min:8')]
    public $password;
    #[Rule('nullable')]
    public $remember = false;

    public function login()
    {
        $this->validate();

        try {
            return $this->findPhoneAndLogin($this->phone,$this->password,$this->remember);
        } catch (\Exception $e) {
            session()->flash('error', 'Ошибка при входе в аккаунт: ' . $e->getMessage());
        }
    }

    public function findPhoneAndLogin($phone, $password, $remember)
    {
        $user = User::where('phone', $phone)->first();
        if ($user && Auth::attempt(['phone' => $phone, 'password' => $password])) {
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
