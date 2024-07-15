<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PaymentsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $clientId = DB::table('clients')->latest('id')->first()->id;

        for ($i = 1; $i <= 5; $i++) {
            DB::table('payments')->insert([
                'client_id' => $clientId,
                'amount' => 10000.00,
                'status' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
