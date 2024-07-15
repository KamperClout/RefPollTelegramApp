<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ClientsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $userId = DB::table('users')->where('phone', '+79173334444')->first()->id;

        $phone = 917555222;

        for ($i = 1; $i <= 5; $i++) {
            DB::table('clients')->insert([
                'name' => 'Клиент ' . $i,
                'surname' => 'Фамилия ' . $i,
                'patronymic' => 'Отчество ' . $i,
                'region' => 'Россия, (Саратов)',
                'deposit' => true,
                'debt_amount' => 10000.00,
                'phone' => '+7' . $phone,
                'is_payment' => false,
                'user_id' => $userId,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
            $phone+=1;
        }
    }
}
