<?php

namespace App\Livewire\RecoveryAccount;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\Attributes\Rule;
use Livewire\Component;

class RecoveryAccount extends Component
{
    public $step = 1;
    public $hiddenSmsCode = '';
    #[Rule('required|string')]
    public $phone;
    #[Rule('required|digits:6')]
    public $smsCode;

    public function sendSms()
    {
        $this->validateOnly('phone');

        $user = User::where('phone', $this->phone)->first();
        if (!$user){
            $this->reset('phone', 'smsCode');

            session()->flash('error', 'Вы не зарегистрированы');

            return;
        }

        $this->hiddenSmsCode=$this->generateSmsCode();

        $this->step = 2;
    }

    public function verifySms()
    {
        $this->smsCode=$this->hiddenSmsCode; // В будущем можно добавить отправку настоящих SMS, не нашёл бесплатных сервисов
        if ($this->hiddenSmsCode==$this->smsCode){
            $this->validateOnly('smsCode');

            $newPassword=$this->generatePassword();

            $this->updatePassword($this->phone,$newPassword);

            $this->step = 1;

            $this->hiddenSmsCode = '';

            session()->flash('message', 'Аккаунт восстановлен успешно! Ваш новый пароль: ' . $newPassword);
        }
        else{
            $this->step = 1;

            $this->hiddenSmsCode = '';

            session()->flash('error', 'Вы ввели не тот СМС');
        }

        $this->reset('phone', 'smsCode');
    }

    public function updatePassword($phone, $newPassword)
    {
        $user = User::where('phone', $phone)->first();
        if ($user) {
            $user->password = Hash::make($newPassword);
            $user->save();
        }
        else {
            $this->step = 1;

            session()->flash('error', 'Вы не зарегистрированы');
        }
    }

    public function generatePassword($length = 10) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $password = '';

        $charLength = strlen($characters);

        for ($i = 0; $i < $length; $i++) {
            $password .= $characters[rand(0, $charLength - 1)];
        }

        return $password;
    }

    public function generateSmsCode($length = 6){
        $characters = '0123456789';
        $smsCode = '';

        $charLength = strlen($characters);

        for ($i = 0; $i < $length; $i++) {
            $smsCode .= $characters[rand(0, $charLength - 1)];
        }

        return $smsCode;
    }

    public function render()
    {
        return view('livewire.recovery-account.recovery-account');
    }
}
