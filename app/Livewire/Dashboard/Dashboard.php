<?php

namespace App\Livewire\Dashboard;

use App\Models\DTO\PaymentDTO;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Dashboard extends Component
{
    public $paymentDTOs = [];
    public $rubles;
    public $copecks;

    public function mount()
    {
        $this->loadPayments();
    }

    public function loadPayments()
    {
        $user = Auth::user();
        $payments = collect();

        foreach ($user->clients as $client) {
            foreach ($client->payments as $clientPayment) {
                $payments->push([
                    'name' => mb_substr($client->name, 0, 1, 'UTF-8') . '.',
                    'surname' => $client->surname,
                    'amount' => number_format($clientPayment->amount, 2, '.', '') . ' ₽',
                    'createdAt' => $clientPayment->created_at->toDateString(), // Форматируем дату
                ]);
            }
        }

        // Группируем платежи по дате
        $this->paymentDTOs = $payments->groupBy('createdAt')->toArray();
    }

    public function render()
    {
        $user = Auth::user();
        $this->rubles = number_format(floor($user->payments), 0, '.', ',');
        $this->copecks = floor(($user->payments - floor($user->payments)) * 100);

//        $this->paymentDTOs = [];
//        foreach ($user->clients as $client) {
//            foreach ($client->payments as $clientPayment) {
//                $this->paymentDTOs[] = [
//                    'name' => mb_substr($client->name, 0, 1, 'UTF-8') . '.',
//                    'surname' => $client->surname,
//                    'amount' => '' . number_format($clientPayment->amount, 2, '.', '') . ' ₽',
//                    'createdAt' => $clientPayment->created_at,
//                ];
//            }
//        }
//        $this->payments =

        return view('livewire.dashboard.dashboard',['rubles' => $user->rubles, 'copecks' => $user->copecks, 'paymentDTOs' => $this->paymentDTOs]);
    }
}
