<?php

namespace App\Livewire\Dashboard;

use App\Models\DTO\PaymentDTO;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Dashboard extends Component
{
    public $paymentDTOs = [];
    public $rubles;
    public $copecks;
    public $sortSelected = 'createdAt asc';

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
                    'createdAt' => $clientPayment->created_at->toDateString(),
                ]);
            }
        }

        list($sortField, $sortDirection) = explode(' ', $this->sortSelected);
        if ($sortDirection=='asc'){
            $this->paymentDTOs = $payments->sortBy($sortField)->groupBy('createdAt')->toArray();
        }
        else{
            $this->paymentDTOs = $payments->sortByDesc($sortField)->groupBy('createdAt')->toArray();
        }

    }

    public function formatDate($date)
    {
        $carbonDate = Carbon::parse($date);

        if ($carbonDate->isToday()) {
            return 'Сегодня, ' . $carbonDate->locale('ru')->isoFormat('D MMMM');
        } elseif ($carbonDate->isYesterday()) {
            return 'Вчера, ' . $carbonDate->locale('ru')->isoFormat('D MMMM');
        } else {
            return mb_strtoupper(mb_substr($carbonDate->locale('ru')->isoFormat('dddd, '), 0, 1, 'UTF-8'), 'UTF-8') . mb_substr($carbonDate->locale('ru')->isoFormat('dd, '), 1, 2, 'UTF-8') . $carbonDate->locale('ru')->isoFormat('D MMMM');
        }
    }

    public function sortBy()
    {
        $this->loadPayments();
    }

    public function render()
    {
        $user = Auth::user();
        $this->rubles = number_format(floor($user->payments), 0, '.', ',');
        $this->copecks = floor(($user->payments - floor($user->payments)) * 100);

//        $this->sortBy('createdAtLast');

        return view('livewire.dashboard.dashboard',['rubles' => $user->rubles, 'copecks' => $user->copecks, 'paymentDTOs' => $this->paymentDTOs, 'formatDate' => [$this, 'formatDate'],]);
    }
}
