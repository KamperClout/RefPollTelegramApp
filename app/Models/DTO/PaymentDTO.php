<?php

namespace App\Models\DTO;

class PaymentDTO
{
    public $name;
    public $surname;
    public $amount;
    public $createdAt;

    public function __construct($name, $surname, $amount, $createdAt) {
        $this->name = $name;
        $this->surname = $surname;
        $this->amount = $amount;
        $this->createdAt = $createdAt;
    }
}
