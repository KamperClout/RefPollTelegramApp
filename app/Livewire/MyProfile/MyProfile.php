<?php

namespace App\Livewire\MyProfile;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class MyProfile extends Component
{
    public function render()
    {
        $user = Auth::user();
        $surname = $user->surname;
        $name = mb_substr($user->name, 0, 1, 'UTF-8') . '.';;
        $patronymic = mb_substr($user->patronymic, 0, 1, 'UTF-8') . '.';
        $test_passed = $user->test_passed;
        return view('livewire.my-profile.my-profile',['surname' => $surname,'name' => $name,'patronymic' => $patronymic,'test_passed' => $test_passed,]);
    }
}
